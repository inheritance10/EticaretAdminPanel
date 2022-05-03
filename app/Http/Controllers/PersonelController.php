<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personel['personel'] = User::where('rol' ,'=',0)->get();
        return view('backend.personeller.personel',compact('personel'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.personeller.personelAdd');
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

        if($request->has('personel_file')){
            $request->validate([
               'personel_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid().'.'.$request->personel_file->getClientOriginalExtension();
            $request->personel_file->move(public_path('/personel_img'),$file_name);

            $personel = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'rol' => 0,
                'file_name' => $file_name,
                'password' => Hash::make($request->password)
            ]);
        }else{
            $personel = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'rol' => 0,
                'password' => Hash::make($request->password)
            ]);
        }

        if($personel){
            return redirect(route('personel.index'))
                ->with('success','Personel kaydı başarıyla tamamlandı');
        }

        return back()->with('error','Personel kaydı başarısız');

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
        $person = User::where('id',$id)->first();
        return view('backend.personeller.personelUpdate',compact('person'));
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
           'email' => 'required|email',
        ]);

        if($request->hasFile('personel_file')){
            $request->validate([
               'personel_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid().'.'.$request->personel_file->getClientOriginalExtension();
            $request->personel_file->move(public_path('/personel_img'),$file_name);


            if(intval(strlen($request->password)) == 0){
                $person = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'file_name' => $file_name,
                        'rol' => 0
                    ]);
            }else{
                $request->validate([
                    'password' => 'required|min:6'
                ]);

                $person = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'file_name' => $file_name,
                        'password' => Hash::make($request->password),
                        'rol' => 0
                    ]);
            }

            $path = 'personel_img/'.$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }

        }else{
            if(intval(strlen($request->password)) == 0){
                $person = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'rol' => 0
                    ]);
            }else{
                $person = User::where('id',$id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'rol' => 0
                    ]);
            }
        }
        if($person){
            return redirect(route('personel.index'))->with('success','Personel Kaydı Başarıyla Güncellendi');
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
        $personel = User::find($id);
        if($personel->delete()){
            return back()->with('delete','Personel Kaydı Başarıyla Silindi');
        }
        return back()->with('deleteError','Personel Kaydı  Silinemedi');
    }

}
