<?php
//запросы из бд begin
    $page['title'] = "Title";
    $page['content'] = "Content";
//запросы из бд end
    View::render($module, $template, array('title' => $page['title'], 'content'=>$page['content']));
?>