<?php
class SiteController{

    public function actionIndex(){
        $categories = Category::getCategories();
        $articles = Article::getArticles();
        $listArticles = Article::sortArticles($categories, $articles);
        require ROOT.'/views/site/index.php';
        return true;
    }
    public function actionArticle(){
        $id = $_POST['id'];
        $content = Article::getContentArticleById($id);
        echo $content;
        return true;
    }
}


