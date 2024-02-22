// Get the logout button element
const logoutButton = document.getElementById('confirm-logout');
const nologoutButton = document.getElementById('no-logout');

logoutButton.addEventListener('click', () => {
    fetch('logout.php')
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            document.querySelector('.logout-container').style.display = 'none';
            // Display the success message
           showSuccessMessage();

            // Redirect after a delay (adjust as needed)
            setTimeout(() => {
                window.location.href = 'sls.php'; // Adjust the actual login page URL
            }, 2000); // Redirect after 2 seconds (customize the delay)
        }
    })
    .catch(error => console.error('Error during logout:', error)); // Redirect after 2 seconds (customize the delay)
});

function showSuccessMessage() {
    const successMessage = document.querySelector('.success-message');
    successMessage.textContent = 'You have successfully logged out.\n Redirecting to login page...';
    successMessage.style.display = 'block'; // Show the message
}

nologoutButton.addEventListener('click', () => {
    window.location.href = 'homepage.php';
});