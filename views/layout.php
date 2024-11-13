<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Proveri da li je `$content` postavljen i prikaži ga -->
<?php
if (isset($content)) {
    echo $content;
} else {
    echo "Content not available";
} ?>
</body>
</html>
