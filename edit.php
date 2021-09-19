<?php
include 'model.php';
$model = new Model();
$id=$_GET["id"];
$news = $model->edit($id);
if (isset($_POST['update'])){
    if (isset($_POST['title']) && isset($_POST['description'])){

        $data['id'] = $id;
        $data['title'] = $_POST['title'];
        if ($_FILES['image']['size']!= 0){

            $name=$_FILES['image']['name'];
            $image='media/images/'.$name;
            move_uploaded_file($_FILES['image']['tmp_name'],'media/images/'.$_FILES['image']['name']);
        }else {

            $image = $_POST['old_image'];
        }
        $data['image']= $image;
        $data['description'] = $_POST['description'];

        $update = $model->update($data);

    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <style>
  body{
    padding: 30px;

  }
  </style>
  <title >Редактирование новости</title>
</head>
<h1 align="center">Редактирование новости</h1>
<form action =" " method ="post" enctype="multipart/form-data" >
  <input type="hidden" name="id" value="<?=$news['id']?>">
  <input type="hidden" name="old_image" value="<?=$news['image']?>">
  <div class="mb-3">
    <p>Заголовок</p>
    <input type ="text" class="form-control" name="title" value="<?=$news['title']?>" >
  </div>
  <div class="mb-3">
    <p>Описание</p>
    <textarea rows="4" class="form-control form-control-lg" name ="description"><?=$news['description']?></textarea>
  </div>
  <div class="mb-3">
    <p>Загрузить  новую картинку: <input type ="file" name="image" class="img-fluid" ></p>
    <p>Старая картинка:<img src="<?=$news['image']?>" class="img-fluid" alt=""></p>

  </div>
  <button type ="submit" name="update" value="Отправить">Редактировать</button>
</form>

</html>
