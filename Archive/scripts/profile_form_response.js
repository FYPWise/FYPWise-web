
function toggleEditMode() {
    const form = document.getElementById('profileForm');
    const editButton = document.getElementById('edit-btn');
    const inputs = form.querySelectorAll('input, select');
    const profileImage = document.querySelector('.profile-image img');
    const imageUploadButton = document.getElementById('imageUploadButton');

    if (editButton.innerText === 'Edit Profile') {
        // Enable form fields for editing
        inputs.forEach(input => {
        if (input.tagName === 'INPUT') {
            input.readOnly = false;
        } else if (input.tagName === 'SELECT') {
            input.disabled = false;
        }
        input.style.border = '1px solid black';
        });
        profileImage.style.width = '300px';
        profileImage.style.height = '300px';
        imageUploadButton.style.display = 'block';

        editButton.innerText = 'Save Profile';
    } else {
        // Disable form fields and show pop-up with profile information
        inputs.forEach(input => {
        if (input.tagName === 'INPUT') {
            input.readOnly = true;
        } else if (input.tagName === 'SELECT') {
            input.disabled = true;
        }
        input.style.border = 'none';
        });
        profileImage.style.width = '350px';
        profileImage.style.height = '350px';
        imageUploadButton.style.display = 'none';

        editButton.innerText = 'Edit Profile';

        // Collect profile information
        let profileInfo = '';
        let profileData = {};
        inputs.forEach(input => {
        profileInfo += `${input.name}: ${input.value}\n`;
        profileData[input.name] = input.value;
        });

        // Show pop-up message
        alert(`Profile Information:\n${profileInfo}`);

    }
}

function uploadImage() {
    // Implement image upload functionality here
    alert('Image upload functionality to be implemented.');
}