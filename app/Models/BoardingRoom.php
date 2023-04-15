<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'boarding_house_id',
        'price',
        'status',
        'name',
        'room_quantity'
    ];

    public function house()
    {
        return $this->belongsTo(BoardingHouse::class,'boarding_house_id');
    }
}
