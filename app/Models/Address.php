<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Address extends Model
{   
    use  HasFactory;

    protected $table = 'addresses';
    public $timestamps = false;

    protected $fillable = [
        'street',
        'user_id'
    ];

    protected $hidden = [
        'id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}