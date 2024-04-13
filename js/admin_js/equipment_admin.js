document.addEventListener('DOMContentLoaded', function () {
    const addEquipmentBtn = document.querySelector('.add-equipment-btn button');
    const addEquipmentContainer = document.querySelector('.add-equipment-container');
    const closeBtns = document.querySelectorAll('.close-btn');
    const addEquipmentForm = document.querySelector('.add-equipment-form');
    const equipmentGrid = document.querySelector('.equipment-grid');
    const popupContainer = document.querySelector('.popup-container');
    const popupCancelBtn = document.querySelector('.popup-cancel-btn');
    const popupDeleteBtn = document.getElementById('popup-delete-btn');

    // Function to show add equipment form
    addEquipmentBtn.addEventListener('click', function () {
        addEquipmentContainer.style.display = 'block';
    });

    // Function to hide any container with close button
    closeBtns.forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            const container = this.closest('.add-equipment-container, .popup-container, .edit-form-container');
            container.style.display = 'none';
        });
    });

    // Function to add new equipment
    addEquipmentForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: this.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            //alert(data); // Display server response
            if (data.includes('successfully')) {
                // Refresh equipment list after successful addition
                fetchEquipmentList();
                addEquipmentContainer.style.display = 'none';
                this.reset(); // Reset form fields
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Function to fetch equipment list
    function fetchEquipmentList() {
        fetch('../functions/equipment_admin_fxn.php')
        .then(response => response.text())
        .then(data => {
            equipmentGrid.innerHTML = data; // Update equipment grid with fetched data
            // Add event listeners to newly loaded edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const equipmentID = this.dataset.equipmentId;
                    editEquipment(equipmentID);
                });
            });
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to handle edit equipment
    function editEquipment(equipmentID) {
        // Set the equipment ID in the hidden input field
        document.getElementById('equipment-id').value = equipmentID;
        // Display the edit form container
        document.querySelector('.edit-form-container').style.display = 'block';
        // Fetch equipment details via AJAX and populate the edit form fields
        fetch('../functions/equipment_admin_fxn.php?id=' + equipmentID)
            .then(response => response.json())
            .then(data => {
                document.getElementById('equipment-name').value = data.equipmentName;
                document.getElementById('description').value = data.description;
                document.getElementById('quantity-available').value = data.quantityAvailable;
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listener for clicking "Cancel" in the confirmation popup
    popupCancelBtn.addEventListener('click', function () {
        popupContainer.style.display = 'none';
    });

    // Initial fetching of equipment list
    fetchEquipmentList();

    // Add event listener to the delete button
    popupDeleteBtn.addEventListener('click', function () {
        // Retrieve equipment ID from the hidden input field
        const equipmentId = document.getElementById('equipment-id').value;

        // Send AJAX request to deleteEquipment_action.php
        fetch('../action/deleteEquipment_action.php?equipment-id=' + equipmentId, {
            method: 'GET'
        })
        .then(response => {
            if (response.ok) {
                // Equipment deleted successfully, perform necessary actions
                popupContainer.style.display = 'none';
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Equipment deleted successfully'
                });
                // Optionally, you can refresh the equipment list or perform other necessary actions here
                fetchEquipmentList();
            } else {
                // Error handling
                console.error('Error:', response.statusText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
