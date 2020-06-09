<?php
session_start();
require __DIR__ . '/const.php';
require BASE . '/controllers/Main.php';
try{
    $app = new Main;
    $app->init();
    Db::destruct();
}catch(Throwable $e){ ?>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
            <meta charset="utf-8">
            <title>Тестовое задание</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
            <style>
            </style>
        </head>
        <body>
            <div class="container">
                <h3 class="alert alert-success">Что-то пошло не так, сообщите пожалуйста разработчику</h3>
                <div class="row">
                    <p class="col-12">
                        Ошибка: <?php echo $e->getMessage(); ?>
                    </p>
                    <p class="col-12">
                        Строка: <?php echo $e->getLine(); ?>
                    </p>
                    <p class="col-12">
                        Дополнитеьно: <?php echo $e->getTraceAsString(); ?>
                    </p>
                </div>
            </div>
        </body>
    </html>
<?php } ?>
