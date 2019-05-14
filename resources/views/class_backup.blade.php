@extends('main')

@section('title')
    Phòng tập online
@endsection

@section('content')
    <script type="text/javascript" src="/assets/js/socket.io.js"></script>
    <?php
        $user = Session::get('user')['0'];
        $signed = 0;
        $hlv_sign = 0;
        
        if(is_object($user)){
            foreach ($hoc_vien as $hv){
                if($user->id == $hv->id_hoc_vien){
                    $signed = 1;
                }
            }
            foreach ($hlv as $h){
                if($user->id == $h->id_hlv){
                    $hlv_sign = 1;
                }
            }
        }
    ?>
    <div class="main-content page-2column page-class">
        <div class="banner">
            <h1 class="page-title">{{$class[0]->ten_khoa_hoc}}</h1>
        </div>
        <div class="container">
            <div class="row-fluid">
                <div class="span2 block-left">
                    <h3 class="block-left-title">DANH MỤC KHÓA HỌC</h3>
                    <ul class="list-unstyled list-category">
                        <?php foreach ($category as $c):?>
                        <li><a href="{{URL::route('subCategory', array($c->id))}}" class="back-link">{{$c->the_loai}}</a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="span10 block-right">
                    <div class="class-description">
                        <h3>Mô tả khóa học</h3>
                        <p>{{$class[0]->mo_ta}}</p>
                        <h3>Thông tin khóa học</h4>
                        <?php if(count($hlv)):?>
                            <p class="info-hlv">
                                Huấn luyện viên: <a href="#" class="hlv-name">{{$hlv[0]->name}}</a>
                            </p>
                        <?php endif;?>
                        <p class="student-quantity">
                            Số lượng học viên theo học: {{count($hoc_vien)}}
                        </p>
                        <p class="time-start">
                            Thời gian khóa học: Từ ngày <?php echo date("d-m-Y", strtotime($class[0]->thoi_gian_khai_giang));?> đến ngày <?php echo date("d-m-Y", strtotime($class[0]->thoi_gian_ket_thuc));?>
                        </p>
                        <p class="time-online">
                            Thời gian buổi học: Từ <?php echo date("G:i", strtotime($class[0]->start_truc_tuyen))?> đến <?php echo date("G:i", strtotime($class[0]->end_truc_tuyen))?> hàng ngày
                        </p>
                        <?php if(is_object($user)):?>
                            <?php if($hlv_sign || $user->roles == 3):?>
                                <div class="btn-update-class">
                                    <a href="{{URL::route('getViewUpdateClass', array($class[0]->id))}}" class="btn btn-primary">Chỉnh sửa khóa học</a>
                                </div>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                    <div class="conversation">
                        <?php if(!is_object($user)):?>
                            <div class="register-class">
                                <a href="{{URL::route("login")}}" class="btn btn-primary">Đăng nhập để theo dõi</a>
                            </div>
                        <?php else:?>
                            <?php if(!$signed && !$hlv_sign && $user->roles != 3):?>
                                <div class="register-class">
                                    <a href="{{URL::route("registerClass", array($class[0]->id, $user->id))}}" class="btn btn-primary">Đăng ký học</a>
                                </div>
                            <?php else:?>
                                <?php if($hlv_sign || $user->roles == 3) :?>
                                    <h3 id="myID"></h3>
                                    <div class="row-fluid">
                                        <?php if($hlv_sign):?>
                                            <div class="start span3">
                                                <button class="btn btn-primary" id="connect">Theo dõi học viên</button>
                                            </div>
                                        <?php endif;?>
                                        <div class="btn-upload-video span2">
                                            <a href="{{URL::route('getViewManageLesson', array($class[0]->id))}}" class="btn btn-primary">Quản lý bài tập</a>
                                        </div>
                                    </div>
                                    <ul id="userOnline"></ul>
                                    <div id="listVideo">
                                        <video id="localStream" width="300" autoplay=""></video>
                                    </div>
                                <?php else :?>
                                    <h3 id="myID"></h3>
                                    <div class="row-fluid">
                                        <div class="start span3" style="margin-right: 10px;">
                                            <button class="btn btn-primary" id="connect">Bắt đầu học trực tuyến </button>
                                        </div>
                                        <div class="unregister span2">
                                            <a href="{{URL::route("unregisterClass", array($class[0]->id, $user->id))}}" class="btn btn-primary" id="connect">Hủy đăng ký lớp</a>
                                        </div>
                                    </div>
                                    <ul id="userOnline"></ul>
                                    <div id="listVideo">
                                        <video id="localStream" width="300" autoplay></video>
                                    </div>
                                <?php endif;?>
                            <?php endif;?>
                            <?php if(!count($bai_hoc)) :?>
                                <div class="title"><h3>Hiện tại chưa có bài tập nào được tải lên</h3></div>
                            <?php else :?>
                                <div class="lesson" style="<?php echo $hlv_sign || $user->roles == 3 ? "" : "display: none;" ?>">
                                    <div class="title"><h3>Danh sách bài tập</h3></div>
                                    <div class="tabs-right row-fluid">
                                        <ul class="nav nav-tabs span2">
                                            <?php $count = 0;?>
                                            <?php foreach ($bai_hoc as $lesson):?>
                                                <?php $count++;?>
                                                <li class="<?php echo $count == 1 ? 'active' : ''?>">
                                                    <a href="#tab<?php echo $count;?>" data-toggle="tab">
                                                        Bài <?php echo $count;?>
                                                    </a>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                        <div class="tab-content span10">
                                            <?php $count = 0;?>
                                            <?php foreach ($bai_hoc as $lesson):?>
                                                <?php $count++;?>
                                                <div class="tab-pane <?php echo $count == 1 ? 'active' : ''?>" id="tab<?php echo $count;?>">
                                                    <iframe height="460" src="https://www.youtube.com/embed/<?php echo substr($lesson->link_bai_hoc, strpos($lesson->link_bai_hoc, "=" ) + 1, 11);?>" frameborder="0" allowfullscreen style="width: 100%;"></iframe>
                                                </div>
                                            <?php endforeach;?>
                                        </div><!-- /tab-content -->
                                    </div><!-- /tabbable -->
                                </div>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if(is_object($user)):?>
    <script>
        $(document).ready(function(){
            // ......................................................
            // ..................RTCMultiConnection Code.............
            // ......................................................

            var connection = new RTCMultiConnection();

            connection.videosContainer = document.getElementById('listVideo');
            // by default, socket.io server is assumed to be deployed on your own URL
            connection.socketURL = 'http://localhost:9000/';

            // comment-out below line if you do not have your own socket.io server
            // connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

            var socket = io("http://localhost:9000");

            //Khai bao nguoi ket noi
            //var Peer = require('simple-peer');
            var peer = new Peer({ initiator: location.hash === '#1', trickle: false });
            //var peer = new Peer({key: 'lwjd5qra8257b9'});
            //var peer = new Peer('id2', {host: 'localhost', port: 9000, path: '/'});

            socket.on('connect', function(){
                //peer.on('open', id => {
                    $("#myID").append("Đang online");
                    $("#myID").attr("peer_id", peer.id);
                    $("#connect").click(function(){
                        socket.emit('user_online', {peer_id: peer.id, class_id: <?php echo $class[0]->id;?>, name: "<?php echo $user->name;?>", user_id: <?php echo $user->id;?>});
                        setTimeout(function(){
                            console.log(connection.socket.id);
                            //connection.socket.emit('test');
                        }, 2000);
                    });
                //});
            });
            
            //Send danh sách online
            socket.on('danh_sach_online', function(peerIDonline){
                if(!<?php echo $hlv_sign?>){
                    $('.lesson').show();
                    $('#localStream').css('display', 'block');
                    openStream()
                        .then(stream => {
                            playStream('localStream', stream);
                        })
                        .catch(err => console.log(err));
                } else {
                    //Nếu là HLV sẽ tạo room
                    connection.open(peer.id, function(isRoomOpened, roomid, error) {
                        if(error) {
                            console.log(error);
                        };
                    });
                }
                console.log(peerIDonline.length);
                peerIDonline.forEach(e => {
                    var peerID = e.peer_id;
                    var name = e.name;
                    <?php if($hlv_sign):?>
                            if(e.class_id == <?php echo $class[0]->id;?>){
                                connection.onstream = function(event) {
                                    if(event.type != 'local') { //check xem strem là của mình hay của người khác
                                        var video = document.createElement('video');
                                        video.id = peerID;
                                        video.width = 300;
                                        video.title = name;
                                        video.autoplay = true;
                                        video.allowfullscreen = true;
                                        video.srcObject = event.stream;
                                        connection.videosContainer.appendChild(video);;
                                    }
                                }
                            }
                    <?php else:?>
                        if(e.user_id == <?php echo $hlv[0]->id_hlv;?>){
                            if(e.class_id == <?php echo $class[0]->id;?>){
                                connection.onstream = function(event) {};
                                connection.checkPresence(e.peer_id, function(isOnline, username) {
                                    if(!isOnline) {
                                        console.log(e.peer_id, + ' is not online.');
                                        return;
                                    }
                                    connection.join(e.peer_id, function(isRoomJoined, roomid, error) {
                                        if(error) {
                                            console.log(error);
                                        }
                                    });
                                });
                            }
                        }
                    <?php endif;?>
                });

                socket.on('co_nguoi_moi', function(user){
                    var peerID = user.peer_id;
                    var name = user.name;
                    <?php if($hlv_sign):?>
                        if(user.class_id == <?php echo $class[0]->id;?>){
                            connection.onstream = function(event) {
                                if(event.type != 'local') { //check xem strem là của mình hay của người khác
                                    var video = document.createElement('video');
                                    video.id = peerID;
                                    video.width = 300;
                                    video.title = name;
                                    video.autoplay = true;
                                    video.allowfullscreen = true;
                                    video.srcObject = event.stream;
                                    connection.videosContainer.appendChild(video);
                                }
                            }
                        };
                    <?php else:?>
                        if(user.user_id != <?php echo $hlv[0]->id_hlv;?>){
                            connection.onstream = function(event) {}
                            connection.checkPresence(peerID, function(isOnline, username) {
                                if(!isOnline) {
                                    console.log(peerID + ' is not online.');
                                    return;
                                }
                                connection.join(peerID, function(isRoomJoined, roomid, error) {
                                    if(error) {
                                        console.log(error);
                                    }
                                });
                            });
                        }
                    <?php endif;?>
                });
            });
         
            //Báo khi người dùng đã kết nối
            socket.on('user_da_ket_noi', function(userID){
                alert("Đã kết nối rồi, đừng ấn nữa!");
            });
            
            //Xóa user khi người đó offline
            socket.on('user_offline', function(user){
                mediaElement = $("[id="+user+"]");
                if(typeof mediaElement !== "undefined"){
                    mediaElement.remove();
                }
            });
            
            //Khi mất kết nối với server  
            socket.on('connect_error', function(data){
                $("#myID").empty();
                $("#myID").append("<div class='connect-fail'>Đang offline</div>");
                $('#localStream').css('display', 'none'); 
            });
            
            //Call khi bấm vào video stream của học viên
            if(<?php echo $hlv_sign?>){
                $("#listVideo").on('click', 'video', function(){
                    $('#localStream').css('display', 'block');  
                    openStream()
                    .then(stream => {
                        playStream('localStream', stream);
                        var call = peer.call($(this).attr('id'), stream);
                    })
                    .catch(err => console.log(err));
                });
            }
            
            //Mở webcam
            function openStream(){
                // phải có mic nếu k sẽ bị lỗi audio
                return navigator.mediaDevices.getUserMedia({audio: true, video: true});
            }

            //Play camera
            function playStream(idVideo, stream){
                const video = document.getElementById(idVideo);
                video.srcObject = stream;
                video.onloadedmetadata = function(e) {
                  video.play();
                };
            }
      
            //Listen
            peer.on('call', call => {
                var idPeerCall = call.provider.id;

                jQuery('<video>', {
                    id: call.peer,
                    class: 'videoStreamHocVien',
                    width: '300',
                    peerID: call.peer,
                    controls: 'true',
                }).appendTo('#listVideo');
                                
                openStream()
                .then(stream => {
                    call.answer(stream);
                    playStream('localStream', stream);
                    call.on('stream', remoteStream => playStream(call.peer, remoteStream));
                });
            });
        
            // ......................................................
            // ..................RTCMultiConnection Code.............
            // ......................................................

            //connection.socketMessageEvent = 'call-by-username-demo';

            // do not shift room control to other users
            connection.autoCloseEntireSession = true;

            connection.session = {
                audio: true,
                video: true,
                broadcast: true // if you remove this, then it becomes MANY-to-MANY
            };

//            connection.videosContainer = document.getElementById('listVideo');
//            connection.onstream = function(event) {
//                console.log(connection.socket)
//                var existing = document.getElementById(event.streamid);
//                if(existing && existing.parentNode) {
//                    existing.parentNode.removeChild(existing);
//                }
//                if(<?php //echo $hlv_sign?>){ //check chỉ HLV mới đc xem stream của tất cả học viên
//                    if(event.type != 'local') { //check xem strem là của mình hay của người khác
//                        var video = document.createElement('video');
//                        connection.dontCaptureUserMedia = true;
//                        video.srcObject = event.stream;
//                        var mediaElement = getHTMLMediaElement(video, {
//                            id: event.streamid,
//                            title: event.userid,
//                            buttons: ['full-screen'],
//                        });
//                        var mediaElement = getHTMLMediaElement(video);
//                        connection.videosContainer.appendChild(mediaElement);
//
//                        setTimeout(function() {
//                            mediaElement.media.play();
//                        }, 500);
//
//                        mediaElement.id = event.streamid;
//                    }
//                }
//            }
            
//            $(".media-container").click(function(){
//                console.log($(this).attr('id'));
//                $('#localStream').css('display', 'block');                
//                openStream()
//                .then(stream => {
//                    playStream('localStream', stream);
//                    var call = peer.call($(this).attr('peerID'), stream);
//                })
//                .catch(err => console.log(err));
//            });
            
            connection.onMediaError = function(e) {
                if (e.message === 'Concurrent mic process limit.') {
                    if (DetectRTC.audioInputDevices.length <= 1) {
                        alert('Please select external microphone. Check github issue number 483.');
                        return;
                    }

                    var secondaryMic = DetectRTC.audioInputDevices[1].deviceId;
                    connection.mediaConstraints.audio = {
                        deviceId: secondaryMic
                    };

                    connection.join(connection.sessionid, function(isRoomJoined, roomid, error) {
                        if(error) {
                            console.log(error);
                        }
                    });
                }
            };
        })
    </script>
<?php endif;?>
@endsection
