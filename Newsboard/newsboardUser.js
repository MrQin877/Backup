document.addEventListener('DOMContentLoaded', () => {
    const postsContainer = document.getElementById('postsContainer');

    loadPosts();

    function loadPosts() {
        fetch('postFetch.php')
        .then(response => response.json())
        .then(data => {
            postsContainer.innerHTML = '';
            data.forEach(post => {
                addPostToDOM(post);
            });
        });
    }

    function addPostToDOM(post) {
        const card = document.createElement('div');
        card.classList.add('card');

        const imageDiv = document.createElement('div');
        imageDiv.classList.add('image');
        const img = document.createElement('img');
        img.src = post.image;
        imageDiv.appendChild(img);

        const title = document.createElement('h2');
        title.innerText = post.title;

        const content = document.createElement('p');
        content.innerText = post.content;

        card.appendChild(imageDiv);
        card.appendChild(title);
        card.appendChild(content);

        postsContainer.appendChild(card);
    }
});
