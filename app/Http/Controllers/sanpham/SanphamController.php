<?php
namespace App\Http\Controllers\sanpham;

use App\Models\donvi;
use App\Models\giaban;
use App\Models\hinhsp;
use App\Models\loaisp;
use App\Models\Sanpham;
use App\Models\khuyenmai;
use App\Models\danhmucsp;
use App\Models\Nhasanxuat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use \Illuminate\Database\QueryException;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sanphams = Sanpham::with('nhasanxuat')->paginate(10);
        return view('admin.sanpham.hienthi')->with('sanphams', $sanphams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhasanxuats=Nhasanxuat::where('nsx_tinhtrang',1)->get();
        $danhmucsps=danhmucsp::where('dm_tinhtrang',1)->get();
        $donvis=donvi::where('dv_tinhtrang',1)->get();
        return view('admin.sanpham.them',compact('nhasanxuats','danhmucsps','donvis'));
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
            $validated=$request->validate(
                [
                    'sp_ten'=>'required',
                    'sp_soluong'=>'nullable',
                    'sp_gianhap'=>'nullable',
                    'sp_mota'=>'nullable',
                    'sp_thongtin'=>'nullable',
                    'nsx_ma'=>'required',
                    'lsp_ma'=>'required',
                ],
                [
                    'sp_ten.required'=>'Chưa nhập tên',
                    'sp_soluong.required'=>'Chưa nhập giá',
                    'nsx_ma.required'=>'Chưa chọn nhà sản xuất',
                    'lsp_ma.required'=>'Chưa chọn loại sản phẩm',
                ]
            );
            $loaisp=loaisp::find($request->lsp_ma);
            $sanpham=sanpham::create($validated);
            $khuyenmai=khuyenmai::create(['sp_ma'=>$sanpham->sp_ma]);
            if($request->hasFile('sp_hinh')){
                $extension1=$request->sp_hinh->extension();
                $pathimg1=time().'.'.$extension1;
                $request->file('sp_hinh')->move(public_path('uploads/img'),$pathimg1);
                $sanpham->sp_hinh=$pathimg1;
                $sanpham->save();
            }

            foreach($request->dv_ma as $key => $value){
                foreach($request->giaban as $key1 => $value1){
                if($value==$key1){
                    $sanpham->donvis()->attach((integer)$value,['giaban'=>(float)$value1]);
                    }
                }
            }
        


            $hinhsps=$request->file('h_ten');
            if($request->hasFile('h_ten')){
                foreach($hinhsps as $hinhsp){
                    $extension=$hinhsp->extension();
                    $pathimg=Str::random(10).$sanpham->sp_ma.'.'.$extension;
                    $hinhspnew= new hinhsp();
                    $hinhsp->move(public_path('uploads/img'),$pathimg);
                    $hinhspnew->h_ten=$pathimg;
                    $hinhspnew->sp_ma=$sanpham->sp_ma;
                    $hinhspnew->save();
                }
            }
            $sanpham->sp_ten=$loaisp->lsp_ten.' '.$request->sp_ten;
            $sanpham->save();
            return redirect()->route('admin.sanpham.them')->with('thanhcong','Thêm thành công');
    
        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Thêm thất bại!');
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
        $sanpham=sanpham::find($id);
        $nhasanxuats=Nhasanxuat::where('nsx_tinhtrang',1)->get();
        $danhmucsps=danhmucsp::where('dm_tinhtrang',1)->get();
        $loaisps=loaisp::where('lsp_tinhtrang',1)->get();
        $result=donvi::where('dv_tinhtrang',1)->orderBy('dv_ma')->get();
        $donvis=$result;
        $i=0;
        foreach($result as $donvi){
            foreach($sanpham->donvis as $donvi1){
                if($donvi1->dv_ma==$donvi->dv_ma){
                    unset($donvis[$i]);
                }
            }
            $i++;
        }
        return view('admin.sanpham.sua',compact('nhasanxuats','danhmucsps','sanpham','loaisps','donvis'));
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
        // dd($request);
        try {
            $validated=$request->validate(
                [
                    'sp_ten'=>'required',
                    'sp_tinhtrang'=>'required',
                    'sp_soluong'=>'nullable',
                    'sp_gianhap'=>'nullable',
                    'sp_mota'=>'nullable',
                    'sp_thongtin'=>'nullable',
                    'nsx_ma'=>'required',
                    'lsp_ma'=>'required',
                ],
                [
                    'sp_ten.required'=>'Chưa nhập tên',
                    'sp_tinhtrang.required'=>'Chưa chọn tình trạng',
                    'sp_soluong.required'=>'Chưa nhập giá',
                    'nsx_ma.required'=>'Chưa chọn nhà sản xuất',
                    'lsp_ma.required'=>'Chưa chọn loại sản phẩm',
                ]
            );
            $loaisp=loaisp::find($request->lsp_ma);
            $sanpham=sanpham::find($id);
            if($sanpham->update($validated)){
                if($request->hasFile('sp_hinh')){
                    $pathimg=public_path('uploads/img/'.$sanpham->sp_hinh);
                    if(File::exists($pathimg)){
                        File::delete($pathimg);
                    }
                    $extension1=$request->sp_hinh->extension();
                    $pathimg1=time().'.'.$extension1;
                    $request->file('sp_hinh')->move(public_path('uploads/img'),$pathimg1);
                    $sanpham->sp_hinh=$pathimg1;
                    $sanpham->save();
                }
                foreach($request->giaban as $key1 => $value1){
                    foreach($sanpham->donvis as $donvi){
                        if($key1==$donvi->dv_ma){
                            $sanpham->donvis()->detach((integer)$key1);
                        }
                    }
                }
                foreach($request->dv_ma as $key => $value){
                    foreach($request->giaban as $key1 => $value1){
                        if($value==$key1){
                            $sanpham->donvis()->attach((integer)$value,['giaban'=>(float)$value1]);
                        }
                    }
                }

                $hinhsps=$request->file('h_ten');
                if($request->hasFile('h_ten')){
                    $hinhsps1=hinhsp::where('sp_ma', $id)->get();
                    foreach($hinhsps1 as $hinhsp1){
                        $pathimg=public_path('uploads/img/'.$hinhsp1->h_ten);
                        if(File::exists($pathimg)){
                            File::delete($pathimg);
                        }
                        $hinhsp1->delete();
                    }
                    foreach($hinhsps as $hinhsp){
                        $extension=$hinhsp->extension();
                        $pathimg=Str::random(10).$sanpham->sp_ma.'.'.$extension;
                        $hinhspnew= new hinhsp();
                        $hinhsp->move(public_path('uploads/img'),$pathimg);
                        $hinhspnew->h_ten=$pathimg;
                        $hinhspnew->sp_ma=$sanpham->sp_ma;
                        $hinhspnew->save();
                    }
                }
                $sanpham->sp_ten=$loaisp->lsp_ten.' '.$request->sp_ten;
                $sanpham->save();
            }
            return redirect()->route('admin.sanpham.sua',['id'=>$id])->with('thanhcong','Cập nhật thành công');

        }catch(QueryException $ex){
            return back()->withInput()->with('thatbai','Thêm thất bại!');
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
        try{
            $sanpham=sanpham::find($id);
            $hinhsps=hinhsp::where('sp_ma', $id)->get();
            foreach($hinhsps as $hinhsp){
                $pathimg=public_path('uploads/img/'.$hinhsp->h_ten);
                if(File::exists($pathimg)){
                    File::delete($pathimg);
                }
                $hinhsp->delete();
            }
            $pathimg1=public_path('uploads/img/'.$sanpham->sp_hinh);
                if(File::exists($pathimg1)){
                    File::delete($pathimg1);
                }
            $sanpham->delete();
            return redirect()->route('admin.sanpham.hienthi')->with('thanhcong','xóa thành công');
        }catch(QueryException $ex){
            $sanpham=sanpham::find($id);
            $sanpham->sp_tinhtrang='0';
            $sanpham->save();
            return redirect()->route('admin.sanpham.hienthi')->with('canhbao','Sản phẩm đã về trạng thai ngừng hoạt động! sản phẩm này không thể xóa vĩnh viễn vì lí do kĩ thuật');
        }
    }
    public function capnhatgia(){
        return view('admin.sanpham.capnhatgia');
    }
    public function khuyenmai(){
        return view('admin.sanpham.khuyenmai.hienthi');
    }

    public function getByLoaisp($id) {
        $sanphams = sanpham::where('lsp_ma', '=', $id)
        ->where('sp_tinhtrang', '=', 1)
        ->get(['sp_ma', 'sp_ten']);
        return response($sanphams);
    }
    public function searchsp(request $request) {
        $sanphams = sanpham::where('sp_ten','like','%'.$request->keyword.'%')->where('sp_tinhtrang', '=', 1)->limit(10)->get();
        $output = '';
        foreach ($sanphams as $sanpham){
            $output.='<li class="form-show--item" onclick="getValue(this);">'.$sanpham->sp_ten.'</li>';
        }
        return response($output);
    }
}
