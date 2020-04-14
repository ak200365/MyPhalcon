<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function onConstruct()
    {
        $this->view->titlePanel = 'Guest';        
        $this->view->authuser = $this->getSession('user');
    }
    protected function setSession($key, $value)
    {
        // $this->persistent->$key = $value;
    	$this->session->set($key, $value);
    }
    protected function getSession($key)
    {
        return $this->session->get($key);
    }
}
