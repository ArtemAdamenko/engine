<?php
function get_routes(){
    return array(
        'page/([-_a-z0-9]+)' => 'page/show/$1',
    );
}
?>