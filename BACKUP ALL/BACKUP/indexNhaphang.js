/**
 * Created by hungd on 10/4/2016.
 */

function movieFormatResult(hanghoa) {
    return hanghoa.name;
}

function movieFormatSelection(hanghoa) {
    return hanghoa.name;
}
// ".select2-hanghoa"
function goiNhacHangHoa(target) {
    $(target).select2({
        placeholder: "Nhập tên hàng hoặc mã hàng",
        minimumInputLength: 1,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: "index.php?r=autocomplete/gethanghoa",
            dataType: 'json',
            data: function (term, page) {
                return {
                    q: term, // search term
                    page_limit: 10
                    // apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                };
            },
            results: function (data, page) { // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to alter remote JSON data
                return {
                    results: data
                };
            }
        },
        initSelection: function (element, callback) {
            // the input tag has a value attribute preloaded that points to a preselected movie's id
            // this function resolves that id attribute to an object that select2 can render
            // using its formatResult renderer - that way the movie name is shown preselected
            var id = $(element).val();
            console.log(id);
            /*if (id !== "") {

                $.ajax("http://api.rottentomatoes.com/api/public/v1.0/movies/" + id + ".json", {
                    data: {
                        // apikey: "ju6z9mjyajq2djue3gbvv26t"
                    },
                    dataType: "jsonp"
                }).done(function (data) {
                    callback(data);
                });
            }*/
        },
        formatResult: movieFormatResult, // omitted for brevity, see the source of this page
        formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
        // dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
        escapeMarkup: function (m) {
            return m;
        } // we do not want to escape markup since we are displaying html in results
    }).
        on('change', function (e) {
            var selectionDVT = $(this).parent().parent().parent().find('.dvt-hanghoa');
            var added = e.added;
            var data = $(".select2-hanghoa").serializeArray();
            data.push({name: 'hanghoa', value: added.code});
            $.ajax({
                url: 'index.php?r=hanghoa/getdvt',
                data: data,
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    selectionDVT.empty();
                    selectionDVT.html('<option value="">Chọn ĐVT</option>');
                    Metronic.blockUI({target: '#donvitinh-giaban .portlet-body'});
                },
                success: function (data) {
                    $.each(data.donvitinh, function (k, v) {
                        selectionDVT.append('<option value="'+v.iddonvitinh+'">'+v.tendvt+'</option>')
                    });
                    $("#khung-gia-ban").html(data.dsHangDaChon);
                },
                complete: function () {
                    Metronic.unblockUI("#donvitinh-giaban .portlet-body");
                }
            });
            // console.log("change "+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));
    })
}

$(document).ready(function () {
    setDatePicker();
    goiNhacHangHoa(".select2-hanghoa");
    createTypeHead('#muabanhang-nhacungcap_khachhang_id','getncc',function (item) {
        $.ajax({
                 url: 'index.php?r=autocomplete/getncc',
                 data: {name: item},
                 type: 'post',
                 dataType: 'json',
                 success: function (data) {
                    $("#muabanhang-diachi").val(data.diachi);
                    $("#muabanhang-dienthoai").val(data.dienthoai);
                }
         })
    });

    $(".btn-chonhang").on('click', function (e) {
        e.preventDefault();

        var slhh = $("#soluonghanghoa").val();
        slhh++;
        $("#soluonghanghoa").val(slhh);
        $("#dshanghoa").append(`<div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="hanghoa-`+slhh+`-group">
                        <input type="hidden" id="hanghoa-`+slhh+`" name="Hanghoa[`+slhh+`]" class="form-control select2 select2-hanghoa" placeholder="Chọn hàng">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="quydoidonvitinh-`+slhh+`">
                        <select id="chitietmuaban-`+slhh+`-quydoidonvitinh_id" class="form-control dvt-hanghoa" name="Chitietmuaban[`+slhh+`][quydoidonvitinh_id]"></select>
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" id="chitietmuaban-`+slhh+`-soluong" class="form-control" name="Chitietmuaban[`+slhh+`][soluong]" value="1">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" id="chitietmuaban-`+slhh+`-dongia" class="form-control" name="Chitietmuaban[`+slhh+`][dongia]" value="0">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-delete-hanghoa"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>`);
        goiNhacHangHoa('#hanghoa-'+slhh);
    });
    $(document).on('click','.btn-delete-hanghoa', function (e) {
        e.preventDefault();
        $(this).parent().parent().parent().remove();
    });

    $("#muabanhang-kieuthanhtoan").change(function () {
        // var type = $(this).val();
        // if(type == 'congno')
        //     $("input[name='sotienthanhtoan']").removeAttr('disabled');
        // else if(type == '')
        //     $("input[name='thanhtoanngay']").attr('disabled');

    });
    $("#btn-save").click(function (e) {
        $.ajax({
            url: 'index.php?r=nhaphang/index',
            data: $("#form-nhaphang").serializeArray(),
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                Metronic.blockUI();
                $(".form-group").removeClass('has-error');
                $(".form-group").removeClass('has-success');
                $(".form-group p").html('');
            },
            success: function (data) {
                if(data.type == 'error'){
                    $.each(data.message, function (k, v) {
                        $(".field-muabanhang-"+k).addClass('has-error');
                        $(".field-muabanhang-"+k+" p").html(v);
                    })
                }else if(data.type == 'errorChuanhaphang'){
                    $(".thongbao").html(data.message);
                }else if(data.type == 'errorChonHang'){
                    $.each(data.message, function (k, v) {
                        $("#"+v.id).addClass('has-error');
                        $("#"+v.id+" p").html(v.message);
                    })
                }
            },
            error: function (r1, r2) {

            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    })
});
