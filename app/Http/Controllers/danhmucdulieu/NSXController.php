<?php

namespace App\Http\Controllers\danhmucdulieu;

use App\Models\nhasanxuat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Database\QueryException;
class NSXController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nhaSanXuats = nhasanxuat::paginate(10);
        return view('admin.danhmucdulieu.nhasanxuat.hienthi', compact('nhaSanXuats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validated=$request->validate(
                [
                    'nsx_ten'=>'required|max:255',
                    'nsx_diachi'=>'required|max:255',
                    'nsx_sdt'=>'required|max:11',
                    'nsx_email'=>'required|email',
                    'nsx_msthue'=>'required|max:11',
                    'nsx_tinhtrang'=>'required',
                ],
                [
                    'nsx_ten.required'=>'Vui lòng nhập tên nhà sản xuất',
                    'nsx_diachi.required'=>'Vui lòng nhập địa chỉ nhà sản xuất',
                    'nsx_diachi.max'=>'Tên địa chỉ quá dài',
                    'nsx_sdt.required'=>'Vui lòng nhập số điện thoại nhà sản xuất',
                    'nsx_sdt.max'=>'Số điện thoại không hơn 11 số',
                    'nsx_email.required'=>'Vui lòng nhập email nhà sản xuất',
                    'nsx_email.email'=>'Email không hợp lệ',
                    'nsx_msthue.required'=>'Vui lòng mã số thuế nhà sản xuất',
                    'nsx_tinhtrang.required'=>'Vui lòng chọn tình trạng',

                ]
            );
            if($request->nsx_ma==null){
                $nhaSanXuat=nhasanxuat::create($validated);
                if($nhaSanXuat){
                    return back()->with('thanhcong','thêm nhà sản xuất thành công');
                }
                return back()->withInput()->with('thatbai','thêm nhà sản xuất thất bại!');
            }else{
                $nhaSanXuat=nhasanxuat::find($request->nsx_ma);
                if($nhaSanXuat->update($validated)){
                    return back()->with('thanhcong','cập nhật nhà sản xuất thành công');
                }
                return back()->withInput()->with('thatbai','Cập nhật nhà sản xuất thất bại!');
            }
        }catch(QueryException $ex){
            return back()->withInput()->with('canhbao','thêm nhà sản xuất thất bại! Lỗi Kĩ thuật');
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
        try{
            $nhaSanXuat=nhasanxuat::find($id);
            if($nhaSanXuat->delete()){
                return back()->with('thanhcong','Xóa mục nhà sản xuất thành công');
            }
            return back()->withInput()->with('thatbai','Xóa nhà sản xuất thất bại!');
        }catch(QueryException $ex){
            $nhaSanXuat=nhasanxuat::find($id);
            $nhaSanXuat->vc_tinhtrang='0';
            $nhaSanXuat->save();
            return back()->withInput()->with('canhbao','Dữ liệu đã chuyển sang trạng thái ngừng sử dụng. Do nhà sản xuất này không thể xóa vĩnh viễn');
        }
    }
}
