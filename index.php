<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c3c1353c4c.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: url('https://unsplash.com/photos/sfL_QOnmy00/download?force=true&w=1920') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .search-container {
            max-width: 1000px;
            margin: 10px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .search-container img {
            width: 50px;
            margin-bottom: 10px;
        }

        .search-container h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #555;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            background-color: #f9f9f9;
            color: #333;
            font-size: 16px;
        }

        .search-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .search-results {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .search-results table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .search-results th, .search-results td {
            padding: 10px;
            text-align: left;
        }

        .search-results th {
            background-color: #eee;
            color: #333;
        }

        .search-results tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            background-color: #eee;
            border-radius: 10px;
            margin-top: 20px;
            color: #555;
        }

        .no-results button {
            border: 1px solid #aaa;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .no-results button:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
<div class="search-container">
    <img src="https://img.icons8.com/ios-filled/50/000000/open-book.png" alt="Book Logo">
    <h1>LibGen Tech Book</h1>
    <div class="search-box">
        <form class="d-flex" role="search" action="index.php" method="get" id="nameform">
            <input ac class="form-control me-2" type="search" placeholder="Type to search" aria-label="Search" name="search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <?php
    // Include the file containing the function
    include 'jena_sparql.php';

    // Define the SPARQL endpoint URL and query
    $sparqlEndpoint = "http://localhost:3030/libs/query";
    $queryFile = "showAll.rq";
    $sparqlQuery = file_get_contents($queryFile);

    if (isset($_GET['search'])) {
        // Call the searchRdfData function with the search term
        $searchTerm = $_GET['search'] ?? '';
        $result = searchRdfData($searchTerm);
    } else {
        $result = executeSparqlQueryAndGetResults($sparqlEndpoint, $sparqlQuery);
    }

    // Check if the result is not false (indicating success)
    if ($result !== false) {
        // Display the results as an HTML table
        echo "<div class='search-results'>";
        echo "<table class='table table-bordered table-striped table-hover text-center' name='search-result'>";
        echo "<tr>";
        foreach ($result['head']['vars'] as $var) {
            echo "<th>$var</th>";
        }
        echo "</tr>";
        foreach ($result['results']['bindings'] as $row) {
            echo "<tr>";
            foreach ($result['head']['vars'] as $var) {
                echo "<td>" . $row[$var]['value'] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        // Handle the failure
        echo 'Failed to retrieve data.';
    }
    ?>
</div>


</body>

</html>
