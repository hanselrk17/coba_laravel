<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $items = ItemModel::paginate(32); // paginate => membatasi data per 32 data
        return view('page.transaction_user',["items" => $items]);
    }
}
