<?php

$setUri['base'] = 'http://localhost/SIG_GIS/';
$hostname = 'localhost';

function getPage($a = '')
{
    $url = '?page=' . $a;
    $getbase_url = $GLOBALS['setUri']['base'];
    return $getbase_url . $url;
}

?>