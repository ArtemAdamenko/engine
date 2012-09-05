<?php
    return array(
        'about' => 'page',
        'home' => 'page',
        'page/([-_a-z0-9]+)' => 'page',
        'users/([-_a-z0-9]+)' => 'users/show/$1',
    );
?>