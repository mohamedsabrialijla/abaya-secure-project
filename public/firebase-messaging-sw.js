

// importScripts('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');
firebase.initializeApp({

    apiKey: "AIzaSyC7LKmXC6mb2YOsw30ijo1yxsTQePCgAjk",
    authDomain: "abaya-square.firebaseapp.com",
    projectId: "abaya-square",
    storageBucket: "abaya-square.appspot.com",
    messagingSenderId: "179669305758",
    appId: "1:179669305758:web:b6f6682a23b495bd126e8f",
    measurementId: "G-G5J04WG4EH"
});




const messaging2 = firebase.messaging();

messaging2.setBackgroundMessageHandler(function(payload) {
    // toastr.options = { onclick: function () {
    //         window.location='/manage/orders/store/view/'+payload.notification.order_id ;
    //     }};
    // toastr.success(payload.notification.title, payload.notification.msg);
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.msg,
        icon: '/firebase-logo.png',
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
