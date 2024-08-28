// Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";
    import {
        getDatabase,
        ref,
        set
    } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-database.js";

    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

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
    const app = initializeApp(firebaseConfig);
    const db = getDatabase();

    function AddData() {
        const name = document.getElementById('name').value;
        const regNo = document.getElementById('regNo').value;
        const address = document.getElementById('address').value;

        set(ref(db, 'permit/' + regNo), {
                name: name,
                regNo: regNo,
                address: address,
            })
            .then(() => {
                alert("Data added to Firebase successfully!");
            })
            .catch((error) => {
                alert("Failed to add data to Firebase.");
                console.error(error);
            });
    }

    document.getElementById('addbtn').addEventListener('click', function(event) {
         AddData(); // Uncomment if you want to save to Firebase directly on button click
    });