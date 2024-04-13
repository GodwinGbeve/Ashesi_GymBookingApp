document.addEventListener('DOMContentLoaded', function () {
    const addInstructorBtn = document.querySelector('.add-instructor-btn button');
    const addInstructorContainer = document.querySelector('.add-instructor-container');
    const closeBtns = document.querySelectorAll('.close-btn');
    const addInstructorForm = document.querySelector('.add-instructor-form');
    const instructorGrid = document.querySelector('.instructor-grid');
    const popupContainer = document.querySelector('.popup-container');
    const popupCancelBtn = document.querySelector('.popup-cancel-btn');
    const popupDeleteBtn = document.getElementById('popup-delete-btn');

    // Function to hide any container with close button
    closeBtns.forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            const container = this.closest('.add-instructor-container, .popup-container, .edit-form-container');
            container.style.display = 'none';
        });
    });

    // Function to show add instructor form
    addInstructorBtn.addEventListener('click', function () {
        addInstructorContainer.style.display = 'block';
        // Reset the form fields and remove validation styling
        addInstructorForm.reset();
        addInstructorForm.classList.remove('was-validated');
        addInstructorForm.querySelectorAll('.is-invalid').forEach(function (element) {
            element.classList.remove('is-invalid');
        });
    });

    // Function to handle form submission
    addInstructorForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Validate form fields
        if (!addInstructorForm.checkValidity()) {
            event.stopPropagation();
            addInstructorForm.classList.add('was-validated');
            return;
        }

        // Create FormData object from the form
        const formData = new FormData(this);

        // Send AJAX request to handle form submission
        fetch(this.action, {
            method: this.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Check if response indicates success
            if (data.includes('successfully')) {
                // Close the add instructor form
                addInstructorContainer.style.display = 'none';

                // Show SweetAlert for successful addition
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data, // Display response message
                    showConfirmButton: false,
                    timer: 2000 // Close after 2 seconds
                }).then(() => {
                    // Fetch updated instructor list and display on the screen
                    fetchInstructorList();
                });
            } else {
                // Show error message in case of failure
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data // Display response message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    });

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
