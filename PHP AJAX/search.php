<?php

require_once "connect.php";

if (isset($_GET['q']) && isset($_GET['filter'])) {
    $q =  "%" . $_GET['q']. "%";
    $filter = $_GET['filter'];
    $subquery = "`title` LIKE '$q' || `author` LIKE '$q' || `genre` LIKE '$q' || `price` LIKE '$q'";
    
    if ($filter != 'all')  $subquery = "`$filter` LIKE '$q'";

    $query = "SELECT * FROM `booktbl` WHERE " . $subquery;
    
    if ($_GET['q'] == '!ALL') $query = "SELECT * FROM `booktbl`";
    
    $res = $conn->query($query);

    echo '<table class="table my-4">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Price</th>
            </tr>
        </thead>
    <tbody>';

    if ($res->num_rows == 0) {
        echo "";
    } else {
        while ($row = $res->fetch_assoc()) { 
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['author'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
        }
    }

    echo "
        </tbody>
    </table>";
}
?>