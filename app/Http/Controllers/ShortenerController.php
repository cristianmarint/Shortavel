<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\links;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Redirect;


class ShortenerController extends Controller
{
    public function redir($hash){
        $data = links::where('shorturl','=',$hash)->first();
        if($data!=null){
            try {
                DB::beginTransaction();
                $data->view_count=$data->view_count+1;
                $data->save();
                DB::commit();
            } catch (\Throwable $e) {
                $error = $e->getMessage();
                DB::rollback();
            }
            return Redirect::to($data->origin);
        }else{
            return "El enlace no existe ";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'origin' => 'required|unique:links,origin|string|max:500'
        ]);
        DB::beginTransaction();
        
        try{
            $success = true;
            $IsItUnique = links::where('origin','=',$request->input('origin'))->first();
            if($IsItUnique!=null){
                $success=false;
                return redirect(url('/show/'.$IsItUnique->hash));
            }
            
            $link = new links;
            $link->origin=$request->input('origin');
            $link->shorturl=Str::random(5);
            $link->view_count=0;
            $link->save();
        }catch(\exception $e){
            $success = false;
            $error_save = $e->getMessage();
            DB::rollback();
        }
        
        if($success){
            DB::commit();
            return redirect(url('/show/'.$link->shorturl,compact($link)))->with('success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $link = links::where('shorturl','=',$hash)->first();
        return view('show',compact('link'));
    }
}
