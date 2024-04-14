// // Get the button and form elements
// const toggleFormBtn = document.querySelector('.toggle-form-btn');
// const bookingFormWrapper = document.querySelector('.booking-form-wrapper');

// // Toggle the visibility of the form when the button is clicked
// toggleFormBtn.addEventListener('click', () => {
//     bookingFormWrapper.style.display = bookingFormWrapper.style.display === 'none' ? 'block' : 'none';
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const closeButton = document.querySelector('.close-button');
//     const formWrapper = document.querySelector('.booking-form-wrapper');

//     closeButton.addEventListener('click', function() {
//         formWrapper.style.display = 'none';
//     });

//     const toggleFormButton = document.querySelector('.toggle-form-btn');

//     toggleFormButton.addEventListener('click', function() {
//         formWrapper.style.display = 'block';
//     });
// });

// // JavaScript for handling edit and delete actions
// document.addEventListener('DOMContentLoaded', function() {
//     // Edit icon click event
//     document.querySelectorAll('.edit-icon').forEach(item => {
//         item.addEventListener('click', event => {
//             event.preventDefault();
//             const bookingID = item.getAttribute('data-id');
//             // Perform action to show edit form or modal
//             // You can use AJAX to fetch booking details and populate the form for editing
//         });
//     });

//     // Delete icon click event
//     document.querySelectorAll('.delete-icon').forEach(item => {
//         item.addEventListener('click', event => {
//             event.preventDefault();
//             const bookingID = item.getAttribute('data-id');
//             // Perform action to delete the booking from the database
//             // You can use AJAX to send a request to delete the booking
//             // After successful deletion, you may need to remove the corresponding row from the table
//         });
//     });
// });


//  // Function to open the edit popup
//  function openEditPopup() {
//     document.getElementById('editPopup').style.display = 'block';
// }

// // Function to close the edit popup
// function closeEditPopup() {
//     document.getElementById('editPopup').style.display = 'none';
// }

// // Attach event listener to edit button icons
// document.querySelectorAll('.edit-icon').forEach(item => {
//     item.addEventListener('click', event => {
//         event.preventDefault();
//         const bookingID = item.getAttribute('data-id');
//         const date = item.closest('tr').querySelector('.date-column').textContent;
//         const time = item.closest('tr').querySelector('.time-column').textContent;
//         document.getElementById('editBookingID').value = bookingID;
//         document.getElementById('editDate').value = date;
//         document.getElementById('editTime').value = time;
//         openEditPopup();
//     });
// });

// // Close edit popup when the close button is clicked
// document.querySelector('.close-edit-popup').addEventListener('click', () => {
//     closeEditPopup();
// });



//     // Function to confirm delete action
//     function confirmDelete(bookingID) {
//         if (confirm('Are you sure you want to delete this booking?')) {
//             // If user confirms, redirect to delete action with bookingID parameter
//             window.location.href = '../action/deleteBook_action.php?id=' + bookingID;
//         } else {
//             // If user cancels, do nothing
//             return false;
//         }
//     }