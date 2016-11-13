/**
 * Created by hungd on 10/2/2016.
 */


$(document).ready(function () {
    $('#ajaxCrudModal').on('shown.bs.modal', function (e) {
        setTimeout(function () {
            createTypeHead('.name-donvitinh','getdvt');
            createTypeHead('#hanghoa-nhomloaihang_id','getnhomloaihang');
        }, 500);
    });

    /*$(document).on('click', '#add-dvt', function (e) {
       e.preventDefault();
        var soluongdvt = $("#soluongdvt").val();
        soluongdvt++;
       $("#dvt-row").append(`<div class="row  no-margin">
    <div class="col-md-6">
        <div class="form-group field-quydoidonvitinh-donvitinh_id required">
            <label class="control-label"></label>
            <input type="text" class="form-control name-donvitinh" name="Quydoidonvitinh[`+soluongdvt+`][donvitinh_id]" placeholder="Tên ĐVT">

            <div class="help-block"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group field-quydoidonvitinh-trongso required">
            <label class="control-label" ></label>
            <input type="number" class="form-control" name="Quydoidonvitinh[`+soluongdvt+`][trongso]" min="0" step="0.1" value="0">

            <div class="help-block"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label"></label>
            <button class="btn btn-danger form-control btn-delete-dvt"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`);
       createTypeHead('.name-donvitinh','getdvt');
        $("#soluongdvt").val(soluongdvt);
   });*/

    $(document).on('click','.btn-delete-dvt', function (e) {
        e.preventDefault();
        $(this).parent().parent().parent().remove();
    });

    $(document).on('click', '#btn-save', function () {
        setTimeout(function () {
            createTypeHead('.name-donvitinh','getdvt');
            createTypeHead('#hanghoa-nhomloaihang_id','getnhomloaihang');
        }, 500);
    })

});