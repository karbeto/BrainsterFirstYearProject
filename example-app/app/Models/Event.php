<?php

namespace App\Models;

use App\Models\City;
use App\Models\Type;
use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    public function types()
    {
        return $this->hasOne(Type::class);
    }
    public function cities()
    {
        return $this->hasOne(City::class);
    }
}
