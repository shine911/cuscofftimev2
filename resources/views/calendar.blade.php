@extends('layout.app')
@section('title', 'Lịch Nghỉ Bù')
@section('exCSS')
<!-- Fullcalendar IO -->
<link href='vendor/fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='vendor/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='vendor/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='vendor/fullcalendar/packages/list/main.css' rel='stylesheet' />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection
@section('sidebar')

@section('content')

<div class="row">
    <div class="col-12">
        @if (session('status'))
            <div id="status" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                Lịch nghỉ bù
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<!-- Calendar Modal -->
<div id="popupCalendar" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật lịch nghỉ bù</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="#form" action="" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ngay">Ngày
                        </label>
                        <input name="date" type="text" class="form-control" id="ngay" readonly>
                    </div>
                    <div class="form-group">
                        <label>Từ</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="time_start" type="text" class="form-control datetimepicker-input"
                                data-target="#datetimepicker1" />
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Đến</label>
                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input name="time_end" type="text" class="form-control datetimepicker-input"
                                data-target="#datetimepicker2" />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class">Lớp <supper>(*)</supper>
                        </label>
                        <input type="text" name="class" class="form-control" id="lop" placeholder="CP1796H03" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Lí Do <supper>(*)</supper>
                        </label>
                        <input type="text" name="reason" class="form-control" id="lido"
                            placeholder="Có việc bận, bệnh, nghỉ ngơi,..." required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Số Giờ <supper>(*)</supper>
                        </label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Lưu thông tin">
                    <button type="button" id="btnDel" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
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
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js">
</script>

<script>
    $(function(){
        $('#datetimepicker1').datetimepicker({
            format: 'LT',
        });

        $('#datetimepicker2').datetimepicker({
            format: 'LT',
        });
    });

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
            locale: initialLocaleCode,
            dateClick: function (info) {
                $('#popupCalendar').on('show.bs.modal', function (event) {
                    var date = info.dateStr;
                    var modal = $(this);
                    modal.find('form').attr('action', '');
                    modal.find('form').attr('method', 'post');
                    modal.find('.modal-title').text(date);
                    modal.find('#ngay').val(date);
                    modal.find('#btnDel').hide();
                    $('#datetimepicker1').datetimepicker('clear');
                    $('#datetimepicker2').datetimepicker('clear');
                });
                $('#popupCalendar').modal();
            },
            eventClick: function (info) {
                $('#popupCalendar').on('show.bs.modal', function (event) {
                    var event = info.event;
                    var prop = event.extendedProps.properties;
                    var modal = $(this);
                    var objEvent = info.event;
                    var dStart = new Date(objEvent.start);
                    var dEnd = new Date(objEvent.end);
                    var title = dStart.toISOString().slice(0, 10) //Tiêu đề trang 2019-xx-xx
                    modal.find('form').attr('action', '1');
                    modal.find('form').attr('method', 'put');
                    modal.find('.modal-title').text(title);
                    modal.find('#ngay').val(title);
                    $('#datetimepicker1').datetimepicker('date', dStart);
                    $('#datetimepicker2').datetimepicker('date', dEnd);
                    modal.find("#lido").val(prop['reason']); //Truyền lý do từ chuỗi đã cắt
                    modal.find("#lop").val(prop['class']); //Truyền lớp vào chuỗi đã cắt
                    modal.find("#amount").val(prop['amount']);
                    modal.find("#btnSubmit").val("Cập nhật");
                });

                $('#popupCalendar').modal();
            },
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: @json($event)
        });
        calendar.setOption('locale', 'vi');
        calendar.render();
    });

</script>

@endsection
