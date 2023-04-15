<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Attendance;
use App\Models\BoardingRoom;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // Show rooms
        $rooms = BoardingRoom::where('status',1)->get();
        $context = [
            'rooms' => $rooms
        ];
        return view('frontend.pages.home', $context);
    }

    public function show_detail_room($slug_room)
    {
        $roomDetails = BoardingRoom::where('slug',$slug_room)->first();
        $context = [
            'roomDetails' => $roomDetails
        ];
        return view('frontend.pages.shortcode.room_details',$context);
    }

    public function register_form(Request $request, $slug_room)
    {

    }
    public function register_room(Request $request, $slug_room)
    {
        $registerRoom = Attendance::create([
            'boarding_room' => $request->boarding_room_id,
            'user_id' => $request->user_id,
            'status' => Status::Pending
        ]);

        if($registerRoom)
        {
            toastr()->success('Bạn đã đăng ký thuê trọ, vui lòng chờ phản hồi');
            return redirect()->back();
        }else{
            toastr()->error('Đã xảy ra lỗi, vui lòng quay lại sau');
            return redirect()->back();
        }
    }

}
