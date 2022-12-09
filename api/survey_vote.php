<?php
include_once "../db/base.php";


$option_id = $_POST['Multiple-choice'];
$option = find('survey_options',$option_id);
dd($option);