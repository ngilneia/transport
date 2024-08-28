// Your web app's Firebase configuration
const firebaseConfig = {
   apiKey: "AIzaSyC6GEHIsRxqejh-6WwXssKP9aHumxgkBbY",
        authDomain: "permit-43daf.firebaseapp.com",
        databaseURL: "https://permit-43daf-default-rtdb.firebaseio.com",
        projectId: "permit-43daf",
        storageBucket: "permit-43daf.appspot.com",
        messagingSenderId: "288540294121",
        appId: "1:288540294121:web:eacc6855623701ed6e6978"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Initialize Firebase Messaging
const messaging = firebase.messaging();

// Request permission to send notifications
messaging.requestPermission()
    .then(function() {
        console.log('Notification permission granted.');
        return messaging.getToken();
    })
    .then(function(token) {
        console.log('FCM Token:', token);
        // Send the token to your server to save it for sending notifications later
    })
    .catch(function(err) {
        console.error('Unable to get permission to notify.', err);
    });

// Listen for messages when the app is in the foreground
messaging.onMessage(function(payload) {
    console.log('Message received. ', payload);
    // Customize notification here
    const notificationTitle = 'New Data Inserted!';
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/firebase-logo.png'
    };

    if (Notification.permission === 'granted') {
        new Notification(notificationTitle, notificationOptions);
    }
});

// Initialize Firebase Realtime Database
const database = firebase.database();

// Listen for new data being added to the database
database.ref('/path/to/data').on('child_added', function(snapshot) {
    const newData = snapshot.val();
    console.log('New data added:', newData);

    // Trigger FCM to send a notification
    // You'll need to send a request to your server to actually send the FCM notification
    // Example:
    fetch('/send-notification', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: 'New Data Added!',
            body: `New data: ${JSON.stringify(newData)}`,
            token: 'FCM_TOKEN'  // You should have saved this token in your server
        })
    });
});
