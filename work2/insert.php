<html>
<meta charset="utf-8">
<head>
<title>はてなユーザー登録確認</title>
</head>
<body>
<?php
$conn = mysql_connect('localhost','diary_user','diary_pass');

$db_selected = mysql_select_db('diary_db',$conn);

mysql_set_charset('utf8');

$name = $_POST['name'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name,password)
        VALUES ('$name','$password')";

$result_flag = mysql_query($sql);

if(empty($result_flag)){
echo 'ユーザー登録に失敗しました。<br>すでに同じユーザー名が使用されています。<br><br><a href="add.php"> はてなユーザー登録画面に戻る </a>';
} else {
echo $name . 'さんを登録しました。<br><br><a href="login.html"> ログイン画面へ移動 </a>';
}
$close_flag = mysql_close($conn);
?>
</body>
</html>
