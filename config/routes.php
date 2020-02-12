<?php
return array(
// article 
    'article/update/([0-9]+)'=>'article/update/$1',
    'article/delete/([0-9]+)'=>'article/delete/$1',
    'article'=>'article/create',
// category
    'category/update/([0-9]+)'=>'category/update/$1',
    'category/delete/([0-9]+)'=>'category/delete/$1',
    'category'=>'category/create',
// task
    'task/check/([0-9]+)'=>'task/check/$1',
    'task/remove/([0-9]+)'=>'task/remove/$1',
    'task/update/([0-9]+)'=>'task/update/$1',
    'task/newtask'=>'task/newtask',
    'task/gettask/([0-9]+)'=>'task/gettask/$1',
    'task/gettaskbyday/([0-9]+)'=>'task/gettaskbyday/$1',
    'task/gettaskbyid/([0-9]+)'=>'task/gettaskbyid/$1',
    'task/gettask'=>'task/gettask',
    'task/([0-9]+)/([0-9]+)'=>'task/index/$1/$2',
    'task/index'=>'task/index',
    'task'=>'task/index',
// site
    'site/article'=>'site/article',
    'site'=>'site/index',
    ''=>'site/index'
);
