
// Get references to form elements
const imageInput = document.getElementById("imageInput");
const previewImage = document.getElementById("previewImage");
const captionInput = document.getElementById("captionInput");
const uploadButton = document.getElementById("uploadButton");
const output = document.getElementById("output");
const uploadMsg = document.querySelector(".upload-message")
const previewContainer  = document.querySelector(".preview")
let uploadImage = null

// Display image preview when a file is selected
imageInput.addEventListener("change", () => {
    const file = imageInput.files[0];

    if (file) {
        uploadImage = file
        const reader = new FileReader();
        reader.onload = () => {
            previewImage.src = reader.result;
        };
        reader.readAsDataURL(file);
        hidePreview()
    } else {
        previewImage.src = "";
    }
});


const backdrop = document.querySelector("#dialog-backdrop")
const dialog = document.querySelector('dialog')

function startUpload() {
    backdrop.style.display = "block"

   dialog.style.display = "block"
 // dialog.open
    
}

const btn = document.querySelector("#uploadBtn")
btn.addEventListener('click',startUpload)
const hidDialog = ()=>{
    backdrop.style.display = "none"

    dialog.style.display = "none"
}
backdrop.addEventListener('click',hidDialog)


// Allow the dialog to accept the dragover event
dialog.addEventListener('dragover', (e) => {
    e.preventDefault(); // Necessary to allow the drop
    dialog.classList.add('dragging'); // Optional: show dashed border during drag
});

// Handle the drop event
dialog.addEventListener('drop', (e) => {
    e.preventDefault(); // Prevent the default action (open as link for some browsers)
    dialog.classList.remove('dragging'); // Remove dashed border after drop
  
    // Get the dropped files
    const files = e.dataTransfer.files;

    // If files exist, process the first file (assuming it's an image)
    if (files.length > 0) {
        const file = files[0];
        if (file.type.startsWith('image/')) {
            // Create a URL for the image and set it as the preview image
            const imageURL = URL.createObjectURL(file);
    hidePreview()
            previewImage.src = imageURL;
            uploadImage = file

        } else {
            alert('Please drop an image file');
        }
    }
});

function hidePreview(){
            uploadMsg.style.display = "none"
            previewContainer.style.display = "flex"
}
// Handle the dragstart event
dialog.addEventListener('dragstart', (e) => {
    console.log('Drag started');
    // Optional: Add some style or behavior when the drag starts (e.g., change cursor)
});

document.getElementById('uploadForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const caption = captionInput.value;
     

    if (!uploadImage) {
        alert("Please select an image to upload.");
        return;
    }

    if (!caption.trim()) {
        alert("Please enter a caption.");
        return;
    }
    formData.set('image',uploadImage)
    fetch('../Database/upload-images.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const parser = new DOMParser();
            const div = document.createElement('div')
          div.innerHTML = ` <div class="photo-item">
                                    <!-- Dynamically set image source and alt text -->
                                    <img style="border-radius:10px;"  src="${previewImage.src}"
                                        alt="${formData.get("title")}">
                                    <div class="photo-details">
                                        <!-- Display title -->
                                        <p><strong>${formData.get("title")}</strong></p>
                                    <div class="text-grey" >${new Date().toString()}</div>
                                    </div>
                                </div>`
                                
                   const el = document.querySelector("#image-list")
                   el.appendChild(div)
                   console.log(el)
hidDialog()

        } else {

 console.log(data)
            alert('Error uploading image');
        }
    })
    .catch(error => {
        console.log(error)
        console.error('Error:', error);
        alert('Something went wrong');
    });
});