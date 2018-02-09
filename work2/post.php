<?php
    // セッションの復元
    session_start();

    $parent_id = $_GET['parent_id'];
?>
<html>
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8">
<title>はてな匿名ダイアリー</title>
</head>
<body>
<form method = "POST" action = "upload.php"><input type = "hidden" name = "parent_id" value = "<?php echo $parent_id; ?>">
■タイトル<br>
<input type = "text" name = "title" size = "50">
<br><br>
■本文<br>
<textarea name = "diary" cols = "40"></textarea>
<br><br>
<input type = "submit" value = "投稿">
</form>
<br><br>
<a href = "diary.php"> トップページへ戻る </a>
</body>
</html>
<?php
    $conn = mysql_connect('localhost','diary_user','diary_pass');

    if ($conn){
        // データベースの選択
        mysql_select_db('diary_db',$conn);

        // child_idの特定
        $sql_select = 'SELECT MAX(id)+1 as child_id FROM diaries';

        $query_select = mysql_query($sql_select, $conn);

        $row = mysql_fetch_assoc($query_select);
        $child_id = $row['child_id'];

        // insert
        $sql_insert = 'INSERT INTO connects
                    (parent_id,child_id)
                    VALUES
                    ("' . $parent_id . '","' . $child_id . '")';

        $query_insert = mysql_query($sql_insert, $conn);
    }
?>
