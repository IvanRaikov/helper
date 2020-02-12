<?php
class TaskController{

    public function actionIndex($monthOffset = 0, $yearOffset = 0){
        $calendar = new Calendar($monthOffset, $yearOffset);
        $timestamp = $calendar->startTimestamp;
        $month = $calendar->createCalendar();
        $tasks = Task::getTasksByDate($timestamp);
        require_once ROOT.'/views/task/index.php';
        return true;
    }
    
    public function actionNewTask(){
        $title = $_POST['title'];
        $date = $_POST['date'];
        $content = $_POST['content'];
        $priority = $_POST['priority'];
        Task::createTask($title, $date, $content, $priority);
        header('Location: /task');
        return true;
    }
    
    public function actionGettask($timestamp){
        if($response = Task::getTasksByDate($timestamp)){
            echo json_encode($response);
        }
        return true;
    }
    
    public function actionGetTaskById($id){
        if($response = Task::getTaskById($id)){
            echo json_encode($response);
        }
        return true;
    }
    
    public function actionGetTaskByDay($timestap){
      if($response = Task::getTasksByDay($timestap)){
          echo json_encode($response);
      }
      return true;
    }
    
    public function actionUpdate($id){
        $title = $_POST['title'];
        $date = $_POST['date'];
        $content = $_POST['content'];
        $priority = $_POST['priority'];
        Task::updateTask($title, $date, $content, $priority, $id);
        header('Location: /task');
        return true;
    }
    
    public function actionCheck($id){
        Task::checkTask($id);
        header('Location: /task');
        return true;
    }
    public function actionRemove($id){
        Task::removeTask($id);
        header('Location: /task');
        return true;
    }
}


