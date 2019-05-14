@extends('main')

@section('title')
    OnlineGym4You
@endsection

@section('content')
<body class="homepage">
    <div class="banner-homepage">
        <div class="container">
            <h1 class="banner-title text-center text-uppercase text-white">Tập gym trực tuyến</h1>
            <p class="text-center text-white content">Giải pháp nâng cao sức khỏe cho những người bận rộn</p>
            <p class="text-center"><a href="{{URL::route('register')}}" class="btn btn-blue btn-size text-center text-uppercase text-white">Đăng ký ngay</a></p>
        </div>
    </div>
    <div class="block-benefit">
        <div class="row-fluid">
            <h2 class="title text-uppercase text-center">Lợi ích khi tham gia</h2>
        </div>
        <div class="container">
            <div class="row-fluid">
                <div class="span6 block-image">
                    <img src="../assets/img/benefit-1.jpg" />
                </div>
                <div class="span6 block-content">
                    <div class="title">Luyện tập mọi lúc mọi nơi</div>
                    <div class="content">Chỉ với chiếc máy tính, bạn có thể luyện tập bất cứ khi nào bạn muốn, mà không cần phải đến trung tâm. Bạn có thể dành nhiều thời gian hơn cho gia đình, hay làm những điều mình yêu thích</div>
                    <a href="{{URL::route('register')}}" class="btn btn-blue btn-size text-center text-uppercase text-white">Đăng ký ngay</a>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 block-content">
                    <div class="title">Được giảng dạy bỏi đội ngũ huấn luyện viên giàu kinh nghiệm</div>
                    <div class="content">Đến với OnlineGym4You, bạn sẽ được hướng dẫn bới những huấn luyện viên chuyên nghiệp từ khắp mọi nơi trên cả nước.</div>
                    <a href="{{URL::route('register')}}" class="btn btn-blue btn-size text-center text-uppercase text-white">Đăng ký ngay</a>
                </div>
                <div class="span6 block-image">
                    <img src="../assets/img/benefit-2.png" />
                </div>
            </div>
        </div>
    </div>
    <div class="block-category">
        <div class="container">
            <div class="row-fluid">
                <h2 class="title text-uppercase text-center">Danh mục khóa học</h2>
            </div>
            <div class="row-fluid">
                <div class="span6 cat-1">
                    <a href="{{URL::route('subCategory', array('1'))}}">
                        <div class="content">
                            <div class="title text-uppercase text-left">YOGA</div>
                            <div class="bnt btn-white btn-size text-center">Xem thêm</div>
                        </div>
                    </a>
                </div>
                <div class="span6 cat-2">
                    <a href="{{URL::route('subCategory', array('2'))}}">
                        <div class="content">
                            <div class="title text-uppercase text-left">Aerobics</div>
                            <div class="bnt btn-white btn-size text-center">Xem thêm</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 cat-3">
                    <a href="{{URL::route('subCategory', array('3'))}}">
                        <div class="content">
                            <div class="title text-uppercase text-left">General Training</div>
                            <div class="bnt btn-white btn-size text-center">Xem thêm</div>
                        </div>
                    </a>
                </div>
                <div class="span6 cat-4">
                    <a href="{{URL::route('subCategory', array('4'))}}">
                        <div class="content">
                            <div class="title text-uppercase text-left">Pilates</div>
                            <div class="bnt btn-white btn-size text-center">Xem thêm</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="block-feedback">
        <div class="container">
            <div class="row-fluid">
                <h2 class="title text-uppercase text-center">Phản hồi từ học viên</h2>
            </div>
            <div class="row-fluid">
                <div class="span4 feedback">
                    <img src="../assets/img/feedback-1.jpg" />
                    <div class="title">Sally Lưu</div>
                    <div class="content">Từ khi biết đến OnlineGym4You, tôi đã không phải tốn thời gian đến trung tâm mà vẫn có thể tập luyện hiệu quả tại nhà. Thật tuyệt vời!</div>
                </div>
                <div class="span4 feedback">
                    <img src="../assets/img/feedback-2.jpg" />
                    <div class="title">Hạnh Nguyễn</div>
                    <div class="content">Các huấn luyện viên rất chuyên nghiệp, tâm huyết. Tôi rất hài lòng khi sử dụng dịch vụ từ OnlineGym4You.</div>
                </div>
                <div class="span4 feedback">
                    <img src="../assets/img/feedback-3.jpg" />
                    <div class="title">Trang Kim</div>
                    <div class="content">Thật tuyệt vời, tôi có thể luyện tập mà không cần ra khỏi nhà. Tôi có thể giành nhiều thời gian hơn cho gia đình, làm những việc mình thích.</div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection