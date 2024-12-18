<style>
    /* General styling for the article card */
.article-card {
    display: flex;
    flex-direction: row;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
    max-width: 600px;
}

/* Styling for the cover image */
img .article-card__cover{
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-right: 1px solid #ddd;
}

/* Styling for the article content */
.article-card__content {
    padding: 15px;
    flex-grow: 1;
}

/* Title of the article */
.article-card__title {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 0;
}

/* Preview text */
.article-card__preview {
    font-size: 1rem;
    color: #555;
    margin: 10px 0;
}

/* Read more link */
.article-card__read-more {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

/* Hover effect for the read more link */
.article-card__read-more:hover {
    text-decoration: underline;
}

</style>
<main>
    <!-- Navigation Links -->
    <div class="nav-links d-flex mb-4" style="margin-bottom:15px;font-size: 18px;">
        <a href="#published" class="articles " style="color:inherit;font-weight: 700;">Articles</a>
        <a href="#drafts" class="drafts " style="margin-left:10px;margin-right:10px; color:inherit;font-weight: 700;">Draft
            Articles</a>
    
        <a href="./editor.php" class="new-article " style="color:inherit;font-weight: 700;">New Article</a>
    </div>

    <!-- Articles Section -->
    <section  id="view-articles">
     
    </section>
</main>

<script src="../Scripts/articles.js" ></script>