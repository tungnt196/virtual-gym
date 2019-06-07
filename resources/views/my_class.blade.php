@extends('main')

@section('title')
    Khóa học của tôi
@endsection

@section('content')
<div class="main-content page-2column my-class">
    <div class="banner">
        <h1 class="page-title">Khóa học của tôi</h1>
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
                        <h3 class="title">Hiện tại bạn chưa đăng ký khóa học nào</h3>
                        <a href="{{URL::route('category')}}" class="btn btn-blue btn-size text-center text-uppercase text-white btn-join-class">Xem các khóa học</a>
                    @else
                        <p class="description">Đây là tất cả các khóa học bạn đã đăng ký. Bắt tay vào luyện tập thôi nào!</p>
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
                                                <a class="course-view-more" href="{{URL::route('class', array($c->id))}}">Luyện tập</a>
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