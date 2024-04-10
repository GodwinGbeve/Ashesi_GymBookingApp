document.addEventListener('DOMContentLoaded', function () {
    // Load user table on page load
    loadUserTable();

    // Function to load user table
    function loadUserTable() {
        // Send AJAX request to fetch user data
        fetch('../functions/manage_admin_fxn.php')
        .then(response => response.text())
        .then(data => {
            // Update user table with fetched data
            document.querySelector('#userTable tbody').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }

    loadUserTable();

   // Event listener for edit button
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('edit-btn')) {
        // Get user ID of the selected row
        

        // Get user details from the row
        const row = event.target.closest('tr');
        const userID = row.cells[0].innerText;
        const username = row.cells[1].innerText;
        const email = row.cells[2].innerText;
        const roleID = row.cells[3].innerText;

        // Set values in the edit form
        document.getElementById('editUsername').value = username;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRoleID').value = roleID;
        document.getElementById('editUserID').setAttribute('value', userID);
        //console.log(userID);

        // Display the edit modal
        document.getElementById('editModal').style.display = 'block';
    }
});

// Close the edit modal when the close button is clicked
document.querySelector('.close').addEventListener('click', function () {
    document.getElementById('editModal').style.display = 'none';
});

    // Event listener for delete button
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-btn')) {
            // Get user ID of the selected row
            const userID = event.target.dataset.userID;

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this user!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete user
                    fetch('../action/manageUser_delete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `userID=${userID}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Reload user table after deletion
                        loadUserTable();
                        // Display success message using SweetAlert
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                        );
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    });
});