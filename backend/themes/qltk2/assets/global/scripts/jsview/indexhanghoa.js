/**
 * Created by hungd on 10/29/2016.
 */
$(document).ready(function () {
    $('#ajaxCrudModal').on('shown.bs.modal', function (e) {
        setTimeout(function () {
            createTypeHead('#hanghoa-donvitinh_id','getdvt');
        }, 0);
    });
});