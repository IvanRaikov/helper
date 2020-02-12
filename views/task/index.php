<?php require ROOT.'/views/layouts/header.php';?>
<div id="calendar" data-timestamp="<?=$timestamp?>">
    <a class="arrowLeft" href="/task/<?=$calendar->getPrevLink()?>"><i class="callendarArrow fa fa-arrow-left"></i></a>
    <a class="arrowRight"href="/task/<?=$calendar->getNextLink()?>"><i class="callendarArrow fa fa-arrow-right"></i></a>
    <table cellpadding="25px">
        <caption><?= $calendar->date['month'].' '.$calendar->date['year']?></caption>
        <tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Вс</th>
        </tr>
        <tr>
        <?php 
        for($i = 1; $i != 7; $i++){
            if($calendar->startWeekDay == $i){
                break;
            }
        ?>
            <td></td>
        <?php }
        ?>
        <?php foreach($month as $day):?>
            <?php if($day['wday'] == 0 && $day['mday'] != count($month)):?>
                <td data-day="<?= $day['mday']?>" data-date="<?= $day[0]?>"><?= $day['mday']?></td>
            </tr>
            <tr>
            <?php else:?>
                <td data-day="<?= $day['mday']?>" data-date="<?= $day[0]?>"><?= $day['mday']?></td>
            <?php endif;?>
            
        <?php endforeach;?>
    </table>
</div>
<div class="submit" id="newTask">новая задача <i class="fa fa-plus"></i></div>
<div id="taskList">
    <h2>список задач на <?= $calendar->date['month'].' '.$calendar->date['year']?></h2>
    
    <ul>
        <?php foreach($tasks as $task):?>
        <li class="<?php echo $task['status']==0? 'checked':''?>" data-id="<?=$task['id']?>"><?= $task['title']?></li>
        <?php endforeach;?>
    </ul>
    
</div>
<div id="showErrors" class="hide">заполните поля</div>
<div id="taskForm"class="fade" style="display:none">
    <h3>добавить новую задачу</h3>
    <i class="fa fa-close close"></i>
    <form action="/task/newtask" method="post">
        <label>задача</label>
        <input type="text" name="title">
        <label>дата (выберите дату на календаре)</label>
        <input type="text" disabled name="date" value="">
        <label>приоритет</label>
        <select name="priority" name="priority[]">
            <option value="1">низкий</option>
            <option value="2">средний</option>
            <option value="3">высокий</option>
        </select>
        <label>описание</label>
        <textarea cols="49" rows="10"name="content"></textarea>
        
        <input class="submit" type="submit" name="send" value="сохранить">
    </form>
</div>
<div id="taskRead">
    <h3></h3>
    <i class="fa fa-close close"></i>
    <div id="taskReadContent"></div>
    <div class="submit" id="editTask">редактировать</div>
    <a class="submit" id="checkTask">выполнено</a>
    <a class="submit" id="removeTask">удалить</a>
</div>

<script src="/template/java-script/calendar.js">
</script>
<?php require ROOT.'/views/layouts/footer.php';?>
