<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        table, td, th { border-collapse: collapse;}
        th, td { text-align: center;}
    </style>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="my-4">Book management system</h1>
                <form class="col-md-4 px-0">
                    <div class="form-group mt-3">
                        <label for="text">Enter text to find:</label>
                        <input type="text" class="form-control" id="text" name="text" placeholder="Enter !ALL to display all book(s)" onkeyup="search()">
                    </div>
                    <div class="form-group mt-3">
                        <label for="filter">Filter:</label>
                        <select name="cars" class="custom-select" id="filter" onchange="search()">
                            <option value="all">All attributes</option>
                            <option value="title">Title</option>
                            <option value="author">Author</option>
                            <option value="genre">Genre</option>
                            <option value="price">Price</option>
                        </select>
                    </div>
                </form>
                    <div id="searchResult"></div>
                    <?php //This div is replaced with search result! ?>
            </div>
        </div>
    </div>

    <script>
        function search() {
            text = document.getElementById("text").value;
            filter = document.getElementById("filter").value; 
            searchResult = document.getElementById("searchResult");

            if (text.length == 0) {
                searchResult.innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        searchResult.innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "search.php?q=" + text + "&filter=" + filter, true);
                xmlhttp.send();
            }
        }
    </script>

</body>
</html>
