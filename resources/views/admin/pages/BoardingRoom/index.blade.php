@extends('admin.master.master')

@section('css')

@endsection

@section('content')
    <div class="container">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý /</span> Danh sách phòng trọ
        </h4>

        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Xin chào {{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                                <p class="mb-4">Nhà trọ đang tiếp nhận <span class="fw-bold">7</span> lượt đăng ký thuê mới</p>
                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">Xét duyệt thông tin thuê trọ</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Tổng số người thuê trọ</h5>
                                    <span class="badge bg-label-warning rounded-pill">Năm 2022</span>
                                </div>
                                <div class="mt-sm-auto">
                                    <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> </small>
                                    <h3 class="mb-0">25 người</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Quản lý phòng trọ</h5>
                        <button type="button" class="btn-sm btn-success text-white fw-bold" data-bs-toggle="modal" data-bs-target="#boardingRoomAddModal">Thêm phòng</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="boardingRoomTable" class="display" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Tên phòng</th>
                            <th>Giá thuê phòng/tháng</th>
                            <th>Trạng thái phòng</th>
                            <th>Số người ở hiện tại</th>
                            <th>Còn trống</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roomData as $room)
                            <tr>
                                <td>{{$room->name}}</td>
                                <td>{{convertStringToNumber($room->price)}}đ</td>
                                @if($room->status == 1)
                                    <td>Đang kinh doanh</td>
                                @else
                                    <td>Tạm ngưng hoạt động</td>
                                @endif

                                @if($room->member_ship <= 0 ||$room->member_ship == null)
                                    <td>Chưa có ai thuê</td>
                                @else
                                    <td>{{$room->member_ship}}</td>
                                @endif

                                @if($room->room_quantity <=0)
                                    <td>
                                        <span class="badge bg-danger">Hết chỗ</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge bg-success">{{$room->room_quantity}} người</span>
                                    </td>
                                @endif

                                <td></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            </div>
        </div>
    </div>

    <!--Boarding Room Modal Add -->
    <form method="POST" action="{{route('admin.boarding-room.post')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="boardingRoomAddModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">Thêm mới phòng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="dobExLarge" class="form-label">Tên phòng</label>
                                <input required type="text" id="dobExLarge" class="form-control" name="name" placeholder="Ví dụ: Phòng số 03 ...">
                            </div>
                            <div class="col mb-3">
                                <label for="dobExLarge" class="form-label">Giá thuê phòng</label>
                                <input required type="number" step="any" id="dobExLarge" class="form-control" name="price" placeholder="Mức giá thuê phòng /tháng">
                            </div>

                            <div class="col mb-3">
                                <label for="dobExLarge" class="form-label">Số người có thể ở</label>
                                <input required type="number" id="dobExLarge" class="form-control" name="room_quantity" placeholder="Phòng có thể ở mấy người">
                            </div>

                            <label for="emailExLarge" class="form-label">Trạng thái phòng</label>
                            <div class="input-group">
                                <select name="status" class="form-select" id="inputGroupSelect01">
                                    <option selected="">---Trạng thái--</option>
                                    <option value="1">Hiển thị</option>
                                    <option value="2">Lưu nhưng không hiển thị</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready( function () {
            $('#boardingRoomTable').DataTable();
        } );
    </script>
@endsection
