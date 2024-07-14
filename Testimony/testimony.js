document.addEventListener("DOMContentLoaded", function() {
    fetchTestimonies();

    document.getElementById('testimonyForm').addEventListener('submit', function(event) {
        event.preventDefault();
        uploadTestimony();
    });
});

function fetchTestimonies() {
    fetch('fetch.php')
        .then(response => response.json())
        .then(data => {
            let testimonies = data.testimony;
            let testimonyDiv = document.getElementById('testimonies');
            testimonyDiv.innerHTML = ''; // Clear the div first
            testimonies.forEach(testimony => {
                let testimonyContainer = document.createElement('div');
                testimonyContainer.classList.add('testimony-container');

                let usernameElement = document.createElement('h3');
                usernameElement.classList.add('username');
                usernameElement.textContent = testimony.username;

                let contentElement = document.createElement('p');
                contentElement.classList.add('content');
                contentElement.textContent = testimony.content;

                testimonyContainer.appendChild(usernameElement);
                testimonyContainer.appendChild(contentElement);
                testimonyDiv.appendChild(testimonyContainer);
            });
        })
        .catch(error => console.error('Error fetching testimonies:', error));
}

function uploadTestimony() {
    let content = document.getElementById('textUpload').value;
    let formData = new FormData();
    formData.append('content', content);

    fetch('testimony.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            document.getElementById('textUpload').value = ''; // Clear the textarea
            fetchTestimonies(); // Refresh the list of testimonies
        } else {
            console.error('Error uploading testimony:', response.statusText);
        }
    })
    .catch(error => console.error('Error:', error));
}
