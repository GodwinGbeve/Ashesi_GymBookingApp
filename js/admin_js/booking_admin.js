$(document).ready(function() {
  // AJAX request to handle delete action
  $(".delete-btn").click(function() {
      var bookingID = $(this).data("booking-id");

      Swal.fire({
          title: 'Are you sure?',
          text: 'You will not be able to recover this booking!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              // User confirmed, proceed with AJAX request
              $.ajax({
                  type: "POST",
                  url: "../action/admin/booking_admin_actions.php",
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
                      // You can update the UI as needed here
                      // Reload the page or update the table if necessary
                  }
              });
          }
      });
  });

  // AJAX request to handle cancel action
  $(".cancel-btn").click(function() {
      var bookingID = $(this).data("booking-id");

      Swal.fire({
          title: 'Are you sure?',
          text: 'You want to cancel this booking?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, cancel it!'
      }).then((result) => {
          if (result.isConfirmed) {
              // User confirmed, proceed with AJAX request
              $.ajax({
                  type: "POST",
                  url: "../action/admin/booking_admin_actions.php",
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
                      // You can update the UI as needed here
                      // Reload the page or update the table if necessary
                  }
              });
          }
      });
  });
});
