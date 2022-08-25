@extends('layouts.app')

@section('content')
    <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-5 col-lg-8 col-md-5">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                                <div class="col">
                                    <div class="p-5">
                                        <div class="text-center pb-2">
                                            <h1 class="h4 text-gray-900 mb-2">{{ config('app.name')}}</h1>
                                            <h1 class="h4 text-gray-900 mb-2">Login</h1>
                                            {{-- <img src="{{ asset('img/logo.jpg') }}" alt="{{ asset('img/logo.jpg') }}" width="150" height="150"> --}}
                                        </div>
                                        <form action="{{ route('handlelogin') }}" class="user" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Username...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            {{-- <a href="/handlelogin" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </a> --}}
                                            <button class="btn btn-primary btn-user col-xl">Login</button>
                                        </form>
                                        {{-- <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
@endsection