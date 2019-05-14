@extends('main')

@section('title')
    Online gym club
@endsection

@section('content')
<body class="responsive" id="home">
    <link rel="stylesheet" href="http://starfitnesshcm.com/themes/starfitnesslaocai/css/style.css">
    <link rel="stylesheet" href="http://starfitnesshcm.com/themes/starfitnesslaocai/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    
    <section id="slider">
        <div id="slider-home" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <a href="#"><img src="http://starfitnesshcm.com/uploads/DANG KY TAP THU/TAP THU slider 1.png" width="100%" alt="Đăng ký tập thử"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Load page giới thiệu trung tâm fitness -->
    <section id="center-fitness">
        <div class="container">
            <h3 class="title-all"><a href="#">KHÓA HỌC</a></h3>
            <span class="line-title-all"><img src="http://starfitnesshcm.com/themes/starfitnesslaocai/images/icon-tittle.png"></span>
            <div class="main-box">
                <div id="trungtamfinet" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                    <div class="owl-wrapper-outer">
                        <div class="owl-wrapper" style="width: 100%; left: 0px; display: block;">
                            <div class="owl-item" style="width: 285px;">
                                <div class="item">
                                    <a href="{{URL::route('subCategory', array(1))}}"><img src="http://starfitnesshcm.com/img.php?pic=WU9HQS9ZT0dBLmpwZw==&amp;w=500&amp;h=500&amp;encode=1" alt=""></a>
                                    <h3 class="title" style="text-transform: uppercase">Yoga</h3>
                                    <p class="sapo"></p>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 285px;">
                                <div class="item">
                                    <a href="{{URL::route('subCategory', array(2))}}"><img src="http://starfitnesshcm.com/img.php?pic=bG9waG9jL0JvZHljb21iYXQuanBn&amp;w=500&amp;h=500&amp;encode=1" alt=""></a>
                                    <h3 class="title" style="text-transform: uppercase">Calisthenics</h3>
                                    <p class="sapo"></p>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 285px;">
                                <div class="item">
                                    <a href="{{URL::route('subCategory', array(3))}}"><img src="http://starfitnesshcm.com/img.php?pic=R1JPVVAgWC9adW1iYS5qcGc=&amp;w=500&amp;h=500&amp;encode=1" alt=""></a>
                                    <h3 class="title"style="text-transform: uppercase">Power lifting</h3>
                                    <p class="sapo"></p>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 285px;">
                                <div class="item">
                                    <a href="{{URL::route('subCategory', array(4))}}"><img src="http://starfitnesshcm.com/img.php?pic=R1JPVVAgWC9HUkFQLmpwZw==&amp;w=500&amp;h=500&amp;encode=1" alt=""></a>
                                    <h3 class="title" style="text-transform: uppercase">Bodybuilding</h3>
                                    <p class="sapo"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    <section id="time-learn">
        <h3 class="title-all"><a href=""></a></h3>
        <span class="line-title-all"><img src="http://starfitnesshcm.com/themes/starfitnesslaocai/images/icon-tittle.png"></span>
        <div class="main-box">
            <div id="lophoc" class="owl-carousel" style="opacity: 0;">
                        </div>
            <div class="customNavigation">
                <a class="prev-lophoc"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                <a class="next-lophoc"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div>
            <a href="#" class="register-free">ĐĂNG KÍ TẬP</a>
        </div>
    </section>
    <div class="col-lg-12">
        <div class="huanluyenvien" style="background-image:url(http://starfitnesshcm.com/uploads/HLV/2.jpg); ">
            <div class="bg-a">
                <a href="#">ĐỘI NGŨ HUẤN LUYỆN VIÊN</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("back-to-top").style.display = "block";
        } else {
            document.getElementById("back-to-top").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        $('body,html').animate({
                scrollTop: 0
        }, 800);
        return false;
    }
    </script>
</body>
@endsection