<h1>資料庫常用自訂函式</h1>
<h3>all()-存取指定條件的多筆資料</h3>
<?php
include_once "./db/base.php";


//$rows=all('students',['name'=>'宋時雨']);
//$rows=all('students',['dept'=>1,'graduate_at'=>1]);
//$rows=all('students',['dept'=>1,'graduate_at'=>1]," ORDER BY `id` desc");
//dd($rows);
//
?>
<h3>find()-存取指定條件的單筆資料</h3>
<?php
/* $row=find('students',100);
dd($row);
$row=find('students',['name'=>'林玟玲']);
dd($row); */
?>

<h3>update()-更新指定條件的資料</h3>
<?php

//update('students',['name'=>'廖凱鴻','dept'=>'2','graduate_at'=>'3']);
//update('students',['name'=>'王大同','dept'=>'4'],['id'=>19]);
//update students set name='王大同',dept='4' where id='19'

//$num=update('class_student',['class_code'=>102],['class_code'=>101]);
//echo "一供有".$num."筆資料更新成功";

// update('class_student',['class_code'=>101],18);
?>

<h4>insert()-新增資料</h4>
<?php

insert('class_student', [
  'school_num' => '911799',
  'class_code' => '101',
  'seat_num' => 51,
  'year' => 2000
])



?>

<h3>del()-刪除資料</h3>
<?php

//del('students',18);
//del('students',21);

echo del('students',['dept'=>4]);

?>

<?php
function dd($array)
{
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}

/**
 * pram table - 資料表名稱
 * pram args[0] - where 條件(array)或sql字串
 * pram args[1] - order by limit 之類的sql 字串
 */

function all($table, ...$args)
{
  global $pdo;
  $sql = "select * from $table ";

  if (isset($args[0])) {
    if (is_array($args[0])) {
      //是陣列 ['acc'=>'mack','pw'=>'1234'];
      //是陣列 ['product'=>'PC','price'=>'10000'];

      foreach ($args[0] as $key => $value) {
        $tmp[] = "`$key`='$value'";
      }

      $sql = $sql . " WHERE " . join(" && ", $tmp);
    } else {
      //是字串
      $sql = $sql . $args[0];
    }
  }

  if (isset($args[1])) {
    $sql = $sql . $args[1];
  }

  echo $sql;
  return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// 傳回指定ID的資料


function find($table, $id)
{

  global $pdo;
  $sql = "select * from `$table` ";
  if (is_array($id)) {
    foreach ($id as $key => $value) {
      $tmp[] = "`$key`='$value'";
    }

    $sql = $sql . " WHERE " . join(" && ", $tmp);
  } else {

    $sql = $sql . " WHERE `id`='$id'";
  }

  return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

// 給定條件更新資料

function update($table, $col, ...$args)
{
  global $pdo;
  $sql = "UPDATE $table SET ";

  if (is_array($col)) {
    foreach ($col as $key => $value) {
      $tmp[] = "`$key`='$value'";
    }

    $sql = $sql . join(",", $tmp);
  } else {
    echo "錯誤，請提供以陣列形式的資料";
  }

  if (isset($args[0])) {

    if (isset($args[0])) {
      if (is_array($args[0])) {
        $tmp = [];
        foreach ($args[0] as $key => $value) {
          $tmp[] = "`$key`='$value'";
        }

        $sql = $sql . " WHERE " . join(" && ", $tmp);
      } else {
        //是字串
        $sql = $sql . " WHERE `id`='{$args[0]}'";
      }
    }
  }


  echo $sql;
  return $pdo->exec($sql);
}


//新增資料
/**
 * ['school_num'=>'911799',
 *  'class_code'=>'101',
 *  'seat_num'=>51,
 *  'year'=>2000]
 */
function insert($table, $cols)
{
  global $pdo;

  $keys = array_keys($cols);
  //dd(join("','",$cols));

  $sql = "insert into $table (`" . join("`,`", $keys) . "`) values ('" . join("','", $cols) . "')";

  echo $sql;
  return $pdo->exec($sql);
}

// 刪除資料
function del($table, $id)
{
  global $pdo;
  $sql = "delete from `$table` ";

  if (is_array($id)) {
    foreach ($id as $key => $value) {
      $tmp[] = "`$key`='$value'";
    }

    $sql = $sql . " where " . join(" && ", $tmp);
  } else {

    $sql = $sql . " where `id`='$id'";
  }

  echo $sql;
  return $pdo->exec($sql);
}
?>