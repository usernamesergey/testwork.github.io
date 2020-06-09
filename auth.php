<!DOCTYPE html>
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
        <div class="row">
          <h1 class="text-center col-12">Авторизация</h1>
          <?php
            if(!empty($error)){
          ?>
              <p class="col-12" style="color:#dc3545">Не правильный логин или пароль</p>
          <?php
            }
          ?>
          <form class="col-6" action="<?php echo PATH ?>" method="post">
            <div class="form-group">
              <label for="exampleInputAuth">Login</label>
              <input name="auth" required type="text" class="form-control" id="exampleInputAuth" >
            </div>
            <div class="form-group">
              <label for="exampleInputPassword">Password</label>
              <input name="pass" required type="password" class="form-control" id="exampleInputPassword" >
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
          </form>
        </div>
      </div>
    </body>
</html>