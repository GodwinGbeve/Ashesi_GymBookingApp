document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch and display report statistics based on selected report type
    function displayReportStatistics(reportType) {
        // AJAX request to fetch report data from the server
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../action/report_admin_actions.php?report-type=${reportType}`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse response JSON data
                    const reportData = JSON.parse(xhr.responseText);
                    // Display the statistics in the report-statistics div
                    const reportStatisticsDiv = document.querySelector('.report-statistics');
                    reportStatisticsDiv.innerHTML = ''; // Clear previous statistics
                    for (const [key, value] of Object.entries(reportData)) {
                        const statItem = document.createElement('div');
                        statItem.innerHTML = `<strong>${key}:</strong> ${value}`;
                        reportStatisticsDiv.appendChild(statItem);
                    }
                } else {
                    console.error('Failed to fetch report data');
                }
            }
        };
        xhr.send();
    }

    // Event listener for the report type selection
    const reportTypeSelect = document.getElementById('report-type');
    reportTypeSelect.addEventListener('change', function() {
        const selectedReportType = reportTypeSelect.value;
        displayReportStatistics(selectedReportType);
    });

    // Event listener for the generate report button
    const generateReportBtn = document.getElementById('generate-report-btn');
    generateReportBtn.addEventListener('click', function() {
        // Get the selected report type
        const selectedReportType = reportTypeSelect.value;
        // Call the function to fetch and display report statistics
        displayReportStatistics(selectedReportType);
    });

    // Event listener for the download report button
    const downloadReportBtn = document.getElementById('download-report-btn');
    downloadReportBtn.addEventListener('click', function() {
        // Get the selected report type
        const selectedReportType = reportTypeSelect.value;
        // AJAX request to download report
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../action/report_admin_actions.php?report-type=${selectedReportType}&download=true`, true);
        xhr.responseType = 'blob';
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Create a blob URL from the response data
                    const blob = new Blob([xhr.response], { type: 'application/octet-stream' });
                    const url = window.URL.createObjectURL(blob);
                    // Create a link element to trigger download
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = `${selectedReportType}_report.xlsx`; // Set the filename
                    // Simulate click on the link to trigger download
                    link.click();
                    // Release the object URL
                    window.URL.revokeObjectURL(url);
                } else {
                    console.error('Failed to download report');
                }
            }
        };
        xhr.send();
    });
});
