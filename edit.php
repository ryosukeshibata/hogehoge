<?php
include('dbconnect.php');
if(!empty($_GET['id'])&& isset($_GET['id'])){
  $sql = sprintf('SELECT * FROM `friends`,`areas` WHERE areas.area_id=
  friends.area_id AND friends.friend_id=%s',$_GET['id']);
  $record = mysqli_query($db,$sql) or die(mysqli_error($db));
  while($table =mysqli_fetch_assoc($record)){
    $datas[] = $table;
  }
  $count = count($datas);
  echo "<pre>";
  print_r($datas);
  echo "</pre>";
}else{
  header('locate: show.php');
  exit();
}
$sql = sprintf('SELECT * FROM `areas`WHERE 1');
$record = mysqli_query($db,$sql) or die(mysqli_error($db));
while($table =mysqli_fetch_assoc($record)){
  $datas_area[] = $table;
}
$count_area = count($datas_area);
if(!empty($_POST)){
  $areas_id = $_POST['area_id'];
  $sql= sprintf('UPDATE `friends` SET `friend_name` =
  "%s", `area_id` = "%d", `gender` = "%s", `age` = "%d"
  WHERE `friends`.`friend_id` = "%s"',
  mysqli_real_escape_string($db, $_POST['name']),
  mysqli_real_escape_string($db, $_POST['area_id']),
  mysqli_real_escape_string($db, $_POST['gender']),
  mysqli_real_escape_string($db, $_POST['age']),
  mysqli_real_escape_string($db, $_GET['id'])
  );
  mysqli_query($db, $sql) or die(mysqli_error($db));
  header("location:show.php?id=$areas_id");
  exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>都道府県お友達システム</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>
    <div class="contents">
      <div class="contents_title">
        <h1>友達登録情報変更</h1>
      </div>
      <form method="post" action="" class="form-horizontal" role="form">
        <div class="form-group">
          <div class="content_title">名前</div>
          <div class="content_input">
            <input type="text" name="name" class="form-control"
            value="<?php echo $datas[0]['friend_name']; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="content_title">出身</div>
          <div class="content_input">
            <select class="form-control" name="area_id">
              <?php for ($i=0; $i < $count_area; $i++): ?>
                <option name="area_id" value="<?php echo
                $datas_area[$i]['area_id'];?>"<?php
                if($datas[0]['area_id'] == $datas_area[$i]['area_id'])
                echo 'selected'; ?>><?php echo
                $datas_area[$i]['area_name'];?></option>
              <?php  endfor; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="content_title">性別</div>
          <div class="content_input">
            <select class="form-control" name="gender">
              <option value="m" <?php if($datas[0]['gender'] == 'm')
              echo'selected'; ?>>男性</option>
              <option value="f" <?php if($datas[0]['gender'] == 'f')
              echo'selected'; ?>>女性</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="content_title">年齢</div>
          <div class="content_input">

            <input type="text" name="age" class="form-control" value="<?php echo $datas[0]['age']; ?>">
          </div>

        </div>
        <input type="submit" class="btn btn-default" value="変更">
      </form>
    </div>
    <div class="copyright">
      <small>Copyright &copy; Core Creative Manager.All right reserved.</small>
    </div>
  </body>
</html>
