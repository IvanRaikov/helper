<?php require ROOT.'/views/layouts/header.php';?>
<h1 style="text-align: center;width:640px; margin:auto"><?= $article['title']?></h1>
<div class="viewContent">
    <?= $article['content']?>
</div>

<?php require ROOT.'/views/layouts/footer.php';?>
