@extends('main')

@section('title')
    Danh sách khóa học {{$main_category->the_loai}}
@endsection

@section('content')
<div class="main-content category-page">
    <div class="banner">
        <img src="../assets/img/red-gym-banner.jpg" width="100%" height="140px"/>
    </div>
    <div class="container">
        <div class="row-fluid">
            <div class="span2 block-left">
                <div class="block-left-title">DANH MỤC KHÓA HỌC</div>
                <ul class="list-unstyled list-category">
                    <?php foreach ($category as $c):?>
                    <li><a href="{{URL::route('subCategory', array($c->id))}}" class="back-link">{{$c->the_loai}}</a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="span10">
                <h1 class="page-title">KHÓA HỌC {{$main_category->the_loai}}</h1>
                <p class="description">{{$main_category->mo_ta}}</p>
                <div class="row-fluid list">
                    <?php foreach ($subCategory as $sb):?>
                        <div class="span4">
                            <div class="course-grid-item box-shadow">
                                <div class="course-grid-image">
                                    <img alt="{{$sb->ten_khoa_hoc}}" src="{{$sb->anh_dai_dien}}" width="100%">
                                </div>
                                <div class="course-grid-info">
                                    <h3 class="course-grid-name">{{$sb->ten_khoa_hoc}}</h3>
                                    <div class="course-description">
                                        <p>{{$sb->mo_ta}}</p> 
                                    </div>
                                    <div class="course-closing-date">
                                        <span class="cgt-label">Ngày bắt đầu: <?php echo date("d-m-Y", strtotime($sb->thoi_gian_khai_giang))?></span>
                                    </div>
                                    <div class="course-closing-date">
                                        <span class="cgt-label">Ngày kết thúc: <?php echo date("d-m-Y", strtotime($sb->thoi_gian_ket_thuc))?></span>
                                    </div>
                                    <div class="course-action">
                                        <a class="course-view-more" href="{{URL::route('class', array($sb->id))}}">Xem thông tin chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection