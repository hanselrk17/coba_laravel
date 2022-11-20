<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.edit_item');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ItemModel::where('id',$id)->first();
        return view('page.edit_item',['item'=>$item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = ItemModel::where('id',$id)->first();
        if($request['aftercrop'] != null){
            if(file_exists(public_path().$item->image_url)) {
                File::delete(public_path().$item->image_url);
            }
            $image_64 = $request['aftercrop'];
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $image_name = Str::random(20).'.jpg';
            $path_name= "images/gambar item/".$id."/".$image_name;
            if (!file_exists(public_path()."/images/gambar item")) {
                File::makeDirectory(public_path()."/images/gambar item");
            }
            if (!file_exists(public_path()."/images/gambar item/".$id)) {
                File::makeDirectory(public_path()."/images/gambar item/".$id);
            }
            file_put_contents(public_path()."/".$path_name,base64_decode($image));
            $item->image_url = $path_name;
        }

        $item->name = $request->get('namaItem');
        $item->qty = $request->get('quantityItem');
        $item->price = $request->get('priceItem');
        $item->expired_time = Carbon::parse($request->get('expiredTimeItem'));

        $item->save();
        Alert::success('berhasil', 'item anda berhasil diedit');
        return Redirect()->route('admin_item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ItemModel::where('id',$id)->delete();
        Alert::success('berhasil', 'item berhasil didelete');
        return Redirect()->back();
    }

    public function dataTable()
    {
        $item = ItemModel::query();
        return DataTables::of($item)->make(true);
    }

    public function addItemWeb() {
        return view('page.tambah_item');
    }

    public function addItem(Request $request) {
        $path_name = "";
        if($request['aftercrop'] != null){
            $image_64 = $request['aftercrop'];
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $image_name = Str::random(20).'.jpg';
            $path_name= "images/gambar item/".$image_name;
            if (!file_exists(public_path()."/images/gambar item")) {
                File::makeDirectory(public_path()."/images/gambar item");
            }
            if (!file_exists(public_path()."/images/gambar item/")) {
                File::makeDirectory(public_path()."/images/gambar item/");
            }
            file_put_contents(public_path()."/".$path_name,base64_decode($image));
        }
        
        ItemModel::create([
            'name'=>$request->get('namaItem'),
            'qty'=>$request->get('quantityItem'),
            'price'=>$request->get('priceItem'),
            'expired_time'=>$request->get('Carbon::parse($request->get("expiredTimeItem"))'),
            'image_url'=>$path_name
         ]);
         Alert::success('berhasil', 'item anda telah berhasil dibuat');
         return Redirect()->route('admin_item.index');
    }
}
