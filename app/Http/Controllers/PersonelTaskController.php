<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class PersonelTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::leftJoin('users', 'tasks.user_id', '=', 'users.id')
            ->where('rol', '=', 0 )
            ->get();


        $auth_personel = User::Join('tasks','tasks.user_id','=','users.id')->where('user_id',Auth::user()->id)->get();

        return view('backend.gorevler.gorev',compact('tasks','auth_personel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $personel_tasks = Task::where('user_id',$id)->get();
        $personel = User::where('id',$id)->first();

        //$task_count = Task::where('user_id',$id)->count();


        return view('backend.gorevler.gorevUpdate',compact('personel_tasks','personel'));
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
        /*$personel = User::leftJoin('tasks', 'tasks.user_id', '=', 'users.id')
            ->where('name',$request->name)
            ->get();*/


        $personel = User::find($id);

        if($personel->gorev_varmi ==0){
            $personel_tasks = Task::create([
                'user_id' => $id,
                'gorev_adi' => $request->gorev_adi,
                'gorev_aciklama' => $request->gorev_aciklama,
                'gorev_durumu' => 0,
            ]);
            User::where('id',$id)->update([
                'gorev_varmi' => 1
            ]);
            if($personel_tasks){
                return redirect(route('gorev.index'))->with('success','G??rev atamas?? ba??ar??yla yap??ld??');
            }
            return back()->with('error','G??rev atamas?? ba??ar??s??z');
        }
        else{
            $personel_tasks = Task::where('id' ,$id)
                ->update([
                    'user_id' => $id,
                    'gorev_adi' => $request->gorev_adi,
                    'gorev_aciklama' => $request->gorev_aciklama,
                    'gorev_durumu' => 0
                ]);

            if($personel_tasks){
                return redirect(route('gorev.index'))->with('success','G??rev  ba??ar??yla g??ncellendi');
            }
            return back()->with('error','G??rev g??ncelleme ba??ar??s??z');
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


        /*$personel = User::leftJoin('tasks', 'tasks.user_id', '=', 'users.id')
           ->where('name',$request->name)
           ->get();*/

        $task = Task::where('id',$id)->first();

        //$user_id = Task::where('id',$task->id)->first();
        if($task->delete()){
            $task->update([
               'gorev_durumu' => 1
            ]);
            if(isEmpty($task)){
                User::where('id',$task->user_id)->update([
                    'gorev_varmi' => 0
                ]);
            }
            return redirect(route('gorev.index'))->with('success','G??rev ba??ar??yla iptal edildi');
        }
        return back()->with('error','G??rev iptal edilemedi');
    }
}
