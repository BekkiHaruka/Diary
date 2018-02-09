<?php
    // セッションの復元
    session_start();

    // title,diary,parent_id
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES,'UTF-8');
    $diary = htmlspecialchars($_POST['diary'], ENT_QUOTES,'UTF-8');
    $parent_id = htmlspecialchars($_POST['parent_id'],ENT_QUOTES,'UTF-8');

    // MySQLへの接続
    $conn = mysql_connect('localhost','diary_user','diary_pass');

    if ($conn) {
        // データベースの選択
        mysql_select_db('diary_db',$conn);

        // データベースへ書き込むSQL文
        $sql = 'INSERT INTO diaries
                (title,diary,date)
                VALUES
                ("' . $title . '","' . $diary. '",now())';

        // SQL文の実行
        $query = mysql_query($sql, $conn);
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>はてな匿名ダイアリー</title>
</head>
<body>
<?php if (empty($parent_id)){
    echo '■日記を投稿しました。';
}else{
    echo '■コメントを投稿しました。';
}?>
<br>
<br><br>
<a href = "diary.php"> トップページへ戻る </a>
</body>
</html>
