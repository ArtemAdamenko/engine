<?php
return array(
    'about' => 'show/about',
    'home' => 'show/home',
    '^page\/(\d+)\/?$' => 'show/$1',
    '^page\/edit\/(\d+)\/?$' => 'edit/$1',
);
?>