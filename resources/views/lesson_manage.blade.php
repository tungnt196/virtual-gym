@extends ('main')

@section('title')
    Quản lý bài tập
@endsection

@section('content')
@foreach(['error', 'success'] as $msg)
    @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
@endforeach
    <div class="main-content manage-lesson">
        <div class="container">
            <h2 class="title text-center">
                Danh sách bài tập cho khóa học {{$class->ten_khoa_hoc}}
            </h2>
            @foreach($list_lesson as $ls)
                <div class="row-fluid">
                    <p class="title">{{$ls->ten_bai_tap}}</p>
                    <div class="infor">
                        <form class="form-update-lesson" action="{{URL::route('updateLesson', array($ls->id))}}" method="post">
                            <div class="link-video">
                                <input type="text" class="form-control" name="video-{{$ls->id}}" value="{{$ls->link_bai_hoc}}">
                            </div>
                            <button type="submit" class="btn btn-size btn-blue">
                                Cập nhật                              
                            </button>
                            {!! csrf_field() !!}
                        </form>
                        <a href="{{URL::route('deleteLesson', array($ls->id))}}" class="btn btn-size btn-blue">
                            Xóa bài tập                                
                        </a>
                    </div>
                </div>
            @endforeach
            <a href="{{URL::route('getViewUploadVideo', array($class->id))}}" class="btn btn-size btn-blue">
                Đăng bài tập mới
            </a>
            <a href="{{URL::route('class', array($class->id))}}" class="btn btn-size btn-blue btn-back-to-class">
                Trở lại khóa học                                
            </a>
        </div>
    </div>
@endsection

