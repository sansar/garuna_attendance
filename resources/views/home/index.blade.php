@extends('layouts.app-master')

@section('content')
    <div class="bg-light rounded">
        <div class="float-end mb-2">
            <a href="/create" class="btn btn-success">Хүн нэмэх</a>
        </div>
        <br>
        @auth
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Нэр</th>
                    <th scope="col">Төлбөр</th>
                    <th scope="col">Ирц</th>
                    <th scope="col">-</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $key=>$list_user)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$list_user->name}}</td>
                        <td>@money($list_user->amount)</td>
                        <td>{{$list_user->attended? 'Ирсэн': '-'}}</td>
                        <td>
                            <a href="/edit/{{$list_user->uid}}">
                                <i class="bi bi-pencil-square "></i></a>
                        </td>
                    </tr>
                @endforeach
                @if(count($lists)==0)
                    <tr>
                        <th scope="row" colspan="5" class="text-center">
                            Бүртгэл хоосон байна
                        </th>
                    </tr>
                @endif
                </tbody>
            </table>

        @endauth

        @guest

            <a href="/login">Нэвтэр</a>
        @endguest
    </div>
@endsection
