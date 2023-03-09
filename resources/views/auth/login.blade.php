@extends('layouts.auth-master')

@section('content')
    <div class="" style="margin-top:200px">
        <div class="rounded d-flex justify-content-center">
            <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                <div class="text-center">
                    <h3 class="text-primary">Нэвтрэх</h3>
                </div>
                @include('layouts.partials.messages')
                <form method="post" action="{{ route('login.perform') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="p-4">
                        <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-person-plus-fill text-white"></i></span>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                   placeholder="Нэр" required="required" autofocus>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-key-fill text-white"></i></span>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                   placeholder="Нууц үг" required="required">
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Намайг сана
                            </label>
                        </div>
                        <button class="btn btn-primary text-center mt-2" type="submit">
                            Нэвтрэх
                        </button>
                        @include('auth.partials.copy')
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
