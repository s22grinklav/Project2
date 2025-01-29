"use strict";

// Function to set up delete confirmation for all deletion forms
function setupDeleteForms() {
    let deleteForms = document.querySelectorAll('form.deletion-form');
    
    // Loop through each delete form and add an event listener
    for (let form of deleteForms) {
        form.addEventListener('submit', function (event) {
            // Prevent the form from submitting immediately
            event.preventDefault();
            
            // Show confirmation dialog
            if (window.confirm('Are you sure you want to delete this object?')) {
                // If user confirms, submit the form
                form.submit();
            } else {
                // If user cancels, prevent form submission
                return false;
            }
        });
    }
}

// Run the setup function once the page is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    setupDeleteForms();
});
