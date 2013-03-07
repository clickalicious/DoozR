<?php

// include DoozR core
require_once '../Controller/Core/Core.php';

// instanciate DoozR core
$DoozR = DoozR_Core::getInstance();

$auth = $DoozR->getModuleHandle('auth');

$auth_array = array(
    'store'		=> 'file',
    'action'	=> 'read'
);

$ok = $auth->dispatch($auth_array);

if (!$ok) {

    $auth_array = array(
        'store'		=> 'file',
        'action'	=> 'delete',
        'redirect'	=> 'index.php'
    );

    $auth->dispatch($auth_array);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>DoozR - Administration</title>
    <link rel="stylesheet" type="text/css" href="../view/static/css/ext/ext-all.css" />
    <link rel="stylesheet" type="text/css" href="../view/static/css/ext/xtheme-gray.css" />
    <link rel="stylesheet" type="text/css" href="view/static/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="view/static/css/setup.css" />
</head>
<body>
    <script type="text/javascript" src="view/static/js/loading.js"></script>
    <script type="text/javascript" src="../view/static/js/ext/adapter/ext/ext-base.js"></script>
    <script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Loading Framwork...';</script>
    <script type="text/javascript" src="../view/static/js/ext/ext-all.js"></script>
    <script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Loading Core Base...';</script>
    <script type="text/javascript" src="view/static/js/basic.js"></script>
    <script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Loading Core API...';</script>
    <script type="text/javascript" src="view/static/js/setup.js"></script>
    <script type="text/javascript" src="view/static/js/loaded.js"></script>
</body>
</html>
