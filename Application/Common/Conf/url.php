<?php 
return array (
  'URL_MODEL' => 0,
  'URL_HTML_SUFFIX' => '.html',
  'URL_PATHINFO_DEPR' => '/',
  'URL_ROUTER_ON' => true,
  'URL_ROUTE_RULES' => 
  array (
    '/^jobfair\/(?!admin)(\w+)$/' => 'jobfair/index/:1',
    '/^mall\/(?!admin)(\w+)$/' => 'mall/index/:1',
  ),
  'SESSION_OPTIONS' => 
  array (
    'path' => 'D:\xamp\htdocs\echo_zp\data\session',
  ),
  'COOKIE_PATH' => '/',
  'QSCMS_VERSION' => '4.2.122',
  'QSCMS_RELEASE' => '2018-06-05 16:04:12',
);