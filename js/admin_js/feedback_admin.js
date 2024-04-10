$(document).ready(function() {
    // AJAX request to handle reply action
    $(".reply-btn").click(function() {
        var feedbackID = $(this).closest("tr").find(".feedbackID").text(); // Get feedback ID
        var replyMessage = prompt("Enter reply message:"); // Prompt user to enter reply message

        if (replyMessage != null) {
            $.ajax({
                type: "POST",
                url: "../action/feedback_admin_actions.php",
                data: {
                    action: "reply",
                    feedbackID: feedbackID,
                    replyMessage: replyMessage
                },
                success: function(response) {
                    // Display SweetAlert for success or error message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response
                    });
                    // You can update the UI as needed here
                }
            });
        }
    });
    
    // AJAX request to handle delete action
    $(".delete-btn").click(function() {
        var feedbackID = $(this).closest("tr").find(".feedbackID").text(); // Get feedback ID

        if (confirm("Are you sure you want to delete this feedback?")) {
            $.ajax({
                type: "POST",
                url: "../action/deletefeedback_admin.php",
                data: {
                    action: "delete",
                    feedbackID: feedbackID
                },
                success: function(response) {
                    // Display SweetAlert for success or error message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response
                    });
                    // You can update the UI as needed here
                }
            });
        }
    });

    // AJAX request to handle mark as resolved action
    $(".resolve-btn").click(function() {
        var feedbackID = $(this).closest("tr").find(".feedbackID").text(); // Get feedback ID

        if (confirm("Are you sure you want to mark this feedback as resolved?")) {
            $.ajax({
                type: "POST",
                url: "../action/feedback_admin_actions.php",
                data: {
                    action: "resolve",
                    feedbackID: feedbackID
                },
                success: function(response) {
                    // Display SweetAlert for success or error message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response
                    });
                    // You can update the UI as needed here
                }
            });
        }
    });
});
