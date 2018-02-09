<?php
    // セッションの復元
    session_start();

    // ID、name
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

    // MySQLへの接続
    $conn = mysql_connect('localhost','diary_user','diary_pass');

    if ($conn) {
        // データベースを選択
        mysql_select_db('diary_db',$conn);

        // データベースからの取り出しSQL文
        $sql = 'SELECT id,title,diary,date
                FROM diaries';

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
はてな匿名ダイアリー
<br>
<br>
<td>名前を隠して楽しく日記。</td>
<br>
<br>
<?php
while($row = mysql_fetch_object($query)){
        echo '<a href="diary_detail.php?id=' . $row->id . '"> ■ ' . $row->title . ':' .$row->date. '</a>';
        echo '<br>' .$row->diary;
        echo '<br><br>';
    }
?>
</body>
</html>
