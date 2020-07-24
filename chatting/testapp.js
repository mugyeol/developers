var express = require('express');
var app = express();
var http = require('http').Server(app);

// var io = require('socket.io')(http);



app.get('/', function(req, res){
    // res.sendFile(__dirname + '/index.html');
    console.log('catch browser');
    res.send('<h1>Hello world</h1>');

});

// io.on('connection', function(socket) {
//     console.log('socket connected');
//
//
// });



http.listen(3000, function(){
    console.log('listening on *:3000');
});