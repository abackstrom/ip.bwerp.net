<?php

define('HOST_IP', 'ip.bwerp.net');
define('HOST_UA', 'ua.bwerp.net');

$method = $_SERVER['QUERY_STRING'];

$params = array(
    'host' => $_SERVER['HTTP_HOST'],
    'remote_ip' => $_SERVER["REMOTE_ADDR"],
    'remote_host' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    'headers_only' => array_key_exists('headers', $_GET),
    'headers' => get_request_headers($_SERVER),
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

function get_request_headers($headers) {
    $headers = array_filter($headers, function($value, $key) {
        return substr($key, 0, 5) === 'HTTP_';
    }, ARRAY_FILTER_USE_BOTH);

    $map = array(
        'dnt' => 'DNT',
    );

    $tmp = [];
    foreach ($headers as $key => $value) {
        $key = strtolower($key);
        $key = substr($key, 5);

        // does key have a manual override?
        if (array_key_exists($key, $map)) {
            $tmp[$map[$key]] = $value;
            continue;
        }

        $key = str_replace("_", "-", $key);
        $key = ucwords($key, "-");
        $tmp[$key] = $value;
    }

    return $tmp;
}

render(__DIR__ . '/tpl/index.phtml', $params);
