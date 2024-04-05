document.addEventListener('DOMContentLoaded', function () {
    const editBtns = document.querySelectorAll('.edit-btn');
    const deleteBtns = document.querySelectorAll('.delete-btn');
    const popupContainer = document.querySelector('.popup-container');
    const popupDeleteBtn = document.querySelector('.popup-delete-btn');
    const popupCancelBtn = document.querySelector('.popup-cancel-btn');

    editBtns.forEach(function (editBtn) {
        editBtn.addEventListener('click', function () {
            // Implement edit functionalityhere
            console.log('Edit instructor:', this.dataset.instructorId);
        });
    });

    deleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener('click', function () {
            const instructorId = this.dataset.instructorId;
            popupContainer.dataset.instructorId = instructorId;
            popupContainer.classList.add('active');
        });
    });

    popupCancelBtn.addEventListener('click', function () {
        popupContainer.classList.remove('active');
    });

    popupDeleteBtn.addEventListener('click', function () {
        const instructorId = popupContainer.dataset.instructorId;
        // Send a request to the backend to delete the instructor
        console.log('Delete instructor:', instructorId);
        popupContainer.classList.remove('active');
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const editBtns = document.querySelectorAll('.edit-btn');
    const deleteBtns = document.querySelectorAll('.delete-btn');
    const popupContainer = document.querySelector('.popup-container');
    const popupDeleteBtn = document.querySelector('.popup-delete-btn');
    const popupCancelBtn = document.querySelector('.popup-cancel-btn');
    const editFormContainer = document.querySelector('.edit-form-container');
    const editForm = document.querySelector('.edit-form');
    const saveBtn = document.querySelector('.save-btn');
    const cancelBtn = document.querySelector('.cancel-btn');

    editBtns.forEach(function (editBtn) {
        editBtn.addEventListener('click', function () {
            const instructorId = this.dataset.instructorId;
            const instructorName = this.dataset.instructorName;
            const timeAvailable = this.dataset.timeAvailable;

            document.getElementById('instructor-id').value = instructorId;
            document.getElementById('instructor-name').value = instructorName;
            document.getElementById('time-available').value = timeAvailable;

            editFormContainer.style.display = 'block';
        });
    });

    cancelBtn.addEventListener('click', function () {
        editFormContainer.style.display = 'none';
    });

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const instructorId = document.getElementById('instructor-id').value;
        const instructorName = document.getElementById('instructor-name').value;
        const timeAvailable = document.getElementById('time-available').value;

        // Send a request to the backend to update the instructor
        console.log('Update instructor:', instructorId, 'with name:', instructorName, 'and time available:', timeAvailable);

        editFormContainer.style.display = 'none';
    });

    // ... (the rest of the JavaScript code for delete functionality)
});


document.addEventListener('DOMContentLoaded', function () {
    const addInstructorBtn = document.querySelector('.add-instructor-btn');
    const addInstructorContainer = document.querySelector('.add-instructor-container');
    const addInstructorForm = document.querySelector('.add-instructor-form');

    addInstructorBtn.addEventListener('click', function () {
        addInstructorContainer.style.display = 'block';
    });

    addInstructorForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const file = document.getElementById('add-instructor-image').files[0];
        const formData = new FormData();
        formData.append('image', file);
        formData.append('name', document.getElementById('add-instructor-name').value);
        formData.append('time_available', document.getElementById('add-time-available').value);

        // Send a request to the backend to add the instructor
        console.log('Add instructor:', formData);

        addInstructorContainer.style.display = 'none';
    });

  
  
    // ... (the rest of the JavaScript code for edit and delete functionality)
});


