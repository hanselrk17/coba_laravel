<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.signup');
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
        //
    }

    public function signup(Request $request)
    {
        $user = UserModel::where('email',$request->get('emailSignup'))->first();
        if ($user) {
            Alert::error('Error', 'email udah dipake');
            return redirect()->route('signup-web.index');
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
           'name'=>$request->get('firstNameSignup')." ".$request->get('lastNameSignup'),
           'email'=>$request->get('emailSignup'),
           'password'=>md5($request->get('passwordSignup')),
           'image_url'=>$path_name
        ]);
        Alert::success('berhasil', 'akun anda telah dibuat, sihlakan login');
        return redirect()->route('login-web.index');
    }
}
