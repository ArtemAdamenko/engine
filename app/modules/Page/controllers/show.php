<?php
//запросы из бд begin
    $page['title'] = "Title";
    $page['content'] = "Content";
//запросы из бд end
$smarty = new Smarty();
$smarty->assign('title', $page['title']);
$smarty->assign('content', $page['content']);
$smarty->display(ROOT . 'view\\'.self::MODULE.'\\'.self::$template.'.php');

//View::render(self::MODULE, self::$template, array('title' => $page['title'], 'content'=>$page['content']));
?>