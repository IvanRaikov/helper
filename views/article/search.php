<?php require ROOT.'/views/layouts/header.php';?>
<h2 style="text-align: center">Результаты поиска по: "<?=$searchText?>"</h2>
<div class="viewContent">
    <?php if($list):?>
        <?php foreach($list as $item):?>
        <a class="searchResultA"><?= $item['title']?></a> <?="встречается ".$item['relivant']." раз"?>
        
        <div class="searchResult"><a class="fa fa-book" href="/article/view/<?= $item['id']?>"> читать</a> <?=$item['content']?> </div>
        
        <hr>
        <?php endforeach;?>
    <?php else:?>
        <?= "по вашему запросу ничего не найдено"?>
    <?php endif;?>
</div>
<script src="/template/java-script/jquery-3.3.1.js"></script>
<script src="/template/java-script/searchResult.js"></script>
<?php require ROOT.'/views/layouts/footer.php';?>
