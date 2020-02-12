<?php
class Article{
    public static function createArticle($categoryId, $content, $title){
        $db = Db::getConnection();
        $sql ="INSERT INTO article VALUES(null, :category_id, :title, :content);";
        $result = $db->prepare($sql);
        $result->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindValue(':title', $title, PDO::PARAM_STR);
        $result->bindValue(':content', $content, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function updateArticle($categoryId, $content, $title, $id){
        $db = Db::getConnection();
        $sql ="UPDATE article SET category_id = :category_id, title = :title, content = :content WHERE id = :id;";
        $result = $db->prepare($sql);
        $result->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindValue(':title', $title, PDO::PARAM_STR);
        $result->bindValue(':content', $content, PDO::PARAM_STR);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getArticles(){
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM article;');
        $i = 0;
        while($row = $result->fetch()){
            $articles[$i]['id'] = $row['id'];
            $articles[$i]['category_id'] = $row['category_id'];
            $articles[$i]['title'] = $row['title'];
            $articles[$i]['content'] = $row['content'];
            $i++;
        }return $articles;
    }
    public static function getContentArticleById($id){
        $db = Db::getConnection();
        $sql ='SELECT * FROM article WHERE id = :id;';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $article = $result->fetch();
        
        return $article['content'];
    }
    public static function getArticleById($id){
        $db = Db::getConnection();
        $sql ='SELECT * FROM article WHERE id = :id;';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();
        $article['id']=$row['id'];
        $article['category_id']=$row['category_id'];
        $article['title']=$row['title'];
        $article['content']=$row['content'];
        return $article;
    }
    public static function sortArticles($categories, $articles){
        $listArticle = array();
        foreach($categories as $category){
            $listArticle[$category['id']] = array();
        }
        foreach($articles as $article){
            $listArticle[$article['category_id']][]=$article;
        }
        return $listArticle;
    }
    public static function deleteArticle($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM article WHERE id = :id;';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
}

