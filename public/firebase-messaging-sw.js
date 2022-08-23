

/*
    Give the service worker access to Firebase Messaging.
    Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
    */
    importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
    importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

    /*
    Initialize the Firebase app in the service worker by passing in the messagingSenderId.
    * New configuration for app@pulseservice.com
    */
    firebase.initializeApp({
        apiKey: "AIzaSyCzxsb3f6qaAZeV6g5ILHycAuiRDGOjO1k",
        authDomain: "notiftes-a4953.firebaseapp.com",
        projectId: "notiftes-a4953",
        storageBucket: "notiftes-a4953.appspot.com",
        messagingSenderId: "969175479697",
        appId: "1:969175479697:web:af24f60476d360a76a9630"
    });

    /*
    Retrieve an instance of Firebase Messaging so that it can handle background messages.
    */
    const messaging = firebase.messaging();
    messaging.setBackgroundMessageHandler(function(payload) {
      console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
      );
      /* Customize notification here */
      const notificationTitle = "Background Message Title";
      const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",

      };

      return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
      );
    });
