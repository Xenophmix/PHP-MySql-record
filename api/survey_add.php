<?php
include_once "../db/base.php";

// $subject = $_POST['subject'];
// $type = 1;
// $vote = 0;
// $active = 0;
// 建立資料陣列
$subject = [$subject = $_POST['subject'],
            $type = 1,
            $vote = 0,
            $active = 0];
insert('survey_subject',$subject);

// insert('survey_options');