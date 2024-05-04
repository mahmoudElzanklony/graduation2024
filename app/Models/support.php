<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class support extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','hall_id','info'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function hall()
    {
        return $this->belongsTo(halls::class,'hall_id');
    }
}
