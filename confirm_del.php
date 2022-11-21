<!-- 我用JS來確認刪除 這個頁面應該用不到 -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>刪除確認</title>
</head>
<body>
  <div class="dialog">

    <h1>刪除確認</h1>
    <div class="msg">
      你真的確定要刪除<span></span>嗎?
    </div>
    <div>
      <button onclick="location.href='./api/del_student.php?id=<?$_GET['id'];?>'">確認刪除</button>
      <button onclick="location.href='./api/del_student.php?id=<?$_GET['id'];?>'">取消</button>
    </div>
  </div>
</body>
</html>