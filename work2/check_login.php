<?php
    // セッションの生成
    session_start();

    // name,password
    $name = htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
    $password = htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');

    // MySQLへの接続
    $conn = mysql_connect('localhost','diary_user','diary_pass');

    if ($conn) {
        // データベースの選択
        mysql_select_db('diary_db',$conn);

        // データベースへの問い合わせSQL文
        $sql = 'SELECT id,name,password FROM users
              WHERE name = "' . $name . '"
              AND password = "' . $password . '"';

        // SQL文の実行
        $query = mysql_query($sql, $conn);
    }

    // 認証
    if (mysql_num_rows($query) == 1) {
       // ログイン成功
       $login = 'OK';
       // データの取り出し
       $row = mysql_fetch_object($query);
       // ユーザーをセッション変数に保存
       $_SESSION['id'] = $row->id;
       $_SESSION['name'] = $row->name;
    } else {
       // ログイン失敗
       $login = 'Error';

       // セッション変数に記録
       $_SESSION['login'] = $login;
	}
    // 移動
    if ($login == 'OK') {
        // ログイン成功
        header('Location: diary.php');
    } else {
        // ログイン失敗
        echo 'ログインに失敗しました。<br>ユーザー名とパスワードを確認してください。<br><br><a href="login.html"> ログイン画面に戻る </a>';
        // セッションを破棄
        session_destroy();
    }
?>
