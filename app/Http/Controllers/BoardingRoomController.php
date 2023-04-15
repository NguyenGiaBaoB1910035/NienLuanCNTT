<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\BoardingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardingRoomController extends Controller
{
    public function index()
    {
        $roomData = BoardingRoom::all();
        $context = [
            'roomData' => $roomData,
        ];
        return view('admin.pages.BoardingRoom.index',$context);
    }

    public function store(Request $request)
    {
        // Lấy id nhà trọ của tài khoản đang login
        $idHouseOfUser = BoardingHouse::select('id')->where('user_id',Auth::user()->id)->first();
        $addRoom = BoardingRoom::create([
            'name' => $request->name,
            'price' =>$request->price,
            'room_quantity' =>$request->room_quantity,
            'status' => $request->status,
            'boarding_house_id' => $idHouseOfUser->id,
        ]);

        if($addRoom)
        {
            toastr()->success("Đã thêm mới dữ liệu");
        }else{
            toastr()->error("Có lỗi xảy ra, vui lòng quay lại sau");
        }
        return redirect()->route('admin.boarding-room');
    }

    public function show($id)
    {

    }

    public function edit(Request $request, $id)
    {

    }

    public function update($id)
    {

    }
}
