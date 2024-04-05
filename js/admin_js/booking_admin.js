document.addEventListener('DOMContentLoaded', getBookings);

function getBookings() {
  // Simulating API call to fetch bookings data
  const bookingsData = [
    { userID: 1, userName: 'John', instructorID: 1, instructorName: 'Michael', date: '2024-04-10', status: 'confirmed' },
    { userID: 2, userName: 'Alice', instructorID: 2, instructorName: 'Jessica', date: '2024-04-12', status: 'pending' },
    { userID: 3, userName: 'Bob', instructorID: 1, instructorName: 'Michael', date: '2024-04-15', status: 'confirmed' },
    // Add more booking data as needed
  ];

  const bookingsBody = document.getElementById('bookings-body');

  // Clear existing data
  bookingsBody.innerHTML = '';

  // Insert new booking data
  bookingsData.forEach(booking => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${booking.userID}</td>
      <td>${booking.userName}</td>
      <td>${booking.instructorID}</td>
      <td>${booking.instructorName}</td>
      <td>${booking.date}</td>
      <td>${booking.status}</td>
      <td>
        <div class="button-container">
          <button onclick="handleBooking(${booking.userID})">Handle</button>
        </div>
      </td>
    `;
    bookingsBody.appendChild(row);
  });
}

function handleBooking(userID) {
  // Simulating handling the booking for the selected user
  alert(`Handling booking for User ID: ${userID}`);
}