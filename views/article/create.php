<?php require ROOT.'/views/layouts/header.php';?>
    <form action="/article/create" method="POST">
        <label>выберите категорю </label>
            <select name="category_id" class="input">
                <?php foreach($categories as $category):?>
                <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <?php endforeach;?>
            </select><br>
            <label>Заголовок</label><br>
            <input class="input" type="text" name="title"/><br>
        
            <p>описание </p><textarea id="editor1" type="text" name="content"></textarea>
            <script>
            var ckeditor1 =CKEDITOR.replace('editor1');
            AjaxFileManager.init({
                returnTo: 'ckeditor',
                editor:ckeditor1
            });
            </script>
            <br>
            <input class="submit" type="submit" value="сохранить" name="submit">
    </form>
<?php require ROOT.'/views/layouts/footer.php';?>

