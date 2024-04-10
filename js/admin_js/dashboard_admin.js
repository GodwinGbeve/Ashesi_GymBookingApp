document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch dashboard data from the server
    function fetchDashboardData() {
        // AJAX request to fetch dashboard data
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../action/dashboard_data.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse response JSON data
                    const dashboardData = JSON.parse(xhr.responseText);
                    // Update the dashboard with the retrieved data
                    updateDashboard(dashboardData);
                } else {
                    console.error('Failed to fetch dashboard data');
                }
            }
        };
        xhr.send();
    }

    // Function to update the dashboard with the retrieved data
    function updateDashboard(data) {
        // Update total bookings
        document.getElementById('total-bookings').innerText = data.totalBookings;
        // Update total members
        document.getElementById('total-members').innerText = data.totalMembers;
        // Update equipment availability
        document.getElementById('equipment-availability').innerText = data.equipmentAvailability;
        // Update total feedbacks
        document.getElementById('total-feedbacks').innerText = data.totalFeedbacks;
        // Update total notifications
        document.getElementById('total-notifications').innerText = data.totalNotifications;
        // Update statistics
        document.getElementById('statistics-percentage').innerText = data.statisticsPercentage + '%';
    }

    // Fetch dashboard data when the page loads
    fetchDashboardData();
});
