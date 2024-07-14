document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('surveyForm');
  const thankYouContainer = document.getElementById('thankYouContainer');
  const exitIcon = document.getElementById('exitIcon');

  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Show the thank you container
    thankYouContainer.style.display = 'flex';

    // Optionally, reset the form
    form.reset();
  });

  // Hide the thank you container when clicking anywhere outside of it
  document.addEventListener('click', function(event) {
    const isClickInsideContainer = thankYouContainer.contains(event.target);
    if (!isClickInsideContainer) {
      thankYouContainer.style.display = 'none';
    }
  });

  // Handle click event on exit icon to hide the thank you container
  exitIcon.addEventListener('click', function(event) {
    thankYouContainer.style.display = 'none';
    event.stopPropagation(); // Prevent the click event from bubbling up
  });
});
