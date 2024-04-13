// schedule_instructor.js

$(document).ready(function() {
    // Delete button click event
    $('.delete-btn').click(function() {
        
        // Retrieve booking ID from data attribute
        var bookingID = $(this).data('booking-id');
        
        // Confirm deletion with user
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete booking
                $.ajax({
                    type: "POST",
                    url: "../action/deleteSchedule_action.php",
                    data: {
                        action: "delete",
                        bookingID: bookingID
                    },
                    success: function(response) {
                        // Display SweetAlert for success or error message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response
                        });
                    // Reload the page or update the booking list
                    location.reload();
                    }
                });
            }
        });
    });

    // Cancel button click event
    $('.cancel-btn').click(function() {
        
        // Retrieve booking ID from data attribute
        var bookingID = $(this).data('booking-id');
        
        // Confirm cancellation with user
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to cancel this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to cancel booking
                $.ajax({
                    type: "POST",
                    url: "../action/deleteSchedule_action.php",
                    data: {
                        action: "cancel",
                        bookingID: bookingID
                    },
                    success: function(response) {
                        // Display SweetAlert for success or error message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response
                        });
                    // Reload the page or update the booking list
                    location.reload();
                    }
                });
            }
        });
    });
});
