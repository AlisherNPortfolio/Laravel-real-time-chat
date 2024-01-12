import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
    authEndpoint: '/pusher/auth',
    csrfToken: $('meta[name="csrf-token"]').attr('content'),
});

window.listen = (id) => {
    window.Echo.private('chat.' + id)
    .listen('.private-chat', (e) => {
        console.log('%c', 'background:blue;color:yellow;font-size:24px;', 'Got message: ', e, );
        $('#message_list').append(window.generateMessageItem(e.message));
        if (isAnotherChat()) {
            notifyAboutMessage(e.message.from);
        }
    });
}

window.generateMessageItem = (msg, isSender = false) => {
    const year = (new Date()).getFullYear();
    const messageTime = typeof msg.created_at == 'string' ? new Date(msg.created_at): msg.created_at;
    const hour = messageTime.getHours();
    const minute = messageTime.getMinutes();

    return `<li class="clearfix">
        <div class="message-data ${!isSender ? 'text-right' : ''}">
            <span class="message-data-time">${+hour >= 10 ? hour : '0'+hour}:${+minute >= 10 ? minute : '0'+minute}, Today</span>
            ${!isSender ? '<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">' : ''}
        </div>
        <div class="message ${!isSender ? 'other-message float-right' : 'my-message'}">${msg.message}</div>
    </li>`;
}

function notifyAboutMessage(id) {
    let user = $('#user__item-' + id);
    if (Object.keys(user).length == 0) return;

    let msgSpan = user.find('span');
    if (msgSpan.length == 0) {
        user.append('<span>1</span>');
    } else {
        let msgCount = +msgSpan.text();
        msgSpan.text(++msgCount);
    }
}
