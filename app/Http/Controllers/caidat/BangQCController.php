<?php

namespace App\Http\Controllers\caidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bangqc;
use App\Models\hinhqc;

use \Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class BangQCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bangqcs = bangqc::paginate(10);
        return view('admin.caidat.bangqc.hienthi',compact('bangqcs'));
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
    public function edit($id)
    {
        $bangqc=Bangqc::find($id);
        return view('admin.caidat.bangqc.sua',compact('bangqc'));
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
                $bangqc=Bangqc::find($id);  
                $hinhqc_s=$request->file('hqc_ten');
                if($request->hasFile('hqc_ten')){
                    $hinhqcs=hinhqc::where('qc_ma', $id)->get();
                    foreach($hinhqcs as $hinhqc1){
                        $pathimg=public_path('uploads/img/'.$hinhqc1->hqc_ten);
                        if(File::exists($pathimg)){
                            File::delete($pathimg);
                        }
                        $hinhqc1->delete();
                    }
                    foreach($hinhqc_s as $hinhqc){
                        $extension=$hinhqc->extension();
                        $pathimg=Str::random(10).$bangqc->qc_ma.'.'.$extension;
                        $hinhqcnew= new hinhqc();
                        $hinhqc->move(public_path('uploads/img'),$pathimg);
                        $hinhqcnew->hqc_ten=$pathimg;
                        $hinhqcnew->qc_ma=$bangqc->qc_ma;
                        $hinhqcnew->save();
                    }
                }            
            return redirect()->route('admin.caidat.bangqc.sua',['id'=>$id])->with('thanhcong','Cập nhật thành công');

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
        //
    }
}
