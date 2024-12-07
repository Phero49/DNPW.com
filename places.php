<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Images/logo2.png">
  <title>DNPW| Stories</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="Styles/styles.css">
  <link rel="stylesheet" href="Styles/stories.css">
  <script src="Scripts/cart.js" defer></script>
</head>

<body>
    <?php
            session_start();
        ?>
    <nav>
        <a href="index.php">
            <img src="Images/parks logo.png" alt="Logo">
        </a>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="hamburger">&#9776;</label>
        <ul class="menu">
        <li><a href="places.php">Places</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">About Us</a></li>
        </ul>
    </nav>

  <main>
    <section>

      <div class="container">
        <div class="cards grid-row">
          <div class="card">
            <div class="card-top">
              <img src="Images/img1.jpg" alt="Blog Name">
            </div>
            <div class="card-info">
              <h2>Yala National Park Sri Lanka</h2>
              <span class="date">Monday, Aug 05, 2024</span>
              <p class="excerpt">Yala National Park, located in the southeastern region of Sri Lanka, is renowned for its incredible biodiversity and one of the highest leopard densities in the world. Spanning across dense forests, grasslands, and lagoons, the park offers a sanctuary to a variety of wildlife including elephants, sloth bears, and crocodiles. Yala is a popular destination for wildlife enthusiasts and nature photographers alike, offering jeep safaris where visitors can explore the rich ecosystems and spot exotic species in their natural habitat.</p>
            </div>
            <div class="card-bottom flex-row">
              <a href="https://www.yalasrilanka.lk/" class="read-more" target="_blank">Visit Here</a>
              <a href="https://maps.app.goo.gl/2ciHDsf73D8DuLBn8" class="button btn1" target="_blank">Google Map</a>
            </div>
          </div>
          <div class="card">
            <div class="card-top">
              <img src="Images/img2.jpg" alt="Blog Name">
            </div>
            <div class="card-info">
              <h2>Horton Plains National Park</h2>
              <span class="date">Sunday, Aug 11, 2024</span>
              <p class="excerpt">Situated in the central highlands of Sri Lanka, Horton Plains National Park is a UNESCO World Heritage site known for its sweeping landscapes, cloud forests, and grasslands. The park is home to the famous World’s End viewpoint, where sheer cliffs drop dramatically to the plains below, offering breathtaking views. Horton Plains is also a biodiversity hotspot, housing endemic species such as the Sri Lankan sambar deer and a variety of birds. Visitors can hike along well-marked trails and explore natural features like Baker’s Falls, making it a favorite spot for nature lovers.</p>
            </div>
            <div class="card-bottom flex-row">
              <a href="https://www.mwfc.gov.lk/2022/03/29/episode-15-horton-plain-national-park/" class="read-more" target="_blank">Visit Here</a>
              <a href="https://maps.app.goo.gl/oHPEpkq4ytycWCTk9" class="button btn2" target="_blank">Google Map</a>
            </div>
          </div>
          <div class="card">
            <div class="card-top">
              <img src="Images/img3.jpg" alt="Blog Name">
            </div>
            <div class="card-info">
              <h2>Late Ancient City - Kandy</h2>
              <span class="date">Tuesday, Aug 17, 2024</span>
              <p class="excerpt">Kandy, nestled in the heart of Sri Lanka’s hill country, was the last capital of the ancient kings and holds a deep historical and cultural significance. The city is home to the revered Temple of the Sacred Tooth Relic, a UNESCO World Heritage site that attracts pilgrims and tourists alike. Kandy is known for its vibrant festivals, particularly the annual Esala Perahera, which features a grand procession of traditional dancers, drummers, and ornately decorated elephants. With its rich cultural heritage and scenic beauty, Kandy remains a must-visit destination for those exploring Sri Lanka's past.</p>
            </div>
            <div class="card-bottom flex-row">
              <a href="https://whc.unesco.org/en/list/450/" class="read-more" target="_blank">Visit Here</a>
              <a href="https://maps.app.goo.gl/YN5v7cMcSJNBu4GG9" class="button btn3" target="_blank">Google Map</a>
            </div>
          </div>
          <div class="card">
            <div class="card-top">
              <img src="Images/img4.jpg" alt="Blog Name">
            </div>
            <div class="card-info">
              <h2>Paradise with Beauty - Ella</h2>
              <span class="date">Monday, Aug 30, 2024</span>
              <p class="excerpt">Ella, a picturesque town nestled in the mountains of Sri Lanka, is a paradise for those seeking tranquility and natural beauty. Surrounded by tea plantations, lush greenery, and cascading waterfalls, Ella offers stunning vistas and a cool climate, making it a perfect escape from the heat. Popular attractions include Ella Rock, which offers panoramic views, and the Nine Arches Bridge, a remarkable feat of colonial-era engineering. Ella is a haven for hikers and photographers, with its serene landscapes and charming village atmosphere capturing the hearts of travelers.</p>
            </div>
            <div class="card-bottom flex-row">
              <a href="https://www.visitella.com/" class="read-more" target="_blank">Visit Here</a>
              <a href="https://maps.app.goo.gl/ddy8zEf5MkpRboqo6" class="button btn4" target="_blank">Google Map</a>
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>

  <footer>
    <p>&copy;Department of Parks and worldlife 2024</p>
  </footer>

</body>

</html>