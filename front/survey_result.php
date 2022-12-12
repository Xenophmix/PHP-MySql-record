<?php
$subject = find("survey_subject", $_GET['id']);
$options = all("survey_options", ['subject_id' => $_GET['id']]);

?>
<h3 class="text-center font-weight-bold text-white">調查結果</h3>


<h3 class="text-center font-weight-bold text-white"><?= $subject['subject']; ?></h3>


<div class="container">
  <ul class="list-group col-10 mx-auto">
    <?php
    foreach ($options as $option) {
      $division = ($subject['vote'] == 0) ? 1 : $subject['vote'];
      $width = round(($option['vote'] / $division) * 100, 2);
    ?>
      <li class="d-flex list-group-item list-group-item-light list-group-item-action">
        <div class="col-6"><?= $option['opt']; ?></div>
        <div class="col-6">
          <div class="progress" style="height: 30px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $width; ?>%;font-size:21px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?= $width; ?>%</div>
          </div>
        </div>
      </li>
    <?php
    }
    ?>
  </ul>
</div>
<div class="text-center mt-4">

  <a href="index.php?do=survey" class="btn btn-warning mx-1">返回</a>
</div>