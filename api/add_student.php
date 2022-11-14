<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');


$sql="INSERT INTO `students` 
(`id`, `school_num`, `name`,
 `birthday`, `uni_id`, `addr`,
  `parents`, `tel`, `dept`,
   `graduate_at`, `status_code`) VALUES 
(NULL, '915084', '陳阿明', '1984-06-12', 'F130821043', '新北市泰山區龍華里貴子街100-1號3樓', '陳明通', '02-12345678', 3, 5, '001')";



$res=$pdo ->exec($sql);
echo "刪除成功:".$res;
