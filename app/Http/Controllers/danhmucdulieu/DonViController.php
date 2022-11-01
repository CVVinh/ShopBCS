<?php

namespace App\Http\Controllers\danhmucdulieu;

use App\Models\DonVi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Database\QueryException;

class DonViController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donvis=DonVi::paginate(10);
        return view('admin.danhmucdulieu.donvi.hienthi',compact('donvis'));
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
                    'dv_ten'=>'required',
                    'dv_tinhtrang'=>'required',
                ],
                [
                    'dv_ten.required'=>'Vui lòng nhập tên đơn vị',
                    'dv_tinhtrang.required'=>'Vui lòng chọn tình trạng',

                ]
            );
            if($request->dv_ma==null){

                $donvi=donvi::create($validated);
                if($donvi){
                    return redirect()->route('admin.danhmucdulieu.donvi.hienthi')->with('thanhcong','thêm đơn vị thành công');
                }
                return back()->withInput()->with('thatbai','thêm đơn vị thất bại!');
            }else{
                $donvi=donvi::find($request->dv_ma);
                if($donvi->update($validated)){
                    return redirect()->route('admin.danhmucdulieu.donvi.hienthi')->with('thanhcong','cập nhật đơn vị thành công');
                }
                return back()->withInput()->with('thatbai','Cập nhật đơn vị thất bại!');
            }
        }catch(QueryException $ex){
            return back()->withInput()->with('canhbao','thêm đơn vị thất bại! Lỗi Kĩ thuật');
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
            $donvi=donvi::find($id);
            if($donvi->delete()){
                return redirect()->route('admin.danhmucdulieu.donvi.hienthi')->with('thanhcong','Xóa đơn vị thành công');
            }
            return back()->withInput()->with('thatbai','Xóa đơn vị thất bại!');
        }catch(QueryException $ex){
            $donvi=donvi::find($id);
            $donvi->dv_tinhtrang='0';
            $donvi->save();
            return back()->withInput()->with('canhbao','Dữ liệu đã chuyển sang trạng thái ngừng dừng dụng. Do đơn vị này không thể xóa vĩnh viễn');
        }
    }
}
