<?php
declare(strict_types=1);

use Phalcon\Escaper;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Url as UrlResolver;

use Phalcon\Dispatcher\Exception as DispatcherException;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Event;
use Phalcon\Events\Manager;


$di->setShared('config', function () {
return include APP_PATH . "/config/config.php";
});




$di->setShared('url', function () {
$config = $this->getConfig();

$url = new UrlResolver();
$url->setBaseUri($config->application->baseUri);

return $url;
});




$di->setShared('view', function () {
$config = $this->getConfig();

$view = new View();
$view->setDI($this);
$view->setViewsDir($config->application->viewsDir);

$view->registerEngines([
'.volt' => function ($view) {
$config = $this->getConfig();

$volt = new VoltEngine($view, $this);

$volt->setOptions([
'path' => $config->application->cacheDir,
'separator' => '_'
]);

return $volt;
},
'.phtml' => PhpEngine::class

]);

return $view;
});




$di->setShared('db', function () {
$config = $this->getConfig();

$class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
$params = [
'host' => $config->database->host,
'username' => $config->database->username,
'password' => $config->database->password,
'dbname' => $config->database->dbname,
'charset' => $config->database->charset
];

if ($config->database->adapter == 'Postgresql') {
unset($params['charset']);
}

return new $class($params);
});





$di->setShared('modelsMetadata', function () {
return new MetaDataAdapter();
});




$di->set('flash', function () {
$escaper = new Escaper();
$flash = new Flash($escaper);
$flash->setImplicitFlush(false);
$flash->setCssClasses([
'error' => 'alert alert-danger',
'success' => 'alert alert-success',
'notice' => 'alert alert-info',
'warning' => 'alert alert-warning'
]);

return $flash;
});




$di->setShared('session', function () {
$session = new SessionManager();
$files = new SessionAdapter([
'savePath' => sys_get_temp_dir(),
]);
$session->setAdapter($files);
$session->start();

return $session;
});





$di->set('dispatcher', function() use ($di) {
    $eventsManager = $di->getShared('eventsManager');

    $eventsManager->attach(
        'dispatch:beforeException',
        function (Event $event, $dispatcher, Exception $exception) {
            switch ($exception->getCode()) { // 404
            case DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
            case DispatcherException::EXCEPTION_ACTION_NOT_FOUND:
                $dispatcher->forward([ 'controller' => 'index', 'action' => 'show404']);
                return false;
            }
        }
    );

    $security = new Security($di);
    $security->setAclFile($di->getConfig()->application->aclFile);
    //Listen for events produced in the dispatcher using the Security plugin
    $eventsManager->attach('dispatch', $security);
    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    
    return $dispatcher;
});