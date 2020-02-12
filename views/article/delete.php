<?php require ROOT.'/views/layouts/header.php';?>
<form action="/article/delete/<?=$id?>" method="POST">
    <label>Вы действительно хотите удалить статью "<?=$article['title']?>"</label>
    <input class="submit" type="submit" value="да" name="yes">
    <input class="submit" type="submit" value="нет" name="no">
</form>
<?php require ROOT.'/views/layouts/footer.php';?>