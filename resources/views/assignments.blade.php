@extends('layout.app')
@section('title', 'Bảng Phân Công')

@section('exCSS')
    <!-- Datatables CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('sidebar')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Thông tin bảng phân công</h1>
<form class="form-inline mb-4" action="" method="get">
    <div class="form-group mb-2">
        <label for="label" class="sr-only">Tháng</label>
        <input type="text" readonly class="form-control-plaintext" id="label" value="Tháng">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="inputMonth" class="sr-only">Month</label>
        <input type="month" name="thang" class="form-control" id="inputMonth" value="{{$now}}">
    </div>
    <button id="confirm" type="submit" title="Xác nhận" class="btn btn-primary mb-2"><i class="fas fa-check fa-sm fa-fw"></i></button>
    <button id="print" type="button" title="Xuất file" class="btn btn-info ml-2 mb-2"><i class="fas fa-file-excel fa-sm fa-fw"></i></button>
</form>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng phân công</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên CB</th>
                        <th>Môn học</th>
                        <th>Từ ngày</th>
                        <th>Đến ngày</th>
                        <th>Tháng</th>
                        <th>Lớp</th>
                        <th>Số Tiết</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tên CB</th>
                        <th>Môn học</th>
                        <th>Từ ngày</th>
                        <th>Đến ngày</th>
                        <th>Tháng</th>
                        <th>Lớp</th>
                        <th>Số Tiết</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($phanCongCollection as $phanCong)
                    <tr>
                        <td>{{$phanCong->CanBo->TenCB}}</td>
                        <td>{{$phanCong->MonHoc->tenMH}}</td>
                        <td>{{$phanCong->TGBatDau}}</td>
                        <td>{{$phanCong->TGKetThuc}}</td>
                        <td>{{$phanCong->Thang}}</td>
                        <td>{{$phanCong->Lop->tenLop}}</td>
                        <td>{{$phanCong->MonHoc->soTiet}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    // Call the dataTables jQuery plugin
        $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Vietnamese.json"
        },
        "columnDefs": [
                { type: "text", targets: 0 }
            ]
        });
        $('#print').click(function(){
            var month = $('#inputMonth').val();
            window.location.href = 'assignments/export?month='+month;
        });
        });
</script>
@endsection