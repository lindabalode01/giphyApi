<!DOCTYPE html>
<html lang="">
<head>
    <title>Trending Gifs</title>
</head>
<body>
<h1>Trending Gifs</h1>
<form action="" method="get">
    <label for="gif-count">Enter the number of gifs to display:</label>
    <input type="text" name="count" id="gif-count" value="">
    <button type="submit">Submit</button>
</form>
<?php
require_once 'vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$n = new App\GifyApi\GiphyApi();
$count = $_GET['count'] ;
foreach ($n->fetchTrending($count) as $gif){
    /** @var App\Giphy\Giphy$gif */
    echo "<img src='{$gif->getUrl()}' alt='{$gif->getTitle()}'>";
}
?>
</body>
</html>
