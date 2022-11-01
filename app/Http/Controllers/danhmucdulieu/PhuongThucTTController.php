<?php

namespace App\Http\Controllers\danhmucdulieu;

use App\Models\thanhtoan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class PhuongThucTTController extends Controller
{
    
    public function index()
    {
        $phuongthuctts = thanhtoan::paginate(10);
        return view('admin.danhmucdulieu.phuongthucthanhtoan.hienthi', compact('phuongthuctts'));
    }

    public function create(Request $request)
    {
        
    }

    
    public function store(Request $request)
    {
        try{
            $validated=$request->validate(
                [
                    'tt_ten'=>'required',
                    'tt_tinhtrang'=>'required',
                ],
                [
                    'tt_ten.required'=>'Vui lòng nhập tên phương thức thanh toán',
                    'tt_tinhtrang.required'=>'Vui lòng chọn tình trạng',

                ]
            );
            if($request->tt_ma==null){
                $phuongthuctt=thanhtoan::create($validated);
                $random = Str::random(10);
                if ($request->hasFile('tt_hinh')) {
                    $extension = $request->tt_hinh->extension();
                    $pathimg = $random . $phuongthuctt->lsp_ma . '.' . $extension;
                    $request->file('tt_hinh')->move(public_path('uploads/img'), $pathimg);
                    $phuongthuctt->tt_hinh = $pathimg;
                }
                if($phuongthuctt->save()){
                    return back()->with('thanhcong','thêm phương thức thanh toán thành công');
                }
                return back()->withInput()->with('thatbai','thêm phương thức thanh toán thất bại!');
            }else{
                $phuongthuctt=thanhtoan::find($request->tt_ma);
                $random = Str::random(10);
                if ($request->hasFile('tt_hinh')) {
                    $pathimg = public_path('uploads/img/' . $phuongthuctt->tt_hinh);
                    if (File::exists($pathimg)) {
                        File::delete($pathimg);
                    }
                    $extension = $request->tt_hinh->extension();
                    $pathimg_update = $random . $phuongthuctt->lsp_ma . '.' . $extension;
                    $request->file('tt_hinh')->move(public_path('uploads/img'), $pathimg_update);
                    $phuongthuctt->tt_hinh = $pathimg_update;
                }
                if($phuongthuctt->update($validated)){
                    return back()->with('thanhcong','cập nhật phương thức thanh toán thành công');
                }
                return back()->withInput()->with('thatbai','Cập nhật phương thức thanh toán thất bại!');
            }
        }catch(QueryException $ex){
            return back()->withInput()->with('canhbao','thêm phương thức thanh toán thất bại! Lỗi Kĩ thuật');
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
            $phuongthuctt=thanhtoan::find($id);
            $hinh=$phuongthuctt->tt_hinh;
            if($phuongthuctt->delete()){
                $pathimg = public_path('uploads/img/'.$hinh);
                if (File::exists($pathimg)) {
                    File::delete($pathimg);
                }
                return back()->with('thanhcong','Xóa mục thanh toán thành công');
            }
            return back()->withInput()->with('thatbai','Xóa thanh toán thất bại!');
        }catch(QueryException $ex){
            $phuongthuctt=thanhtoan::find($id);
            $phuongthuctt->tt_tinhtrang='0';
            $phuongthuctt->save();
            return back()->withInput()->with('canhbao','Dữ liệu đã chuyển sang trạng thái ngừng sử dụng. Do thanh toán này không thể xóa vĩnh viễn');
        }
    }

}
