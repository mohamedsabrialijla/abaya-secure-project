<audio id="PlAyAuDiO" src="<?php echo e(asset('admin/juntos-607.mp3')); ?>" autostart="false" ></audio>

<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-database.js"></script>
<script>

    // Initialize Firebase
    var firebaseConfig = {
        apiKey: "AIzaSyC7LKmXC6mb2YOsw30ijo1yxsTQePCgAjk",
        authDomain: "abaya-square.firebaseapp.com",
        projectId: "abaya-square",
        storageBucket: "abaya-square.appspot.com",
        messagingSenderId: "179669305758",
        appId: "1:179669305758:web:b6f6682a23b495bd126e8f",
        measurementId: "G-G5J04WG4EH"
    };


    if (!firebase.apps.length) {
        firebase.initializeApp(firebaseConfig);
    }
    const  messaging = firebase.messaging();
    messaging.onMessage(function(payload) {
        toastr.options = { onclick: function () {
                window.location=payload.notification.click_action ;
            },
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "showDuration": "40000",
            "hideDuration": "1500",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "progressBar": true,};
        toastr.success(payload.notification.title, payload.notification.body);
        var sound = document.getElementById("PlAyAuDiO");
        sound.play();

    });
</script>
<?php /**PATH /home/abayasquare/public_html/new/resources/views/layouts/partials/firebase_notification.blade.php ENDPATH**/ ?>