<?php
class CategoryController{

    public function actionCreate(){
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            if(Category::createCategory($title)){
                header('Location: /');
            }
        }
        require ROOT.'/views/category/create.php';
        return true;
    }
    public function actionUpdate($id){
        $category = Category::getCategoryById($id);
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            if(Category::updateCategory($name, $id)){
                header('Location: /');
            }
        }
        require ROOT.'/views/category/update.php';
        return true;
    }
    public function actionDelete($id){
        $category = Category::getCategoryById($id);
        if(isset($_POST['yes'])){
            if(Category::deleteCategory($id)){
                header('Location: /');
            }
        }
        if(isset($_POST['no'])){
            header('Location: /');
        }
        require ROOT.'/views/category/delete.php';
        return true;
    }
    

}