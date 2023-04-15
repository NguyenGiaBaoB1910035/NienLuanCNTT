<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','address','contact_phone','room_quatity','price','electricity_price','water_price','garbage_price','description','user_id'
    ];

    // 1 nhà trọ chĩ có 1 chủ trọ
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // 1 nhà trọ có nhiều phòng trọ
    public function rooms()
    {
        return $this->hasMany(BoardingRoom::class,'boarding_house_id','id');
    }

}
