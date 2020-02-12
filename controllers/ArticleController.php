<?php
class ArticleController{

    public function actionCreate(){
        $categories = Category::getCategories();
        if(isset($_POST['submit'])){
            $categoryId = $_POST['category_id'];
            $content = $_POST['content'];
            $title = $_POST['title'];
            if(Article::createArticle($categoryId, $content, $title)){
                header('Location: /');
            }
            
        }
        require ROOT.'/views/article/create.php';
        return true;
    }
    public function actionUpdate($id){
        $categories = Category::getCategories();
        $article = Article::getArticleById($id);
        if(isset($_POST['submit'])){
            $categoryId = $_POST['category_id'];
            $content = $_POST['content'];
            $title = $_POST['title'];
            if(Article::updateArticle($categoryId, $content, $title, $id)){
                header('Location: /');
            }
            
        }
        require ROOT.'/views/article/update.php';
        return true;
    }
    public function actionDelete($id){
        $article = Article::getArticleById($id);
        if(isset($_POST['yes'])){
            if(Article::deleteArticle($id)){
                header('Location: /');}
        }
        if(isset($_POST['no'])){
            header('Location: /');
        }  
        require ROOT.'/views/article/delete.php';
        return true;
    }
}


