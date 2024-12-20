<?php
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];


}
?>





<div>
    <div id="dialog-backdrop">

    </div>
    <dialog id="model" aria-modal="true" open>
        <div class="model">
            <div class="upload-card">
                <h2 align="center">Upload Image </h2>
                <form id="uploadForm" enctype="multipart/form-data">
                    <label class="file-label">
                        <input type="file" id="imageInput" accept="image/*" name="image">
                        <input type="text" value="1" hidden name="user_id" />
                        <span>Select an Image</span>
                    </label>
                    <div style="display:none" class="preview">
                        <img id="previewImage" alt="Image Preview" src="">
                    </div>
                    <div class="upload-message">
                        <div class="flex-center">
                            <div>
                                <h3>drag and drop image</h3>

                            </div>

                        </div>
                    </div>
                    <input type="text" name="title" id="title" placeholder="Title e.g Lion" />
                    <textarea id="captionInput" placeholder="Enter a caption..." name="caption"></textarea>
                    <button type="submit" id="uploadButton">Upload</button>
                </form>
                <div id="output"></div>
            </div>
        </div>

    </dialog>


    <main>



        <section>
            <div style="text-align:right;margin:10px;">
                <button id="uploadBtn">Upload Images</button></li>
            </div>
            <h1 class="text-center text-grey">Uploaded images </h1>
            <?php
            // Connect to the database
            $pdo = connectToDatabase();

            // Fetch the first 50 image records ordered by time
            $res = $pdo->query('SELECT `id`, `path`, `user`, `time`,`title`,`caption` FROM `images` ORDER BY time LIMIT 50');

            // Validate the query result
            if ($res) {
                $data = $res->fetchAll(); // Fetch all records
            


                // Check if rows are available
                if ($res->rowCount() > 0) {
                    ?>
                    <!-- Main Gallery Container -->
                    <div class="MainGallery">
                        <div class="gallery" id="image-list">
                            <?php
                            // Loop through each image record
                            foreach ($data as $value) {
                                ?>
                                <div class="photo-item">
                                    <!-- Dynamically set image source and alt text -->
                                    <img style="border-radius:10px;"
                                        src="<?php echo '../Database/read-image.php?img=' . htmlspecialchars($value['path']); ?>"
                                        alt="<?php echo htmlspecialchars($value['title']); ?>">
                                    <div class="photo-details">
                                        <!-- Display title -->
                                        <p><strong><?php echo htmlspecialchars($value['title']); ?></strong></p>
                                        <div class="caption"><?php echo htmlspecialchars($value['caption']); ?></div>
                                        <div class="text-grey"><?php echo htmlspecialchars($value['time']); ?></div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div> <!-- End of gallery -->
                    </div> <!-- End of MainGallery -->
                    <?php
                } else {
                    // Message if no images are found
                    echo "<p>No images found.</p>";
                }
            } else {
                // Error message if query failed
                echo "<p>Error fetching images from the database.</p>";
            }
            ?>
        </section>

    </main>

    <script src="../Scripts/uploadImages.js"></script>


</div>