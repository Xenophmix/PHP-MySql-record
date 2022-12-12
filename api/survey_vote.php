<?php
include_once "../db/base.php";


$option_id = $_POST['Multiple-choice'];
$option = find('survey_options', $option_id);
$subject = find('survey_subject', $option['subject_id']);

$subject['vote']++;
$option['vote']++;
// $subject['vote'] = $subject['vote'] + 1;
dd($option);
dd($subject);

update("survey_subject", $subject, $subject['id']);
update("survey_options", $option, $option['id']);
if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
  //check ip from share internet
  $ip = $_SERVER['HTTP_CLIENT_IP'];

 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
   //to check ip is pass from proxy
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

 else 
 
  $ip = $_SERVER['REMOTE_ADDR'];

$log = [
  'user' => (isset($_SESSION['login'])) ? $_SESSION['login']['id'] : 0,
  'ip' => $ip,
  'subject_id' => $subject['id'],
  'option_id' => $option['id']
];
insert("survey_log", $log);

to("../index.php?do=survey_result&id={$subject['id']}");
