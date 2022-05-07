@extends('backend.layout')

@section('content-title','Personel Görev Düzenleme')

@section('content')
    <div class="auth-form-container text-start" style="width: 75%;">
        <div align="right">
            <a href="{{route('personel.index')}}">
                <button class='btn btn-success'>Geri Dön</button>
            </a>
        </div>
        <form class="auth-form login-form" method="post" action="{{route('gorev.update',$personel->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Ad Soyad</label>
                <input name="name" type="text" class="form-control" value="{{$personel->name}}">
            </div><!--//form-group-->
            <div class="mb-3">
                <label>Görev Adı</label>
                <input name="gorev_adi" type="text" class="form-control" @if($personel->gorev_varmi == 1) value="{{$personel_tasks[0]->gorev_adi}}"@endif>
            <div class="mb-3">
                <label>Görev Açıklama</label>
                <textarea name="gorev_aciklama" class="form-control" style="height: 100px">@if($personel->gorev_varmi == 1) {{$personel_tasks[0]->gorev_aciklama}}@endif</textarea>
            </div><!--//form-group-->
            <div class="text-center">
                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                    Görev Ata
                </button>
            </div>
        </form>
        @if($personel->gorev_varmi == 1)
            <div class="table-responsive mt-5">
                <div class="alert alert-info">
                    <p>
                        Bu personelin {{count($personel_tasks)}} adet görevi mevcuttur
                    </p>
                </div>
                <h3>Mevcut Görevler</h3>
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                    <tr>
                        <th class="cell">Görev Adı</th>
                        <th class="cell">Görev Açıklama</th>
                        <th class="cell">Görev Durumu</th>
                        <th class="cell"></th>
                        <th class="cell"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personel_tasks as $task)
                        <tr>
                            <td class="cell"><span class="truncate">{{$task->gorev_adi}}</span></td>
                            <td class="cell"><span class="truncate">{{$task->gorev_aciklama}}</span></td>
                            <td class="cell"><span class="truncate">{{$task->gorev_durumu}}</span></td>
                            <td class="cell"><span class="truncate">{{$task->id}}</span></td>
                            <form method="post" action="{{route('gorev.destroy',$task->id)}}">
                                @csrf
                                @method('DELETE')
                                <td class="cell">
                                    <button type="submit" class="btn btn-danger">
                                        İptal
                                    </button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--//table-responsive-->
        @endif
    </div><!--//auth-form-container-->
@endsection





@section('css')
@endsection



@section('js')
@endsection



