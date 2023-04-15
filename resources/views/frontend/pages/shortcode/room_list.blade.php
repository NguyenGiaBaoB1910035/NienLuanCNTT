<!-- Room Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Phòng trọ tốt nhất</h6>
            <h1 class="mb-5">Danh sách <span class="text-primary text-uppercase">Phòng</span></h1>
        </div>
        <div class="row g-4">
            @foreach($rooms as $room)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/room-1.jpg" alt="">
                            <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{convertStringToNumber($room->price)}}đ/tháng</small>
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{$room->name}}</h5>
                                {{--                                    <div class="ps-2">--}}
                                {{--                                        <small class="fa fa-star text-primary"></small>--}}
                                {{--                                        <small class="fa fa-star text-primary"></small>--}}
                                {{--                                        <small class="fa fa-star text-primary"></small>--}}
                                {{--                                        <small class="fa fa-star text-primary"></small>--}}
                                {{--                                        <small class="fa fa-star text-primary"></small>--}}
                                {{--                                    </div>--}}
                            </div>
                            <div class="d-flex mb-3">
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                            </div>
                            <p class="text-body mb-3">Mô tả phòng</p>
                            <i class="fa fa-tag"></i> <p class="text-body mb-3 text-danger fw-bold" style="display: inline-flex">{{$room->house->name}}</p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{route('page.show_detail_room',$room->slug)}}">Thông tin phòng</a>
                                <a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Đăng ký thuê</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Room End -->
