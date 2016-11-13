/**
 * Created by hungd on 11/8/2016.
 */
function getThongkeTongquan(tatca, start, end){

    if(tatca)
        var data = {tatca: 'tatca'};
    else
        var data = {tatca: 'theothang', start: start, end: end};
    $.ajax({
        url: 'index.php?r=baocaokho/thongke',
        data: data,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            $("#tondauky").html(data.tondauky);
            $("#nhaphang").html(data.nhaphang);
            $("#xuatkho").html(data.xuatkho);
            $("#thoigian").html(data.thoigian);
        }
    })
}

$(document).ready(function () {
    getThongkeTongquan(true);
    $('#reportrange').daterangepicker({
            opens: (Metronic.isRTL() ? 'left' : 'right'),
            startDate: moment([2016, 9, 1]),
            endDate: moment(),
            minDate: moment([2016, 9, 1]),
            maxDate: '12/31/2029',
            dateLimit: {
                days: 60000
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Tất cả': [moment([2016, 9, 1]).format('DD/MM/YYYY'), moment()],
                'Hôm nay': [moment(), moment()],
                'Hôm qua': [moment().subtract('days', 1), moment().subtract('days', 1)],
                '7 ngày trước': [moment().subtract('days', 6), moment()],
                '30 ngày trước': [moment().subtract('days', 29), moment()],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            buttonClasses: ['btn'],
            applyClass: 'green',
            cancelClass: 'default',
            format: 'DD/MM/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Áp dụng',
                fromLabel: 'Từ',
                toLabel: 'Đến',
                customRangeLabel: 'Tùy chọn',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function (start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }
    );
    //Set the initial state of the picker label
    $('#reportrange span').html(moment([2016, 9, 1]).format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        var start = picker.startDate.format("YYYY-MM-DD");
        var end = picker.endDate.format("YYYY-MM-DD");
        getThongkeTongquan(false, start, end);

        $.pjax.reload({container: "#grid-tonkhotonghop", method: "post", data: {start: start, end: end}});
        // console.log(picker.startDate.format('YYYY-MM-DD'));
        // console.log(picker.endDate.format('YYYY-MM-DD'));
    });


});