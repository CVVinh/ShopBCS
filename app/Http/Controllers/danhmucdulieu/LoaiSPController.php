<?php

namespace App\Http\Controllers\danhmucdulieu;

use App\Http\Controllers\Controller;
use \Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Loaisp;
use App\Models\Danhmucsp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class LoaiSPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmucsps = Danhmucsp::all();
        $loaisps = Loaisp::paginate(10);
        return view('admin.danhmucdulieu.loaisanpham.hienthi', compact('danhmucsps', 'loaisps'));
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
        try {
            $validated = $request->validate(
                [
                    'lsp_ten' => 'required',
                    'dm_ma' => 'required',
                    'lsp_tinhtrang' => 'required',
                ],
                [
                    'lsp_ten.required' => 'Vui lòng nhập tên loại thức uống',
                    'dm_ma.required' => 'Vui lòng chọn danh mục',
                    'lsp_tinhtrang.required' => 'Vui lòng chọn tình trạng',
                ]
            );
            $danhmucsp=Danhmucsp::find($request->dm_ma);
            if ($request->lsp_ma == null) {
                $loaisp = new loaisp;
                $loaisp->lsp_ten=$danhmucsp->dm_ten." ".$request->lsp_ten;
                $loaisp->dm_ma = $request->dm_ma;
                $loaisp->lsp_tinhtrang = $request->lsp_tinhtrang;
                $random = Str::random(10);
                if ($request->hasFile('lsp_hinh')) {
                    $extension = $request->lsp_hinh->extension();
                    $pathimg = $random . $loaisp->lsp_ma . '.' . $extension;
                    $request->file('lsp_hinh')->move(public_path('uploads/img'), $pathimg);
                    $loaisp->lsp_hinh = $pathimg;
                    
                }
                if ($loaisp->save()) {
                    return redirect()->route('admin.danhmucdulieu.loaisanpham.hienthi')->with('thanhcong', 'Thêm thành công');
                } else {
                    return back()->withInput()->with('thatbai', 'Thêm thất bại!');
                }
            } else {
                $loaisp = loaisp::find($request->lsp_ma);
                $loaisp->lsp_ten=$danhmucsp->dm_ten." ".$request->lsp_ten;
                $loaisp->dm_ma = $request->dm_ma;
                $loaisp->lsp_tinhtrang = $request->lsp_tinhtrang;
                $random = Str::random(10);
                if ($request->hasFile('lsp_hinh')) {
                    $pathimg = public_path('uploads/img/' . $loaisp->lsp_hinh);
                    if (File::exists($pathimg)) {
                        File::delete($pathimg);
                    }
                    $extension = $request->lsp_hinh->extension();
                    $pathimg_update = $random . $loaisp->lsp_ma . '.' . $extension;
                    $request->file('lsp_hinh')->move(public_path('uploads/img'), $pathimg_update);
                    $loaisp->lsp_hinh = $pathimg_update;
                }
                if ($loaisp->save()) {
                    return redirect()->route('admin.danhmucdulieu.loaisanpham.hienthi')->with('thanhcong', 'Cập nhật thành công');
                } else {
                    return back()->withInput()->with('thatbai', 'Cập nhật thất bại!');
                }
            }
        } catch (QueryException $ex) {
            return back()->withInput()->with('canhbao', 'Thêm thất bại! Lỗi Kĩ thuật');
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
            
            $loaisp=Loaisp::find($id);
            $hinh=$loaisp->lsp_hinh;
            if($loaisp->delete()){
                $pathimg = public_path('uploads/img/'.$hinh);
                if (File::exists($pathimg)) {
                    File::delete($pathimg);
                }
                return back()->with('thanhcong','Xóa loại sản phẩm thành công');
            }
            return back()->withInput()->with('thatbai','Xóa loại sản phẩm thất bại!');
        }catch(QueryException $ex){
            $loaisp=Loaisp::find($id);
            $loaisp->lsp_tinhtrang='0';
            $loaisp->save();
            return back()->withInput()->with('canhbao','Dữ liệu đã chuyển sang trạng thái ngừng dừng dụng. Do loại sản phẩm này không thể xóa vĩnh viễn');
        }
    }

    public function getByDanhMucSP($id) {
        $loaisps = Loaisp::where('dm_ma', '=', $id)
        ->where('lsp_tinhtrang', '=', 1)
        ->get(['lsp_ma', 'lsp_ten']);
        return response($loaisps);
    }
}
