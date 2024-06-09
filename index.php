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
            max-width: 600px;
            margin: 100px auto;
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
            margin-bottom: 20px;
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
            <form class="d-flex" role="search" action="" method="post" id="nameform">
                <input class="form-control me-2" type="search" placeholder="Type a command or search" aria-label="Search" name="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </form>
        </div>

        <?php if (isset($_POST['search'])): ?>
            <div class="search-results">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>Showing search results for "<?php echo $_POST['search']; ?>"</span>
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Book</th>
                            <th>Category</th>
                            <th>Published</th>
                            <th>Author</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example static data -->
                        <tr>
                            <td>1</td>
                            <td>Example Book</td>
                            <td>Fiction</td>
                            <td>2000</td>
                            <td>John Doe</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Another Book</td>
                            <td>Non-Fiction</td>
                            <td>2010</td>
                            <td>Jane Smith</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="no-results">
                <span>No tags found</span>
                <p>"Untitled" did not match any tags currently used in projects. Please try again or create a new tag.</p>
                <button class="btn btn-outline-secondary">Clear search</button>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>
