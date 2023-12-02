// profile.js

function fetchUserProfile() {
    $.ajax({
        type: 'GET',
        url: 'Php/profile.php', // Adjust the path based on your directory structure
        success: function(response) {
            console.log(response);
            // Process the user profile data as needed
        },
        error: function(error) {
            console.error(error);
            // Handle AJAX error
        }
    });
}

// Call the function when the page is ready
$(document).ready(function() {
    fetchUserProfile();
});
