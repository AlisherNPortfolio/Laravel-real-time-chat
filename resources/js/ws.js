const host = 'ws://127.0.0.1:9100/websocket'
const w_socket = new WebSocket(host);

w_socket.onmessage = function (e) {
    console.log('socket onmessage', e)
}

// window.wsManager = new WebSocket("ws://")
