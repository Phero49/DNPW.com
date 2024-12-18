const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'], // Text styling
    ['blockquote', 'code-block'],             // Block styles
  
    [{ 'header': 1 }, { 'header': 2 }],       // Headers
    [{ 'list': 'ordered'}, { 'list': 'bullet' }], // Lists
    [{ 'script': 'sub'}, { 'script': 'super' }],  // Subscript/Superscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],      // Indent/Outdent
    [{ 'direction': 'rtl' }],                 // Text direction
  
    [{ 'size': ['small', false, 'large', 'huge'] }], // Font size
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],      // Header levels
    [{ 'color': [] }, { 'background': [] }],   // Text color and background
    [{ 'font': [] }],                         // Font family
    [{ 'align': [] }],                        // Alignment
  
    ['link', 'image', 'video'],              // Media
    ['clean']                                // Remove formatting
  ];
  const quill = new Quill('#editor-container', {
    theme: 'snow', // Use the "snow" theme for a clean UI
    modules: {
      toolbar: toolbarOptions
    }
  });


// Auto-save debounce timer
let autoSaveTimer;
let articleId ;
// Listen to the Quill `text-change` event
quill.on('text-change', () => {
  // Clear the existing timer to debounce saves
  clearTimeout(autoSaveTimer);
  console.log('fired')

  // Set a new timer to save content after 1 second of inactivity
  autoSaveTimer = setTimeout(() => {
    // Get the HTML content of the editor
    const content = quill.root.innerHTML;

    // Prepare the data to send to the server
    const formData = new FormData();
    formData.append("id",articleId)
    formData.append('content', content);

    // Send the content to the server via fetch
    fetch('../Database/saveContent.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Failed to auto-save content');
        }
        return response.text(); // Adjust if your server returns JSON
      })
      .then(result => {
        console.log('Content auto-saved successfully:', result);
      })
      .catch(error => {
        console.error('Error auto-saving content:', error);
      });
  }, 1000); // Debounce duration (1 second)
});

onload = (e)=>{
 const article =  document.body.getAttribute('article')
 if (article != null) {
  articleId = article
  fetch('../Database/getArticle.php?article_id='+article)
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const article = data.article;
      quill.root.innerHTML =article.content  // Load content into the Quill editor
      console.log('Title:', article.title,article.content);
    } else {
      console.error('Error:', data.error);
    }
  })
  .catch(error => console.error('Fetch error:', error));

 }
}

     // Custom "Publish" button logic
     document.getElementById('publish-button').addEventListener('click', () => {
      const content = quill.root.innerHTML;
      alert('Publish button clicked! Content: \n' + content);
      // Add your "publish" logic here (e.g., send content to server)
  });



  // Custom "Preview" button logic
  document.getElementById('preview-button').addEventListener('click', () => {
      const content = quill.root.innerHTML;
      const previewWindow = window.open('', '_blank');
      previewWindow.document.write(`
       <html>
<head>
    <title>Preview</title>
    
     <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
            
    <style>

   img{
   max-width: 800px;
   width:100%
   } 
    </style>
</head>
<body style="display: flex;  justify-content: center; margin: 0; background-color: #f5f5f5;">
    <div style="max-width: 800px; width: 100%; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        ${content}
    </div>
</body>
</html>

      `);
      previewWindow.document.close();
  });



