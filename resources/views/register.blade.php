@extends('layout/base_layout')

@section('title')
Register
@endsection

@section('base')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="../assets/images/login/3.jpg" alt="looginpage">
        </div>
        <div class="col-xl-7 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light"
                                src="../assets/images/logo/logo.png" alt="looginpage"><img class="img-fluid for-dark"
                                src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form" action="{{url('/register')}}" method="POST">
                            @csrf
                            <h4>Create your account</h4>
                            <p>Enter your personal details to create account</p>
                            <div class="form-group">
                                <label class="col-form-label">Nama Lengkap</label>
                                <input class="form-control" type="text" required="" placeholder="Nama Lengkap"
                                    name="user_nama">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Username</label>
                                <input class="form-control" type="text" required="" placeholder="Username"
                                    name="user_username">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" required="" placeholder="example@gmail.com"
                                    name="user_email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Kata Sandi</label>
                                <div class="form-input position-relative">
                                    <input id="password" class="form-control" type="password" required=""
                                        placeholder="*********" name="password">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy
                                            Policy</a></label>
                                </div>
                                <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                            </div>
                            <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2"
                                    href="{{url('/viewLogin')}}">Sign in</a></p>
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
        if($('#password').attr('type') == 'password'){

            $('#password').attr('type', 'text')
        }else{
            $('#password').attr('type', 'password')
        }
    })
</script>
@endpush