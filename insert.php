<?php require("header.php"); ?>

    <?php

    // Get data from form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $descr = $_POST["descr"];
        $qty = $_POST["qty"];

        // If upload button is clicked ...
        if (isset($_POST['upload'])) {

            $imgFilename = $_FILES["uploadImg"]["name"];
            $imgTempname = $_FILES["uploadImg"]["tmp_name"];
            $imgFolder = "./image/" . $imgFilename;
            
            // // SQL query to insert data
            // $sql = "INSERT INTO myitems (name, descr, image, qty) VALUES ('$name', '$descr', '$filename', '$qty')";

            if (!move_uploaded_file($imgTempname, $imgFolder)) {
                echo "<script>alert('Failed to upload image.');</script>";
            }
        }

        if (isset($_POST['upload'])) {

            $pdfFilename = $_FILES["uploadPdf"]["name"];
            $pdfTempname = $_FILES["uploadPdf"]["tmp_name"];
            $pdfFolder = "./datasheet/" . $pdfFilename;
            
            // // SQL query to insert data
            // $sql = "INSERT INTO myitems (name, descr, image, qty) VALUES ('$name', '$descr', '$filename', '$qty')";

            if (!move_uploaded_file($pdfTempname, $pdfFolder)) {
                echo "<script>alert('Failed to upload Datasheet.');</script>";
            }
        }

        // SQL query to insert data
        $sql = "INSERT INTO myitems (name, descr, qty, image, datasheet) VALUES ('$name', '$descr', '$qty', '$imgFilename', '$pdfFilename')";
    
        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully.');</script>";
            // Clear form data
            $_POST = array();
        } else {
            echo "<script>alert('Error: ' . $sql . '<br>' . $conn->error');</script>";
        }

    }

    // Close the connection
    $conn->close();
    ?>
    <div class="formContainer">
    
    <form action="" method="POST" enctype="multipart/form-data">
    <p>Add New Item:</p>
        <div class="formRow">
            <div class="titleRow">    
                <label for="name">Item Name* : </label>
            </div>
            <div class="inputRow">
                <input type="text" id="name" name="name" required><br><br>
            </div>
        </diV>

        <div class="formRow">
            <div class="titleRow">
                <label for="descr">Description : </label>
            </div>
            <div class="inputRow">
                <textarea id="descr" name="descr">Description</textarea><br><br>
            </div>
        </div>

        <div class="formRow">
            <div class="titleRow">
                <label for="image">Image : </label>
            </div>
            <div class="inputRow">
                <input type="file" id="image" name="uploadImg" accept="image/png,image/jpeg" onchange="showImage()"><br><br>
                <img id="imagePreview" class="imagePreview" src="#"/><br>
            </div>
        </div>

        <div class="formRow">
            <div class="titleRow">
                <label for="datasheet">Datasheet : </label>
            </div>
            <div class="inputRow">
                <input type="file" id="datasheet" name="uploadPdf" accept=".pdf" onchange="pdfPreview()"><br><br>
                <iframe id='pdfPreview' class='pdfPreview' src='./datasheet/" . $datasheet ."'></iframe><br>
            </div>
        </div>

        <div class="formRow">
            <div class="titleRow">
                <label for="qty">Quantity : </label>
            </div>
            <div class="inputRow">
                <input type="number" id="qty" name="qty" ><br><br>
            </div>
        </div>

        <div class="formRow">
                <input type="submit" value="Submit" name="upload">
        </div>
    </form>
    </div>

<?php require("footer.php"); ?>

<script src="script.js"></script>

</body>
</html>