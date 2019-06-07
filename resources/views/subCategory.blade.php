@extends('main')

@section('title')
    Danh sách khóa học {{$main_category->ten_danh_muc}}
@endsection

@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <?php $user = Session::get('user')['0'];?>
    <div class="main-content page-2column category-page">
        <div class="banner">
            <h1 class="page-title">KHÓA HỌC {{$main_category->ten_danh_muc}}</h1>
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
                    <p class="description">{{$main_category->mo_ta}}</p>
                        <?php if(is_object($user)):?>
                            <?php if($user->roles != 1):?>
                                <a href="{{URL::route('createClass')}}" class="btn btn-blue btn-size text-center text-uppercase text-white btn-create-class">Tạo khóa học</a>
                            <?php endif;?>
                        <?php endif;?>
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
                                            <span class="cgt-label">Giờ học: <?php echo date("d-m-Y", strtotime($sb->thoi_gian_khai_giang))?></span>
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