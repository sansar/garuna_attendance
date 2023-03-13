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
                    <th scope="col">Утас</th>
                    <th scope="col">Төлөв</th>
                    <th scope="col">-</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $key=>$list_user)
                    <tr style="background-color: {{ $list_user->attended ? 'aquamarine' : ($list_user->mail_sent ? 'lightcyan' : 'white') }}">
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$list_user->name}}</td>
                        <td>{{$list_user->phone}}</td>
                        <td>{{$list_user->attended ? 'Ирсэн' : ($list_user->mail_sent ? 'Урилга илгээсэн' : '-')}}</td>
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
