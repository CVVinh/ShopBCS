<?php

namespace App\Http\Controllers\taikhoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nhanvien;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
class TaiKhoanNVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nhanviens=nhanvien::paginate(10);
        return view('admin.taikhoan.taikhoannv',compact('nhanviens'));
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
    public function viewdoimk($id){
        $nhanvien=nhanvien::find($id);
        return view('admin.taikhoan.viewdoimk',compact('nhanvien'));
    }

    public function doimk(request $request,$id){
        $request->validate(
            [
                'passwordold' => 'required|min:6',
                'passwordnew' => 'required|min:6',
            ],
            [
                'passwordold.required' => 'Vui lòng nhập mật khẩu cũ',
                'passwordnew.required' => 'Vui lòng nhập mật khẩu mới',
                'passwordold.min' => 'Vui lòng nhập mật khẩu cũ ít nhất 6 ký tự',
                'passwordnew.min' => 'Vui lòng nhập mật khẩu mới ít nhất 6 ký tự',
            ]
        );
        $nhanvien=Auth::guard('nv')->user();
        if (Auth::guard('nv')->attempt(['nv_ma'=>$nhanvien->nv_ma,'password'=>$request->passwordold])){
            $nhanvien->password=Hash::make($request->passwordnew);
        if($nhanvien->save()){
            return back()->withInput()->with('thanhcong','Cập nhật mật khẩu thành công!');
        }else{
            return back()->withInput()->with('thatbai','Cập nhật mật khẩu thất bại!');
        }
        }
        else{
            return back()->withInput()->with('thatbai','Cập nhật mật khẩu cũ không đúng!~');
        }
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
    public function khoatk(Request $request){
        $nhanvien=nhanvien::find($request->value);
        if($request->name=="khoa"){
                $nhanvien->tinhtrang='0';
                $nhanvien->save();
        }else{
            $nhanvien->tinhtrang='1';
            $nhanvien->save();
        }
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
