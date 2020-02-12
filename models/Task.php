<?php

class Task {
    
    public static function getTasksByDate($timestamp){
    $range = self::getRangeMonth($timestamp);
    $db = Db::getConnection();
    $sql = 'SELECT * FROM task WHERE deadline BETWEEN :min AND :max;';
    $result = $db->prepare($sql);
    $result->bindValue(':min', $range['min'], PDO::PARAM_STR);
    $result->bindValue(':max', $range['max'], PDO::PARAM_STR);
    $result->execute();
    $i = 0;
    $tasks = array();
    while($row = $result->fetch()){
        $tasks[$i]['id'] = $row['id'];
        $tasks[$i]['title'] = $row['title'];
        $tasks[$i]['deadline'] = getdate($row['deadline']);
        $tasks[$i]['priority'] = $row['priority'];
        $tasks[$i]['content'] = $row['content'];
        $tasks[$i]['status'] = $row['status'];
        $i++;
    }
    return $tasks;
    }
    
    public static function getTaskById($id){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM task WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        if($row = $result->fetch()){
            $task['id'] = $row['id'];
            $task['title'] = $row['title'];
            $task['deadline'] = getdate($row['deadline']);
            $task['content'] = $row['content'];
            $task['status'] = $row['status'];
            $task['priority'] = $row['priority'];
            return $task; 
        }
        return false;
    }
    
    public static function getTasksByDay($timestamp){
        $response = array();
        $response['date'] = getdate($timestamp);
        $range = self::getRangeDay($timestamp);
        $db = Db::getConnection();
        $sql = 'SELECT * FROM task WHERE deadline BETWEEN :min AND :max;';
        $result = $db->prepare($sql);
        $result->bindValue(':min', $range['min'], PDO::PARAM_STR);
        $result->bindValue(':max', $range['max'], PDO::PARAM_STR);
        $result->execute();
        $i = 0;
        while($row = $result->fetch()){
            $response['tasks'][$i]['id'] = $row['id'];
            $response['tasks'][$i]['title'] = $row['title'];
            $response['tasks'][$i]['deadline'] = getdate($row['deadline']);
            $response['tasks'][$i]['content'] = $row['content'];
            $response['tasks'][$i]['status'] = $row['status'];
            $response['tasks'][$i]['priority'] = $row['priority'];
            $i++;
        }
        if(isset($response['tasks'])){
            return $response;
        }
        return false;
    }
    
    public static function createTask($title, $date, $content, $priority){
        $date = self::checkAndGetDate($date);
        if($date && !empty($title) && !empty($content) && !empty($priority)){
            $status = 1;
            $db = Db::getConnection();
            $sql = 'INSERT INTO task VALUES(null, :title, :deadline, :priority, :status, :content);';
            $result = $db->prepare($sql);
            $result->bindValue(':title', $title, PDO::PARAM_STR);
            $result->bindValue(':deadline', $date, PDO::PARAM_STR);
            $result->bindValue(':priority', $priority, PDO::PARAM_INT);
            $result->bindValue(':status', $status, PDO::PARAM_INT);
            $result->bindValue(':content', $content, PDO::PARAM_STR);
            return $result->execute();
        }
        return false;
    }
    
    public static function updateTask($title, $date, $content, $priority, $id){
        $date = self::checkAndGetDate($date);
        if($date && !empty($title) && !empty($content) && !empty($priority)){
            $status = 1;
            $db = Db::getConnection();
            $sql = 'UPDATE task SET title = :title, deadline = :deadline, '
                    . 'priority = :priority, status = :status, content = :content'
                    . ' WHERE id = :id;';
            $result = $db->prepare($sql);
            $result->bindValue(':title', $title, PDO::PARAM_STR);
            $result->bindValue(':deadline', $date, PDO::PARAM_STR);
            $result->bindValue(':priority', $priority, PDO::PARAM_INT);
            $result->bindValue(':status', $status, PDO::PARAM_INT);
            $result->bindValue(':content', $content, PDO::PARAM_STR);
            $result->bindValue(':id', $id, PDO::PARAM_STR);
            return $result->execute();
        }
        return false;
    }
    
    public static function checkTask($id){
        $db = Db::getConnection();
        $sql = 'UPDATE task SET status = 0 WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        return $result->execute();
    }
    
    public static function removeTask($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM task WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindValue(':id', $id);
        return $result->execute();
    }
    
    private static function getRangeDay($timestamp){
        $range = array();
        $date = getdate($timestamp);
        $range['min'] = mktime(0, 0, 0, $date['mon'], $date['mday'], $date['year']);
        $range['max'] = mktime(23, 59, 59, $date['mon'], $date['mday'], $date['year']);
        return $range;
    }
    
    private static function getRangeMonth($timestamp){
        $date = getdate($timestamp);
        $range = array();
        $range['min'] = mktime(0, 0, 0, $date['mon'], 1, $date['year']);
        $range['max'] = mktime(23, 59, 59, $date['mon']+1, 0, $date['year']);
        return $range;
    }
    
    private static function checkAndGetDate($date){
        $date = explode('.', $date);
        if(is_array($date) && count($date) == 3 && checkdate( (int)$date[1], (int)$date[0], (int)$date[2])){
            return $deadline = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
        }
        return false;
    }
}
