/**
 * Created by hungd on 10/29/2016.
 */

function createTypeHeadKhachHang(id, field) {
    $(id).typeahead({
        source: function (query, process) {
            var states = [];
            return $.get('index.php?r=autocomplete/getkhachhang', { query: query }, function (data) {
                $.each(data, function (i, state) {
                    if(field == 'dienthoai')
                        states.push(state.dienthoai);
                    else
                        states.push(state.name);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            var data = {type: 'khachhang', 'item': item};
            $.ajax({
                url: 'index.php?r=nhacungcapkhachhang/getinfo',
                data: data,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (field, value) {
                        $("#nhacungcapkhachhang-"+field).val(value);
                    })
                }
            })
        }
    });
}

function createTypeHeadSerial(target) {
    var idMe = null;
    $(target).typeahead({
        source: function (query, process) {
            idMe = $(this)[0].$element.context.id;

            var states = [];
            return $.get('index.php?r=autocomplete/gethangfromserial', { query: query }, function (data) {
                $.each(data, function (i, state) {
                    states.push(state.serialnumber);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            var data = {serial: item};
            $.ajax({
                url: 'index.php?r=hanghoa/getrowinfo',
                data: data,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    var soluonginput = parseInt($("#soluongmathang").val(), 10) ;
                    var index = $("#"+idMe).parent().parent().find('button').val();
                    $("#"+idMe).parent().parent().find('.mahang').val(data.ma);
                    $("#"+idMe).parent().parent().find('.tenhang').html(data.name);
                    $("#"+idMe).parent().parent().find('.dvt').html(data.donvitinh_id);
                    $("#"+idMe).parent().parent().find('.cell-dongia').html("<input type='number' name='Chitietxuatnhapkho["+index+"][dongia]' class='form-control dongia' />");
                    $("#"+idMe).parent().parent().find('.cell-soluong').html("<input type='number' name='Chitietxuatnhapkho["+index+"][soluong]' class='form-control soluong' />");

                    var lastMaHang = $(".mahang").last();
                    if(lastMaHang.val() != ""){
                        soluonginput++;
                        $("#soluongmathang").val(soluonginput);
                        var inputTextMahang = '<input type="text" id="chitietxuatnhapkho-'+soluonginput+'-hanghoa_id" class="form-control mahang" name="Chitietxuatnhapkho['+soluonginput+'][hanghoa_id]">';
                        var inputTextSerial = '<input type="text" id="chitietxuatnhapkho-'+soluonginput+'-serialnumber" class="form-control soserial" name="Chitietxuatnhapkho['+soluonginput+'][serialnumber]">';
                        $("#"+idMe).parent().parent().parent().append('<tr><td>'+inputTextMahang+'</td><td>'+inputTextSerial+
                            '</td><td class="tenhang"></td><td class="dvt"></td><td class="cell-dongia"></td><td class="cell-soluong"></td><td class="thanhtien"><td class="action text-center">' +
                            '<button type="button" class="btn btn-sm btn-danger btn-remove" value="'+soluonginput+'"><i class="fa fa-trash"></i></button> </td></td></tr>');
                        createTypeHeadSerial('#chitietxuatnhapkho-'+soluonginput+'-serialnumber');
                        createTypeHeadMaHang('#chitietxuatnhapkho-'+soluonginput+'-hanghoa_id');
                    }
                }
            })
        }
    });
}

function createTypeHeadMaHang(target) {
    var idMe = null;
    $(target).typeahead({
        source: function (query, process) {
            idMe = $(this)[0].$element.context.id;

            var states = [];
            return $.get('index.php?r=autocomplete/gethanghoa', { query: query }, function (data) {
                $.each(data, function (i, state) {
                    states.push(state.ma);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            var data = {mahang: item};
            $.ajax({
                url: 'index.php?r=hanghoa/getrowinfo',
                data: data,
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    var soluonginput = parseInt($("#soluongmathang").val(), 10) ;
                    var index = $("#"+idMe).parent().parent().find('button').val();

                    $("#"+idMe).parent().parent().find('.soserial').val("");
                    $("#"+idMe).parent().parent().find('.tenhang').html(data.name);
                    $("#"+idMe).parent().parent().find('.dvt').html(data.donvitinh_id);
                    $("#"+idMe).parent().parent().find('.cell-dongia').html("<input type='number' name='Chitietxuatnhapkho["+index+"][dongia]' class='form-control dongia' />");
                    $("#"+idMe).parent().parent().find('.cell-soluong').html("<input type='number' name='Chitietxuatnhapkho["+index+"][soluong]' class='form-control soluong' />");

                    var lastMaHang = $(".mahang").last();
                    if(lastMaHang.val() != ""){
                        soluonginput++;
                        $("#soluongmathang").val(soluonginput);
                        var inputTextMahang = '<input type="text" id="chitietxuatnhapkho-'+soluonginput+'-hanghoa_id" class="form-control mahang" name="Chitietxuatnhapkho['+soluonginput+'][hanghoa_id]">';
                        var inputTextSerial = '<input type="text" id="chitietxuatnhapkho-'+soluonginput+'-serialnumber" class="form-control soserial" name="Chitietxuatnhapkho['+soluonginput+'][serialnumber]">';

                        $("#"+idMe).parent().parent().parent().append('<tr><td>'+inputTextMahang+'</td><td>'+inputTextSerial+
                            '</td><td class="tenhang"></td><td class="dvt"></td><td class="cell-dongia"></td><td class="cell-soluong"></td><td class="thanhtien"><td class="action text-center">' +
                            '<button type="button" class="btn btn-sm btn-danger btn-remove" value="'+soluonginput+'"><i class="fa fa-trash"></i></button> </td></td></tr>');
                        createTypeHeadSerial('#chitietxuatnhapkho-'+soluonginput+'-serialnumber');
                        createTypeHeadMaHang('#chitietxuatnhapkho-'+soluonginput+'-hanghoa_id');
                    }

                }
            })
        }
    });
}

$(document).ready(function () {

    $("#nhacungcapkhachhang-dienthoai").typeahead({
        source: function (query, process) {
            var states = [];
            return $.get('index.php?r=autocomplete/getkhachhang', { query: query }, function (data) {
                $.each(data, function (i, state) {
                    states.push(state.dienthoai);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            $.ajax({
             url: 'index.php?r=nhacungcapkhachhang/getinfo',
                 data: {type: 'khachhang', dienthoai: item},
                 type: 'post',
                 dataType: 'json',
                 success: function (data) {
                     $.each(data, function (field, value) {
                         $("#nhacungcapkhachhang-"+field).val(value);
                     })
                 }
             })
        }
    });

    $("#nhacungcapkhachhang-name").typeahead({
        source: function (query, process) {
            var states = [];
            return $.get('index.php?r=autocomplete/getkhachhang', { query: query }, function (data) {
                $.each(data, function (i, state) {
                    states.push(state.name);
                });
                return process(states);
            }, 'json');
        },
        afterSelect: function (item) {
            $.ajax({
             url: 'index.php?r=nhacungcapkhachhang/getinfo',
                 data: {type: 'khachhang', dienthoai: item},
                 type: 'post',
                 dataType: 'json',
                 success: function (data) {
                     $.each(data, function (field, value) {
                         $("#nhacungcapkhachhang-"+field).val(value);
                     })
                 }
             })
        }
    });
    
    /*$("#giatritimkiem").change(function () {
        var kieutimkiem = $("#kieutimkiem").val();
        var giatritimkiem = $(this).val();
        var soluongmathang = $("#soluongmathang").val();
        $.ajax({
            url: 'index.php?r=hanghoa/timkiemdathang',
            data: {kieutimkiem: kieutimkiem, giatri: giatritimkiem, soluongmathang: soluongmathang},
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $(".thongbao").html('');
                Metronic.blockUI();
            },
            success: function (data) {
                if(data.timthay){
                    if($("#table-danhsachdathang tbody tr.empty-row").length > 0)
                        $("#table-danhsachdathang tbody").html(data.row);
                    else
                        $("#table-danhsachdathang tbody").append(data.row);
                    soluongmathang++;
                    $("#soluongmathang").val(soluongmathang);
                }
                else
                    $(".thongbao").html(data.message);
            },
            error: function (r1, r2) {
                $(".thongbao").html(r1.responseText);
            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    });*/

    $(document).on('change', '.soluong', function () {
        var soluong = $(this).val();
        var dongia = parseInt($(this).parent().parent().find('.dongia').val(), 10);
        var thanhtien = soluong * dongia;
        $(this).parent().parent().find('.thanhtien').html("<label class='control-label'>"+thanhtien.toLocaleString()+"</label>");
    });

    $(document).on('change', '.dongia', function () {
        var dongia = $(this).val();
        var soluong = parseInt($(this).parent().parent().find('.soluong').val(), 10);
        var thanhtien = soluong * dongia;
        $(this).parent().parent().find('.thanhtien').html("<label class='control-label'>"+thanhtien.toLocaleString()+"</label>");
    });

    $(document).on('click', '.btn-save, .btn-print-save', function (e) {
        e.preventDefault();
        var data = $("#form-khachhang, #form-banhang, #form-hoadon").serializeArray();
        if($(this).hasClass('btn-save'))
            data.push({'name':'type','value':'onlysave'});
        else
            data.push({'name':'type','value':'saveandprint'});
        var me = $(this);
        $.ajax({
            url: 'index.php?r=nhapxuathang/xuatkho',
            data: data,
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                Metronic.blockUI();
                $(".thongbao").html("");
            },
            success: function (data) {
                $("#form-khachhang, #form-hoadon")[0].reset();
                $("#table-danhsachdathang tbody").html('<tr>' +
                    '<td><input type="text" id="chitietxuatnhapkho-0-hanghoa_id" class="form-control mahang" name="Chitietxuatnhapkho[0][hanghoa_id]"></td>' +
                    '<td><input type="text" id="chitietxuatnhapkho-0-serialnumber" class="form-control soserial" name="Chitietxuatnhapkho[0][serialnumber]"></td>' +
                    '<td class="tenhang"></td><td class="dvt"></td> <td class="cell-dongia"></td> <td class="cell-soluong"></td> <td class="thanhtien"></td> <td class="action text-center"> ' +
                    '<button type="button" class="btn btn-sm btn-danger btn-remove"><i class="fa fa-trash"></i></button> ' +
                    '</td> </tr>');
                createTypeHeadMaHang('.mahang');

                $('.thongbao').html(data.message);

                if(me.hasClass('btn-print-save'))
                    $("#print-block").html(data.noiDungIn).printArea();
            },
            error: function (r1, r2) {
                $(".thongbao").html(r1.responseText);
            },
            complete: function () {
                Metronic.unblockUI();
            }
        })
    });

    $(document).on('click', '.btn-remove', function (e) {
        e.preventDefault();
        if($("#table-danhsachdathang tbody tr").length > 1){
            if(confirm("Bạn có chắc chắn muốn xóa thông tin đặt hàng này?"))
                $(this).parent().parent().remove();
        }else
            alert("Phải có ít nhất một mặt hàng được đặt trong hóa đơn!");
    });

    createTypeHeadMaHang('.mahang');
    createTypeHeadSerial('.soserial');
});