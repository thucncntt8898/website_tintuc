<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function getDanhSach(){
    	$user=User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
    	
    }
    public function postThem(Request $request)
    {

       
    }
    public function getSua($id){
    	
    }
    public function postSua(Request $request,$id){
    	
    }
    public function getXoa($id)
    {
    }
    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32'
        ],[
            'email.required'=>'Ban chua nhap email',
            'password.required'=>'Ban chua nhap password',
            'password.min'=>'Password khong duoc nho hon 3 ky tu',
            'password.max'=>'Password khong duoc lon hon 32 ky tu'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thong bao','Dang nhap khong thanh cong!');
        }
    }
}
