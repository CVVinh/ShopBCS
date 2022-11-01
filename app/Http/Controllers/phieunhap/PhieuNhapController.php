<?php

namespace App\Http\Controllers\phieunhap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuNhap;
use App\Models\Sanpham;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\QueryException;

class PhieuNhapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phieunhaps=PhieuNhap::paginate(10);
        return view('admin.phieunhap.hienthi',compact('phieunhaps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sanphams=sanpham::where('sp_tinhtrang','1')->get();
        return view('admin.phieunhap.them',compact('sanphams'));
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
            if($request->sp_ma!=null){
                $nhanvien=Auth::guard('nv')->user();
                $phieunhap=PhieuNhap::create(['nv_ma'=>$nhanvien->nv_ma]);
                $tongtien=0.0;
                foreach($request->sp_ma as $key => $value){
                    $sanpham=sanpham::find($value);
                    $sl=$sanpham->sp_soluong;
                    foreach($request->soluong as $key1 => $value1){
                        if($value==$key1){
                            $thanhtien=$request->gianhap[$key1]*$request->soluong[$key1];
                            $tongtien+=$thanhtien;
                            $sl+=$request->soluong[$key1];
                            $phieunhap->sanphams()->attach((float)$value,['soluong'=>(float)$value1,'gianhap'=>(float)$request->gianhap[$key1],'thanhtien'=>(float)$thanhtien]);
                        }
                    }
                    $sanpham->sp_soluong=$sl;
                    $sanpham->save();
                }
                $phieunhap->pn_tongtien=$tongtien;
                $phieunhap->save();
                return redirect()->route('admin.phieunhap.hienthi')->with('thanhcong','Tạo phiếu nhập thành công');
            }
            return back()->withInput()->with('thatbai','Tạo phiếu nhập thất bại! Bạn chưa chọn sản phẩm để sale');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Tạo phiếu nhập thất bại! Lỗi kỹ thuật');
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
        $phieunhap=phieunhap::find($id);
        $result=sanpham::where('sp_tinhtrang',1)->orderBy('sp_ten')->get();
        $sanphams=$result;

        $i=0;
        foreach($result as $sanpham){
            foreach($phieunhap->sanphams as $sanpham1){
                if($sanpham1->sp_ma==$sanpham->sp_ma){
                    unset($sanphams[$i]);
                }
            }
            $i++;
        }
        return view('admin.phieunhap.sua',compact('phieunhap','sanphams'));
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
        try{
            if($request->sp_ma!=null){
                $phieunhap=PhieuNhap::find($id);
                $tongtien=0.0;

                foreach($request->soluong as $key1 => $value1){
                    foreach($phieunhap->sanphams as $sanpham){
                        if($key1==$sanpham->sp_ma){
                            $sl=$sanpham->sp_soluong-$sanpham->pivot->soluong;
                            $sanpham1=sanpham::find($sanpham->sp_ma);
                            $sanpham1->sp_soluong=$sl;
                            $sanpham1->save();
                            $phieunhap->sanphams()->detach((integer)$key1);
                        }
                    }
                }


                foreach($request->sp_ma as $key => $value){
                    $sanpham=sanpham::find($value);
                    $sl=$sanpham->sp_soluong;
                    foreach($request->soluong as $key1 => $value1){
                        if($value==$key1){
                            $thanhtien=$request->gianhap[$key1]*$request->soluong[$key1];
                            $tongtien+=$thanhtien;
                            $sl+=$request->soluong[$key1];
                            $phieunhap->sanphams()->attach((float)$value,['soluong'=>(float)$value1,'gianhap'=>(float)$request->gianhap[$key1],'thanhtien'=>(float)$thanhtien]);
                        }
                    }
                    $sanpham->sp_soluong=$sl;
                    $sanpham->save();
                }
                $phieunhap->pn_tongtien=$tongtien;
                $phieunhap->save();
                return redirect()->route('admin.phieunhap.hienthi')->with('thanhcong','Cập nhật phiếu nhập thành công');
            }
            return back()->withInput()->with('thatbai','Cập nhật phiếu nhập thất bại! Bạn chưa chọn sản phẩm để sale');
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Cập nhật phiếu nhập thất bại! Lỗi kỹ thuật');
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
