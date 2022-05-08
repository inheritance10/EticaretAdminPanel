@extends('backend.layout')

@section('content-title','Ürünler')

@section('content')
    <div class="tab-content" id="orders-table-tab-content">
        <div align="right" class="mb-3">
            <a href="{{route('product.create')}}">
                <button class="btn btn-warning">
                    Ürün Ekle
                </button>
            </a>
        </div>
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                            <tr>
                                <th class="cell">Kategori Adı</th>
                                <th class="cell">Ürün Adı</th>
                                <th class="cell">Ürün Resmi</th>
                                <th class="cell">Fiyat</th>
                                <th class="cell">Stok</th>
                                <th class="cell">Satılan Adet</th>
                                <th class="cell">Kalan Adet</th>
                                <th class="cell">Kar</th>
                                <th class="cell">Zarar</th>
                                <th class="cell">Zam-İndirim</th>
                                <th class="cell"></th>
                                <th class="cell"></th>
                                <th class="cell"></th>
                                <th class="cell"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="cell">{{$product->kategori_adi}}</td>
                                    <td class="cell">{{$product->urun_adi}}</td>
                                    <td class="cell">
                                        <img src="/product_img/{{$product->file_name}}" alt="">
                                    </td>
                                    <td class="cell">{{$product->urun_fiyat}}</td>
                                    <td class="cell">{{$product->urun_stok}}</td>
                                    <td class="cell">{{$product->urun_satis_miktari}}</td>
                                    <td class="cell">{{$product->kalan_adet}}</td>
                                    <td class="cell">{{$product->urun_kar}}</td>
                                    <td class="cell">{{$product->urun_zarar}}</td>
                                    <td class="cell">Ürün %25 indirimlidir</td>
                                    <td class="cell">
                                        <a href="">
                                            <button class="btn btn-secondary">
                                                Düzenle
                                            </button>
                                        </a>
                                    </td>
                                    <form method="post" action="">
                                        @csrf
                                        @method('DELETE')
                                        <td class="cell">
                                            <button type="submit" class="btn btn-danger">
                                                 Sil
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div><!--//tab-pane-->
    </div><!--//tab-content-->


    <script>
        @if(session()->has('delete'))
        alertify.success('{{session('delete')}}')
        @endif

        @if(session()->has('deleteError'))
        alertify.error('{{session('deleteError')}}')
        @endif
    </script>

@endsection






@section('css')
@endsection



@section('js')
@endsection

