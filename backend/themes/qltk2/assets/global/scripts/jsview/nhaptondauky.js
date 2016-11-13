/**
 * Created by hungd on 10/29/2016.
 */
function getInfoHanghoa(mahang, parent, myID){
    $.ajax({
        url: 'index.php?r=hanghoa/getinfo',
        data: {mahang: mahang, idHTMLMaHang: myID},
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if(data.slhanghoa > 0){
                parent.find('td .tenhang').val(data.hanghoa.name);
                parent.find('.donvitinh').html('<label class="control-label">'+data.donvitinh+'</label>');
                parent.find('.nhomloaihang').html('<label class="control-label">'+data.nhomloaihang+'</label>');
            }else{
                var donvitinh = parent.find('.donvitinh');
                var nhomloaihang = parent.find('.nhomloaihang');
                donvitinh.html(data.donvitinh);
                nhomloaihang.html(data.nhomloaihang);
                parent.find('td .tenhang').val("");
                createTypeHead("#hanghoa-"+data.index+"-nhomloaihang_id",'getnhomloaihang');
                createTypeHead("#hanghoa-"+data.index+"-donvitinh_id",'getdvt');
            }

        }
    });
}

function createTypeHeadOnIdMaHang(idMaHang, parent){

    $(idMaHang).typeahead({
        source: function (query, process) {
            var states = [];
            return $.get('index.php?r=autocomplete/gethanghoa', { query: query }, function (data) {
                $.each(data, function (i, state) {
                    states.push(state.ma);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            var myID = $(this).attr("id");
            getInfoHanghoa(item, parent, myID);
        }
    });
}

$(document).ready(function () {

    var idphieu = $("#idnhpaxuatkho").val();
    if(idphieu != ""){
        $(".ma-hang").typeahead({
            source: function (query, process) {
                var states = [];
                return $.get('index.php?r=autocomplete/gethanghoa', { query: query }, function (data) {
                    $.each(data, function (i, state) {
                        states.push(state.ma);
                    });
                    return process(states);
                }, 'json');
            }
        });
    }

    $(document).on('change','.ma-hang', function () {
        var parent = $(this).parent().parent();
        var myID = $(this).attr("id");
        // if(typeof parent.find('.donvitinh input').val() == 'undefined')
        getInfoHanghoa($(this).val(), parent, myID);
    });

    $(document).on('click', '#btn-themhang', function () {
        var indexhang = parseInt($("#indexhang").val(),10);
        $.ajax({
            url: 'index.php?r=nhapxuathang/getrownhaptondauky',
            data: {indexhang: indexhang},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $(".thongbao").html('');
                Metronic.blockUI();
            },
            success: function (data) {
                if($("#table-chitietnhaphang tbody tr.empty-row").length > 0)
                    $("#table-chitietnhaphang tbody").html(data);
                else
                    $("#table-chitietnhaphang tbody").append(data);

                var rowOfMaHang = $("#hanghoa-"+indexhang+"-ma").parent().parent();
                createTypeHeadOnIdMaHang("#hanghoa-"+indexhang+"-ma",rowOfMaHang);
                indexhang++;
                $("#indexhang").val(indexhang);
            },
            error: function (r1, r2) {
                $(".thongbao").html(r1.responsiveText);
            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    });

    $(document).on('click','.btn-remove', function () {
        $(this).parent().parent().remove();
    });

    $(document).on('change', '.soluong', function () {
        var soluong = $(this).val();
        var dongia = parseInt($(this).parent().parent().find('.dongia').val());
        var thanhtien = soluong * dongia;
        $(this).parent().parent().find('.thanhtien').html("<label class='control-label'>"+thanhtien.toLocaleString()+"</label>");
    });

    $(document).on('change', '.dongia', function () {
        var dongia = $(this).val();
        var soluong = parseInt($(this).parent().parent().find('.soluong').val());
        var thanhtien = soluong * dongia;
        $(this).parent().parent().find('.thanhtien').html("<label class='control-label'>"+thanhtien.toLocaleString()+"</label>");
    });
    
    $(document).on('click', '.btn-save', function () {
        var data = $("#form-nhapxuatkho, #form-chitietnhaphang").serializeArray();
        $.ajax({
            url: 'index.php?r=nhapxuathang/savetondauky',
            data: data,
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $(".thongbao").html('');
                Metronic.blockUI();
                $(".form-group").removeClass('has-success');
                $(".form-group").removeClass('has-error');
            },
            success: function (data) {

                if($("#idnhpaxuatkho").val() != "")
                    window.location = 'index.php?r=nhapxuathang/index';


                $(".thongbao").html(data.message);

                if(data.error){
                    $.each(data.errors, function (field, message) {
                        $(".field-"+data.class+"-"+field).addClass('has-error');
                        $(".field-"+data.class+"-"+field+" .help-block").html(message);
                    });
                }else{
                    $("#table-chitietnhaphang tbody").html('<tr class="empty-row"><td colspan="10"><h3>CHƯA THÊM MẶT HÀNG NÀO</h3></td></tr>');
                    $("#form-nhapxuatkho")[0].reset();
                    $("#nhapxuatkho-maphieu").val(data.maphieumoi);

                }
            },
            error: function (r1, r2) {
                $(".thongbao").html(r1.responseText);
            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    });
});