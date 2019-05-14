<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../assets/style.css"/>
    <link rel="stylesheet" href="../assets/font.css"/>
    <link rel="stylesheet" href="../assets/font-awesome.min.css"/>
    <link rel="stylesheet" href="/assets/getHTMLMediaElement.css">
    <link rel="stylesheet" href="/assets/datepicker/jquery-ui.css">
    <link rel="stylesheet" href="/assets/timepicker/jquery.timepicker.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/validate-js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../assets/validate-js/jquery.validate.vn.min.js"></script>
    <script type="text/javascript" src="../assets/peer.min.js"></script>
    <!--<script type="text/javascript" src="/assets/RTCMultiConnection_auth.min.js"></script>-->
    <script type="text/javascript" src="/assets/RTCMultiConnection.js"></script>
    <script type="text/javascript" src="../assets/simple-peer/simplepeer.min.js"></script>
    <script type="text/javascript" src="/assets/getHTMLMediaElement.js"></script>
    <script type="text/javascript" src="/assets/datepicker/jquery-ui.js"></script>
    <script type="text/javascript" src="/assets/timepicker/jquery.timepicker.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand title" href="{{URL::route('homepage')}}">OnlineGym4You</a>
            </div>
            <ul class="nav navbar-nav nav-center">
                <li><a href="{{URL::route('homepage')}}">Trang chủ</a></li>
                <li class="dropdown">
                    <a href="{{URL::route('category')}}" class="dropdown-toggle">Khóa học <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::route('subCategory', array('1'))}}" class="back-link">Yoga</a></li>
                        <li><a href="{{URL::route('subCategory', array('2'))}}" class="back-link">Aerobics</a></li>
                        <li><a href="{{URL::route('subCategory', array('3'))}}" class="back-link">General Training</a></li>
                        <li><a href="{{URL::route('subCategory', array('4'))}}" class="back-link">Pilates</a></li>
                    </ul>
                </li>
                <!--<li><a href="#">Huấn luyện viên</a></li>-->
                <!--<li><a href="#">Học phí</a></li>-->
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Hỗ trợ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Session::has('login') && Session::get('login') == true && Session::has('user'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Chào {{Session::get('user')['0']->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::route('getAccount', array(Session::get('user')['0']->id))}}">Cập nhật thông tin</a></li>
                            @if(Session::get('user')['0']->roles == 1)
                                <li><a href="{{URL::route('myClass')}}">Khóa học của tôi</a></li>
                            @endif
                            @if(Session::get('user')['0']->roles == 2)
                                <li><a href="<?php echo route('classManage')?>">Quản lý khóa học</a></li>
                            @endif
                            <li><a href="{{URL::route('logout')}}">Đăng xuất</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{URL::route('register')}}"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
                    <li><a href="{{URL::route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                @endif
            </ul>
        </div>
    </nav>
    
    @yield('content')
    
    <footer>
        <div class="container">
            <div class="title">OnlineGym4You - Thêm thời gian, thêm yêu thương</div>
            <div class="row-fluid">
                <ul class="menu-bot">
                    <li>Giới thiệu</li>
                    <li>Liên hệ</li>
                    <li>Câu hỏi thường gặp</li>
                    <li>Chính sách</li>
                </ul>
            </div>
            <div class="row-fluid">
                <ul>
                    <li>
                        <a href="#"><img src="../assets/img/icon-fb.png" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="../assets/img/icon-gg.png" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="../assets/img/icon-linkedin.png" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="../assets/img/icon-twitter.png" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="../assets/img/icon-youtube.png" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>