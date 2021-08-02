<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'first_name', 'last_name', 'phone'];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
