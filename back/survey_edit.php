<?php
if (isset($_GET['id'])) {
  $subject = find('survey_subject', $_GET['id']);
  dd($subject);
  $options = all('survey_options', ['subject_id' => $_GET['id']]);
  dd($options);
} else {

  header("location:admin_center.php?do=survey&error=沒有指定編輯的調查id");
}

?>
<h3 class="text-center text-white">編輯調查</h3>

<form action="./api/survey_edit.php" class="col-10 mx-auto d-flex flex-wrap justify-content-end" method="post">
  <div class="form-group row col-12 gap-3">
    <div class="col-2 text-end">
      <label class="text-end text-white">主題</label>
    </div>
    <div class="col-8 text-end">
      <input name="subject" type="text" class="form-control" value="<?= $subject['subject']; ?>">
      <input name="subject_id" type="hidden" class="form-control" value="<?= $subject['id']; ?>">
    </div>
  </div>
  <!--選項區-->
  <?php
  foreach ($options as $idx => $option) {

  ?>
    <div class="form-group row col-12 justify-content-center mt-2">
      <div class="col-1 text-end">
        <label class="text-end text-white">項目<?= $idx + 1; ?></label>
      </div>
      <div class="col-7">
        <input type="text" class="form-control" name='opt[]' value="<?= $option['opt']; ?>">
        <input type="hidden" class="form-control" name='opt_id[]' value="<?= $option['id']; ?>">
      </div>
    </div>
  <?php
  }
  ?>
  </div>
  <div class="text-center col-12 mt-3">
    <input class="btn btn-primary mx-1" type="submit" value="確定新增">
    <input class="btn btn-warning mx-1" type="reset" value="重置">
  </div>
</form>