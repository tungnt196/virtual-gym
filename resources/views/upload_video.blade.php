@extends('main')

@section('title')
    Đăng bài tập
@endsection

@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <div class="main-content upload-video">
        <div class="container">
            <div class="upload-box">
                <form id="upload-form" action="{{URL::route('uploadVideo', array($class->id))}}" method="post">
                    <h2 class="title text-center">Đăng bài tập lên<br>"{{$class->ten_khoa_hoc}}"</h2>
                    <div class="form-group">
                        <input type="text" id="name" name="name" required="required" class="form-control" autocomplete="off" placeholder="Tên bài tập">
                    </div>
                    <div class="form-group">
                        <input type="text" id="link-youtube-video" name="link-youtube-video" required="required" class="form-control" autocomplete="off" placeholder="Nhập link youtube của video">
                    </div>

                    {!! csrf_field() !!}
                    <button type="submit" id="btn-submit" name="_submit" class="btn btn-primary btn-white btn-upload">
                        Tải video lên                                
                    </button>
                    <a href="{{URL::route('class', array($class->id))}}" class="btn btn-primary btn-white btn-back-to-class">
                        Trở lại khóa học                                
                    </a>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection

