<?php

const DEBUG = 1; // 1 - режим Разработки, 0 - режим Релиза
define("ROOT", dirname(__DIR__));
const WWW = ROOT . '/public';
const APP = ROOT . '/app';
const CORE = ROOT . '/vendor/workpayment/core';
const LIBS = ROOT . '/vendor/workpayment/core/libs';
const CACHE = ROOT . '/tmp/cache';
const CONF = ROOT . '/config';
const LAYOUT = 'workpayment';

// http://workpayment/public/index.php
$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
// http://workpayment/public/
$app_path = preg_replace("#[^/]+$#", '', $app_path);
// http://workpayment
$app_path = str_replace('/public/', '', $app_path);

define("PATH", $app_path);
const ADMIN = PATH . '/admin';

require_once ROOT . '/vendor/autoload.php';