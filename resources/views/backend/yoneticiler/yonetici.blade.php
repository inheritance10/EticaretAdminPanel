@extends('backend.layout')

@section('content-title','Yöneticiler')

@section('content')
    <div class="tab-content" id="orders-table-tab-content">
        <div align="right" class="mb-3">
            <a href="{{route('yonetici.create')}}">
                <button class="btn btn-warning">
                    Yönetici Kaydı Oluştur
                </button>
            </a>
        </div>
        <div align="right" class="mb-3">
            <a href="">
                <button class="btn btn-info">
                    Listeyi Yenile
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
                                <th class="cell">Ad Soyad</th>
                                <th class="cell">Email</th>
                                <th class="cell"></th>
                                <th class="cell"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($yonetici['yonetici'] as $yonetici)
                                <tr>
                                    <td class="cell">
                                            {{$yonetici->name}}
                                    </td>
                                    <td class="cell"><span class="truncate">{{$yonetici->email}}</span></td>
                                    <td class="cell">
                                        <a href="{{route('yonetici.edit',$yonetici->id)}}">
                                            <button class="btn btn-warning">
                                                Düzenle
                                            </button>
                                        </a>
                                    </td>
                                    <form method="post" action="{{route('yonetici.destroy',$yonetici->id)}}">
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


