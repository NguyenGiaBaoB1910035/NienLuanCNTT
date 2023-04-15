@extends('admin.master.master')
<style>
    .tab-content{
        padding: 0 !important;
    }
</style>
@section('css')

@endsection

@section('content')
    <div class="container">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý /</span> Danh sách khu trọ
        </h4>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>Quản lý khu trọ</h5>
                    <button type="button" class="btn-sm btn-success text-white fw-bold" data-bs-toggle="modal" data-bs-target="#boardingHouseAddModal">Thêm mới</button>
                </div>
            </div>
            <div class="card-body">
                <table id="boardingHouseTable" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Họ tên chủ trọ</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Mức giá chung</th>
                            <th>Số lượng phòng</th>
                            <th>Giá điện</th>
                            <th>Giá nước</th>
                            <th>Phí vệ sinh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($boardingHouseData as $bdh)
                        @php
                            /* Convert String to Float: pirce, electricity, water ... */
                            $price = $bdh->price;
                            $electricity_price = $bdh->electricity_price;
                            $water_price = $bdh->water_price;
                            $garbage_price = $bdh->garbage_price;
                            /* Convert */
                            $pirceConvert = (float)$price;
                            $electricity_priceConvert = (float)$electricity_price;
                            $water_priceConvert = (float)$water_price;
                            $garbage_priceConvert = (float)$garbage_price;
                        @endphp
                        <tr>
                            <td>{{$bdh->user->name}}</td>
                            <td>{{$bdh->contact_phone}}</td>
                            <td>{{$bdh->address}}</td>
                            <td>{{number_format($pirceConvert)}} VNĐ</td>
                            <td>{{$bdh->room_quatity}}</td>
                            <td>{{number_format($electricity_priceConvert)}} VNĐ</td>
                            <td>{{number_format($water_priceConvert)}} VNĐ</td>
                            <td>{{number_format($garbage_priceConvert)}} VNĐ</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-add-to-queue me-1"></i> Thêm phòng</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Ngưng hoạt động</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>

        </div>

        <div class="card mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h5>Danh sách phòng trọ</h5>
                    <button type="button" class="btn-sm btn-success text-white fw-bold" data-bs-toggle="modal" data-bs-target="#boardingRoomAddModal">Thêm phòng</button>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table id="boardingRoomTable" class="display" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Họ tên chủ trọ</th>
                                    <th>Giá thuê tháng</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($boardingHouseData as $bdh)
                                <tr>
                                    <td>{{$bdh->name}}</td>
                                    @foreach($bdh->rooms as $i)
                                        @php
                                            $priceMonth = $i->price;
                                            $priceMonthCovert = (float)$priceMonth;
                                        @endphp
                                    <td>{{number_format($priceMonthCovert)}}đ/tháng</td>
                                    @if($i->status == 1)
                                        <td>Còn trống</td>
                                    @else
                                        <td>Đã đủ người</td>
                                    @endif
                                    @endforeach
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Thêm người thuê</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Danh sách người thuê</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        Comming
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>


    </div>

    <form method="POST" action="{{route('admin.boarding-house.post')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="boardingHouseAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Thêm mới nhà trọ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameExLarge" class="form-label">Tên nhà trọ</label>
                            <input type="text" id="nameExLarge" class="form-control" name="name" placeholder="Tên nhà trọ, khu trọ">
                        </div>
                        <div class="col mb-3">
                            <label for="nameExLarge" class="form-label">Số lượng phòng</label>
                            <input type="number" id="nameExLarge" class="form-control" name="room_quatity" placeholder="Số lượng phòng">
                        </div>
                        <div class="col mb-3">
                            <label for="nameExLarge" class="form-label">Slug</label>
                            <input type="text" id="nameExLarge" class="form-control" name="slug" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="emailExLarge" class="form-label">Người quản lý nhà trọ</label>
                            <div class="input-group">
                                <select name="user_id" class="form-select" id="inputGroupSelect01">
                                    <option selected="">---Chủ trọ---</option>
                                    @foreach($usrID as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="dobExLarge" class="form-label">Địa chỉ nhà trọ</label>
                            <input type="text" id="dobExLarge" class="form-control" name="address" placeholder="Địa chỉ nhà trọ">
                        </div>
                        <div class="col mb-3">
                            <label for="dobExLarge" class="form-label">Điện thoại liên hệ</label>
                            <input type="number" name="contact_phone" id="dobExLarge" class="form-control" placeholder="Số điện thoại">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="emailExLarge" class="form-label">Giá thuê dao động</label>
                            <input type="text" id="emailExLarge" class="form-control" name="price" placeholder="xxxx@xxx.xx">
                        </div>
                        <div class="col mb-3">
                            <label for="dobExLarge" class="form-label">Giá điện</label>
                            <input type="text" id="dobExLarge" class="form-control" name="electricity_price" placeholder="Địa chỉ nhà trọ">
                        </div>
                        <div class="col mb-3">
                            <label for="dobExLarge" class="form-label">Giá nước</label>
                            <input type="number" name="water_price" id="dobExLarge" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="col mb-3">
                            <label for="dobExLarge" class="form-label">Phí vệ sinh</label>
                            <input type="number" name="garbage_price" id="dobExLarge" class="form-control" placeholder="Số điện thoại">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Thông tin mô tả</label>
                            <textarea class="form-control" name="description"></textarea>
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

{{--    <!--Boarding Room Modal Add -->--}}
{{--    <form method="POST" action="{{route('admin.boarding-room.post')}}" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        <div class="modal fade" id="boardingRoomAddModal" tabindex="-1" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-lg" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalLabel4">Thêm mới phòng</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col mb-3">--}}
{{--                                <label for="emailExLarge" class="form-label">Thuộc nhà trọ</label>--}}
{{--                                <div class="input-group">--}}
{{--                                    <select name="boarding_house_id" class="form-select" id="inputGroupSelect01">--}}
{{--                                        <option selected="">---Nhà trọ--</option>--}}
{{--                                        @foreach($boardingHouseData as $bdh)--}}
{{--                                            <option value="{{$bdh->id}}">{{$bdh->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col mb-3">--}}
{{--                                <label for="dobExLarge" class="form-label">Tên phòng</label>--}}
{{--                                <input required type="text" id="dobExLarge" class="form-control" name="name" placeholder="Ví dụ: Phòng số 03 ...">--}}
{{--                            </div>--}}
{{--                            <div class="col mb-3">--}}
{{--                                <label for="dobExLarge" class="form-label">Giá thuê phòng</label>--}}
{{--                                <input required type="number" step="any" id="dobExLarge" class="form-control" name="price" placeholder="Mức giá thuê phòng /tháng">--}}
{{--                            </div>--}}

{{--                            <label for="emailExLarge" class="form-label">Trạng thái phòng</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <select name="status" class="form-select" id="inputGroupSelect01">--}}
{{--                                    <option selected="">---Trạng thái--</option>--}}
{{--                                    <option value="1">Còn trống</option>--}}
{{--                                    <option value="2">Đủ người</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>--}}
{{--                        <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}


    <script>
        $(document).ready( function () {
            $('#boardingHouseTable').DataTable();
        } );
    </script>

@endsection
