<?php

$SELF_URL = "../../developers/z_test/paging_example.php"; // 기본 url
$conn = mysqli_connect("localhost", "root", "ehfrhfo12", "mugyeolDB") or die("fail");
$sql = "SELECT article_id FROM article ORDER BY article_id DESC"; //article id 조회 //submenu 는 where명령어 추가
$data = mysqli_query($conn, $sql);

$num = mysqli_num_rows($data); // 총 데이터 수

//    echo ($_GET['page'])?$_GET['page']:2;
//    $page = ($_GET['page'])?$_GET['page']:1;
if (!isset($_GET['page'])|| $_GET['page'] <= 0  ) {
    $page = 1;

} else if (isset($_GET['page'])) {
    $page = $_GET['page']; //page 2부터

}

$list = 10; //한 페이지당 데이터
$block = 3; // 한 블록 당 버튼 수

$pageNum = ceil($num / $list); // 총 페이지
$blockNum = ceil($pageNum / $block); // 총 블록
$nowBlock = ceil($page / $block); //현재 블록

$s_page = ($nowBlock * $block) - 2;
if ($s_page <= 1) {
    $s_page = 1;
}
$e_page = $nowBlock * $block;

if ($pageNum <= $e_page) {
    $e_page = $pageNum;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/index_style.css">

    <title></title>
</head>
<body>


<nav class="my_paging">
    <ul class="pagination pagination-lg justify-content-center ">

        <!--            //현재 1페이지에 있으면 previous 버튼 disable-->
        <?php
        if ($s_page <= 1){
        ?>
    <li class="page-item disabled">
    <?php
    }else{
    ?>
        <li class="page-item">
            <?php
            }
            ?>

            <a class="page-link" href="<?= $SELF_URL ?>?page=<?= $s_page - 1 ?>" tabindex="-1">Previous</a>
        </li>
        <!--    <a href="--><? //=$PHP_SELP?><!--?page=--><? //=$s_page-1?><!--">이전</a>-->
        <li class="page-item"><a class="page-link" href="<?= $SELF_URL ?>">1</a></li>

        <?php
        if ($e_page>=2) {
            for ($p = $s_page + 1; $p <= $e_page; $p++) {
                ?>
                <!--        페이지 링크 생성-->


                <li class="page-item"><a class="page-link" href="<?= $SELF_URL ?>?page=<?= $p ?>"><?= $p ?></a></li>


                <?php
            }
        }
        ?>
        <!--    블락 생성-->


        <li class="page-item">
            <a class="page-link" href="<?= $SELF_URL ?>?page=<?= $e_page + 1 ?>">Next</a>
        </li>
    </ul>
</nav>

<?php
$s_point = ($page - 1) * $list; // start point // page 1 일 경우 0 // 2일 경우 10 //

$sql = "SELECT * FROM article ORDER BY article_id DESC LIMIT $s_point,$list"; //row 갯수로 리밋


$real_data = mysqli_query($conn, $sql);
$num = mysqli_num_rows($real_data); // 페이지 당 데이터 수-> 예제에서는 위에서 구한 총데이터 값 사용 < 크게 상관은 없을듯,, 어짜피 데이터가 10개라서?

echo $num;

for ($i = 1; $i <= $num; $i++) {
    $row = mysqli_fetch_array($real_data);
    ?>

    <div>
        <?= $row['article_id'] ?>
    </div>

    <?php
    if ($row == false) {
        exit;
    }
}
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>