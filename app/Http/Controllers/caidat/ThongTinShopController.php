<?php

namespace App\Http\Controllers\caidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\thongtinshop;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ThongTinShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    public function edit()
    {
        $thongtinshop = thongtinshop::find(1);
        return view('admin.caidat.thongtinshop.sua',compact('thongtinshop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $thongtinshop = thongtinshop::find(1);

        $validated = $request->validate(
        [
            'shop_ten'=>'required',
            'shop_sdt'=>'required',
            'shop_diachi'=>'required',
            'shop_email'=>'required',
            'shop_maugd'=>'required',

        ],
        [
            'shop_ten.required'=>'Vui lòng nhập tên shop',
            'shop_sdt.required'=>'Vui lòng nhập số điện thoại',
            'shop_diachi.required'=>'Vui lòng nhập địa chỉ shop',
            'shop_email.required'=>'Vui lòng nhập email',
            'shop_maugd.required'=>'Vui lòng chọn màu giao diện',
        ]);
        $random = Str::random(10);
        if ($request->hasFile('shop_logo')) {
            $pathimg = public_path('uploads/img/' . $thongtinshop->shop_logo);
                    if (File::exists($pathimg)) {
                        File::delete($pathimg);
                    }
            $extension = $request->shop_logo->extension();
            $pathimg = $random.$thongtinshop->shop_logo.'.'.$extension;
            $request->file('shop_logo')->move(public_path('uploads/img'), $pathimg);
            $thongtinshop->shop_logo = $pathimg;
            $thongtinshop->save(); 
        }
        if ($thongtinshop->update($validated)){
            return redirect()->route('admin.caidat.thongtinshop.sua')->with('thanhcong','Cập nhật thành công');
        }else{
            return back()->withInput()->with('thatbai', 'Cập nhật thất bại');
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
