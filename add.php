<?php

include 'model.php';
$model = new Model();
$model->insert();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Добавление новости</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <style>
  body{
    padding: 30px;

  }
  </style>
</head>
<h1 align="center">Добавление новости</h1>
<form action =" " method ="post" enctype="multipart/form-data" >
  <div class="mb-3">
    <p>Заголовок</p>
    <input type ="text" class="form-control" name="title" >
  </div>
  <div class="mb-3">
    <p>Описание</p>
    <textarea rows="4" class="form-control form-control-lg" name ="description"></textarea>
  </div>
  <div class="mb-3">
    <p>Загрузить картинку: <input type ="file" name="image" ></p>

  </div>
  <button type ="submit" name="submit" value="Отправить">Добавить запись</button>
</form>
</html>
