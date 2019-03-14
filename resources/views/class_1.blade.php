<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Call</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript" src="{{Asset('/assets/webcam.js') }}"></script>
    <script type="text/javascript" src="{{Asset('/assets/peer.min.js') }}"></script>
    <script>
        // Yêu cầu sử dụng camera trên các trình duyệt khác nhau
        //navigator.mediaDevices.getUserMedia = navigator.mediaDevices.getUserMedia || navigator.mediaDevices.webkitGetUserMedia || navigator.mediaDevices.mozGetUserMedia;

        var peer = new Peer('hocVien', {host: '27.79.160.66', port: 9000, path: '/'});

        peer.on('open', function() {
            $('#my-id').text(peer.id);
        });

        // Sự kiện lắng nghe chờ cuộc gọi đến
        peer.on('call', function(call) {
            // Tự động chấp nhận khi có ng gọi đến
            call.answer(navigator.mediaDevices.getUserMedia({
                audio: true,
                video: false
            }));
            navigator.mediaDevices.getUserMedia({video: true, audio: true}, function(stream) {
                call.answer(stream); // Answer the call with an A/V stream.
                call.on('stream', function(remoteStream) {
                    // Show stream in some video/canvas element.
                    $('#their-video').prop('src', URL.createObjectURL(stream));
                });
            }, function(err) {
                console.log('Failed to get local stream' ,err);
            });
            console.log(2);
        });

        peer.on('error', function(err) {
            alert(err.message);
            // Có lỗi xảy ra
            step2();
            console.log(3);
        });

        $(function() {
            $('#make-call').click(function() {
                // Gọi cho 1 id
                console.log(navigator.mediaDevices.getUserMedia({
                    audio: true,
                    video: false
                }));
                var call = peer.call('hlv', navigator.mediaDevices.getUserMedia({
                    audio: true,
                    video: false
                }));
                if(typeof(call) != 'undefined'){
                    call.on('stream', function(remoteStream) {
                        $('#their-video').prop('src', URL.createObjectURL(stream));
                    }, function(err) {
                        console.log('Failed to get local stream' ,err);
                    });
                } else
                console.log(4);
            });

            $('#end-call').click(function() {
                window.existingCall.close();
                step2();
            });

            // Thử lại nếu trình duyệt không đc cấp quyền camera
            $('#step1-retry').click(function() {
                $('#step1-error').hide();
                step1();
            });

            step1();
        });

        function step1() {
        // Lấy stream từ camera và audio
        var video = document.querySelector("#my-video");
            if (navigator.mediaDevices.getUserMedia) {       
                navigator.mediaDevices.getUserMedia({video: true})
                .then(function(stream) {
                    video.srcObject = stream;
                    console.log(stream);
                })
                .catch(function(error) {
                    console.log("Something went wrong!");
                });
            }
        }

        function step2() {
            $('#step1, #step3').hide();
            $('#step2').show();
        }

    //    function step3(call) {
    //        // Đóng cuộc gọi dang diễn ra nếu có 1 cuộc gọi khác đến
    //        if(window.existingCall) {
    //          window.existingCall.close();
    //        }
    //
    //        // Chờ và hiển thị video người gọi
    //        call.on('stream', function(stream) {
    //            $('#their-video').prop('src', URL.createObjectURL(stream));
    //        });
    //
    //        window.existingCall = call;
    //        $('#their-id').text(call.peer);
    //        call.on('close', step2);
    //        $('#step1, #step2').hide();
    //        $('#step3').show();
    //    }

    </script>
    </head>
    <style>
    #container {
        margin: 0px auto;
        width: 500px;
        height: 375px;
        border: 10px #333 solid;
    }
    #their-video, #my-video {
        width: 500px;
        height: 375px;
        background-color: #666;
    }
    </style>
    <body>

    <!-- Video -->
    <div>
        <video autoplay="true" id="their-video"></video>
        <video autoplay="true" id="my-video"></video>
    </div>

    <!-- Steps -->

    <!-- Get local audio/video stream -->
    <div id="step1">
        <p>Nhấn `allow` để cấp quyền camera.</p>
        <div id="step1-error">
            <p>Có lỗi xảy ra</p>
            <a href="#" id="step1-retry">Thử lại</a>
        </div>
    </div>

    <!-- Make calls to others -->
    <div id="step2">
        <p>ID của tôi: <span id="my-id">Đang kết nối...</span></p>
        <div class="pure-form">
            <input type="text" placeholder="ID người cần gọi" id="callto-id">
            <a href="#" id="make-call">Gọi</a>
        </div>
    </div>

    <div id="step3">
        <p>Đang gọi: <span id="their-id">đang kết nối...</span></p>
        <p><a href="#" id="end-call">Kết thúc cuộc gọi</a></p>
    </div>

    </body>
</html>

<!doctype html>