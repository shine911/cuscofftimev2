@extends('layout.app')
@section('title', 'Trang chủ')

@section('exCSS')
    <!-- Fullcalendar IO -->
    <link href='vendor/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='vendor/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='vendor/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='vendor/fullcalendar/packages/list/main.css' rel='stylesheet' />
@endsection

@section('sidebar')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lịch nghỉ bù</h6>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Số Giờ Học Trong Tháng</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="singleBarChart"></canvas>
                </div>
                <hr>
                <p> Trong giờ là: G, H, J, K</p>
                <p> Ngoài giờ là: F, M </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Số Giờ Học Trong Tháng</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                </div>
                <hr>
                <p> Trong giờ là: G, H, J, K</p>
                <p> Ngoài giờ là: F, M </p>
            </div>
        </div>
    </div>

    <!-- Thống kê -->
    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thống kê</h6>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="text-primary font-weight-bold">Số Cán Bộ</td>
                                    <td>{{$summary["CanBo"]}}</td>
                                </tr>
                                <tr>
                                        <td class="text-primary font-weight-bold">Số Ngày Nghỉ</td>
                                    <td>{{$summary["NghiBu"]}}</td>
                                </tr>
                                <tr>
                                        <td class="text-primary font-weight-bold">Số Loại Hình</td>
                                        <td>{{$summary["LoaiHinh"]}}</td>
                                </tr>
                                <tr>
                                        <td class="text-primary font-weight-bold">Số Chương Trình</td>
                                        <td>{{$summary["ChuongTrinh"]}}</td>
                                </tr>
                                <tr>
                                        <td class="text-primary font-weight-bold">Số Môn Học</td>
                                        <td>{{$summary["MonHoc"]}}</td>
                                </tr>
                                <tr>
                                        <td class="text-primary font-weight-bold">Số Lớp Học</td>
                                        <td>{{$summary["Lop"]}}</td>
                                </tr>
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>

<!-- Calendar Modal -->
<div id="popupCalendar" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông Tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4"><span class="font-weight-bold">Tên Cán Bộ:</span></div>
                        <div class="col-sm-8"><label id="tenCB"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><span class="font-weight-bold">Lớp:</span></div>
                        <div class="col-sm-8"><label id="lop"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><span class="font-weight-bold">Thời gian nghỉ:</span></div>
                        <div class="col-sm-8"><label id="thoigian"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><span class="font-weight-bold">Ngày nghỉ:</span></div>
                        <div class="col-sm-8"><label id="ngay"></label></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src='vendor/fullcalendar/packages/core/main.js'></script>
<script src='vendor/fullcalendar/packages/interaction/main.js'></script>
<script src='vendor/fullcalendar/packages/daygrid/main.js'></script>
<script src='vendor/fullcalendar/packages/timegrid/main.js'></script>
<script src='vendor/fullcalendar/packages/list/main.js'></script>
<script src='vendor/fullcalendar/packages/core/locales-all.js'></script>
<script src="{{ asset('js/Chart.js') }}"></script>
<script>
window.onload = function () {
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito',
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
// Chart tổng
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ["Trong Giờ", "Ngoài Giờ"],
    datasets: [{
        label: "Tổng số giờ",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: @json($sumGio),
    }],
    },
    options: {
    maintainAspectRatio: false,
    layout: {
        padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
        }
    },
    scales: {
        xAxes: [{
        gridLines: {
            display: false,
            drawBorder: false
        },
        ticks: {
            maxTicksLimit: 6
        },
        maxBarThickness: 25,
        }],
        yAxes: [{
        ticks: {
            min: 0,
            max:  @json(((int)(max($sumGio)/10)+1)*10),
            maxTicksLimit: 5,
            padding: 10
        },
        gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
        }
        }],
    },
    legend: {
        display: false
    },
    tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10
    },
    }
});
//Kết thúc xử lý chart tổng

//Bắt đầu xử lí chart đơn
var ctx = document.getElementById("singleBarChart");
var singleChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: @json($canBoName),
    datasets: [{
        label: "Trong giờ",
        backgroundColor: "green",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: @json($canBoData[0]),
    },{
        label: "Ngoài giờ",
        backgroundColor: "red",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: @json($canBoData[1]),
    }],
    },
    options: {
    maintainAspectRatio: false,
    layout: {
        padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
        }
    },
    scales: {
        xAxes: [{
        gridLines: {
            display: false,
            drawBorder: false
        },
        ticks: {
            maxTicksLimit: 6
        },
        maxBarThickness: 25,
        }],
        yAxes: [{
        ticks: {
            min: 0,
            //Đem chia lấy phần nguyên + 1 rồi nhân 10 vd x = 13 => x/10 được 1 lấy 1 + 1 = 2 * 10 = 20
            max: @json(((int)(max($sumGio)/10)+1)*10),
            maxTicksLimit: 5,
            padding: 10
        },
        gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
        }
        }],
    },
    legend: {
        display: false
    },
    tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10
    },
    }
});
//Kết thúc xử lí chart đơn
}

//Xử lí hiển thị data Event
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var initialLocaleCode = 'vi';
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        eventClick: function (e) {
            $('#popupCalendar').on('show.bs.modal', function (event) {
                var event = e.event;
                var prop = event.extendedProps.properties;
                var modal = $(this);
                //Chinh sua chuoi gio de hien thi
                var dStart = new Date(event.start);
                var dEnd = new Date(event.end);
                //Dinh dang hien thi vd: 13:00 - 14:00
                var thoigian = dStart.toLocaleTimeString('en-GB').slice(0, 5) +
                    "-" + dEnd.toLocaleTimeString(
                        'en-GB').slice(0, 5);
                modal.find("#tenCB").text(event.title);
                modal.find("#lop").text(prop["classroom"]);
                modal.find("#thoigian").text(thoigian);
                modal.find("#ngay").text(dStart.toLocaleDateString('vi-VN'));
            });
            $('#popupCalendar').modal();
        },
        locale: initialLocaleCode,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: @json($event)
    });
    calendar.setOption('locale', 'vi');
    calendar.render();
});
//Kết thúc xử lí dataEvent
</script>
@endsection