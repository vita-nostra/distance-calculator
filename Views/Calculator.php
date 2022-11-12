<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="mar30-tb b-center w500px pad30-rl pad10-tb bordered rounded">
    <h1>Расчет стоимости перевозки груза</h1>

    <form method="POST">
        <div class="mar10-b">Укажите расстояние для перевозки, км</div>
        <input class="w100" type="text" name="total_distance" value="">

        <div><button class="mar20-tb" type="submit">Submit</button></div><br>

    </form>
    <div class="error">
        <?php
        if (isset($error)) {
            echo $error;
        }?>
    </div>
    <div class="result">
        <?php
        if (isset($result)) {
            echo $result;
        }?>
    </div>
</div>
</body>
</html>
