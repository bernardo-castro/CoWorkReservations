<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cowork_space_id',
        'reservation_date',
        'reservation_time',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coworkSpace()
    {
        return $this->belongsTo(CoworkSpace::class);
    }
}