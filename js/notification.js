// Add event listener to reply buttons
const replyPopup = document.getElementById('reply-popup');
const closePopupBtn = document.getElementById('close-popup');

  // Show reply popup when clicking reply button
  document.querySelectorAll('.message-item .reply-button').forEach(btn => {
    btn.addEventListener('click', () => {
        replyPopup.style.display = 'block';
        const senderName = btn.parentElement.querySelector('.message-content strong').textContent.split(': ')[1];
        document.getElementById('reply-name').value = senderName;
    });
});

// Close reply popup when clicking close button
closePopupBtn.addEventListener('click', () => {
    replyPopup.style.display = 'none';
});

// Function to render a message item
function renderMessage(message, list) {
    const messageItem = document.createElement('div');
    messageItem.classList.add('message-item');
    messageItem.innerHTML = `
        <div class="message-content">
            <strong>${message.name}</strong>: ${message.content}
        </div>
        <button class="reply-button">Reply</button>
    `;
    list.appendChild(messageItem);
}

// Handle reply form submission
const replyForm = document.getElementById('reply-form');
replyForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const senderName = document.getElementById('reply-name').value;
    const messageContent = document.getElementById('reply-message').value;
    console.log(`Reply from ${senderName}: ${messageContent}`);
    // Clear form fields and close popup
    replyForm.reset();
    replyPopup.style.display = 'none';
});
