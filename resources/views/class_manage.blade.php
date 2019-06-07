@extends('main')

@section('title')
    Quản lý khóa học
@endsection

@section('content')
    <div class="main-content page-2column class-manage">
        <div class="banner">
            <h1 class="page-title">Quản lý khóa học</h1>
        </div>
        <div class="container">
            <div class="container">
                <div class="row-fluid">
                    <div class="span2 block-left">
                        <div class="block-left-title">DANH MỤC KHÓA HỌC</div>
                        <ul class="list-unstyled list-category">
                            <?php foreach ($category as $c):?>
                            <li><a href="{{URL::route('subCategory', array($c->id))}}" class="back-link">{{$c->ten_danh_muc}}</a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <div class="span10 block-right">
                        @if(count($classList) == 0)
                            <h3 class="title">Hiện tại bạn chưa có khóa học nào</h3>
                            <a href="{{URL::route('createClass')}}" class="btn btn-blue btn-size text-center text-uppercase text-white btn-create-class">Đăng khóa học</a>
                        @else
                            <p class="description">Đây là tất cả các khóa học bạn quản lý. Hãy đăng bài đều đặn nhé!</p>
                            <a href="{{URL::route('createClass')}}" class="btn btn-blue btn-size text-center text-uppercase text-white btn-create-class">Tạo khóa học mới</a>
                            <div class="row-fluid">
                                <?php foreach ($classList as $c):?>
                                    <div class="span4">
                                        <div class="course-grid-item box-shadow">
                                            <div class="course-grid-image">
                                                <img alt="{{$c->ten_khoa_hoc}}" src="{{$c->anh_dai_dien}}" width="100%">
                                            </div>
                                            <div class="course-grid-info">
                                                <h3 class="course-grid-name">{{$c->ten_khoa_hoc}}</h3>
                                                <div class="course-closing-date">
                                                    <b>Thời gian buổi học:</b><br>
                                                    Từ <?php echo date("G:i", strtotime($c->start_truc_tuyen))?> đến <?php echo date("G:i", strtotime($c->end_truc_tuyen))?>
                                                </div>
                                                <div class="course-action">
                                                    <a class="course-view-more" href="{{URL::route('class', array($c->id))}}">Quản lý</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
