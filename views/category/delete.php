<?php require ROOT.'/views/layouts/header.php';?>
    <form action="/category/delete/<?=$category['id']?>" method="POST">
            <label>вы действительно хотите удалить категорию "<?= $category['name']?>"</label>
            <input class="submit" type="submit" value="да" name="yes">
            <input class="submit" type="submit" value="нет" name="no">
    </form>
<?php require ROOT.'/views/layouts/footer.php';?>
