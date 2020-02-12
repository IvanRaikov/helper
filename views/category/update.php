<?php require ROOT.'/views/layouts/header.php';?>
    <form action="/category/update/<?=$category['id']?>" method="POST">
            <label>Заголовок</label>
            <input class="input" type="text" name="name" value="<?=$category['name']?>"/><br>
            <input class="submit" type="submit" value="сохранить" name="submit">
    </form>
<?php require ROOT.'/views/layouts/footer.php';?>
