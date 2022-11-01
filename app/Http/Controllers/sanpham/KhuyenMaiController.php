<?php

namespace App\Http\Controllers\sanpham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\khuyenmai;
use \Illuminate\Database\QueryException;
class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khuyenmais=khuyenmai::all();
        return view('admin.sanpham.khuyenmai.hienthi',compact('khuyenmais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
        $sp=sanpham::find($id);
        if($sp->khuyenmai==null){
            $khuyenmai=khuyenmai::create(['sp_ma'=>$id]);
        }else{
            $khuyenmai=khuyenmai::find($sp->khuyenmai->km_ma);
        }
        $result=sanpham::where('sp_tinhtrang',1)->orderBy('sp_ten')->get();
        $sanphams=$result;
        $i=0;
        foreach($result as $sanpham){
            foreach($khuyenmai->sanphams as $sanpham1){
                if($sanpham1->sp_ma==$sanpham->sp_ma){
                    unset($sanphams[$i]);
                }
            }
            $i++;
        }
        return view('admin.sanpham.suakm',compact('sanphams','sp','khuyenmai'));
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
        try {
            $sanpham1=sanpham::find($id);
            $khuyenmai=khuyenmai::find($sanpham1->khuyenmai->km_ma);
            if($request->sp_ma!=null){
                foreach($request->sp_ma as $key1 => $value1){
                    $khuyenmai->sanphams()->detach((integer)$value1);
                }

                foreach($request->sp_ma as $key => $value){
                    foreach($request->phantram as $key1 => $value1){
                        if($value==$key1){
                            $khuyenmai->sanphams()->attach((integer)$value,['phantram'=>(float)$value1,'mota'=>$request->mota[$key1],'dv_ma'=>$request->dv_ma[$key1]]);
                        }
                    }
                }
                return redirect()->route('admin.sanpham.suakm',['id'=>$id])->with('thanhcong','Cập nhật khuyến mãi thành công');
            }
            return back()->withInput()->with('thatbai','cập nhật khuyến mãi thất bại! Bạn chưa chọn sản phẩm để khuyến mãi');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Cập nhật khuyến mãi thất bại!');
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
