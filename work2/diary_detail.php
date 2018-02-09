<?php
    // セッションの復元
    session_start();

    // ID,name
    $id = $_GET['id'];
    $name = $_SESSION['name'];

    // MySQLへの接続
    $conn = mysql_connect('localhost','diary_user','diary_pass');

    if ($conn) {
        // データベースを選択
        mysql_select_db('diary_db',$conn);

        // 親スレッドの取得
        $sql_parent = 'SELECT id,title,diary,date
                    FROM diaries
                    WHERE id = "' .$id. '"';

        $query_parent = mysql_query($sql_parent,$conn);

        $row_parent = mysql_fetch_object($query_parent);

        // 子スレッドの確認
        $sql = 'SELECT child_id FROM connects WHERE parent_id = "' .$id. '"';

        $query = mysql_query($sql,$conn);

        $row = mysql_fetch_object($query);
        $child_id = $row->child_id;
var_dump($child_id);

        // 子スレッドの取得
        $sql_child = 'SELECT id,title,diary,date
                    FROM diaries
                    WHERE id = "' .$child_id. '"';

        $query_child = mysql_query($sql_child,$conn);
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>はてな匿名ダイアリー</title>
</head>
<body>
    <b><?php if (empty($_SESSION['id'])){
        echo 'ようこそゲストさん';
    }else{
        echo 'ようこそ' .$name. 'さん';
    }?>
</b>
<hr>
<a href = "login.html"> ログイン </a>
&nbsp;
<a href = "add.php"> ユーザー登録 </a>
&nbsp;
<a href = "post.php"> 日記を書く </a>
&nbsp;
<a href = "logout.php"> ログアウト </a>
<hr>
    <?php
        echo '<b>■' .$row_parent->title. ':' .$row_parent->date. '</b>';
        echo '<br><br>' .$row_parent->diary. '<br><br>';
        echo '<a href = "post.php?parent_id=' .$id. '"> コメントする </a>';
        echo '<br><br>';

        while($row_child = mysql_fetch_object($query_child)){
                echo '<a href="diary_detail.php?id=' . $row_child->id . '"> ■ ' . $row_child->title . ':' .$row_child->date. '</a>';
                echo '<br>' .$row_child->diary;
                echo '<br><br>';
            var_dump($row_child->id);}
    ?>
<br><br>
<a href = "diary.php"> トップページへ戻る </a>
</body>
</html>
