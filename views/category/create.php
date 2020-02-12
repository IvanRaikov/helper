<?php require ROOT.'/views/layouts/header.php';?>
    <form action="/category" method="POST">
            <label>Заголовок</label><br>
            <input class="input" type="text" name="title"/><br>
            <input class="submit" type="submit" value="сохранить" name="submit">
    </form>
<?php require ROOT.'/views/layouts/footer.php';?>

