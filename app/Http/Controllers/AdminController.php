<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.pilih_menu_admin');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = UserModel::where('id',$id)->delete();
        Alert::success('berhasil', 'user berhasil didelete');
        return Redirect()->back();
    }

    public function dataTable()
    {
        $users = UserModel::query();
        return DataTables::of($users)->make(true);
    }
    
    public function itemIndex()
    {
        return view('page.admin_item');
    }

    public function userIndex()
    {
        return view('page.admin_user');
    }

    public function addUserIndex() {
        return view('page.tambah_user');
    }

    public function addUser(Request $request) {
        $user = UserModel::where('email',$request->get('emailUser'))->first();
        if ($user) {
            Alert::error('Error', 'email udah dipake');
            return redirect()->route('tambah_user_index.adminController');
        }

        $path_name = "";
        if($request['aftercrop'] != null){
            $image_64 = $request['aftercrop'];
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $image_name = Str::random(20).'.jpg';
            $path_name= "images/profile user/".$image_name;
            if (!file_exists(public_path()."/images/profile user")) {
                File::makeDirectory(public_path()."/images/profile user");
            }
            if (!file_exists(public_path()."/images/profile user/")) {
                File::makeDirectory(public_path()."/images/profile user/");
            }
            file_put_contents(public_path()."/".$path_name,base64_decode($image));
        }
        
        UserModel::create([
            'name'=>$request->get('firstNameUser') . " " . $request->get('lastNameUser'),
            'email'=>$request->get('emailUser'),
            'password'=>bcrypt($request->get('passwordUser')),
            'image_url'=>$path_name
        ]);
        Alert::success('berhasil', 'user anda telah berhasil dibuat');
        return Redirect()->route('admin_user.index');
    }

    public function addAdminIndex() {
        return view('page.tambah_admin');
    }

    public function addAdmin(Request $request) {
        $user = UserModel::where('email',$request->get('emailAdmin'))->first();
        if ($user) {
            Alert::error('Error', 'email udah dipake');
            return redirect()->route('tambah_admin_index.adminController');
        }

        $path_name = "";
        if($request['aftercrop'] != null){
            $image_64 = $request['aftercrop'];
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $image_name = Str::random(20).'.jpg';
            $path_name= "images/profile user/".$image_name;
            if (!file_exists(public_path()."/images/profile user")) {
                File::makeDirectory(public_path()."/images/profile user");
            }
            if (!file_exists(public_path()."/images/profile user/")) {
                File::makeDirectory(public_path()."/images/profile user/");
            }
            file_put_contents(public_path()."/".$path_name,base64_decode($image));
        }
        
        UserModel::create([
            'name'=>$request->get('firstNameAdmin') . " " . $request->get('lastNameAdmin'),
            'email'=>$request->get('emailAdmin'),
            'password'=>bcrypt($request->get('passwordAdmin')),
            'image_url'=>$path_name,
            'role'=>1
        ]);
        Alert::success('berhasil', 'admin baru telah berhasil dibuat');
        return Redirect()->route('admin_user.index');
    }
}