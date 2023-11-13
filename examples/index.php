<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';


$ignoredFiles = ['index.php', 'config.php', 'config.php.dist', 'connector.php'];
$exampleFiles = array_filter(
    scandir(__DIR__),
    fn(string $file): bool => !is_dir($file) && !in_array($file, $ignoredFiles)
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <title>Examples</title>
</head>
<body>
<h1><a href="./">Examples</a></h1>
<ul>
    <?php foreach ($exampleFiles as $exampleFile): ?>
        <li><a href="?example=<?= $exampleFile; ?>"><?= $exampleFile; ?></a></li>
    <?php endforeach; ?>

    <?php
    $exampleFile = filter_input(INPUT_GET, 'example');
    if ($exampleFile && in_array($exampleFile, $exampleFiles)) {
        echo '<hr>';
        echo "<h2>Example: $exampleFile</h2>";
        require_once __DIR__ . '/' . $exampleFile;
    }
    ?>
</ul>
</body>
</html>
