<?php

include 'model.php';
$model = new Model();

$res= mysqli_query($model->conn,"SELECT COUNT(*) FROM `news`");
$arr=mysqli_fetch_assoc($res);
$page_count=ceil($arr['COUNT(*)']/3);

$news = $model->fetch();

if (isset($_GET['id'])){
    $model->delete($_GET['id']);
}
if (isset($_GET["sort"])){
    $sort=$_GET["sort"];
}else{
    $sort='desc';
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Блог</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
      body {
        padding: 30px;

      }
      .btn-group{
        margin-left: 70%;
      }
      .btn-toolbar{
        margin-left: 80%;

      }

    </style>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <h1 align="center">Блог</h1>
    <div class="btn-group">
      <a  class="btn btn-secondary btn-sm"  href="add.php">Добавить запись</a>
      <button type="button" class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        Отсортировать
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="index.php?sort=desc">Сначала новые</a></li>
        <li><a class="dropdown-item" href="index.php?sort=asc">Cначала старые</a></li>
      </ul>
    </div>
    <div class="container">

      <div class="row justify-content-center">
        <?php

            if(!empty($news)){
            foreach($news as $new){
            ?>
          <div class="col-4">
            <img src= "<?php echo $new['image']; ?>" class="img-thumbnail" alt="" class ="img-thumbnail">
          </div>
          <div class ="col-8">
            <h3>
              <?php echo $new['title']; ?>
            </h3>
            <i class="far fa-calendar"><?php echo $new['date']; ?></i>
            <p class="preview-text"><?php echo $new['description']; ?></p>
            <a  class="btn btn-secondary btn-sm" href="edit.php?id=<?php echo $new['id']?>">Редактировать запись</a>
            <a  class="btn btn-secondary btn-sm" href="index.php?id=<?php echo $new['id']?>" class="btn">Удалить запись</a>
          </div>
        <?php
        }
            }
        ?>
         <br>
         <br>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <p>Перейти на страницу:</p>
        <?php
        for ($i=1;$i<=$page_count;$i++){

        echo"<a href=\"?page-select=$i&sort=$sort\"class=\"btn btn-secondary btn-sm\" role=\"button\" >$i</a> ";
        };
        ?>
    </div>
  </body>
</html>