<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/template/css/style.css">
    <link rel="stylesheet" href="/template/css/font-awesome.css">
    <link rel="stylesheet" href="/template/css/menu.css">
    <link rel="stylesheet" href="/template/css/task-calendar.css">
    <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="/template/java-script/clock.js"></script>
</head>
<body>
    <?php $categories = Category::getCategories();?>
    <div class="wrapMenu">
    <nav class="mainMenu">
		<ul>
			<li><a href="/"><i class="fa fa-home"></i>Главная</a></li>
			<li><a href="/category"><i class="fa fa-archive"></i>Новая категория</a></li>
                        <li><a href="/article"><i class="fa fa-book"></i>Новая запись</a></li>
			<li><a href=""><i class="fa fa-edit"></i>Изменить категорию</a>
				<ul>
                                    <?php foreach($categories as $cat):?>
                                    <li><a href="/category/update/<?= $cat['id'] ?>"><?= $cat['name'] ?></a></li>
                                    <?php endforeach;?>
				</ul>
			</li>
			<li><a href=""><i class="fa fa-trash"></i>Удалить категорию</a>
				<ul>
                                    <?php foreach($categories as $cat):?>
                                    <li><a href="/category/delete/<?= $cat['id'] ?>"><?= $cat['name'] ?></a></li>
                                    <?php endforeach;?>
				</ul>
			</li>
                        <li><a href="/task/index"><i class="fa fa-calendar"></i>Календарь задач</a></li>
                        <li id="clock"></li>
		</ul>
        </nav>
        </div>
<div class="wrapper">