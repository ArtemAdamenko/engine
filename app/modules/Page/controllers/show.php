<?php
    $page['title'] = "Title";
    $page['content'] = "Content";
    View::render('page','index', array('title' => $page['title'], 'content'=>$page['content']));
?>