document.addEventListener('DOMContentLoaded', function () {
    const addInstructorBtn = document.querySelector('.add-instructor-btn button');
    const addInstructorContainer = document.querySelector('.add-instructor-container');
    const closeBtns = document.querySelectorAll('.close-btn');
    const addInstructorForm = document.querySelector('.add-instructor-form');
    const instructorGrid = document.querySelector('.instructor-grid');
    const popupContainer = document.querySelector('.popup-container');
    const popupCancelBtn = document.querySelector('.popup-cancel-btn');
    const popupDeleteBtn = document.getElementById('popup-delete-btn');

    // Function to show add instructor form
    addInstructorBtn.addEventListener('click', function () {
        addInstructorContainer.style.display = 'block';
    });

    // Function to hide any container with close button
    closeBtns.forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            const container = this.closest('.add-instructor-container, .popup-container, .edit-form-container');
            container.style.display = 'none';
        });
    });

    // Function to add new instructor
    addInstructorForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: this.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display server response
            if (data.includes('successfully')) {
                // Refresh instructor list after successful addition
                fetchInstructorList();
                addInstructorContainer.style.display = 'none';
                this.reset(); // Reset form fields
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Function to handle delete instructor action
//     // Assuming instructor-id is the correct ID
// const instructorIdInput = document.getElementById('instructor-id');
// console.log('Instructor ID:', instructorIdInput); // Debugging line

// // Function to handle delete instructor action
// popupDeleteBtn.addEventListener('click', function () {
//     const instructorId = instructorIdInput.value;

//     fetch('../action/deleteInstructor_action.php?id=' + instructorId, {
//         method: 'DELETE' 
//     })
//     .then(response => {
//         if (response.ok) {
//             // Instructor deleted successfully, perform necessary actions
//             popupContainer.style.display = 'none';
//             fetchInstructorList(); // Refresh instructor list
//         } else {
//             // Error handling
//             console.error('Error:', response.statusText);
//         }
//     })
//     .catch(error => console.error('Error:', error));
// });


    // Function to fetch instructor list
    function fetchInstructorList() {
        fetch('../functions/instructor_admin_fxn.php')
        .then(response => response.text())
        .then(data => {
            instructorGrid.innerHTML = data; // Update instructor grid with fetched data
            // Add event listeners to newly loaded edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const instructorID = this.dataset.instructorId;
                    editInstructor(instructorID);
                });
            });
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to handle edit instructor
    function editInstructor(instructorID) {
        // Set the instructor ID in the hidden input field
        document.getElementById('instructor-id').value = instructorID;
        // Display the edit form container
        document.querySelector('.edit-form-container').style.display = 'block';
        // Fetch instructor details via AJAX and populate the edit form fields
        fetch('../functions/instructor_admin_fxn.php?id=' + instructorID)
            .then(response => response.json())
            .then(data => {
                document.getElementById('instructor-name').value = data.instructorName;
                document.getElementById('time-available').value = data.time_available;
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listener for clicking "Cancel" in the confirmation popup
    popupCancelBtn.addEventListener('click', function () {
        popupContainer.style.display = 'none';
    });

    // Initial fetching of instructor list
    fetchInstructorList();
});
