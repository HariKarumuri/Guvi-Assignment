// register.js

function registerUser() {
    // Assuming you have a function to gather form data, for example, getFormData()
    var formData = getFormData();

    // Perform AJAX registration and handle response
    $.ajax({
        type: 'POST',
        url: 'Php/register.php', // Specify the correct path to your PHP file
        data: formData,
        success: function(response) {
            console.log(response);

            // Parse the JSON response
            var jsonResponse = JSON.parse(response);

            // Check if registration was successful
            if (jsonResponse.success) {
                alert('Registration successful!');
                // Redirect to login page or do other actions as needed
            } else {
                alert('Registration failed. ' + jsonResponse.message);
                // Handle registration failure, show an error message, etc.
            }
        },
        error: function(error) {
            console.error(error);
            // Handle AJAX error
        }
    });
}

function getFormData() {
    // Function to gather form data as an object
    var formData = {
        username: $('#username').val(),
        password: $('#password').val(),
        // Add other form fields as needed
    };

    return formData;
}
