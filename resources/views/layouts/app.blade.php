<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyCqnTF7Rn7MSRG5dyvSFUSmK3kW49HGY_c",
        authDomain: "afterlife-4c033.firebaseapp.com",
        databaseURL: "https://afterlife-4c033-default-rtdb.firebaseio.com",
        projectId: "afterlife-4c033",
        storageBucket: "afterlife-4c033.appspot.com",
        messagingSenderId: "836958581961",
        appId: "1:836958581961:web:2648ed0ddbca964a44c918",
        measurementId: "G-T6LH1PPX8M"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function() {
            return messaging.getToken()
        }).then(function(token) {

            axios.post("{{ route('fcmToken') }}", {
                _method: "PATCH",
                token
            }).then(({
                data
            }) => {
                console.log(data)
            }).catch(({
                response: {
                    data
                }
            }) => {
                console.error(data)
            })

        }).catch(function(err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();

    messaging.onMessage(function({
        data: {
            body,
            title
        }
    }) {
        new Notification(title, {
            body
        });
    });
</script>
