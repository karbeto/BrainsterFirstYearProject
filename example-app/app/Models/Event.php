<?php

namespace App\Models;

use App\Models\City;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
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
