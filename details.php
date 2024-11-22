<?php require("header.php"); ?>

<?php
// Get the name from the form
if (isset($_GET['listno'])) {
    $listno = $_GET["listno"];

    // SQL query to search by name
    $sql = "SELECT * FROM myitems WHERE listno='$listno'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { 

        $row = $result->fetch_assoc();

        $name = $row["name"];
        $image = $row['image'];
        $descr = $row["descr"];
        $qty = $row["qty"];
        $datasheet = $row['datasheet'];

        echo "<div class='myListItems'>
            <div class='myListItems-container'>
            <table>
                <tr>
                    <th>listno</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Datasheet</th>
                </tr>
                <tr>
                    <td>". $listno ."</td>
                    <td><img class='itemImage' src='./image/". $image ."'></td>
                    <td>". $name ."</td>
                    <td>". $descr ."</td>
                    <td>". $qty ."</td>
                    <td><a href='./datasheet/". $datasheet ."' target='_blank'><img src='Icon_pdf_file.png'></a></td>
                </tr>
        
                </table></div>
                <div class='editItemBtn'>
                    <a class='editBtn' href='update.php?listno=" . $listno . "'>EDIT</a>            
                    <a class='deleteBtn' role='button' onclick='deleteFunction()'>DELETE</a>
                </div>
                </div>
                <script>
                    function deleteFunction() {
                        if(confirm('Do you want delete this item!') == true) { 
                            window.location.href = 'delete.php?listno=" . $listno . "&confirm=yes';    
                        } 
                    }
                </script>";

    } else {
            echo "<script>alert('No results found.');</script>";
    }

}
// Close the connection
$conn->close();
?>
<script src="script.js"></script>

<?php require("footer.php"); ?>