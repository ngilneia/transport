        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-app.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCcZl3IePWqkYvdCxq6f9kAPTsrs5TLwAE",
            authDomain: "example-3a8cb.firebaseapp.com",
            databaseURL: "https://example-3a8cb-default-rtdb.firebaseio.com",
            projectId: "example-3a8cb",
            storageBucket: "example-3a8cb.appspot.com",
            messagingSenderId: "644905995173",
            appId: "1:644905995173:web:844a5a4ffeba88f7a2b64c"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        import { getDatabase, ref, set } from "https://www.gstatic.com/firebasejs/10.13.0/firebase-database.js";

        const db = getDatabase();
        let name = document.getElementById('name');
        let regNo = document.getElementById('regNo');
        let address = document.getElementById('address');
        let vClass = document.getElementById('vClass');
        let dd = document.getElementById('dd') ;
        let jd = document.getElementById('jd') ;
        let director = document.getElementById('director');

        let AddBtn = document.getElementById('AddBtn');
        function AddData() {
            set(ref(db, 'exmp/' + regNo.value), {
                name: name.value,
                regNo: regNo.value,
                address: address.value,
                vClass:vClass.value,
                jd: jd.value,
                dd: dd.value,
                director: director.value
            })
                .then(() => { alert("Data Added Successfully") })
                .catch((error) => { alert("Unsuccessful"); console.log(error) })

        }
        
        AddBtn.addEventListener('click', AddData);
