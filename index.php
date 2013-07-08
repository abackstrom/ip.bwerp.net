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

render(__DIR__ . '/tpl/index.phtml');
