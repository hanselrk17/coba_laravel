<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'item';

    protected $fillable = [
        'name',
        'qty',
        'price',
        'expired_time',
        'image_url'
    ];
}
