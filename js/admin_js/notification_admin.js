document.addEventListener("DOMContentLoaded", function () {
    // Get the reply button and reply form container
    var replyButtons = document.querySelectorAll(".reply-button");
    var replyFormContainer = document.querySelector(".reply-form-container");

    // Add event listener to each reply button
    replyButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Display the reply form container
            replyFormContainer.style.display = "block";
        });
    });

    // Get the close button in the reply form container
    var closeButton = document.getElementById("close-popup");

    // Add event listener to the close button
    closeButton.addEventListener("click", function () {
        // Hide the reply form container
        replyFormContainer.style.display = "none";
    });
});

// JavaScript for admin notification page

// Get the send notification button
const sendNotificationBtn = document.getElementById('send-notification-btn');

// Get the send notification popup
const sendNotificationPopup = document.getElementById('send-notification-popup');

// Get the close send notification popup button
const closeSendNotificationPopupBtn = document.getElementById('close-send-notification-popup');

// Add event listener to the send notification button
sendNotificationBtn.addEventListener('click', function() {
    // Display the send notification popup
    sendNotificationPopup.style.display = 'block';
});

// Add event listener to the close send notification popup button
closeSendNotificationPopupBtn.addEventListener('click', function() {
    // Hide the send notification popup
    sendNotificationPopup.style.display = 'none';
});

// Add event listener to the send notification form submit button
const sendNotificationForm = document.getElementById('send-notification-form');
sendNotificationForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Get the recipient and message values
    const recipient = document.getElementById('recipient').value;
    const message = document.getElementById('message').value;

    // Perform necessary actions with recipient and message values (e.g., send notification)
    console.log('Recipient:', recipient);
    console.log('Message:', message);

    // Clear the form fields
    sendNotificationForm.reset();

    // Close the send notification popup
    sendNotificationPopup.style.display = 'none';
});


document.addEventListener("DOMContentLoaded", function() {
    // Function to send notification
    function sendNotification(recipient, message) {
        // AJAX request to send notification to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_notification.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Notification sent successfully
                    console.log(xhr.responseText); // Log response from server
                    // Optionally, update UI or display success message
                } else {
                    // Failed to send notification
                    console.error('Failed to send notification');
                }
            }
        };
        // Send data to server
        xhr.send(`recipient=${recipient}&message=${message}`);
    }

    // Function to handle reply
    function replyToNotification(notificationID, replyMessage) {
        // AJAX request to send reply to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'reply_notification.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Reply sent successfully
                    console.log(xhr.responseText); // Log response from server
                    // Optionally, update UI or display success message
                } else {
                    // Failed to send reply
                    console.error('Failed to send reply');
                }
            }
        };
        // Send data to server
        xhr.send(`notificationID=${notificationID}&replyMessage=${replyMessage}`);
    }

    // Get the send notification button and send notification popup
    const sendNotificationBtn = document.getElementById('send-notification-btn');
    const sendNotificationPopup = document.getElementById('send-notification-popup');

    // Get the close button in the send notification popup
    const closeSendNotificationPopupBtn = document.getElementById('close-send-notification-popup');

    // Add event listener to the send notification button
    sendNotificationBtn.addEventListener('click', function() {
        // Display the send notification popup
        sendNotificationPopup.style.display = 'block';
    });

    // Add event listener to the close send notification popup button
    closeSendNotificationPopupBtn.addEventListener('click', function() {
        // Hide the send notification popup
        sendNotificationPopup.style.display = 'none';
    });

    // Add event listener to the send notification form submit button
    const sendNotificationForm = document.getElementById('send-notification-form');
    sendNotificationForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        // Get recipient and message values
        const recipient = document.getElementById('recipient').value;
        const message = document.getElementById('message').value;
        // Call sendNotification function
        sendNotification(recipient, message);
        // Clear form fields
        sendNotificationForm.reset();
        // Close the send notification popup
        sendNotificationPopup.style.display = 'none';
    });

    // Function to handle reply button click
    function handleReplyButton(replyButton) {
        // Add event listener to each reply button
        replyButton.addEventListener("click", function() {
            // Display the reply form container
            document.querySelector('.reply-form-container').style.display = 'block';
        });
    }

    // Get all reply buttons
    const replyButtons = document.querySelectorAll(".reply-button");

    // Add event listener to each reply button
    replyButtons.forEach(handleReplyButton);

    // Get the close button in the reply form container
    const closeButton = document.getElementById("close-popup");

    // Add event listener to the close button
    closeButton.addEventListener("click", function() {
        // Hide the reply form container
        document.querySelector('.reply-form-container').style.display = 'none';
    });

    // Add event listener to the reply form submit button
    const replyForm = document.getElementById('reply-form');
    replyForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        // Get notification ID and reply message
        const notificationID = replyForm.dataset.notificationId;
        const replyMessage = document.getElementById('reply-message').value;
        // Call replyToNotification function
        replyToNotification(notificationID, replyMessage);
        // Clear form fields
        replyForm.reset();
        // Close the reply form container
        document.querySelector('.reply-form-container').style.display = 'none';
    });
});

