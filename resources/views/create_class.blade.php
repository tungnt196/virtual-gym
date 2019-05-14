@extends('main')

@section('title')
    Tạo phòng tập online
@endsection

@section('content')
    <script>
        $(document).ready(function(){
            $('#datepicker-1, #datepicker-2').datepicker({ dateFormat: 'dd-mm-yy' });
            $('#timepicker-1, #timepicker-2').timepicker({ timeFormat: 'H:mm:ss' });
        });
    </script>
    <div class="main-content create-class-page">
        <div class="container">
            <div class="create-class-box">
                <form id="create-form" action="{{URL::route('getViewCreateClass')}}" method="post" enctype="multipart/form-data">
                    <h2 class="title text-center">Tạo khóa học trực tuyến</h2>
                    <div class="form-group">
                        <label>Danh mục khóa học</label>
                        <select id="category" name="category" required="required" class="form-control">
                            <option disabled="">Danh mục khóa học</option>
                            <option value="1">Yoga</option>
                            <option value="2">Aerobics</option>
                            <option value="3">General Training</option>
                            <option value="4">Pilates</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên khóa học</label>
                        <input type="text" id="name" name="name" required="required" class="form-control" placeholder="Tên khóa học">
                    </div>
                    <div class="form-group">
                        <label>Mô tả khóa học</label>
                        <textarea type="text" id="description" name="description" required="required" class="form-control" placeholder="Mô tả khóa học" minlength="100"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input data-preview="#preview" name="file" type="file" id="imageInput" required="required">
                    </div>
                    <div class="form-group">
                        <label>Ngày khai giảng</label>
                        <input type="text" class="form-control" name="start-date" id="datepicker-1" placeholder="Ngày bắt đầu" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="text" class="form-control" name="end-date" id="datepicker-2" placeholder="Ngày kết thúc" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Giờ bắt đầu buổi học</label>
                        <input type="text" class="form-control" name="start-time" id="timepicker-1" placeholder="Thời gian bắt đầu giờ học" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Giờ kết thúc buổi học</label>
                        <input type="text" class="form-control" name="end-time" id="timepicker-2" placeholder="Thời gian kết thúc giờ học" autocomplete="off">
                    </div>
                    {!! csrf_field() !!}
                    <button type="submit" id="btn-create-class" class="btn btn-primary btn-white">
                        Tạo ngay                                
                    </button>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
