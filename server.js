/**
 * Created by A643564 on 04/07/2017.
 */
var app = require('express')();
var server = require('http').Server(app);


app.get('/', function (req, res) {
        res.render('socket.jade');
    })
    .use(function (req,res,next) {
        res.redirect('/');
    });

var io = require('socket.io').listen(server);

io.sockets.on('connection', function (socket) {
    socket.emit('message', 'Vous êtes connecté');
    socket.on('new_user', function (pseudo) {
        socket.pseudo = pseudo;
        var arrival = {pseudo: pseudo, msg: ' a rejoint le chat'};
        socket.broadcast.emit('discussion', arrival);
    })
    socket.on('message', function (message) {
        var msg = {pseudo: socket.pseudo, message: message};
        socket.broadcast.emit('discussion', msg);
    })
})

server.listen(3000);
