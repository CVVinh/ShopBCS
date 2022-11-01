<?php

namespace App\Http\Controllers\nguoidung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhanVien;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class NguoiDungNVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nhanviens=nhanvien::paginate(10);
        return view('admin.nguoidung.danhsachnv',compact('nhanviens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nguoidung.themnv');
    }
    public function thongtinnv($id)
    {
        $nhanvien=nhanvien::find($id);
        return view('admin.nguoidung.thongtinnv',compact('nhanvien'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate(
            [
                'ten'=>'required',
                'sdt' =>'required|unique:nhanvien',
                'ngaysinh'=>'required',
                'gioitinh'=>'required',
                'email'=>'unique:nhanvien',
                'diachi'=>'nullable',    
                'cccd'=>'required',

            ],
            [
                'ten.required'=>'Vui lòng nhập tên',
                'sdt.unique' =>'Số điện thoại đã tồn tại',
                'email.unique' =>'Email đã tồn tại',
                'sdt.required' =>'Vui lòng nhập số điện thoại',
                'ngaysinh.required'=>'Vui lòng nhập ngày sinh',
                'gioitinh.required'=>'Vui lòng chọn giới tính',
                'cccd.required'=>'Vui lòng nhập cccd', 
            ]
        );
        try{
            $nhanvien=nhanvien::create(['ten'=>$request->ten,'diachi'=>$request->diachi,'sdt'=>$request->sdt,'ngaysinh'=>$request->ngaysinh,'gioitinh'=>$request->gioitinh,'email'=>$request->email,'cccd'=>$request->cccd,'password' => Hash::make('123456')]);
            $random = Str::random(10);
            if ($request->hasFile('hinh')) {
                $extension = $request->hinh->extension();
                $pathimg_update = $random . $nhanvien->hinh . '.' . $extension;
                $request->file('hinh')->move(public_path('uploads/img'), $pathimg_update);
                $nhanvien->hinh = $pathimg_update;
                $nhanvien->save();
            }
            if($nhanvien) {
                return back()->with('thanhcong','Thêm nhân viên thành công');
            }
            return back()->withInput()->with('thatbai','Thêm nhân viên thất bại!');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Thêm nhân viên thất bại! Lỗi kĩ thuật');
        }
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
        $validated=$request->validate(
            [
                'ten'=>'required',
                'sdt' =>'required',
                'ngaysinh'=>'required',
                'gioitinh'=>'required',
                'email'=>'nullable',
                'cccd'=>'required',
                'diachi'=>'nullable', 

            ],
            [
                'ten.required'=>'Vui lòng nhập tên',
                'sdt.required' =>'Vui lòng nhập số điện thoại',
                'ngaysinh.required'=>'Vui lòng nhập ngày sinh',
                'gioitinh.required'=>'Vui lòng chọn giới tính',
                'cccd.required'=>'Vui lòng nhập cccd', 
            ]
        );
        try{
            $nhanvien=nhanvien::find($id);
            $random = Str::random(10);
            if ($request->hasFile('hinh')) {
                $pathimg = public_path('uploads/img/' . $nhanvien->hinh);
                if (File::exists($pathimg)) {
                    File::delete($pathimg);
                }
                $extension = $request->hinh->extension();
                $pathimg_update = $random . $nhanvien->hinh . '.' . $extension;
                $request->file('hinh')->move(public_path('uploads/img'), $pathimg_update);
                $nhanvien->hinh = $pathimg_update;
                $nhanvien->save();
            }
            if($nhanvien->update($validated)){
                return back()->with('thanhcong','Cập nhật nhân viên thành công');
            }
            return back()->withInput()->with('thatbai','Cập nhật nhân viên thất bại!');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Cập nhật nhân viên thất bại! Số điện thoại hoặc email đã tồn tại');
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
