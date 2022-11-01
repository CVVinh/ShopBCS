<?php

namespace App\Http\Controllers\sanpham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\sale;
use \Illuminate\Database\QueryException;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales=sale::all();
        return view('admin.sanpham.sale.hienthi',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sanphams=sanpham::where('sp_tinhtrang','1')->get();
        return view('admin.sanpham.sale.them',compact('sanphams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try{
            $validated = $request->validate(
                [
                    'sale_tgbd'=>'required',
                    'sale_tgkt'=>'required',
                    'sale_noidung'=>'nullable',
                ],
                [
                    'sale_tgbd.required'=>'Chưa nhập ngày bắt đầu',
                    'sale_tgkt.required'=>'Chưa nhập ngày kết thúc',
                ]
            );
            if($request->sp_ma!=null){
                $sale=sale::create($validated);
                foreach($request->sp_ma as $key => $value){
                    foreach($request->giamgia as $key1 => $value1){
                    if($value==$key1){
                        $sale->sanphams()->attach((float)$value,['giamgia'=>(float)$value1]);
                        }
                    }
                }
                return redirect()->route('admin.sanpham.sale.hienthi')->with('thanhcong','Thêm sale thành công');
            }
            return back()->withInput()->with('thatbai','Thêm sale thất bại! Bạn chưa chọn sản phẩm để sale');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Thêm sale thất bại! Lỗi Kỹ thuật');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale=sale::find($id);
        $result=sanpham::where('sp_tinhtrang',1)->orderBy('sp_ten')->get();
        $sanphams=$result;

        $i=0;
        foreach($result as $sanpham){
            foreach($sale->sanphams as $sanpham1){
                if($sanpham1->sp_ma==$sanpham->sp_ma){
                    unset($sanphams[$i]);
                }
            }
            $i++;
        }
        return view('admin.sanpham.sale.sua',compact('sale','sanphams'));
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
            $validated = $request->validate(
                [
                    'sale_tgbd'=>'required',
                    'sale_tgkt'=>'required',
                    'sale_noidung'=>'nullable',
                ],
                [
                    'sale_tgbd.required'=>'Chưa nhập ngày bắt đầu',
                    'sale_tgkt.required'=>'Chưa nhập ngày kết thúc',
                ]
            );
            $sale=sale::find($id);
            if($request->sp_ma!=null){
                if($sale->update($validated)){
                    foreach($request->giamgia as $key1 => $value1){
                        foreach($sale->sanphams as $sanpham){
                            if($key1==$sanpham->sp_ma){
                                $sale->sanphams()->detach((integer)$key1);
                            }
                        }
                    }
                    foreach($request->sp_ma as $key => $value){
                        foreach($request->giamgia as $key1 => $value1){
                            if($value==$key1){
                                $sale->sanphams()->attach((float)$value,['giamgia'=>(float)$value1]);
                            }
                        }
                    }
                }
                return redirect()->route('admin.sanpham.sale.sua',['id'=>$id])->with('thanhcong','Cập nhật sale thành công');
            }
            return back()->withInput()->with('thatbai','cập nhật sale thất bại! Bạn chưa chọn sản phẩm để sale');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Cập nhật sale thất bại!');
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
        $sale=sale::find($id);
        $sale->delete();
        return redirect()->route('admin.sanpham.sale.hienthi')->with('thanhcong','xóa sale thành công');
    }
}
