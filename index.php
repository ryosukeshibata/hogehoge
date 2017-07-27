<?php
include('dbconnect.php');
  $sql = sprintf('SELECT COUNT(*) AS cnt, area_name, areas.area_id  FROM
  `areas`, `friends`WHERE friends.area_id = areas.area_id GROUP BY  area_name
  ORDER BY cnt DESC');
  $record = mysqli_query($db,$sql) or die(mysqli_error($db));
  while($table =mysqli_fetch_assoc($record)){
    $datas[] = $table;
  }
  $count = count($datas);
  echo "<pre>";
  print_r($datas);
  echo "</pre>";
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
        <h1>都道府県友達一覧</h1>
      </div>
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th class="ranking">ランキング</th>
            <th class="prefectures">県名</th>
            <th class="people_number">人数</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for($i = 0; $i < $count; $i++):
           ?>
           <tr>
             <td><?php
             if($i == 0 || $datas[$i]{'cnt'} != $datas[$i - 1]{'cnt'}){
              $rank = $i +1 ;
            }
             echo $rank ;
             ?></td>
             <td><a href="show.php?id=<?php echo $datas[$i]{'area_id'};
             ?>"><?php echo $datas[$i]{'area_name'};?></a></td>
             <td><?php echo $datas[$i]{'cnt'}; ?></td>
           </tr>
          <tr>
          <?php
          endfor;
          ?>
        </tbody>
      </table>
    </div>
    <div class="copyright">
      <small>Copyright &copy; Core Creative Manager.All right reserved.</small>
    </div>
  </body>
</html>
