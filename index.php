<!DOCTYPE html>
<html lang="">
<head>
    <title>Trending Gifs</title>
    <style>
        body {
            background-color: lightgrey;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        button, input[type="text"], input[type="submit"] {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<h1>GIFFS</h1>

<button id="showTrending">Show Trending</button>

<form id="searchForm" action="" method="get" style="display: none">
    <label for="keyword">Enter a keyword to search for gifs:</label>
    <input type="text" name="keyword" id="keyword" value="">
    <label for="gif-count">Enter the number of gifs to display:</label>
    <input type="text" name="count" id="gif-count" value="">
    <button type="submit">Search</button>
</form>

<?php
require_once 'vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$n = new App\GifyApi\GiphyApi();

if (isset($_GET['count']) && empty($_GET['keyword'])) {
    $trendingCount = $_GET['count'];
    foreach ($n->fetchTrending($trendingCount) as $gif){
        /** @var App\Giphy\Giphy$gif */
        echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>";
    }
} else if (isset($_GET['keyword']) && isset($_GET['count'])) {
    $keyword = $_GET['keyword'];
    $searchCount = $_GET['count'];
    foreach ($n->searchGifs($keyword, $searchCount) as $gif) {
        /** @var App\Giphy\Giphy$gif */
        echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>";
    }
}
?>

<script>
    const showTrendingButton = document.getElementById("showTrending");
    const searchForm = document.getElementById("searchForm");

    showTrendingButton.addEventListener("click", () => {
        showTrendingButton.style.display = "none";
        searchForm.style.display = "block";
    });
</script>
</body>
</html>