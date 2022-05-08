@extends('backend.layout')
@section('content-title','Personel Görev Listesi')
@section('content')
    <div class="tab-content" id="orders-table-tab-content">
        @if(\Illuminate\Support\Facades\Auth::user()->rol == 1)
            <div align="right">
                <a href="{{route('personel.index')}}">
                    <button class="btn btn-secondary">
                        Görev Oluştur
                    </button>
                </a>
            </div>
        @endif
        <H3 class="mb-3">Görevlerim</H3>
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                            <tr>
                                <th class="cell">Ad Soyad</th>
                                <th class="cell">Görev Adı</th>
                                <th class="cell">Görev Açıklama</th>
                                <th class="cell">Görev Durumu</th>
                                <th class="cell"></th>
                                <th class="cell"></th>
                                <th class="cell"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(\Illuminate\Support\Facades\Auth::user()->rol == 0)
                                @foreach($auth_personel as $person)
                                    <tr>
                                        <td class="cell">{{$person->name}}</td>
                                        <td class="cell"><span class="truncate">{{$person->gorev_adi}}</span></td>
                                        <td class="cell"><span class="truncate">{{$person->gorev_aciklama}}</span></td>
                                        <td class="cell"><span class="truncate">{{  $person->gorev_durumu == 0 ? 'Tamamlanmamış' : 'Tamamlandı' }}</span></td>
                                        <form method="post" action="{{route('gorev.destroy',$person->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <td class="cell">
                                                <button type="submit" class="btn btn-success">
                                                    Teslim Et
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            @elseif(\Illuminate\Support\Facades\Auth::user()->rol == 1)
                                @foreach($tasks as $task)
                                    <tr>
                                        <td class="cell">{{$task->name}}</td>
                                        <td class="cell"><span class="truncate">{{$task->gorev_adi}}</span></td>
                                        <td class="cell"><span class="truncate">{{$task->gorev_aciklama}}</span></td>
                                        <td class="cell"><span class="truncate">{{  $task->gorev_durumu == 0 ? 'Tamamlanmamış' : 'Tamamlandı' }}</span></td>
                                        <td class="cell">
                                            <a href="{{route('gorev.edit',$task->id)}}">
                                                <button class="btn btn-warning">
                                                    Görev Düzenle
                                                </button>
                                            </a>
                                        </td>
                                        <form method="post" action="{{route('gorev.destroy',$task->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <td class="cell">
                                                <button type="submit" class="btn btn-danger">
                                                    Görev İptal
                                                </button>
                                            </td>
                                        </form>
                                        @if($task->gorev_durumu == 1)
                                            <td class="cell">
                                                <a href="">
                                                    <button class="btn btn-secondary">
                                                        Yeni Görev
                                                    </button>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif

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

