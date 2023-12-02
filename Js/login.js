// login.js

function loginUser() {
    // Assuming you have a function to gather login form data, for example, getLoginFormData()
    var loginFormData = getLoginFormData();

    // Perform AJAX login and handle response
    $.ajax({
        type: 'POST',
        url: 'Php/login.php', // Specify the correct path to your PHP login file
        data: loginFormData,
        success: function(response) {
            console.log(response);

            // Parse the JSON response
            var jsonResponse = JSON.parse(response);

            // Check if login was successful
            if (jsonResponse.success) {
                alert('Login successful!');
                // Redirect to the profile page or do other actions as needed
            } else {
                alert('Login failed. ' + jsonResponse.message);
                // Handle login failure, show an error message, etc.
            }
        },
        error: function(error) {
            console.error(error);
            // Handle AJAX error
        }
    });
}

function getLoginFormData() {
    // Function to gather login form data as an object
    var loginFormData = {
        username: $('#loginUsername').val(),
        password: $('#loginPassword').val(),
        // Add other login form fields as needed
    };

    return loginFormData;
}