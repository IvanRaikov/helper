<?php
class highLightHelper {
    public static function process($content, $searchText){
        return preg_replace("/$searchText/", "<bold class='hightLight'>$searchText</bold>", $content);
    }
}
