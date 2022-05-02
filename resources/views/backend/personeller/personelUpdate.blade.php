@extends('backend.layout')

@section('content-title','Personel Kaydı Düzenle')

@section('content')
    <div class="auth-form-container text-start" style="width: 50%;">
        <div align="right">
            <a href="{{route('personel.index')}}">
                <button class='btn btn-success'>Geri Dön</button>
            </a>
        </div>
        <form class="auth-form login-form" method="post" action="{{route('personel.update',$person->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Ad Soyad</label>
                <input name="name" type="text" class="form-control" value="{{$person->name}}">
            </div><!--//form-group-->
            <div class="email mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="{{$person->email}}">
            </div><!--//form-group-->
            <div class="email mb-3">
                <label>Şifre Güncelle</label>
                <input name="password" type="password" class="form-control">
            </div><!--//form-group-->

            <div class="mb-3">
                <label>Görsel</label>
                <input name="personel_file" type="file" class="form-control">
            </div><!--//form-group-->
            @isset($person->file_name)
            <div class="mb-3">
                <img src="/personel_img/{{$person->file_name}}" width="100px;" alt="">
            </div><!--//form-group-->
            @endisset
            <input type="hidden" name="old_file" value="{{$person->file_name}}">

            <div class="text-center">
                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Kayıt Düzenle</button>
            </div>
        </form>
    </div><!--//auth-form-container-->




@endsection





@section('css')
@endsection



@section('js')
@endsection

