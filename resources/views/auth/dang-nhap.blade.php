@extends('client.templates.layout')
@section('title')
    - Đăng Nhập
@endsection
@section('content')
    <!-- header -->
    <header class="single-header">
        <!-- Start: Header Content -->
        <div class="container">
            <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h3>Đăng Nhập</h3>
                    <h4><a href="{{ route('home') }} "> Trang chủ </a> <span> &vert; </span> Đăng Nhập </h4>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!--/
            ==================================================-->
    <!-- Start: Account Section
            ==================================================-->
    <section class="account-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="reg_wrap">
                        <!-- Start: Image -->
                        <div class="reg_img">
                            <img src="{{ asset('client/images/hero-men.png') }}" alt="">
                        </div>
                        <!-- Start:  Login Form  -->
                        <div class="login-form">
                            <h2> Đăng nhập </h2>
                            <div>
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if (Session::has('message'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <strong>{{ Session::get('message') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <form method="post" action="{{ route('auth.login') }}">
                                @csrf
                                <input class="login-field" name="email" id="lemail" type="text" placeholder="Email">
                                <input class="login-field" name="password" id="lpassword" type="password"
                                    placeholder="Password">
                                <div class="lost_pass">
                                    <a href="{{ route('form_quen_mat_khau') }}" class="forget" style="margin-left: 15px">
                                        Bạn quên mật khẩu? </a>
                                </div>
                                @if ($errors->any())
                                <div class="alert alert-secondary"> 
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li style="color: red">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                </div>
                                @endif

                                <div class="submit-area">
                                    <button class="submit more-link"> Đăng Nhập </button>
                                    <a href="{{ route('auth.getdangki') }}" class="submit more-link"> Đăng Ký Tài Khoản</a>
                                    <div id="lmsg" class="message"></div>
                                </div>
                            </form>
                        </div>
                        <!-- End:Login Form  -->
                    </div>
                </div>
                <!-- .col-md-6 .col-sm-12 /- -->
            </div>
            <!-- row /- -->
        </div>
        <!-- container /- -->
    </section>
    <!-- End : Account Section
            ==================================================-->
@endsection
