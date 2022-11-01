<?php

namespace App\Http\Controllers\danhmucdulieu;

use App\Models\DanhMucSP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Database\QueryException;
class DanhMucSPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmucsps=DanhMucSP::paginate(10);
        return view('admin.danhmucdulieu.danhmucsp.hienthi',compact('danhmucsps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
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
                    'dm_ten'=>'required',
                    'dm_tinhtrang'=>'required',
                ],
                [
                    'dm_ten.required'=>'Vui lòng nhập tên danh mục sản phẩm',
                    'dm_tinhtrang.required'=>'Vui lòng chọn tình trạng',

                ]
            );
            if($request->dm_ma==null){
                
                $danhmucsp=Danhmucsp::create($validated);
                if($danhmucsp){
                    return back()->with('thanhcong','thêm danh mục sản phẩm thành công');
                }
                return back()->withInput()->with('thatbai','thêm danh mục sản phẩm thất bại!');
            }else{
                $danhmucsp=Danhmucsp::find($request->dm_ma);
                if($danhmucsp->update($validated)){
                    return back()->with('thanhcong','cập nhật danh mục sản phẩm thành công');
                }
                return back()->withInput()->with('thatbai','Cập nhật danh mục sản phẩm thất bại!');
            }
        }catch(QueryException $ex){
            return back()->withInput()->with('canhbao','thêm danh mục sản phẩm thất bại! Lỗi Kĩ thuật');
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
            $danhmucsp=Danhmucsp::find($id);
            if($danhmucsp->delete()){
                return back()->with('thanhcong','Xóa danh mục sản phẩm thành công');
            }
            return back()->withInput()->with('thatbai','Xóa danh mục sản phẩm thất bại!');
        }catch(QueryException $ex){
            $danhmucsp=Danhmucsp::find($id);
            $danhmucsp->dm_tinhtrang='0';
            $danhmucsp->save();
            return back()->withInput()->with('canhbao','Dữ liệu đã chuyển sang trạng thái ngừng dừng dụng. Do danh mục sản phẩm này không thể xóa vĩnh viễn');
        }
    }
}
