var selectedUser = null;

$(document).ready(function () {
    init();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#logout').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: "/logout",
            success: function (res) {
                if (res) {
                    window.location.href = "/login"
                } else {
                    alert('Error on logout');
                }
            },
            error: function (err) {

            }
        })
    });

    $(document).on('click', '.user__menu-item', function (e) {
        const _this = $(this);
        selectedUser = _this.data('user-id');
        $.ajax({
            type: 'GET',
            url: `/chat-messages/${selectedUser}`,
            success: function (res) {
                if (res.status) {
                    const data = res.data;
                    setChatHeader(data.user);
                    setChat(data.messages);
                    setStorageItem('selected_chat', selectedUser);
                    resetMsgNotification(_this);
                } else {

                }
            },
            error: function (err) {
                console.log(err)
            }
        });
    })

    $(document).on('click', '#send_btn', function (e) {
        sendMessage()
    });

    $(document).on('keypress', '#message_input', function (e) {
        let keyboard = e.which;
        if (keyboard == 13) {
            sendMessage();
            return false;
        }
    })

    listen(currentUserId);

});

function setChatHeader(userData) {
    let headerTemplate = `<div id="user_header"></a><a href="javascript:void(0);" data-toggle="modal" data-target="#view_info" >
            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
        </a>
        <div class="chat-about">
            <h6 class="m-b-0">${userData.name}</h6>
            <small>Last seen: 2 hours ago</small>
        </div></div>`;

        let header = $('#chat_top').find('#user_header');
        if (header.length > 0) {
            $(header[0]).remove();
        }

        if (isAnotherChat()) {
            $('#chat_top').append(headerTemplate);
        }
}

function setChat(chatData) {
    let chatTemplate = `<div id="chat_history"><div class="chat-history">
        ${generateChatMessageList(chatData)}
    </div>
    <div class="chat-message clearfix">
        <div class="input-group mb-0">
            <div class="input-group-prepend">
                <span class="input-group-text" id="send_btn"><i class="fa fa-send"></i></span>
            </div>
            <input type="text" id="message_input" class="form-control" placeholder="Enter text here...">
        </div>
    </div></div>`;

    $('#chat_header').css('height', '');

    let ch = $('#chat').find('#chat_history');
    if (ch.length > 0) {
        $(ch[0]).remove();
    }

    if (isAnotherChat()) {
        $('#chat').append(chatTemplate);

        const chatHistory = $('#chat_history');
        chatHistory.scrollTop(chatHistory.height());
    }
}

function generateChatMessageList(messages) {
    if (messages.length == 0) '<ul class="m-b-0" id="message_list">No messages</ul>';

    let messageList = '<ul class="m-b-0" id="message_list">';
    messages.forEach(message => {
        messageList += generateMessageItem(message, +message.from == +currentUserId);
    });
    messageList += '</ul>';

    return messageList;
}

function resetMsgNotification(userMenuItem) {

    const userCountSpan = userMenuItem.find('span');

    if (userCountSpan.length > 0) {
        userCountSpan[0].remove();
    }
}

function init() {
    setStorageItem('selected_chat', 0);
    $('#chat_header').css('height', '90vh');
}
window.getStorageItem = (key) => {
    return localStorage.getItem(key);
}
window.setStorageItem = (key, value) => {
    localStorage.setItem(key, value);
}

window.isAnotherChat = () => {
    const userInStorage = getStorageItem('selected_chat');
    return userInStorage != selectedUser || userInStorage == 0;
}

function sendMessage() {
    let message = $('#message_input'),
            msgVal = message.val();

        if (selectedUser && msgVal.length > 0) {
            const data = {
                to: selectedUser,
                message: msgVal
            }

            $.ajax({
                method: "POST",
                url: "/send-private",
                data,
                success: function (res) {
                    const senderMsg = generateMessageItem({
                        message: data.message,
                        created_at: new Date()
                    }, true);

                    $('#message_list').append(senderMsg);
                    message.val(null)
                }
            })
        }
}
