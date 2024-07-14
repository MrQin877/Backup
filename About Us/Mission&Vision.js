// JavaScript for overlay sliding animation

// Function to slide in the overlay from left to right
function slideInOverlay(overlay) {
    overlay.style.opacity = '1'; // Ensure overlay is visible
    overlay.style.transform = 'translateX(0%)'; // Slide in from left
}

// Function to slide out the overlay from right to left
function slideOutOverlay(overlay) {
    overlay.style.opacity = '0'; // Hide overlay
    overlay.style.transform = 'translateX(-100%)'; // Slide out to left
}

document.addEventListener('DOMContentLoaded', function() {
    // Get all overlay elements
    const overlays = document.querySelectorAll('.overlay');

    // Add event listeners to each overlay
    overlays.forEach(overlay => {
        // Handle click on overlay to hide it
        overlay.addEventListener('click', function() {
            slideOutOverlay(overlay);
        });
    });

    // Get all images that trigger overlay
    const images = document.querySelectorAll('.mission-container img, .vision-container img');

    // Add mouseover event listener to each image
    images.forEach(image => {
        // Find corresponding overlay for the image
        const overlay = image.parentElement.querySelector('.overlay');

        // Handle mouseover on image to show overlay
        image.addEventListener('mouseover', function() {
            slideInOverlay(overlay);
        });

        // Handle mouseout on image to hide overlay
        image.addEventListener('mouseout', function() {
            slideOutOverlay(overlay);
        });
    });
});
