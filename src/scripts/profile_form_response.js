function toggleEditMode() {
    var editButton = document.getElementById('edit-btn');
    var inputs = document.querySelectorAll('#profileForm input, #profileForm select');
    var passwordInputs = document.querySelectorAll('.password-input');
    var profileImage = document.querySelector('.profile-image img');
    var fileImage = document.getElementById('imageUpload');
    var imageUploadButton = document.getElementById('imageUploadButton');
    var tooltip = document.getElementById('tooltip');

    if (editButton.innerText === 'Edit Profile') {
        // Enable form fields
        inputs.forEach(input => {
            if (input.tagName === 'INPUT') {
                input.readOnly = false;
            } else if (input.tagName === 'SELECT') {
                input.disabled = false;
            }
            input.style.border = '1px solid #ccc';
        });
        if (window.matchMedia("(max-width: 768px)").matches) {
            profileImage.style.width = '160px';
            profileImage.style.height = '160px';
        } else {
            profileImage.style.width = '300px';
            profileImage.style.height = '300px';
        }

        passwordInputs.forEach(input => {
            input.style.display = 'block';
        });
        passwordInput.addEventListener('focus', function() {
            tooltip.style.display = 'block';

        });
        
        passwordInput.addEventListener('blur', function() {
            tooltip.style.display = 'none';
        });
        fileImage.style.display = 'block';
        imageUploadButton.style.display = 'block';

        editButton.innerText = 'Save Profile';
        editButton.type = 'button';
    } else {
        
        // Disable form fields
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
        passwordInputs.forEach(input => {
            input.style.display = 'none';
        });
        tooltip.style.display = 'none';
        fileImage.style.display = 'none';
        imageUploadButton.style.display = 'none';

        editButton.innerText = 'Edit Profile';
        editButton.type = 'submit';
    }
}