@extends('main')

@section('title')
    Phòng tập online
@endsection

@section('content')
    <?php $user = Session::get('user')['0'];?>
    <?php $signed = false;
          $hlv_sign = false;?>
    <div class="main-content page-class">
        <div class="page-title">
            <h3>{{$class[0]->ten_khoa_hoc}}</h3>
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
                <div class="span10">
                    <div class="class-description">
                        <h3>Mô tả khóa học</h3>
                        <p>{{$class[0]->mo_ta}}</p>
                        <h3>Thông tin khóa học</h4>
                        <p class="info-hlv">
                            Huấn luyện viên: <a href="#" class="hlv-name">{{$hlv[0]->name}}</a>
                        </p>
                        <p class="student-quantity">
                            Số lượng học viên hiện tại: {{count($hoc_vien)}}
                        </p>
                        <p class="time-start">
                            Thời gian khóa học: Từ ngày <?php echo date("d-m-Y", strtotime($class[0]->thoi_gian_khai_giang));?> đến ngày <?php echo date("d-m-Y", strtotime($class[0]->thoi_gian_ket_thuc));?>
                        </p>
                        <p class="time-online">
                            Thời gian buổi học: Từ <?php echo date("h:m", strtotime($class[0]->start_truc_tuyen))?> đến <?php echo date("h:m", strtotime($class[0]->end_truc_tuyen))?> hàng ngày
                        </p>
                    </div>
                    <div class="conversation">
                        <?php if(!is_object($user)):?>
                            <div class="register-class">
                                <a href="{{URL::route("login")}}" class="btn btn-primary">Đăng ký lớp học</a>
                            </div>
                        <?php else:?>
                            <?php
                                foreach ($hoc_vien as $hv){
                                    if($user->id == $hv->id_hoc_vien){
                                        $signed = true;
                                    }
                                }
                                foreach ($hlv as $h){
                                    if($user->id == $h->id_hlv){
                                        $hlv_sign = true;
                                    }
                                }
                            ?>
                            <?php if(!$signed && !$hlv_sign):?>
                                <div class="register-class">
                                    <a href="dang-ky-hoc" class="btn btn-primary">Đăng ký lớp học</a>
                                </div>
                            <?php else:?>
                                <?php if($hlv_sign) :?>
                                    <h3 id="myID"></h3>
                                    <div class="start">
                                        <button class="btn btn-primary" id="connect">Theo dõi học viên</button>
                                    </div>
                                    <ul id="userOnline"></ul>
                                    <div id="listVideo">
                                        <video id="localStream" width="300" controls=""></video>
                                        <br>
                                    </div>
                                <?php else :?>
                                    <h3 id="myID"></h3>
                                    <div class="start">
                                        <button class="btn btn-primary" id="connect">Bắt đầu học trực tuyến</button>
                                    </div>
                                    <ul id="userOnline"></ul>
                                    <div id="listVideo">
                                        <video id="localStream" width="300" controls=""></video>
                                        <br>
                                    </div>
                                <?php endif;?>
                            <?php endif;?>
                            <div class="lesson">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if(is_object($user)):?>
    <script>
        $(document).ready(function(){
            var socket = io("192.168.1.102:9000");

            //Send danh sách online
            socket.on('danh_sach_online', function(peerIDonline){
                //$('#content').append(data);
                //console.log(peerIDonline);
                peerIDonline.forEach(e => {
                    var peerID = e.peer_id;
                    var name = e.name;
                    <?php if($hlv_sign):?>
                        if(e.class_id == <?php echo $class[0]->id;?>){
                            //sinh danh sách online
//                            if(e.user_id != <?php echo $user->id;?>){
//                                $('#userOnline').append('<li id="'+peerID+'">'+name+'</li>');
//                            }
                        }
                    <?php else:?>
                        if(e.class_id == <?php echo $class[0]->id;?>){
                            if(e.user_id == <?php echo $hlv[0]->id_hlv;?>){
                                openStream()
                                .then(stream => {
                                    var call = peer.call(peerID, stream);
                                })
                                .catch(err => console.log(err));
                            }
                        }
                    <?php endif;?>
                });

                socket.on('co_nguoi_moi', function(user){
                    var peerID = user.peer_id;
                    var name = user.name;
                    <?php if($hlv_sign):?>
                        if(user.class_id == <?php echo $class[0]->id;?>){
                            $('#userOnline').append('<li id="'+peerID+'">'+name+'</li>') ;
                        };
                    <?php else:?>
                        if(user.class_id == <?php echo $class[0]->id;?>){
                            if(user.user_id == <?php echo $hlv[0]->id_hlv;?>){
                                openStream()
                                .then(stream => {
                                    var call = peer.call(peerID, stream);
                                })
                                .catch(err => console.log(err));
                            }
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
                document.getElementById(user).remove();
            });
         
            //Call khi bấm vào video stream của học viên
            
            $("#listVideo").on('click', 'video', function(){
                console.log($(this).attr('peerID'));
                                
                openStream()
                .then(stream => {
                    playStream('localStream', stream);
                    var call = peer.call($(this).attr('peerID'), stream);
                })
                .catch(err => console.log(err));
            });
            
            //Call khi bấm vào ID
            $("#userOnline").on('click', 'li', function(){
                console.log($(this).attr('id'));
                                
                openStream()
                .then(stream => {
                    playStream('localStream', stream);
                    var call = peer.call($(this).attr('id'), stream);
                })
                .catch(err => console.log(err));
            });
            
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

            //Khai bao nguoi ket noi
            //var Peer = require('simple-peer');
            var peer = new Peer({ initiator: location.hash === '#1', trickle: false });
            //var peer = new Peer({key: 'lwjd5qra8257b9'});
            //var peer = new Peer('id2', {host: 'localhost', port: 9000, path: '/'});
            peer.on('open', id => {
                $("#myID").append("Đang online");
                $("#myID").attr("peer_id", id);
                $("#connect").click(function(){
                    socket.emit('user_online', {peer_id: id, class_id: <?php echo $class[0]->id;?>, name: "<?php echo $user->name;?>", user_id: <?php echo $user->id;?>});
                    <?php if(!$hlv_sign):?>
                        $('#localStream').css('display', 'block');
                        openStream()
                            .then(stream => {
                                playStream('localStream', stream);
                            })
                            .catch(err => console.log(err));
                    <?php endif;?>
                });
            });

            /*Click call*/
//            $("#btnCall").click(function(){
//                console.log("1");
//                var id = $("#remoteID").val();
//                openStream()
//                .then(stream => {
//                    playStream('localStream', stream);
//                    var call = peer.call(id, stream);
//                    call.on('stream', remoteStream => playStream('remoteStream', remoteStream));
//                })
//                .catch(err => console.log(err));
//            });

            /*Listen*/
            peer.on('call', call => {
                var idPeerCall = 'video'+call.provider.id;

                jQuery('<video>', {
                    id: idPeerCall,
                    class: 'videoStreamHocVien',
                    width: '300',
                    peerID: call.peer,
                }).appendTo('#listVideo');
                
                console.log(call);
                
                openStream()
                .then(stream => {
                    call.answer(stream);
                    playStream('localStream', stream);
                    call.on('stream', remoteStream => playStream(idPeerCall, remoteStream));
                });
            });
        });
    </script>
<?php endif;?>
@endsection