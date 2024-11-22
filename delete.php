<?php
require("connection.php");

// Get the listno of the row to delete
if (isset($_GET['listno'])) {
    $listno = $_GET['listno'];

    $sql = "SELECT image, datasheet FROM myitems WHERE listno = $listno";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $image = $row['image'];
        $datasheet = $row['datasheet'];

        // Unlink the image file
        if (!empty($image)) {
            unlink("./image/" . $image);
        }

        // Unlink the PDF file
        if (!empty($datasheet)) {
            unlink("./datasheet/" . $datasheet);
        }

        // Delete the row from the database
        $deleteSql = "DELETE FROM myitems WHERE listno = $listno";
        if ($conn->query($deleteSql)) {

            // Reorder listno after deletion
            $conn->query("SET @num := 0;");
            $conn->query("UPDATE myitems SET listno = @num := (@num+1);");
            $conn->query("ALTER TABLE myitems AUTO_INCREMENT = 1;");

            echo "<script>
                    window.location = 'index.php';
                </script>";           
        } else {
            echo "<script>alert('Error deleting record:');</script> " . $conn->error;
        }
    } else {
        echo "<script>alert('No results found.');</script>";
    }

}
$conn->close();
?>