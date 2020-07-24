var express = require('express');
var bodyParser = require('body-parser')
var app = express();
app.use(bodyParser.json()); // for parsing application/json
app.use(bodyParser.urlencoded({ extended: true })); // for parsing application/x-www-form-urlencoded

var server = require('http').createServer(app);
// http server를 socket.io server로 upgrade한다
var io = require('socket.io')(server);
var port = 8000;
app.use(express.static('public'))


// app.get('/', function(req, res) {
//     res.sendFile(__dirname + '/index.html');
// });

// var nickname;
app.post('/', function(req, res) {
    res.sendFile(__dirname + '/index.html');
    console.log(req.body);
    //닉네임 여기서 정해짐.
    // nickname = req.body.usernickname;

    // res.json(req.body.usernickname);
    // res.send(req.body.usernickname);
});

// var nicknames = [];
var socket_ids = [];
// connection event handler
// connection이 수립되면 event handler function의 인자로 socket인 들어온다
io.on('connection', function(socket) {

    // 접속한 클라이언트의 정보가 수신되면
    socket.on('login', function(data) {
        // console.log('Client logged-in:\n name:' + data.name + '\n userid: ' + data.userid);
        // console.log(nickname);
        // socket에 클라이언트 정보를 저장한다
        // socket.name = nickname;
        socket.name = data.name;
        // socket.userid = data.userid;
        socket_ids[data.name]= socket.id;
        // 접속된 모든 클라이언트에게 메시지를 전송한다 -> 접속한 사람 제외로 변경
        socket.broadcast.emit('login', data.name);

    });
    socket.on('selflogin', function(data) {
    //     console.log('successfully login to chatroom');

        socket.name = data.name;
        socket.emit('selflogin', data.name );

    });

    // 클라이언트로부터의 메시지가 수신되면
    socket.on('chat', function(data) {
        var msg = {
            name: data.name,
            msg: data.msg,
            to: data.to
        };


        if (data.to === 'all'){

            io.emit('chat', msg);

        }else{
            socket.id = socket_ids[data.to];
            if(socket.id !== undefined){
                io.to(socket.id).emit('chat',msg);
            }else {

                var fail = {
                    to: 'fail',
                    receiver : data.to
                };

                socket.emit('chat',fail);

            }




        }



        // 메시지를 전송한 클라이언트를 제외한 모든 클라이언트에게 메시지를 전송한다
        // socket.broadcast.emit('chat', msg);

        // 메시지를 전송한 클라이언트에게만 메시지를 전송한다
        // socket.emit('s2c chat', msg);

        // 접속된 모든 클라이언트에게 메시지를 전송한다
        // io.emit('s2c chat', msg);

        // 특정 클라이언트에게만 메시지를 전송한다
        // io.to(id).emit('s2c chat', data);
    });

    // force client disconnect from server
        socket.on('forceDisconnect', function() {
            socket.disconnect();
        });

        socket.on('disconnect', function() {
            delete socket_ids[socket.name];
            var logout ={
                name : socket.name
            };

            io.emit('disconnect', logout);

        console.log('user disconnected: ' + socket.name);
    });
});

server.listen(port, function() {
    console.log('Socket IO server listening on port '+port);
});