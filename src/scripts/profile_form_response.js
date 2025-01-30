function toggleEditMode() {
    const editButton = document.getElementById('edit-btn');
    const inputs = document.querySelectorAll('#profileForm input, #profileForm select');
    const profileImage = document.querySelector('.profile-image img');
    const fileImage = document.getElementById('imageUpload');
    const imageUploadButton = document.getElementById('imageUploadButton');

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
        fileImage.style.display = 'block';
        imageUploadButton.style.display = 'block';

        editButton.innerText = 'Save Profile';
    } else {
        document.getElementById('profileForm').submit();

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
        fileImage.style.display = 'none';
        imageUploadButton.style.display = 'none';


        editButton.innerText = 'Edit Profile';
        
    }
}