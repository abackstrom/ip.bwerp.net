<?php

define('HOST_IP', 'ip.bwerp.net');
define('HOST_UA', 'ua.bwerp.net');

$method = $_SERVER['QUERY_STRING'];

$params = array(
    'host' => $_SERVER['HTTP_HOST'],
    'remote_ip' => $_SERVER["REMOTE_ADDR"],
    'remote_host' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
);

if ($method == null && strpos($params['user_agent'], 'curl/') === 0) {
    if ($params['host'] === HOST_IP) {
        die($params['remote_ip'] . "\n");
    } else {
        die($params['user_agent'] . "\n");
    }
}

switch($method) {
    case 'txt':
    case 'simple': die($params['remote_ip']);
    case 'fail': header('HTTP/1.0 404 Not Found'); die('404 Not Found');
}

function render($tpl, $params = array()) {
    extract($params, EXTR_SKIP);
    include $tpl;
}

render(__DIR__ . '/tpl/index.phtml', $params);
