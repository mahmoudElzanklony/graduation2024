<?php

namespace App\Models;

use App\Http\Enum\HallsTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class halls extends Model
{
    use HasFactory;

    protected $fillable = ['city_id','name','info','address','type','day_price'];

    protected $casts = [
      'type'=>HallsTypeEnum::class,
    ];
    public function city()
    {
        return $this->belongsTo(cities::class,'city_id');
    }

    public function images()
    {
        return $this->morphMany(images::class,'imageable');
    }
}
