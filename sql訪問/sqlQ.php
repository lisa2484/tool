<?php
include("serverset.php");
include("functionbox.php");
$type = trim($_POST["type"]);
$sql = trim($_POST["sql"]);
$page = empty($_POST["page"]) ? 1 : trim($_POST["page"]);
$limit = ($page - 1) * 1000;
$err = "";
$req = "";
$str = "";
if (!empty($sql)) {
    switch ($type) {
        case "show":
            $req = SqlQueryArray($sql, $link_ID);
            if (mysqli_errno($link_ID)) {
                $err = mysqli_error($link_ID);
            }
            break;
        case "select":
            $req = SqlQueryArray($sql . " LIMIT " . $limit . ",1000", $link_ID);
            if (mysqli_errno($link_ID)) {
                $err = mysqli_error($link_ID);
            }
            break;
        case "other":
            mysqli_query($link_ID, $sql);
            if (mysqli_errno($link_ID)) {
                $err = mysqli_error($link_ID);
            }
            break;
        case "copy_table":
            $str = copyTable($link_ID, $sql);
            break;
    }
}

function copyTable($link_ID, $db_name)
{
    $str = "";
    $sql = "SHOW TABLE STATUS FROM `" . $db_name . "`";
    $r = SqlQueryArray($sql, $link_ID);
    if (mysqli_errno($link_ID)) return $str = mysqli_error($link_ID);
    foreach ($r as $b) {
        $sql = "SHOW CREATE TABLE `" . $db_name . "`.`" . $b["Name"] . "`";
        $r = SqlQueryArray($sql, $link_ID);
        if (mysqli_errno($link_ID)) return $str = mysqli_error($link_ID);
        $str .= "-- " . $r[0]["Table"] . "<br>" . $r[0]["Create Table"] . ";<br>";
    }
    return $str;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-color: #3b3b3b;color:#fff;">
    <div class="container"><?= $err ?></div>
    <div class="container pt-3">
        <form action="sqlQuery.php" method="post" class="form-group">
            <input class="form-control" name="type" value="<?= $type ?>">
            <textarea class="form-control" name="sql"><?= $sql ?></textarea>
            <input class="form-control" name="page" value="<?= $page ?>">
            <input class="btn btn-light" type="submit" value="送出表單">
        </form>
    </div>
    <?php
    if (!empty($req)) {
    ?>
        <div class="container" style="overflow: auto;height:700px">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <?php
                        foreach (array_keys($req[0]) as $k) {
                        ?>
                            <th><?= $k ?></th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($req as $datas) {
                    ?>
                        <tr>
                            <?php
                            foreach ($datas as $data) {
                            ?>
                                <td><?= $data ?></td>
                            <?php
                            } ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
    if (!empty($str)) {
    ?>
        <div><?= $str ?></div>
    <?php
    }
    ?>
</body>

</html>