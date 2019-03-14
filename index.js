/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var express = require("express");
var Peer = require('simple-peer');
var app = express();
app.use(express.static("./public"));
app.set("view engine", "ejs");
app.set("views", "./resources/views");

var server = require("http").Server(app);
var io = require("socket.io")(server);
server.listen(9000);

io.on("connection", function(socket){
    console.log("co ng ket noi");
})

app.get("/", function(req, res){
    res.render("homepage");
})