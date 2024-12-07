function validateForm() {
    // Get form elements
    const userName = document.getElementById("userName").value.trim();
    const email = document.getElementById("email").value.trim();
    const phoneNumber = document.getElementById("pno").value.trim();
    const nicNumber = document.getElementById("nicno").value.trim();
    const password = document.getElementById("pws").value.trim();

    // Empty value validation
    if (!userName || !email || !phoneNumber || !nicNumber || !password) {
        showModal("All fields must be filled out");
        return false;
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        showModal("Please enter a valid email address.");
        return false;
    }

    // Phone number validation (must be digits and 10 characters)
    const phonePattern = /^\d{10}$/;
    if (!phonePattern.test(phoneNumber)) {
        showModal("Please enter a valid phone number (071XXXXXXX).");
        return false;
    }

    // NIC validation (Old and New NIC types)
    const nicPattern = /^(?:[0-9]{9}[vV]|[0-9]{12})$/;
    if (!nicPattern.test(nicNumber)) {
        showModal("Please enter a valid NIC number.");
        return false;
    }

    showSuccessModal("Registration is Successful!");
    // document.querySelector('.register-form').reset();
    return true;
}

function showModal(message) {
    document.getElementById("modalMessage").innerText = message;
    document.getElementById("validationModal").style.display = "flex";
}

function showSuccessModal(message) {
    document.getElementById("modalMessage").innerText = message;
    document.getElementById("validationModal").style.display = "flex";

    setTimeout(function () {
        closeModal();
    }, 3000);
}

function closeModal() {
    document.getElementById("validationModal").style.display = "none";
}

function redirectToLogin() {
    window.location.href = "login.php";
}
