<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = UserModel::where('id',$id)->first();
        return view('page.show_profile',['user'=>$data]);
    }

    public function edit($id)
    {
        $data = UserModel::where('id',$id)->first();
        return view('page.edit_profile',['user'=>$data]);
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
        $user = UserModel::where(['id'=>$id,'password'=>bcrypt($request->get('passwordUser'))])->first();
        if (!$user) {
            Alert::error('gagal', 'password salah goblog');
            return redirect()->back();
        }
        
        if($request['aftercrop'] != null){
            if(file_exists(public_path().$user->image_url)) {
                File::delete(public_path().$user->image_url);
            }
            $image_64 = $request['aftercrop'];
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $image_name = Str::random(20).'.jpg';
            $path_name= "images/profile user/".Auth::user()->id."/".$image_name;
            if (!file_exists(public_path()."/images/profile user")) {
                File::makeDirectory(public_path()."/images/profile user");
            }
            if (!file_exists(public_path()."/images/profile user/".Auth::user()->id)) {
                File::makeDirectory(public_path()."/images/profile user/".Auth::user()->id);
            }
            file_put_contents(public_path()."/".$path_name,base64_decode($image));
            $user->image_url = $path_name;
        }

        $user->name = $request->get('namaUser');
        $user->email = $request->get('emailUser');
      
        $user->save();
        Alert::success('berhasil', 'User profile anda berhasil diedit');
        return Redirect()->route('show_profile.userController',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $data = UserModel::where('id',$id)->first();
        return view('page.edit_profile_password',['user'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $user = UserModel::where(['id'=>$id,'password'=>bcrypt($request->get('passwordUser'))])->first();
        if (!$user) {
            Alert::error('gagal', 'password sekarang salah goblog');
            return redirect()->back();
        }
        $user->password = bcrypt($request->get('passwordBaruUser'));
        $user->save();
        Alert::success('berhasil', 'password anda berhasil diedit');
        return Redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
