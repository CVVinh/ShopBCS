<?php

namespace App\Http\Controllers\danhmucdulieu;

use App\Models\vanchuyen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class VanChuyenController extends Controller
{
    
    public function index()
    {
        $vanchuyens=vanchuyen::paginate(10);
        return view('admin.danhmucdulieu.vanchuyen.hienthi',compact('vanchuyens'));
    }

    
    public function create(Request $request)
    {
       
    }

    
    public function store(Request $request)
    {
        try{
            $validated=$request->validate(
                [
                    'vc_ten'=>'required',
                    'vc_tinhtrang'=>'required',
                ],
                [
                    'vc_ten.required'=>'Vui lòng nhập tên vận chuyển',
                    'vc_tinhtrang.required'=>'Vui lòng chọn tình trạng',

                ]
            );
            if($request->vc_ma==null){
                $vanchuyen=vanchuyen::create($validated);
                $random = Str::random(10);
                if ($request->hasFile('vc_hinh')) {
                    $extension = $request->vc_hinh->extension();
                    $pathimg = $random . $vanchuyen->lsp_ma . '.' . $extension;
                    $request->file('vc_hinh')->move(public_path('uploads/img'), $pathimg);
                    $vanchuyen->vc_hinh = $pathimg;
                }
                if($vanchuyen->save()){
                    return back()->with('thanhcong','thêm vận chuyển thành công');
                }
                return back()->withInput()->with('thatbai','thêm vận chuyển thất bại!');
            }else{
                $vanchuyen=vanchuyen::find($request->vc_ma);
                $random = Str::random(10);
                if ($request->hasFile('vc_hinh')) {
                    $pathimg = public_path('uploads/img/' . $vanchuyen->vc_hinh);
                    if (File::exists($pathimg)) {
                        File::delete($pathimg);
                    }
                    $extension = $request->vc_hinh->extension();
                    $pathimg_update = $random . $vanchuyen->lsp_ma . '.' . $extension;
                    $request->file('vc_hinh')->move(public_path('uploads/img'), $pathimg_update);
                    $vanchuyen->vc_hinh = $pathimg_update;
                }
                if($vanchuyen->update($validated)){
                    return back()->with('thanhcong','cập nhật vận chuyển thành công');
                }
                return back()->withInput()->with('thatbai','Cập nhật vận chuyển thất bại!');
            }
        }catch(QueryException $ex){
            return back()->withInput()->with('canhbao','thêm vận chuyển thất bại! Lỗi Kĩ thuật');
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
            $vanchuyen=vanchuyen::find($id);
            $hinh=$vanchuyen->vc_hinh;
            if($vanchuyen->delete()){
                $pathimg = public_path('uploads/img/'.$hinh);
                if (File::exists($pathimg)) {
                    File::delete($pathimg);
                }
                return back()->with('thanhcong','Xóa mục vận chuyển thành công');
            }
            return back()->withInput()->with('thatbai','Xóa vận chuyển thất bại!');
        }catch(QueryException $ex){
            $vanchuyen=vanchuyen::find($id);
            $vanchuyen->vc_tinhtrang='0';
            $vanchuyen->save();
            return back()->withInput()->with('canhbao','Dữ liệu đã chuyển sang trạng thái ngừng sử dụng. Do vận chuyển này không thể xóa vĩnh viễn');
        }
    }
}
