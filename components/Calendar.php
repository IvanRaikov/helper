<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendar
 *
 * @author Lenovo
 */
class Calendar {
    CONST SEC_IN_DAY = 86400;
    public $startTimestamp;
    public $startWeekDay;
    public $currentMonthString;
    
    function __construct($monthOffset = 0, $yearOffset = 0){
        $now = getdate(time());
        $month = (int)($monthOffset ? $monthOffset : $now['mon']);
        $year = (int)($yearOffset ? $yearOffset : $now['year']);
        $this->date = getdate(mktime($now['hours'], $now['minutes'], $now['seconds'], $month, $now['mday'], $year));
        $this->startTimestamp = mktime(0,0,0,$this->date['mon'], 1, $this->date['year']);
        $this->startWeekDay = getdate($this->startTimestamp)['wday'];
    }
    
    public function createCalendar(){
        $calendar = array();
        for($i = 0; true; $i++){
            $date = getdate( $this->startTimestamp + ($i * self::SEC_IN_DAY));
            if($date['mon'] == $this->date['mon']){
                $calendar[] = $date;
            }else{
                break;
            }
        }
        return $calendar;
    }
    
    public function getNextLink(){
        $month = $this->date['mon'] > 11 ? 1 : $this->date['mon']+1;
        $year = $this->date['mon'] > 11 ? $this->date['year']+1: $this->date['year'];
        return $month.'/'.$year;
    }
    
    public function getPrevLink(){
        $month = $this->date['mon'] <= 1 ? 12 : $this->date['mon']-1;
        $year = $this->date['mon'] <= 1 ? $this->date['year']-1: $this->date['year'];
        return $month.'/'.$year;
    }
}
