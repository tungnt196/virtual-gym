@extends('main')

@section('title')
    Danh sách khóa học
@endsection

@section('content')
<?php $user = Session::get('user')['0'];?>
<div class="main-content page-2column category-page">
    <div class="banner">
        <h1 class="page-title">DANH MỤC KHÓA HỌC</h1>
    </div>
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
                <?php if(is_object($user)):?>
                    <?php if($user->roles != 1):?>
                        <a href="{{URL::route('createClass')}}" class="btn btn-blue btn-size text-center text-uppercase text-white btn-create-class">Tạo khóa học</a>
                    <?php endif;?>
                <?php endif;?>
                <div class="row-fluid list">
                    <?php foreach ($category as $c):?>
                        <div class="span4">
                            <div class="course-grid-item box-shadow">
                                <div class="course-grid-image">
                                    <img alt="{{$c->ten_danh_muc}}" src="{{$c->anh_dai_dien}}" width="100%">
                                </div>
                                <div class="course-grid-info">
                                    <h3 class="course-grid-name">{{$c->ten_danh_muc}}</h3>
                                    <div class="course-description">
                                        <p>{{$c->mo_ta}}</p> 
                                    </div>
                                    <div class="course-closing-date">
                                        <span class="cgt-label">Số lượng khóa học: {{$c->number}}</span>
                                    </div>
                                    <div class="course-action">
                                        <a class="course-view-more" href="{{URL::route('subCategory', array($c->id))}}">Xem tất cả khóa học</a>
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