<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

    require __DIR__ . '/vendor/autoload.php';

    use App\Acme\JWTAuth;
    // echo file_get_contents('./keys/key.pem');
    echo (new JWTAuth)->render();
    ?>
</body>
</html>
