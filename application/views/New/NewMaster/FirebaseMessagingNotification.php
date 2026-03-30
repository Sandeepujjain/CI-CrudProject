<!-- Firebase Messaging Notification --><?php if (isset($_SESSION['emp_data_session'])): ?>
    <script src=<?php echo base_url('assets/js/firebase/firebase-app.js'); ?>></script>
    <script type="module" src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>
    <script type="module" src="https://www.gstatic.com/firebasejs/8.2.2/firebase-messaging.js"></script>
    <script type="module">
        const firebaseConfig = <?= $_ENV['firebase_config'] ?? '{}' ?>;
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const fcm = firebase.messaging();
        fcm.getToken({
                vapidKey: "<?= $_ENV['firebase_web_push_certificate_key_pair'] ?? "" ?>",
            })
            .then((currentToken) => {
                if (currentToken) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "addEmployeeUserTokenFirebase", // Replace with your server-side script

                        data: {
                            employee_id: '<?php echo $_SESSION['emp_data_session']['employee_id'] ?? '' ?>',
                            token: currentToken,
                            user_type: "employee"
                        },
                        success: function(response) {
                            console.log(response);
                            // Handle success, e.g., show a success message to the user
                        },
                        error: function(error) {
                            console.error(error);
                            // Handle error, e.g., show an error message to the user
                        },
                    });
                } else {
                    console.log(
                        "No registration token available. Request permission to generate one."
                    );
                }
            })
            .catch((err) => {
                console.log("An error occurred while retrieving token. ", err);
            });
        fcm.onMessage((data) => {
            console.log(data);
        });
    </script><?php endif; ?>