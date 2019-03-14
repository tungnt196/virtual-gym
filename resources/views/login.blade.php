@extends('main')

@section('title')
    Đăng nhập
@endsection

@section('content')
<div class="main-content login-page">
    <div class="container">
	<div class="login-box">
	    <div class="col-md-4">
	        <form id="login-form" action="{{url('login')}}" method="post">
                <h2>Đăng nhập</h2>
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
                    Login                                
                    <img class="img-loading" width="20" style="margin-left: 5px; display: none;" src="/img/icon/icon-loading.gif">
                </button>
                <br>
                <!--<a href="/a/reset/request" class="lost-password">Forgot your password?</a>-->
	        </form>
	    </div>    
	</div>
    </div>
</div>
@endsection