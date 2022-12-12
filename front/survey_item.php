<?php
if (isset($_GET['id'])) {
  $survey = find("survey_subject", $_GET['id']);
  $options = all("survey_options", ['subject_id' => $_GET['id']]);
  // dd($survey);
  // dd($options);
} else {
  $error = "請回到問卷首頁選擇正確的題目來進行";
}
?>
<h3 class="text-center font-weight-bold text-white mb-5"><?= $survey['subject']; ?></h3>

<form action="./api/survey_vote.php" method="POST">
  <?php
  if (isset($error)) {
    echo "<sapn style='color:red;display: block;text-align: center;'>";
    echo $error;
    echo "</span>";
  } else {
  ?>
    <div class="container">
      <?php
      foreach ($options as $option) {
      ?>
        <div class="input-group mb-3">
          <div class="input-group-text">
            <input class="form-check-input mt-0" name="Multiple-choice" type="radio" aria-label="Checkbox for following text input" value="<?=$option['id'];?>" required>
          </div>
          <div class="form-control"><?= $option['opt']; ?>
          </div>
        </div>
    <?php
      }
    }
    ?>
    <?php
    if (!isset($error)) {
    ?>


      <div class="text-center mt-4">
        <input type="submit" class="btn btn-primary mx-1" value="投票">
        <a href="index.php?do=survey" class="btn btn-warning mx-1">取消返回</a>
      </div>
    <?php
    }
    ?>
</form>