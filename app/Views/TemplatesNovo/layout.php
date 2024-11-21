<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($params['title'] ?? 'Default Title') ?></title>
    <link href="/ninaverse/public/css/style.css" rel="stylesheet">
</head>
<body>
<header><?= $params['header'] ?? 'Default Header' ?></header>
<main><?= $params['main'] ?? 'Default Content' ?></main>
<footer><?= $params['footer'] ?? 'Default Footer' ?></footer>
</body>
</html>
