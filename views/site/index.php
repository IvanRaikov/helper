<?php require ROOT.'/views/layouts/header.php';?>
<body>
    <?php foreach($categories as $category):?>
        <h3 class="category"><?=$category['name']?></h3>
        <ul class="sideMenu">
            <?php foreach($listArticles[$category['id']] as $article):?>
            <li><a data-id="<?=$article['id']?>" class="a" ><?=$article['title']?></a></li>
            <?php endforeach;?>
        </ul>    
    <?php endforeach;?>
    
    <div id="content"></div>
    <div class="buttons">
        <a class="edit submit"><i class="fa fa-pencil"></i> редактировать</a>
        <a class="deleteArticle submit"><i class="fa fa-trash"></i> удалить</a>
    </div>
    <script src="/template/java-script/jquery-3.3.1.js"></script>
    <script src="/template/java-script/main-js.js"></script>
<?php require ROOT.'/views/layouts/footer.php';?>

        

    