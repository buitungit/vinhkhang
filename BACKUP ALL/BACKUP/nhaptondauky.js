/**
 * Created by hungd on 10/14/2016.
 */
function typeHeadAll() {
    createTypeHead('.mahang','gethanghoa');
    createTypeHead('.tenhang','gethanghoa');
    createTypeHead('.nhomloaihang','getnhomloaihang');
    createTypeHead('.tendonvitinh','getdvt');
}

$(document).ready(function () {
    $(document).on('click', '#btn-khoitaohang', function (e) {
        var soluonghanghoa = parseInt($("#soluonghanghoa").val(), 10) ;
        var soluongkhoitao = parseInt($("#soluongkhoitao").val(), 10);

        $.ajax({
            url: 'index.php?r=hanghoa/getformtondauky',
            data: {slhang: soluonghanghoa, soluongkhoitao: soluongkhoitao},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                Metronic.blockUI({target: "#form-nhaptondauky"});
            },
            success: function (data) {
                $('#form-nhaptondauky').append(data);
                soluonghanghoa += soluongkhoitao;
                $("#soluonghanghoa").val(soluonghanghoa);
                typeHeadAll();
            },
            complete: function () {
                Metronic.unblockUI("#form-nhaptondauky");
            }
        });

        if($('#btn-save').hasClass('hide'))
            $("#btn-save").removeClass('hide');
    });
    $(document).on('click', '.btn-delete-hanghoa', function (e) {
        if($('#form-nhaptondauky .hanghoa').length == 1)
            alert('Không thể xóa!');
        else
            $(this).parent().parent().remove();
    });
    $(document).on('click', '.btn-delete-dvt', function (e) {
        var row = $(this).parent().parent().parent();
        var sldvt = row.find('.row').length;
        if(sldvt == 1)
            alert("Không thể xóa!");
        else
         $(this).parent().parent().remove();
    });
    $(document).on('click', '.btn-add-dvt', function (e) {
        var row = $(this).parent().parent();
        var hide = row.find('.form-quydoidvt');
        $("#donvitinh-"+hide.val()).append(`<div class="row" style="margin-bottom: 10px">
                                <div class="col-md-3">
                                    <input type="text" class="form-control tendonvitinh" name="donvitinh[`+hide.val()+`][name][]">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control soluong" name="donvitinh[`+hide.val()+`][soluong][]">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control trongso" name="donvitinh[`+hide.val()+`][trongso][]">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="donvitinh[`+hide.val()+`][gianhap][]" value="0" min="1">                                
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="donvitinh[`+hide.val()+`][giaban][]" value="0" min="1">                                
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-warning btn-delete-dvt"><i class="fa fa-minus"></i></button>                                
                                </div>
                            </div>`);
        createTypeHead('.tendonvitinh','getdvt');
    });
    $(document).on('change','.mahang',function () {
        var parent = $(this).parent().parent().parent();
        var tenhang = parent.find('.tenhang');
        var nhomhang = parent.find('.nhomloaihang');
        var donvitinh = parent.find('.form-quydoidvt');
        var stt = donvitinh.val();
        $.ajax({
            url: 'index.php?r=hanghoa/gethangtheoma',
            data: {mahang: $(this).val()},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                tenhang.val(data.name);
                nhomhang.val(data.nhomhang);
                if(data.name !="")
                    tenhang.focus();
                if(data.nhomhang!="")
                    nhomhang.focus();
                /* Xử lý đơn vị tính */
                if(data.donvitinhs.length > 0){
                    $("#donvitinh-"+stt).html("");
                    $.each(data.donvitinhs, function (k, v) {
                        $("#donvitinh-"+stt).append(`<div class="row" style="margin-bottom: 10px">
                                <div class="col-md-3">
                                    <input type="text" class="form-control tendonvitinh" name="donvitinh[`+stt+`][name][]" value="`+v.tendvt+`">
                                </div>
                                 <div class="col-md-2">
                                    <input type="text" class="form-control soluong" name="donvitinh[`+stt+`][soluong][]" value="0">
                                </div>
                                 <div class="col-md-2">
                                    <input type="text" class="form-control trongso" name="donvitinh[`+stt+`][trongso][]" value="`+v.trongso+`">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="donvitinh[`+stt+`][gianhap][]" value="`+v.giamua+`" min="1">                                
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="donvitinh[`+stt+`][giaban][]" value="`+v.giaban+`" min="1">                                
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-warning btn-delete-dvt"><i class="fa fa-minus"></i></button>                                
                                </div>
                            </div>`)
                    });
                    createTypeHead('.tendonvitinh','getdvt');
                }
            }
        });
        typeHeadAll();
    });
    $(document).on('click', '#btn-save', function () {
        $.ajax({
            url: 'index.php?r=hanghoa/nhaptondauky',
            data: $("#form-nhaptondauky *").serializeArray(),
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $(".thongbao").html("");
                Metronic.blockUI({target: "#form-nhaptondauky"});
            },
            success: function (data) {
                $(".thongbao").html(data);
                $("#form-nhaptondauky").html('');
                $("#btn-save").addClass('hide');
            },
            error: function (r1, r2) {
                $(".thongbao").html(r1.responseText);
            },
            complete: function () {
                Metronic.unblockUI("#form-nhaptondauky");
            }
        })
    })
});