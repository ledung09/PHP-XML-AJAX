<?php
if (isset($_GET['q']) && isset($_GET['filter'])) {
    $q =  $_GET['q'];
    $filter = $_GET['filter'];
    $res = [];

    $xmlDoc = new DOMDocument();
    $xmlDoc->load("book.xml");

    $book_len = $xmlDoc->getElementsByTagName("book")->length;
    $title = $xmlDoc->getElementsByTagName("title");
    $author = $xmlDoc->getElementsByTagName("author");
    $genre = $xmlDoc->getElementsByTagName("genre");
    $price = $xmlDoc->getElementsByTagName("price");

    if ($filter != 'all') {
        $element = $xmlDoc->getElementsByTagName("$filter");
        for ($i=0; $i<$book_len; $i++) {
            if (strpos($element[$i]->childNodes[0]->nodeValue, $q) !== false) {
                $res[] = $i;
            }
        }
    } else {
        for ($i=0; $i<$book_len; $i++) {
            if (strpos($title[$i]->childNodes[0]->nodeValue, $q) !== false
            || strpos($author[$i]->childNodes[0]->nodeValue, $q) !== false
            || strpos($genre[$i]->childNodes[0]->nodeValue, $q) !== false
            || strpos($price[$i]->childNodes[0]->nodeValue, $q) !== false) {
                $res[] = $i;
            }
        }
    }

    if ($q == '!ALL') $res = range(0, 5);
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
    
        foreach ($res as $i) { 
            echo "<tr>";
            echo "<td>" . $title[$i]->childNodes[0]->nodeValue . "</td>";
            echo "<td>" . $author[$i]->childNodes[0]->nodeValue . "</td>";
            echo "<td>" . $genre[$i]->childNodes[0]->nodeValue . "</td>";
            echo "<td>" . $price[$i]->childNodes[0]->nodeValue . "</td>";
            echo "</tr>";
            echo "\n";
        }
        
        echo "
            </tbody>
        </table>";

}
?>