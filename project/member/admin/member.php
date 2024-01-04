<?php

$js_array=['js/member.js'];

include 'inc_common.php';
include 'inc_header.php';
include '../inc/dbconfig.php';
include '../inc/member.php';    //회원클래스
include '../inc/lib.php'; //페이지 처리

$sn = (isset($_GET['sn'])&& $_GET['sn'] !='' && is_numeric($_GET['sn']))? $_GET['sn']:'';
$sf = (isset($_GET['sf'])&& $_GET['sf'] !='')? $_GET['sf']:'';


$paramArr = ['sn'=>$sn, 'sf'=>$sf];

$member = new Member($db);
$total = $member->total($paramArr);
$limit=5;
$page_limit=5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page']:1 ;


$param="";


$memArr = $member->list($page, $limit, $paramArr);



?>
<main class="border rounded-5 p-5" style="height: calc(100vh-200px);">

    <div class="container">
        <h3>회원관리</h3>
    </div>

    <table class="table table-border">
        <tr>
            <th>번호</th>
            <th>아이디</th>
            <th>이름</th>
            <th>이메일</th>
            <th>등록일시</th>
            <th>관리</th>
        </tr>
        <?php
            foreach($memArr AS $row){
                //$row['create_at']=substr($row['create_at'],0,16);
        ?>
        <tr>
            <td><?= $row['idx']; ?></td>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['create_at']; ?></td>
            <td>
                <button type="button" class="btn btn-green3 btn-sm btn_mem_edit" data-idx="<?=$row['idx']; ?>">수정</button>
                <button type="button" class="btn btn-danger btn-sm btn_mem_delete" data-idx="<?=$row['idx']; ?>">삭제</button>
            </td>

        </tr>

        <?php
            }
        ?>
    </table>

    <div class="container mt-3 d-flex gap-2 w-75">
        <select class="form-select w-25" name="sn" id="sn">
            <option value="1">이름</option>
            <option value="2">아이디</option>
            <option value="3">이메일</option>
        </select>

        <input type="text" class="form-control w-50" id="sf" name="sf">
        <button class="btn btn-green1" id="btn_search">검색</button>
        <button class="btn btn-green3" id="btn_all">전체목록</button>


    </div>
    

    <div class="d-flex mt-3 justify-content-between align-items-start">
    <?php
    $param = '&sn='.$sn.'&sf='.$sf;
        $pagenation = my_pagination($total, $limit, $page_limit, $page, $param);

        echo $pagenation;
    ?>

            <button type="button" class="btn btn-success" id="btn_excel">엑셀로 저장</button>
    </div>

</main>
<?php
include 'inc_footer.php';
?>
