var notificationsCountElem = document.getElementById('notification_bell');
var notificationsCount     = parseInt(notificationsCountElem.getAttribute('data-count'));
var notifications          = document.getElementById('notification'); //news notification
var registerNoti           = document.getElementById('registerNoti');
var showNotiCount          = document.getElementById('noticount');
var count                  = notificationsCountElem.dataset.count;

if(notificationsCount <= 0)
{
    showNotiCount.classList.add('hidden');
}

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('b0d1e15bdcfa88d5ac1f', {
    encrypted: true,
    cluster: "ap1",
    forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('clientPostNews', function(data) {
    //var existingNotifications = notifications.html();
    var newNotificationHtml = `
        <a href="/admin/estate_news/news/detail/`+data.data.id+`" class="block">
            <div class="flex px-4 space-x-4">
                <div class="relative flex-shrink-0">
                    <span class="z-10 inline-block p-2 overflow-visible rounded-full bg-primary-50 text-primary-light dark:bg-primary-darker">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </span>
                    <div class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker"></div>
                </div>
                <div class="flex-1 overflow-hidden">
                    <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                        `+data.data.message+`
                    </h5>
                    <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                        Tài khoản `+data.data.author+` đã đăng tin với mã `+data.data.idBanking+`
                    </p>
                    <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> Vào lúc `+data.data.time+` </span>
                </div>
            </div>
        </a>
    `;
    // notifications.html(newNotificationHtml + existingNotifications);
    notifications.innerHTML += newNotificationHtml;

    notificationsCount += 1;
    //notificationsCountElem.attr('data-count', notificationsCount);
    count = notificationsCount;

    showNotiCount.innerHTML = count;

    showNotiCount.classList.remove('hidden');
});

var registerChannel = pusher.subscribe('clientRegister');
registerChannel.bind('clientRegister', function(data) {
    //var existingNotifications = notifications.html();
    var newNotificationHtml = `
        <a href="/admin/customer_manager/detail/`+data.data.id+`" class="block">
            <div class="flex px-4 space-x-4">
                <div class="relative flex-shrink-0">
                    <span class="z-10 inline-block p-2 overflow-visible rounded-full bg-primary-50 text-primary-light dark:bg-primary-darker">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </span>
                    <div class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker"></div>
                </div>
                <div class="flex-1 overflow-hidden">
                    <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Có tài khoản mới tạo!!</h5>
                    <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                        Tài khoản có tên `+data.data.username+` vừa được tạo, yêu cầu xác thực
                    </p>
                    <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> `+data.data.time+` </span>
                </div>
            </div>
        </a>
    `;
    // notifications.html(newNotificationHtml + existingNotifications);
    registerNoti.innerHTML += newNotificationHtml;

    notificationsCount += 1;
    //notificationsCountElem.attr('data-count', notificationsCount);
    count = notificationsCount;

    showNotiCount.innerHTML = count;

    showNotiCount.classList.remove('hidden');
});
