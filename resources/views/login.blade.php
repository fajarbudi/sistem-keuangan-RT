@extends('layout/base_layout')

@section('title')
Login
@endsection

@section('base')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets_front/images/front/front-top-1.jpg')}}" alt="looginpage">
        </div>
        <div class="col-xl-5 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo text-start" href="{{route('front')}}"><img height="75px" class="img-fl-uid for-light" src="{{ asset('/assets/images/logo/logo.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('/assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form" action="{{url('/login')}}" method="POST">
                            @csrf
                            <h4>{{lang('skpd')}}</h4>
                            <p>Autentikasi sistem keuangan desa</p>
                            <div class="form-group">
                                <label class="col-form-label">Nama Login</label>
                                <input class="form-control" type="text" required="" place-holder="Username" name="user_username">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Kata Sandi</label>
                                <div class="form-input position-relative">
                                    <input id="password" class="form-control" required="" place-holder="*********" name="password" type="password">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <!-- <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Remember password</label>
                                </div> -->
                                <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Sign in</button>
                            </div>
                            {{-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{url('/viewRegister')}}">Create Account</a></p> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('jsTambahan')
<script>
    $('.show-hide').on('click', () => {
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text')
        } else {
            $('#password').attr('type', 'password')
        }
    })
</script>
@endpush