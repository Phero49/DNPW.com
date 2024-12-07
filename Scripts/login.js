function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    // Empty value validation
    if (!email || !password) {
        showModal("Both email and password must be filled out.");
        return false;
    }

    // Email format validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        showModal("Please enter a valid email address.");
        return false;
    }

    // showSuccessModal();
    return true;
}

function showModal(message) {
    document.getElementById("modalMessage").innerText = message;
    document.getElementById("validationModal").style.display = "flex";
}

// function showSuccessModal() {
//     const successModal = document.createElement('div');
//     successModal.className = 'modal';
//     successModal.innerHTML = `
//         <div class="modal-content">
//             <h3>Login Successful!</h3>
//             <button class="close-btn" onclick="redirectToHome()">OK</button>
//         </div>
//     `;
//     document.body.appendChild(successModal);
//     successModal.style.display = "flex";
// }

// function redirectToHome() {
//     window.location.href = "index.php";
// }

function closeModal() {
    document.getElementById("validationModal").style.display = "none";
}
