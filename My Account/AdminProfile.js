document.addEventListener("DOMContentLoaded", function() {
    var profileData = JSON.parse(localStorage.getItem('profileData'));
    if (profileData) {
        document.getElementById('username').innerText = 'Name: ' + profileData.username;
        document.getElementById('email').innerText = 'Email: ' + profileData.email;
        document.getElementById('adminID').innerText = 'ID: ' + profileData.adminID;
        
        // Work Experienceを読み込む
        var workExperience = profileData.workExperience || [];
        displayWorkExperience(workExperience);
    }
});

// 新しいWork Experienceを追加する関数
function addExperience() {
    var newExperience = document.getElementById('new-experience').value.trim();
    if (newExperience === '') return;

    var profileData = JSON.parse(localStorage.getItem('profileData'));
    var workExperience = profileData.workExperience || [];
    workExperience.push(newExperience);

    localStorage.setItem('profileData', JSON.stringify({
        ...profileData,
        workExperience: workExperience
    }));

    displayWorkExperience(workExperience);

    // 追加後、テキストエリアをクリアする
    document.getElementById('new-experience').value = '';
}

// Work Experienceを表示する関数
function displayWorkExperience(workExperience) {
    var ul = document.getElementById('work-experience-list');
    ul.innerHTML = '';

    workExperience.forEach(function(item) {
        var li = document.createElement('li');
        li.textContent = item;
        ul.appendChild(li);
    });
}



// Function to preview selected image
function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    
    reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById('profileImage');
        output.src = dataURL;
    };
    
    reader.readAsDataURL(input.files[0]);
}

