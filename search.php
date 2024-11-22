<?php require("header.php"); ?>

<?php
// Get the name from the form
if (isset($_GET['search'])) {
    $search = $_GET["search"];

    $items_per_page = 4;

    // Get the current page number or set it to 1 if not set
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $items_per_page;

    $total_query = "SELECT COUNT(*) AS total FROM myitems WHERE name LIKE '%$search%' OR descr LIKE '%$search%'";
    $total_result = $conn->query($total_query);
    $total_row = $total_result->fetch_assoc();
    $total_items = $total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    // Fetch paginated results
    $query = "SELECT * FROM myitems WHERE name LIKE '%$search%' OR descr LIKE '%$search%' LIMIT $items_per_page OFFSET $offset";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {       
        echo "<div class='myListItems'>";
        echo "<div class='myListItems-container'>";
        echo "<p>'$search' Results ($total_items)</p>";
        echo "<table>
                <tr>
                    <th>listno</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Datasheet</th>
                </tr>";
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["listno"] . "</td>
                    <td><img class='itemImage' src='./image/" . $row['image'] ."'></td>
                    <td><a class='itemName' href='details.php?listno=" . $row["listno"] . "'>" . $row["name"] . "</a></td>
                    <td>" . $row["descr"] . "</td>
                    <td>" . $row["qty"] . "</td>
                    <td><a href='./datasheet/" . $row['datasheet'] ."' target='_blank'><img src='Icon_pdf_file.png'></a></td>
                </tr>";
        }
        echo "</table></div></div>";
        
        // Display pagination links
        echo "<div class='pagination'>";

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<a class='active' href='?search=$search&page=$i'>$i</a> ";
                } else {
                    echo "<a href='?search=$search&page=$i'>$i</a> ";
                }
            }
            
        echo "</div>";
    } else {
        echo "<p>No results found for '$search'.</p>";
    }
}

// Close the connection
$conn->close();
?>

<script src="script.js"></script>

<?php require("footer.php"); ?>