
    // AJAX request to handle delete action
   // AJAX request to handle delete action
$(".delete-btn").click(function() {
    var feedbackID = $(this).data("feedback-id"); // Get feedback ID

    // Use SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this feedback!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX request to handle delete
            $.ajax({
                type: "POST",
                url: "../action/deletefeedback_admin.php",
                data: {
                    action: "delete",
                    feedbackID: feedbackID
                },
                success: function(response) {
                    // Display SweetAlert for success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response
                    });
                    // You can update the UI as needed here
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Handle cancel button click
            Swal.fire('Cancelled', 'The feedback was not deleted', 'info');
        }
    });
});


    // AJAX request to handle mark as resolved action
    $(".resolve-btn").click(function() {
        var feedbackID = $(this).closest("tr").find(".feedbackID").text(); // Get feedback ID

        // Use SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to mark this feedback as resolved?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, mark as resolved!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request to handle mark as resolved
                $.ajax({
                    type: "POST",
                    url: "../action/feedback_admin_actions.php",
                    data: {
                        action: "resolve",
                        feedbackID: feedbackID
                    },
                    success: function(response) {
                        // Display SweetAlert for success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response
                        });
                        // You can update the UI as needed here
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Handle cancel button click
                Swal.fire('Cancelled', 'The feedback was not marked as resolved', 'info');
            }
        });
    });

