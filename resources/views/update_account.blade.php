@extends ('main')

@section('title')
    Cập nhật thông tin
@endsection

@section('content')
    @foreach(['error', 'success'] as $msg)
        @if(Session::has('alert-'.$msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <script>
        $(document).ready(function(){
            $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
        });
    </script>
    <div class="main-content update-account">
        <div class="container">
            <div class="update-account-box">
                <form id="update-account-form" action="{{URL::route('updateAccount', array($user->id))}}" method="post" enctype="multipart/form-data">
                    <h2 class="title text-center">Cập nhật tài khoản</h2>
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input type="text" id="name" name="name" required="required" class="form-control" placeholder="Họ tên" value="{{$user->name}}" required="required">
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <?php if($user->avatar != null):?>
                            <p><img src="{{$user->avatar}}" width="100"/></p>
                        <?php else:?>
                            <p><img src="../assets/img/images.jpg" width="100"/></p>
                        <?php endif;?>
                        <input name="file" type="file" id="imageInput">
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="text" class="form-control" name="birthday" id="datepicker" placeholder="Ngày sinh" autocomplete="off" value="<?php echo $user->birthday != null ? date('d-m-Y', strtotime($user->birthday)) : '' ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" value="{{$user->email}}" required="required">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group">
                        <label>Xác nhận lại mật khẩu</label>
                        <input type="password" id="re-password" name="re-password" class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" id="address" name="address" required="required" class="form-control" placeholder="Địa chỉ" value="{{$user->address}}" required="required">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="number" id="phone" name="telephone" required="required" class="form-control" placeholder="Số điện thoại" value="{{$user->telephone}}" required="required">
                    </div>
                    {!! csrf_field() !!}
                    <button type="submit" id="btn-create-class" class="btn btn-size btn-blue">
                        Cập nhật                             
                    </button>
                    <a href="{{URL::route('homepage')}}" class="btn btn-size btn-blue">
                        Trang chủ                              
                    </a>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#update-account-form').validate({
                rules: {
                    "re-password": {
                        equalTo: "#password",
                    }
                }
            })
        })
    </script>
@endsection