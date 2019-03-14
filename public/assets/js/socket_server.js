/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var express = require("express");
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
        var index = peerIDonline.findIndex(id => id === socket.peerID);
        peerIDonline.splice(index, 1);
        io.emit('user_offline', socket.peerID);
    })
        
    socket.on("user_online", function(user){
        console.log(socket.id + ' online');
        socket.peerID = user.peer_id;
        if(peerIDonline.some(e => e.user_id === user.user_id)){
            return socket.emit('user_da_ket_noi');
        };
        peerIDonline.push(user);
        socket.emit('danh_sach_online', peerIDonline);
        socket.broadcast.emit('co_nguoi_moi', user);
    });
})

//app.get("/", function(req, res){
//    res.render("homepage");
//})