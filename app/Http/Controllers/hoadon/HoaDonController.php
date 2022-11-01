<?php

namespace App\Http\Controllers\hoadon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\Sanpham;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use \Illuminate\Database\QueryException;
class HoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoadons=hoadon::where('hd_tinhtrang','!=','0')->paginate(10);
        return view('admin.hoadon.hienthi',compact('hoadons'));
    }
    public function chuaduyet()
    {
        $hoadons=hoadon::where('hd_tinhtrang','2')->paginate(10);
        return view('admin.hoadon.chuaduyet',compact('hoadons'));
    }
    public function chuahoanthanh()
    {
        $hoadons=hoadon::where('hd_tinhtrang','1')->paginate(10);
        return view('admin.hoadon.chuahoanthanh',compact('hoadons'));
    }
    public function hoanthanh()
    {
        $hoadons=hoadon::where('hd_tinhtrang','4')->paginate(10);
        return view('admin.hoadon.hoanthanh',compact('hoadons'));
    }
    public function cthoadoncd($id)
    {
        $hoadon=hoadon::find($id);
        return view('admin.hoadon.cthoadoncd',compact('hoadon'));
    }
    public function cthoadonht($id)
    {
        $hoadon=hoadon::find($id);
        return view('admin.hoadon.cthoadonht',compact('hoadon'));
    }
    public function inhoadon($id)
    {
        $hoadon=hoadon::find($id);
        return view('admin.hoadon.inhoadon',compact('hoadon'));
    }
    public function duyet(Request $request,$id)
    {
        try{
            $nhanvien=auth::guard('nv')->user();
            $hoadon=hoadon::find($id);
            $hoadon->nv_ma=$nhanvien->nv_ma;
            if($request->duyet=='duyet'){
                $hoadon->hd_tinhtrang='1';
                $hoadon->save();
                return back()->withInput()->with('thanhcong','Duyệt thành công');
            }elseif($request->tuchoi=='tuchoi'){
                $hoadon->hd_tinhtrang='5';
                $hoadon->save();
                return back()->withInput()->with('thanhcong','Từ chối thành công');
            }elseif($request->khoiphuc=='khoiphuc'){
                $hoadon->hd_tinhtrang='2';
                $hoadon->save();
                return back()->withInput()->with('thanhcong','khôi phục thành công');
            }else{
                $hoadon->hd_tinhtrang='4';
                $hoadon->save();
                return back()->withInput()->with('thanhcong','Hóa đơn đã hoàn tất');
            }
        }catch(QueryException $e){
            return back()->withInput()->with('thatbai','thất bại');
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sanphams=sanpham::where('sp_tinhtrang','1')->get();
        return view('admin.hoadon.them',compact('sanphams'));
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
