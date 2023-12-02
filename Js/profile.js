// profile.js

function fetchUserProfile() {
    $.ajax({
        type: 'GET',
        url: 'Php/profile.php', 
        success: function(response) {
            console.log(response);

    
            var userProfileData = JSON.parse(response);

            localStorage.setItem('userProfileData', JSON.stringify(userProfileData));

            
            processUserProfile(userProfileData);
        },
        error: function(error) {
            console.error(error);
            
        }
    });
}

function processUserProfile(userProfileData) {
    
    $('#username').text(userProfileData.username);
}


$(document).ready(function() {
    
    var storedProfileData = localStorage.getItem('userProfileData');

    if (storedProfileData) {
       
        processUserProfile(JSON.parse(storedProfileData));
    } else {
        // If data doesn't exist in local storage, fetch it
        fetchUserProfile();
    }
});
