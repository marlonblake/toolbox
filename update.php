<?php require("header.php"); ?>
<?php
// Get the name from the form
if (isset($_GET['listno'])) {
    $listno = $_GET["listno"];

    // SQL query to search by list number
    $sql = "SELECT * FROM myitems WHERE listno='$listno'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {       

        $row = $result->fetch_assoc();

        $name = $row["name"];
        $image = $row['image'];
        $descr = $row["descr"];
        $qty = $row["qty"];
        $datasheet = $row['datasheet'];

        echo "<div class='formContainer'>
                <form action='' method='POST' enctype='multipart/form-data'>
                    <p>Edit This Item:</p>
                    <div class='formRow'>
                        <div class='titleRow'>    
                            <label for='name'>Item Name* : </label>
                        </div>
                        <div class='inputRow'>
                            <input type='text' id='new-name' name='new-name' value='$name' required><br><br>
                        </div>
                    </div>

                    <div class='formRow'>
                        <div class='titleRow'>
                            listno : 
                        </div>
                        <div class='inputRow'>
                            <input type='hidden' id='listno' name='listno' value='$listno' required>$listno<br><br>
                        </div>
                    </div>

                    <div class='formRow'>
                        <div class='titleRow'>
                            <label for='descr'>Description : </label>
                        </div>
                        <div class='inputRow'>
                            <textarea id='new-descr' name='new-descr'>$descr</textarea><br><br>
                        </div>
                    </div>

                    <div class='formRow'>
                        <div class='titleRow'>
                            <label for='image'>Image : </label>
                        </div>
                        <div class='inputRow'>
                            <input type='file' id='new-image' name='uploadNewImg' accept='image/png,image/jpeg' onchange='showNewImage()'><br><br>
                            <img id='imageNewPreview' class='imageUpdate' src='./image/" . $image . "'/><br><br>
                        </div>
                    </div>

                    <div class='formRow'>
                        <div class='titleRow'>
                            <label for='datasheet'>Datasheet : </label>
                        </div>
                        <div class='inputRow'>
                            <input type='file' id='new-datasheet' name='uploadNewPdf' accept='.pdf' onchange='pdfNewPreview()'><br><br>
                            <iframe id='pdfNewPreview' src='./datasheet/" . $datasheet . "'></iframe><br><br>
                        </div>
                    </div>

                    <div class='formRow'>
                        <div class='titleRow'>
                            <label for='qty'>Quantity : </label>
                        </div>
                        <div class='inputRow'>
                            <input type='number' id='new-qty' name='new-qty' value='$qty'><br><br>
                        </div>
                    </div>

                    <div class='formRow'>
                            <input type='submit' value='Update' name='upload'>
                    </div>
                </form>
                </div>";

    } else {
        echo "<script>alert('No results found.');</script>";
    }
}

// Get data from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listno = $_POST["listno"];
    $name = $_POST["new-name"];
    $descr = $_POST["new-descr"];
    $qty = $_POST["new-qty"];

    // Handle image upload
    if (isset($_FILES['uploadNewImg']) && $_FILES['uploadNewImg']['error'] == UPLOAD_ERR_OK) {
        $imgFilename = $_FILES["uploadNewImg"]["name"];
        $imgTempname = $_FILES["uploadNewImg"]["tmp_name"];
        $imgFolder = "./image/" . $imgFilename;

        // Remove old image if exists and move new image
        if (!empty($image)) {
            unlink("./image/" . $image);
        }
        if (!move_uploaded_file($imgTempname, $imgFolder)) {
            echo "<script>alert('Failed to upload image.');</script>";
        }
    } else {
        $imgFilename = $image;
    }

    // Handle PDF upload
    if (isset($_FILES['uploadNewPdf']) && $_FILES['uploadNewPdf']['error'] == UPLOAD_ERR_OK) {
        $pdfFilename = $_FILES["uploadNewPdf"]["name"];
        $pdfTempname = $_FILES["uploadNewPdf"]["tmp_name"];
        $pdfFolder = "./datasheet/" . $pdfFilename;

        // Remove old PDF if exists and move new PDF
        if (!empty($datasheet)) {
            unlink("./datasheet/" . $datasheet);
        }
        if (!move_uploaded_file($pdfTempname, $pdfFolder)) {
            echo "<script>alert('Failed to upload Datasheet.');</script>";
        }
    } else {
        $pdfFilename = $datasheet;
    }

    // SQL query to update data
    $sql = "UPDATE myitems SET name='$name', descr='$descr', qty='$qty', image='$imgFilename', datasheet='$pdfFilename' WHERE listno='$listno'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Record updated successfully.');
                window.location = 'details.php?listno=$listno';
            </script>";
    } else {
        echo "<script>alert('Error: ' . $sql . '<br>' . $conn->error');</script>";
    }
}


// Close the connection
$conn->close();
?>

<script src="script.js"></script>
<?php require("footer.php"); ?>