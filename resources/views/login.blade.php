@extends('main')

@section('title')
    Đăng nhập
@endsection

@section('content')
<div class="main-content login-page">
    <div class="container">
	<div class="login-box">
            <form id="login-form" action="{{url('login')}}" method="post">
                <h2 class="title text-center">Đăng nhập OnlineGym4You</h2>
                @if(Session::has('register-success'))
                    <p class="alert alert-success">{{ Session::get('register-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @if($errors->has('errorLogin'))
                    <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            {{$errors->first('errorLogin')}}
                    </div>
                @endif
                <div class="form-group">
                    <input type="text" id="email" name="email" required="required" value="{{old('email')}}" class="form-control" placeholder="Nhập email">
                </div>
                @if($errors->has('email'))
                    <p style="color: red">{{$errors->first('email')}}</p>
                @endif

                <div class="form-group">
                    <input type="password" id="password" name="password" required="required" class="form-control" placeholder="Mật khẩu">
                </div>
                @if($errors->has('password'))
                    <p style="color: red">{{$errors->first('password')}}</p>
                @endif

                {!! csrf_field() !!}
                <button type="submit" id="btn-submit-login" name="_submit" class="btn btn-primary btn-white">
                    Đăng nhập                                
                </button>
                <br>
            <!--<a href="/a/reset/request" class="lost-password">Forgot your password?</a>-->
            </form>
	</div>
    </div>
</div>
@endsection