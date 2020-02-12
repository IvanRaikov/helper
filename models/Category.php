<?php
class Category{
    
    public static function getCategories(){
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM category;');
        $i = 0;
        while($row = $result->fetch()){
            $categories[$i]['id'] =$row['id'];
            $categories[$i]['name'] =$row['name'];
            $i++;
        }
        return $categories;
    }
    
    public static function updateCategory($name, $id){
        $db = Db::getConnection();
        $sql = 'UPDATE category SET name = :name WHERE id = :id;';
        $result = $db->prepare($sql);
        $result->bindValue(':name', $name, PDO::PARAM_STR);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function deleteCategory($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM category WHERE id = :id;';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function createCategory($title){
        $db = Db::getConnection();
        $sql = 'INSERT INTO category VALUES(null, :title);';
        $result = $db->prepare($sql);
        $result->bindValue(':title', $title, PDO::PARAM_STR);
        return $result->execute();
    }
    
    public static function getCategoryById($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM category WHERE id = :id;";
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
}
