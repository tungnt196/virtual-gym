<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../assets/style.css"/>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javacsript" src="../assets/validate-js/jquery.validate.js"></script>
    <script type="text/javacsript" src="../assets/validate-js/jquery.validate.vn.js"></script>
    <script src='http://192.168.1.102:9000/socket.io/socket.io.js'></script>
    <script type="text/javascript" src="../assets/peer.min.js"></script>
    <script type="text/javascript" src="../assets/simple-peer/simplepeer.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">GYM CLUB</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{URL::route('homepage')}}">Trang chủ</a></li>
                <li class="dropdown">
                    <a href="{{URL::route('category')}}" class="dropdown-toggle">Khóa học <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::route('subCategory', array('1'))}}" class="back-link">Yoga</a></li>
                        <li><a href="{{URL::route('subCategory', array('2'))}}" class="back-link">Calisthenics</a></li>
                        <li><a href="{{URL::route('subCategory', array('3'))}}" class="back-link">Power lifting</a></li>
                        <li><a href="{{URL::route('subCategory', array('4'))}}" class="back-link">Bodybuilding</a></li>
                        <li><a href="{{URL::route('subCategory', array('5'))}}" class="back-link">Crossfist</a></li>
                    </ul>
                </li>
                <li><a href="#">Huấn luyện viên</a></li>
                <li><a href="#">Học phí</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Hỗ trợ</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="/action_page.php">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if(Session::has('login') && Session::get('login') == true)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Chào {{Session::get('user')['0']->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
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
    
</body>
</html>