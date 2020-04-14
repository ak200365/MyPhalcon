<?php
declare(strict_types=1);

class UserController extends ControllerBase
{
	public function initialize()
	{
		$this->view->titlePanel = 'User';
        $this->view->setTemplateAfter('navlink');
	}

    public function indexAction()
    {
    }

    public function designAction()
    {
        $this->dispatcher->forward(['controller' => 'user', 'action' => 'index']);
    }
    public function businessAction()
    {
        $this->dispatcher->forward(['controller' => 'user', 'action' => 'index']);
    }

}

