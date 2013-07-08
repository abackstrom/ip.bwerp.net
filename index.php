<?php

switch( $_SERVER['QUERY_STRING'] ) {
    case 'txt':
    case 'simple': die( $_SERVER['REMOTE_ADDR'] );
    case 'fail': header('HTTP/1.0 404 Not Found'); die('404 Not Found');
}

function render($tpl, $params = array()) {
    extract($params, EXTR_SKIP);
    include $tpl;
}

$params = array(
    'host' => $_SERVER['HTTP_HOST'],
    'remote_ip' => $_SERVER["REMOTE_ADDR"],
    'remote_host' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
);

render(__DIR__ . '/tpl/index.phtml', $params);
