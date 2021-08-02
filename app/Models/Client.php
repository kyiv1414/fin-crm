<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['id', 'first_name', 'last_name', 'phone'];
    use HasFactory;

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
