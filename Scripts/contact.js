// Form validation function for contact form
function validateContactForm() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    // Empty value validation
    if (!name || !email || !message) {
        showModal("All fields must be filled out.", "validationModal");
        return false;
    }

    // Email format validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        showModal("Please enter a valid email address.", "validationModal");
        return false;
    }

    showModal("Message Sent Successfully!", "successModal");
    return true;
}

function showModal(message, modalId) {
    const modal = document.getElementById(modalId);
    const modalMessage = modal.querySelector('h3');
    modalMessage.innerText = message;
    modal.style.display = "flex";
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = "none";
}

// function handleSuccess(modalId) {
//     const modal = document.getElementById(modalId);
//     modal.style.display = "none";
//     document.querySelector('.contact-form').reset();
// }