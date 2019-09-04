<?php
    require_once "system/config.php";

    // 作成したデータベースに接続(今回は「my_works」)
    // ここで$pdoとすることで、postやcommentなどを使いやすくしている。
    // $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);
    // $user = 'takuyayanooo_myw';
    // $pass = 'mywork0714';

    // 作成したデータベースに接続(今回は「my_works」)
    // ここで$pdoとすることで、postやcommentなどを使いやすくしている。
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass);

    
    // postテーブルの一覧から、を取得するSQL文
    $st = $pdo->query("SELECT * FROM `post` ORDER BY `post`.`time` DESC");

$year = 2016;
while($year <= date('Y')) {
    echo "<tr><td>{$year}年</td>";
    for ($month = 1; $month <= 12; $month++) {
    if (sprintf('%04d%02d', $year, $month) > date('Ym')) {
        echo '<td>&nbsp;</td>';
    }
    else {
        echo '<td><a href="'.$year.'-'.sprintf('%02d',$month).'">'.$month.'月</a></td>';
    }
    }
    echo "</tr>";
    $year++;
}

?>