const mainContent  =  document.querySelector("div.main-content")
async function loadPage(path) {
  const res = await   fetch()
  const htmlPage =  await res.json()
  mainContent.innerHTML =  htmlPage
}
const hash =  window.location.hash.replace("#",'')
switch (hash) {
    case 'news':
  
        break; 
    case 'images':
        
        break;

    default:
        break;
}