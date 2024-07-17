<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    public function booking()
{
    return $this->belongsTo(Booking::class);
}

public function approver()
{
    return $this->belongsTo(User::class, 'approver_id');
}

}
