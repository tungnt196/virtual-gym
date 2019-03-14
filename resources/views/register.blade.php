@extends('main')

@section('title')
	Đăng ký
@endsection

@section('content')
    <div class="main-content register-page">
        <div class="container">
            <div class="register-box">
                <div class="col-md-4">
                    <form id="register-form" action="{{url('register')}}" method="post">
                    <h2>Đăng ký</h2>
                        <div class="form-group">
                            <input type="text" id="name" name="name" required="required" value="{{old('name')}}" class="form-control" placeholder="Họ và tên">
                        </div>
<!--                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input type="text" id="birthday" name="birthday" required="required" value="{{old('birthday')}}" class="form-control" placeholder="Ex: 19-11-1996">
                        </div>-->
                        <div class="form-group">
                            <input type="text" id="email" name="email" required="required" value="{{old('email')}}" class="form-control" placeholder="Email">
                        </div>
<!--                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" id="telephone" name="telephone" required="required" value="{{old('telephone')}}" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="address" id="address" name="address" required="required" class="form-control" placeholder="Địa chỉ">
                        </div>-->
                        <div class="form-group">
                            <input type="password" id="password" name="password" required="required" class="form-control" placeholder="Mật khẩu">
                        </div>
                        <div class="form-group">
                            <input type="password" id="re-password" name="re-password" required="required" class="form-control" placeholder="Nhập lại mật khẩu">
                        </div>
                        <div class="form-group">
                            <select id="roles" name="roles" required="required" class="form-control">
                                <option disabled="">Bạm muốn đăng ký làm...</option>
                                <option value="1">Học viên</option>
                                <option value="2">Huấn luyện viên</option>
                            </select>
                        </div>
                        {!! csrf_field() !!}
                        <button type="submit" id="btn-submit-register" name="_submit" class="btn btn-primary btn-white">
                            Register                                
                            <img class="img-loading" width="20" style="margin-left: 5px; display: none;" src="/img/icon/icon-loading.gif">
                        </button>
                    </form>
                </div>    
            </div>
        </div>
    </div>
@endsection