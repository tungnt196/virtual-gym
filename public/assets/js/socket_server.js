/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var express = require("express");
var RTCMultiConnectionServer = require('rtcmulticonnection-server');
var app = express();
//app.use(express.static("./public"));
//app.set("view engine", "ejs");
//app.set("views", "./resources/views");

var server = require("http").Server(app);
var io = require("socket.io")(server);
server.listen(9000);

var peerIDonline = new Array();

io.on("connection", function(socket){        
    console.log("co ng ket noi " + socket.id);
        
    socket.on("disconnect", function(){
        console.log(socket.id + " ngat ket noi");
        var index = -1;
        for(i = 0; i < peerIDonline.length; i++){
            if(peerIDonline[i].peer_id === socket.peerID){
                index = i;
            }
        }
        peerIDonline.splice(index, 1);
        io.emit('user_offline', socket.peerID);
        if(socket.hlv){
            io.emit('hlv_offline');
            console.log('hlv_offline');
        };
    })
        
    socket.on("user_online", function(user){
        console.log(socket.id + ' online');
        socket.peerID = user.peer_id;
        socket.hlv = user.hlv;
        if(peerIDonline.some(e => e.user_id === user.user_id)){
            return socket.emit('user_da_ket_noi');
        };
        peerIDonline.push(user);
        socket.emit('danh_sach_online', peerIDonline);
        socket.broadcast.emit('co_nguoi_moi', user);
        if(socket.hlv){
            socket.broadcast.emit('hlv_online');
            console.log('hlv_online');
        };
    });
    
    // ----------------------
    // below code is optional

    const params = socket.handshake.query;

    if (!params.socketCustomEvent) {
        params.socketCustomEvent = 'custom-message';
    }

    socket.on(params.socketCustomEvent, function(message) {
        socket.broadcast.emit(params.socketCustomEvent, message);
    });
    
    RTCMultiConnectionServer.addSocket(socket);
})
//app.get("/", function(req, res){
//    res.render("homepage");
//})