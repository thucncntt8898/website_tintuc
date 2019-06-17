<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
    	$loaitin=LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem(){
        $theloai=TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function getSua($id){
        $theloai=TheLoai::all();
    	$loaitin=LoaiTin::find($id);
    	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
    	$this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:loaitin,Ten',
                'TheLoai' => 'required'

            ],[
                'Ten.required'=>'Ban chua nhap ten loai tin',
                'Ten.min'=>'Ten loai tin phai co do dai tu 3 den 100 ky tu',
                'Ten.max'=>'Ten loai tin phai co do dai tu 3 den 100 ky tu',
                'Ten.required' => 'ban chua chon the loai cho loai tin'
            ]);
        $loaitin=LoaiTin::find($id);
    	$loaitin->Ten=$request->Ten;
    	$loaitin->TenKhongDau=changeTitle($request->Ten);
        $loaitin->idTheLoai=$request->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/sua/'.$loaitin->id)->with('thong bao',"Success");

    }
    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten' => 'required|min:3|max:100|unique:loaitin,Ten',
                'TheLoai' => 'required'

    		],[
    			'Ten.required'=>'Ban chua nhap ten loai tin',
    			'Ten.min'=>'Ten loai tin phai co do dai tu 3 den 100 ky tu',
    			'Ten.max'=>'Ten loai tin phai co do dai tu 3 den 100 ky tu',
                'Ten.required' => 'ban chua chon the loai cho loai tin'
    		]);

    	$loaitin=new LoaiTin;
        $loaitin->Ten=$request->Ten;
        $loaitin->TenKhongDau=changeTitle($request->Ten);
        $loaitin->idTheLoai=$request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thong bao','success');
    }
    public function getXoa($id)
    {
        $loaitin=LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thong bao','Success');
    }
}
