<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordEmail;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.login');
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

    public function login(Request $request)
    {
        $user = UserModel::where('email',$request->get('emailLogin'))->where('password',md5($request->get('passwordLogin')))->first();
        if (!$user) {
            Alert::error('Error', 'salah goblog');
            return redirect()->route('login-web.index');
        }
    
        Auth::login($user);
        return redirect()->route('dashboard.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login-web.index');
    }

    public function forgotPassword()
    {
        return view('page.forgot_password');
    }

    public function forgotPasswordEmail(Request $request)
    {
        $user = UserModel::where('email',$request->get('emailForgotPassword'))->first();
        if(!$user) {
            Alert::error('Error', 'email tidak ada');
            return redirect()->route('forgot_password.index');
        }
        
        try { 
            Mail::to($user->email)->send(new ForgetPasswordEmail($user)); 
        } catch (\Exception $e) {
            error_log($e); //buat baca eror di console local
            Alert::error('eror', 'ada kesalahan code');
            return redirect()->route('forgot_password.index');
        }
        
        Alert::success('berhasil', 'sihlakan cek email anda');
        return redirect()->route('login-web.index');
    }

    public function forgotPasswordEnterNewPassword($id)
    {
        $user = UserModel::where('id',$id)->first();
        if(!$user) {
            Alert::error('Error', 'id user tidak ada');
            return redirect()->route('login-web.index');
        }
        return view('page.forgot_password_enter_password',['id'=>$id]);
    }

    public function forgotPasswordSuccess(Request $request, $id)
    {
        $user = UserModel::where('id',$id)->first();
        $user->password = md5($request->get('newPassword'));
        $user->save();

        Alert::success('berhasil', 'password anda telah diganti');
        return Redirect()->route('login-web.index');
    }
}