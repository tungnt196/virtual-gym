@extends('main')

@section('title')
    Chỉnh sửa khóa học
@endsection

@section('content')
    @foreach(['error', 'success'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <script>
        $(document).ready(function(){
            $('#datepicker-1, #datepicker-2').datepicker({ dateFormat: 'dd-mm-yy' });
            $('#timepicker-1, #timepicker-2').timepicker({ timeFormat: 'H:mm:ss' });
        });
    </script>
    <div class="main-content update-class">
        <div class="container">
            <div class="update-class-box">
                <form id="update-class-form" action="{{URL::route('updateClass', array($class->id))}}" method="post" enctype="multipart/form-data">
                    <h2 class="title text-center">Cập nhật khóa học</h2>
                    <div class="form-group">
                        <label>Tên khóa học</label>
                        <input type="text" id="name" name="name" required="required" class="form-control" placeholder="Tên khóa học" value="{{$class->ten_khoa_hoc}}">
                    </div>
                    <div class="form-group">
                        <label>Mô tả khóa học</label>
                        <textarea type="text" id="description" name="description" required="required" class="form-control" placeholder="Mô tả khóa học" minlength="100">{{$class->mo_ta}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <p><img src="{{$class->anh_dai_dien}}" width="150" height="84"/></p>
                        <input data-preview="#preview" name="file" type="file" id="imageInput" value="{{$class->anh_dai_dien}}">
                    </div>
                    <div class="form-group">
                        <label>Ngày khai giảng</label>
                        <input type="text" class="form-control" name="start-date" id="datepicker-1" placeholder="Ngày bắt đầu" autocomplete="off" value="{{$class->thoi_gian_khai_giang}}">
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="text" class="form-control" name="end-date" id="datepicker-2" placeholder="Ngày kết thúc" autocomplete="off" value="{{$class->thoi_gian_ket_thuc}}">
                    </div>
                    <div class="form-group">
                        <label>Giờ bắt đầu buổi học</label>
                        <input type="text" class="form-control" name="start-time" id="timepicker-1" placeholder="Thời gian bắt đầu giờ học" autocomplete="off" value="{{$class->start_truc_tuyen}}">
                    </div>
                    <div class="form-group">
                        <label>Giờ kết thúc buổi học</label>
                        <input type="text" class="form-control" name="end-time" id="timepicker-2" placeholder="Thời gian kết thúc giờ học" autocomplete="off" value="{{$class->end_truc_tuyen}}">
                    </div>
                    {!! csrf_field() !!}
                    <button type="submit" id="btn-create-class" class="btn btn-size btn-blue">
                        Cập nhật                             
                    </button>
                    <a href="{{URL::route('class', array($class->id))}}" class="btn btn-size btn-blue btn-back-to-class">
                        Trở lại khóa học                                
                    </a>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection