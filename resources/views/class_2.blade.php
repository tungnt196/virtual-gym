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

        var peer = new Peer('hocVien', {host: '192.168.1.102', port: 9000, path: '/'});
                            
//        function turnOn(){
            
            if (navigator.mediaDevices.getUserMedia) {       
                navigator.mediaDevices.getUserMedia({video: true, audio: true})
                .then(function(stream) {
                    console.log('1');
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.log(error);
                });
            }
//        }
//
        peer.on('connection', function(conn) {
            conn.on('data', function(data){
                // Will print 'hi!'
                alert(data);
            });
        });

            peer.on('open', function() {
                $('#my-id').text(peer.id);
            });
                        
//        function turnOnPartner(){
            var video_partner = document.querySelector("#their-video");
//
            peer.on('call', function(call) {
                console.log('2');
                navigator.mediaDevices.getUserMedia({video: true, audio: true}, function(stream) {
                    call.answer(stream); // Answer the call with an A/V stream.
                    call.on('stream', function(remoteStream) {
                        // Show stream in some video/canvas element.
                        console.log('3');
                        video.src = URL.createObjectURL(remoteStream);
                        video.play();
                    });
                }, function(err) {
                    console.log('Failed to get local stream' ,err);
                });
            });
//        }
        
        function connect(){
            var conn = peer.connect('hlv');
            // on open will be launch when you successfully connect to PeerServer
            conn.on('open', function(){
                // here you have conn.id
                conn.send('hi!');
            });
                       
            navigator.mediaDevices.getUserMedia = navigator.mediaDevices.getUserMedia || navigator.mediaDevices.webkitGetUserMedia || navigator.mediaDevices.mozGetUserMedia;
            
            var video = document.querySelector("#my-video");
            var video_partner = document.querySelector("#their-video");
            
            navigator.mediaDevices.getUserMedia({video: true, audio : true}, function(stream) {
                    console.log('4');
                    var call = peer.call('hlv', stream);
                    console.log('5');
                    setTimeout(console.log(call), 3000);
                    call.on('stream', function(remoteStream) {
                        console.log('8');
                        // Show stream in some video/canvas element.
                        video_partner.srcObject = remoteStream;
                        video.srcObject = stream;
                        console.log('6');
                    });
                    console.log('9');
                },function(err) {
                    console.log('Failed to get local stream' ,err);
            });
            console.log('7');
//            turnOn();
        }
        
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
<!--    <div id="step1">
        <p>Nhấn `allow` để cấp quyền camera.</p>
        <div id="step1-error">
            <p>Có lỗi xảy ra</p>
            <a href="#" id="step1-retry">Thử lại</a>
        </div>
    </div>-->

    <!-- Make calls to others -->
    <div id="step2">
        <p>ID của tôi: <span id="my-id">Đang kết nối...</span></p>
        <div class="pure-form">
            <input type="text" placeholder="ID người cần gọi" id="callto-id">
            <a href="#" id="make-call" onclick="connect()">Gọi</a>
        </div>
    </div>

    <div id="step3">
        <p>Đang gọi: <span id="their-id">đang kết nối...</span></p>
        <p><a href="#" id="end-call">Kết thúc cuộc gọi</a></p>
    </div>

    </body>
</html>

<!doctype html>