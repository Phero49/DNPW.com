function fetchArticles(publishedStatus) {
    // Make a GET request to fetch articles by published status
    fetch(`../Database/getArticleList.php?published=${publishedStatus}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                    data.forEach(element => {
                renderArticleCard(element)
            });
            }else{
const p = document.createElement('p')
p.style.textAlign = "center"
const text = document.createTextNode("No articles found. start creating new artcles ")
p.appendChild(text)


            }
        
            // You can now handle the response (e.g., display the articles on the page)
        })
        .catch(error => {
            console.error('Error fetching articles:', error);
        });
}

function renderArticleCard(article) {
    const articleCard = document.createElement('div');
    articleCard.classList.add('article-card');

    const img = document.createElement('img');
    img.classList.add('article-card__cover');
    img.src = article.cover.length  > 4? article.cover:'https://via.placeholder.com/150' ;
    img.alt = 'Article Cover';
    img.style.height = "150px" 
    img.style.width = "150px"
  
    articleCard.appendChild(img);

    const contentDiv = document.createElement('div');
    contentDiv.classList.add('article-card__content');

    const title = document.createElement('h3');
    title.classList.add('article-card__title');
    title.textContent = article.title;
    contentDiv.appendChild(title);

    const preview = document.createElement('p');
    preview.classList.add('article-card__preview');
    preview.textContent = article.preview;
    contentDiv.appendChild(preview);

    const readMoreLink = document.createElement('a');
    readMoreLink.classList.add('article-card__read-more');
    readMoreLink.href = article.url;
    readMoreLink.textContent = 'Read More';
    contentDiv.appendChild(readMoreLink);

    articleCard.appendChild(contentDiv);

    // Append the article card to a container (e.g., a div with id 'articles')
    document.getElementById('view-articles').appendChild(articleCard);
}



// Render the article card

onload = ()=>{
 const published = window.location.hash.includes("published")
 console.log(published)
 
    // Fetch published articles
fetchArticles(published ? 1 : 0);  // Pass 1 for published articles or 0 for unpublished


}

window.addEventListener('hashchange',()=>{
    const published = window.location.hash.includes("published")
    console.log(published)
})