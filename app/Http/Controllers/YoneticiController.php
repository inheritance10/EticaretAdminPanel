<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class YoneticiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yonetici['yonetici'] = User::where('rol' , "=" ,1)->get();
        return view('backend.yoneticiler.yonetici',compact('yonetici'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.yoneticiler.yoneticiAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);


        if($request->hasFile('yonetici_file')){
            $request->validate([
               'yonetici_file' => 'required|image|mimes:jpg,jpeg,png'
            ]);

            $file_name = uniqid().'.'.$request->yonetici_file->getClientOriginalExtension();
            $request->yonetici_file->move(public_path('/yonetici_img'),$file_name);
            $yonetici = User::create([
               'name' =>  $request->name,
                'email' => $request->email,
                'file_name' => $file_name,
                'rol' => 1,
                'password' => $request->password
            ]);
        }else{
            $yonetici = User::create([
                'name' =>  $request->name,
                'email' => $request->email,
                'rol' => 1,
                'file_name' => null,
                'password' => $request->password
            ]);
        }

        if($yonetici){
            return redirect(route('yonetici.index'))->with('success','Yönetici kaydı başarıyla tamamlandı');
        }

        return back()->with('error','Kayıt başarısız');
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
        $yonetici = User::where('id',$id)->first();
        return view('backend.yoneticiler.yoneticiUpdate',compact('yonetici'));
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
        $request->validate([
           'name' => 'required',
           'email' => 'required|email'
        ]);

        if($request->hasFile('yonetici_file')){
            $request->validate([
                'yonetici_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid().'.'.$request->yonetici_file->getClientOriginalExtension();
            $request->yonetici_file->move(public_path('/yonetici_img'),$file_name);

            if(intval(strlen($request->password)) == 0){
                $yonetici = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'file_name' => $file_name,
                        'rol' => 1
                    ]);
            }else{
                $yonetici = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'file_name' => $file_name,
                        'rol' => 1,
                        'password' => Hash::make($request->password)
                    ]);
            }

            $path = 'yonetici_img/'.$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
        }else{
            if(intval(strlen($request->password)) == 0){
                $yonetici = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'rol' => 1
                    ]);
            }else{
                $yonetici = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'rol' => 1,
                        'password' => Hash::make($request->password)
                    ]);
            }
        }

        if($yonetici){
            return redirect(route('yonetici.index'))->with('success','Yönetici kaydı başarıyla güncellendi');
        }

        return back()->with('error','Düzenleme işlemi başarısız');

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
