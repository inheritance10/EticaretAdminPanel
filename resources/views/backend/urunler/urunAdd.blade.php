@extends('backend.layout')

@section('content-title','Ürün Kayıt')

@section('content')

    <div class="auth-form-container text-start" style="width: 50%;">
        <div align="right">
            <a href="{{route('product.index')}}">
                <button class='btn btn-success'>Geri Dön</button>
            </a>
        </div>
        <form class="auth-form login-form" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <label for="">Kategori Seçiniz</label>
            <div class="mb-3 box">
                <select>
                    @foreach($products as $product)
                        <option value="{{$product->kategori_id}}">{{$product->kategori_adi}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Ürün Adı</label>
                <input name="urun_adi" type="text" class="form-control">
            </div><!--//form-group-->
            <div class="mb-3">
                <label>Ürün Fiyat</label>
                <input name="urun_fiyat" type="text" class="form-control">
            </div><!--//form-group-->
            <div class="mb-3">
                <label>Ürün Stok</label>
                <input name="urun_stok" type="text" class="form-control">
            </div><!--//form-group-->
            <div class="mb-3">
                <label>Görsel</label>
                <input name="personel_file" type="file" class="form-control">
            </div><!--//form-group-->
            <div class="mb-3">
                <label>Zam - İndirim Oranı</label>
                <input name="zam_indirim" type="text" class="form-control">
            </div><!--//form-group-->
            <div class="mb-3">
                <label for="">Ürüne Zam Yap</label>
                <input name="urun_zam" type="radio">
                <br><br>
                <label for="">Ürüne İndirim Yap</label>
                <input name="urun_indirim" type="radio">
            </div><!--//form-group-->

            <div class="text-center">
                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Kayıt Oluştur</button>
            </div>
        </form>
    </div><!--//auth-form-container-->




@endsection





@section('css')

@endsection



@section('js')
@endsection


