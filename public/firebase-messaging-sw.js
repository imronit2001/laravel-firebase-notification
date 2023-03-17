importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCqnTF7Rn7MSRG5dyvSFUSmK3kW49HGY_c",
    authDomain: "afterlife-4c033.firebaseapp.com",
    databaseURL: "https://afterlife-4c033-default-rtdb.firebaseio.com",
    projectId: "afterlife-4c033",
    storageBucket: "afterlife-4c033.appspot.com",
    messagingSenderId: "836958581961",
    appId: "1:836958581961:web:2648ed0ddbca964a44c918",
    measurementId: "G-T6LH1PPX8M"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function ({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
});