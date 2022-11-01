<?php

namespace App\Http\Controllers\sanpham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\combo;
use \Illuminate\Database\QueryException;
class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $sp=sanpham::find($id);
        // if($sp->combo==null){
        //     $combo=combo::create(['sp_ma'=>$id]);
        // }else{
        //     $combo=combo::find($sp->combo->km_ma);
        // }
        $combo=combo::where('idspgoc',$sp->sp_ma)->get();
        $result=sanpham::where('sp_tinhtrang',1)->orderBy('sp_ten')->get();
        $sanphams=$result;
        $i=0;
        
        foreach($result as $sanpham){
            foreach($combo as $cb){
                if($cb->idspphu==$sanpham->sp_ma){
                    unset($sanphams[$i]);
                }
            }
            $i++;
        }
        return view('admin.sanpham.suacombo',compact('sanphams','sp','combo','id'));
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
            $combo=combo::where('idspgoc',$id)->get();
            foreach($combo as $cb){
                $cb->delete();
            }
            if($request->sp_ma!=null){
                foreach($combo as $cb){
                    $cb->delete();
                }
                foreach($request->sp_ma as $key => $value){
                    foreach($request->dv_ma as $key1 => $value1){
                        if($value==$key1){
                            combo::create(['idspgoc'=>$id,'idspphu'=>$value,'dv_ma'=>$request->dv_ma[$key1]]);
                        }
                    }
                }
                return redirect()->route('admin.sanpham.suacombo',['id'=>$id])->with('thanhcong','Cập nhật combo thành công');
            }
            return back()->withInput()->with('thanhcong','Cập nhật combo thành công');
        }catch(QueryException $ex){
            dd($ex);
            return back()->withInput()->with('thatbai','Cập nhật combo thất bại!');
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
