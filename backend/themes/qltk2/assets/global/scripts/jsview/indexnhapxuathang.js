/**
 * Created by hungd on 10/29/2016.
 */
$(document).ready(function () {


   $(document).on('click', '.maphieu', function (e) {
       e.preventDefault();
       $.ajax({
           url: 'index.php?r=nhapxuathang/chitiet',
           data: {idhtmlphieu: $(this).attr("id")},
           type: 'post',
           dataType: 'json',
           beforeSend: function () {
               $(".thongbao").html("");
               Metronic.blockUI({target: "#noidungchitiet"});
           },
           success: function (data) {
               $("#noidungchitiet").html(data);
           },
           error: function (r1, r2) {
               $(".thongbao").html(r1.responseText);
           },
           complete: function () {
               Metronic.unblockUI("#noidungchitiet");
           }
       })
   });

    $(document).on('click', '.btn-del', function (e) {
        e.preventDefault();
        if(confirm('Bạn có chắc chắn muốn thực hiện việc này?')){
            $.ajax({
                url: 'index.php?r=nhapxuathang/del',
                data: {idphieu: $(this).val()},
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    $(".thongbao").html('');
                    $("#noidungchitiet").html('<h3 class="text-center text-success">HÃY NHẤP CHUỘT VÀO MÃ PHIẾU ĐỂ XEM CHI TIẾT</h3>');
                    Metronic.blockUI();
                },
                success: function (data) {
                    $(".thongbao").html(data);
                    $.pjax.reload({container: '#grid-phieunhapxuat'});
                },
                error: function (r1, r2) {
                    $(".thongbao").html(r1.responseText);
                },
                complete: function () {
                    Metronic.unblockUI();
                }
            })
        }
    });

    $(document).on('click', '.btn-edit', function (e) {
        window.location = 'index.php?r=nhapxuathang/update&idphieu=' + $(this).val();
    });

    $(document).on('click','.btn-print-phieuxuatkho', function (e) {
        $.ajax({
            url: 'index.php?r=nhapxuathang/inphieuxuathang',
            data: {idxuathang: $(this).val()},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                Metronic.blockUI();
                $(".thongbao").html("");
            },
            success: function (data) {
                $("#print-block").html(data.noidungin).printArea();
            },
            error: function (r1, r2) {
                $(".thongbao").html(r1.responseText);
            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    })
});