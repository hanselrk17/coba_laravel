<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $fillable = [
        'name',
        'qty',
        'price',
        'expired_time',
        'image_url'
    ];
}
