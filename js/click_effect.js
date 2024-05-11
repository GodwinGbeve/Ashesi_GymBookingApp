// Function to handle menu item click
function handleMenuItemClick(event) {
    // Remove 'active' class from all menu items
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(function(item) {
        item.classList.remove('active');
    });

    // Add 'active' class to the clicked menu item
    const clickedMenuItem = event.currentTarget;
    clickedMenuItem.classList.add('active');
}

// Get all menu items
const menuItems = document.querySelectorAll('.menu-item');

// Attach click event listener to each menu item
menuItems.forEach(function(item) {
    item.addEventListener('click', handleMenuItemClick);
});
