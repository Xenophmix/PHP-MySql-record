<?php

//使用PDO方式建立資料庫連線物件
include "./db/base.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生</title>
</head>

<body>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <form action="../api/add_student.php" method="post">
              <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">學號</label>
        <?php
            //從資料庫中找到最大的學號
            $sql="SELECT max(`school_num`) FROM `students`";
            $max=$pdo->query($sql)->fetchColumn();
        ?>
        <!--將最大的學號+1後做為要新增的下一位學生的學號-->
        <input class="form-control col-md-8" type="text" name="school_num" value="<?=$max+1;?>" readonly >
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">姓名</label>
        <input class="form-control col-md-8" type="text" name="name">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">生日</label>
        <input class="form-control col-md-8" type="date" name="birthday">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">身份證字號</label>
        <input class="form-control col-md-8" type="text" name="uni_id">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">地址</label>
        <input class="form-control col-md-8" type="text" name="addr">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">家長</label>
        <input class="form-control col-md-8" type="text" name="parents">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">聯絡電話</label>
        <input class="form-control col-md-8" type="text" name="tel">
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">科系</label>
        <select class="form-control col-md-8" name="dept">
            <?php
                //從`dept`資料表中撈出所有的科系資料並在網頁上製作成下拉選單的項目
                $sql="SELECT * FROM `dept`";
                $depts=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($depts as $dept){
                    echo "<option value='{$dept['id']}'>{$dept['name']}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">畢業國中</label>
        <select class="form-control col-md-8" name="graduate_at" >
            <?php 
            //從`graduate_school`t資料表中撈出所有的畢業學生資料並在網頁上製作成下拉選單的項目
            $sql="SELECT * FROM `graduate_school`";
            $grads=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            foreach($grads as $grad){
                echo "<option value='{$grad['id']}'>{$grad['county']}{$grad['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">畢業狀態</label>
        <select class="form-control col-md-8" name="status_code" >
            <?php 
            //從`status`資料表中撈出所有的畢業狀態並在網頁上製作成下拉選單的項目
            $sql="SELECT * FROM `status`";
            $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row){
                echo "<option value='{$row['code']}'>{$row['status']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-4" style="text-align-last:justify">班級</label>
        <select class="form-control col-md-8" name="class_code">
            <?php
            //從`classes`資料表中撈出所有的班級資料並在網頁上製作成下拉選單的項目
            $sql="SELECT `id`,`code`,`name` FROM `classes`";
            $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row){
                echo "<option value='{$row['code']}'>{$row['name']}</option>";
            }
            ?>
        </select>                
    </div>
   <div class="text-center">
       <input class="btn btn-primary" type="submit" value="確認新增">
   </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>