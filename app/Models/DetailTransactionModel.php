<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransactionModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detail_transaction';

    protected $fillable = [
        'transaction_id',
        'item_id',
        'item_name',
        'quantity',
        'price',
        'total_price'
    ];

    public function get_item()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }
}
