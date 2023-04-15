<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\User;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    public function index()
    {
        $usrID = User::where('status',"Active")->get();
        $boardingHouseData = BoardingHouse::all();

        $context = [
            'usrID' => $usrID,
            'boardingHouseData' => $boardingHouseData
        ];
        return view('admin.pages.BoardingHouse.index',$context);
    }

    public function store(Request $request)
    {
        // Show user_id

        $addBoardingHouse = BoardingHouse::create($request->all());


        if($addBoardingHouse)
        {
            toastr()->success("Đã thêm mới dữ liệu");
        }else{
            toastr()->error("Có lỗi xảy ra, vui lòng quay lại sau");
        }
        return redirect()->route('admin.boarding-house');
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
