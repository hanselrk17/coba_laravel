<?php

namespace App\Models;

use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transaction';

    protected $fillable = [
        'user_id',
        'list_item',
        'total_quantity',
        'final_price'
    ];

    public function get_user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    public function get_detail_transaction()
    {
        return $this->hasMany(DetailTransactionModel::class, 'transaction_id', 'id');
    }
}
