document.addEventListener('DOMContentLoaded', () => {
    const postForm = document.getElementById('postForm');
    const postsContainer = document.getElementById('postsContainer');
    const imageInput = document.getElementById('image');
    let editIndex = -1;
    let posts = [];

    loadPosts();

    postForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(postForm);
        if (editIndex !== -1) {
            formData.append('id', posts[editIndex].id);
        }

        fetch('postManage.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            loadPosts();
            postForm.reset();
            editIndex = -1;
        });
    });

    function loadPosts() {
        fetch('postFetch.php')
        .then(response => response.json())
        .then(data => {
            posts = data;
            postsContainer.innerHTML = '';
            posts.forEach((post, index) => {
                addPostToDOM(post, index);
            });
        });
    }

    function addPostToDOM(post, index) {
        const postCard = createPostCard(post, index);
        postsContainer.appendChild(postCard);
    }
    //add post item

    function createPostCard(post, index) {
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

        const actionsDiv = document.createElement('div');
        actionsDiv.classList.add('actions');

        const editButton = document.createElement('button');
        editButton.innerText = 'Edit';
        editButton.addEventListener('click', () => editPost(post, index));

        const deleteButton = document.createElement('button');
        deleteButton.innerText = 'Delete';
        deleteButton.addEventListener('click', () => deletePost(index));

        actionsDiv.appendChild(editButton);
        actionsDiv.appendChild(deleteButton);

        card.appendChild(imageDiv);
        card.appendChild(title);
        card.appendChild(content);
        card.appendChild(actionsDiv);

        return card;
    }
    //create post card let the post item included

    function editPost(post, index) {
        editIndex = index;
        postForm.title.value = post.title;
        postForm.content.value = post.content;
        
        // Create a new File object to display the filename
        const imagePathParts = post.image.split('/');
        const imageFilename = imagePathParts[imagePathParts.length - 1];
        const file = new File([], imageFilename);
        
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        imageInput.files = dataTransfer.files;
    }

    function deletePost(index) {
        const formData = new FormData();
        formData.append('id', posts[index].id);

        fetch('postDelete.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            loadPosts();
        });
    }
});
