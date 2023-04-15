@extends('frontend.master.layout')
@section('content_page')
    <div class="container-fluid">
        <div class="container">
            <!-- Cucumbers -->
            <a href="#">Cho thuê phòng trọ > {{$roomDetails->house->name}} > {{$roomDetails->name}}</a>
            <div class="row">
                <div class="col-md-8">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
{{--                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>--}}
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="img-fluid" src="https://images.unsplash.com/photo-1508919801845-fc2ae1bc2a28?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1nfGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="First slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h6 class="text-primary fs-5 text-uppercase mt-3">{{$roomDetails->name}}</h6>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="room_description">
                                <p class="text-body mb-3">Nhà trọ: <b>{{$roomDetails->house->name}}</b> </p>
                                <p class="text-body mb-3">Địa chỉ: <b>{{$roomDetails->house->address}}</b> </p>
                                <p class="text-body mb-3">Giá cho thuê: {{convertStringToNumber($roomDetails->price)}}đ/tháng </p>
                            </div>
                            <h4>Thông tin mô tả</h4>
                            <p class="text-body mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <h4>Mô tả chi tiết</h4>

                            <section class="section post-overview">
                                <div class="section-content">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td class="name">Mã tin:</td>
                                            <td>#620924</td>
                                        </tr>
                                        <tr>
                                            <td class="name">Khu vực</td>
                                            <td> Cho thuê phòng trọ Hồ Chí Minh </td>
                                        </tr>
                                        <tr>
                                            <td class="name">Loại tin rao:</td>
                                            <td>Phòng trọ, nhà trọ</td>
                                        </tr>
                                        <tr>
                                            <td class="name">Đối tượng thuê:</td>
                                            <td>Tất cả</td>
                                        </tr>

                                        <tr>
                                            <td class="name">Ngày đăng:</td>
                                            <td>
                                                <time title="{{$roomDetails->created_at}}">{{$roomDetails->created_at->format('d-m-Y')}}</time>
                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </section>


                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center fw-bold fs-4 text-white" style="background: #1266dd">
                            <div class="card-title">
                                THÔNG TIN CHỦ TRỌ
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="room_contact_info">
                                <p class="text-body mb-3">Họ tên chủ trọ: <b>{{$roomDetails->house->user->name}}</b> </p>
                                <p class="text-body mb-3">Điện thoại liên hệ: <b>{{$roomDetails->house->user->phone ?? "Chưa cập nhật"}}</b></p>
                                <p class="text-body mb-3">Hoạt động tại: <b>{{$roomDetails->house->name}}</b> </p>
                            </div>

                        </div>
                        <form method="POST" action="{{route('page.register_room.post',$roomDetails->slug)}}">
                            @csrf
                            <div class="card-footer text-center">
                                <input type="hidden" name="boarding_room_id" value="{{$roomDetails->id}}">
                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                <button type="submit" class="btn btn-primary fw-bold">Đăng ký thuê trọ</button>
{{--                                <a href="{{route('page.register_room.get',$roomDetails->slug,$roomDetails->slug)}}" class="btn btn-primary fw-bold">Đăng ký thuê trọ</a>--}}
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
