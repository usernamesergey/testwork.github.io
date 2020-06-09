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
            <a href="<?php PATH ?>?auth" class="btn btn-primary col-2">Авторизация</a>
            <?php 
                if($this->isAdmin()){
            ?>
                    <a href="<?php PATH ?>?exit" class="btn btn-primary col-2 offset-8">Выход</a>
            <?php
                }
            ?>
        </div>
            <h1 class="text-center">Задачи</h1>
            <?php if(isset($arResult['is_admin']) && $is_admin == false) {
                echo'<h4 style="color:#dc3545">Требуется авторизация</h4>';
            } ?>
            <div class="row">
                <form action="<?php echo PATH ?>" method="post" class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputName1">Введите имя</label>
                        <input name="name" type="text" required class="form-control" id="exampleInputName1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Введите email</label>
                        <input name="email" required type="email" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст задачи</label>
                        <textarea required class="form-control"  name="text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <?php if(!empty($arResult['success'])) { ?>
                        <div class="alert alert-success text-center">
                            <strong>Отправлено</strong>
                        </div>
                    <?php } ?>
                </form>
            </div>
            <br>
            <div class="row">
                <?php
                    if(!empty($arResult['items'])){
                    foreach($arResult['items'] as $v){
                ?>      
                        <div class="col-12">
                            <div class="row" name='update'>
                                <p class="col-3">
                                    <strong>Именя пользователя</strong><br>
                                    <a href="<?php echo PATH . '?' . $q_s . '&sort=name-ASC'; ?>">сортировка по возрастанию</a><br>
                                    <a href="<?php echo PATH . '?' . $q_s . '&sort=name-DESC'; ?>">сортировка по убыванию</a>
                                </p>
                                <p class="col-9"><?php echo $v['name']; ?></p>
                                <p class="col-3">
                                    <strong>Email</strong><br>
                                    <a href="<?php echo PATH . '?' . $q_s . '&sort=email-ASC'; ?>">сортировка по возрастанию</a><br>
                                    <a href="<?php echo PATH . '?' . $q_s . '&sort=email-DESC'; ?>">сортировка по убыванию</a>
                                </p>
                                <p class="col-9"><?php echo $v['email']; ?></p>
                                <p class="col-3"><strong>Текст задачи</strong></p>
                                    <?php
                                    if(!$this->isAdmin()){
                                        echo '<p class="col-9">' . $v['text'] . '</p>';
                                    }else{
                                        echo '
                                        <form action="' . PATH . '" method="post" class="col-9" style="margin-bottom: 16px;">
                                            <input type="hidden" name="id" value="' . $v['id'] . '">
                                            <p><textarea class="form-control" name="amendments">' . $v['text'] . '</textarea></p>
                                            <input type="submit" value="Изменить" class="btn btn-primary">
                                        </form>';
                                    }
                                    ?>
                                <p class="col-3">
                                    <strong>Статус</strong><br>
                                    <a href="<?php echo PATH . '?' . $q_s . '&sort=status-ASC'; ?>">сортировка по возрастанию</a><br>
                                    <a href="<?php echo PATH . '?' . $q_s . '&sort=status-DESC'; ?>">сортировка по убыванию</a>
                                </p>
                                <div class="col-9">
                                    <div class="row">
                                        <?php
                                            if($v['status'] == 0){
                                        ?>
                                                <div class="alert alert-secondary col-3"><strong>Не выполнено</strong></div>
                                                <?php if($is_admin === true){ ?>
                                                    <form action="<?php echo PATH ?>" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $v['id'] ?>">
                                                        <input type="hidden" name="done">
                                                        <input class="alert alert-light" type="submit" value="Выполнить?">
                                                    </form>
                                                <?php }?>
                                        <?php
                                            } else{ ?>
                                            <div class="alert alert-success col-3"><strong>Выполнено</strong></div>
                                        <?php var_dump($arResult); }
                                            if(!empty($arResult['amendments']) and $arResult['amendments'] == $v['id']){
                                        ?>
                                            <div class="alert col-6"><strong>Отредактировано администратором</strong></div>
                                        <?php

                                            }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="col-12">
                <?php
                    }
                    }
                ?>
            </div>
            <?php
                if(!empty($arResult['nav'])){
            ?>
                <div class="row">
                        <?php echo $arResult['nav']; ?>
                </div>
            <?php
                }
            ?>

        </div>
    </body>
</html>







