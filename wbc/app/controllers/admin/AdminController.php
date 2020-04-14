<?php
declare(strict_types=1);


class AdminController extends ControllerBase
{
	public function initialize()
	{
        $this->view->titlePanel = 'Admin';
        $this->view->setTemplateAfter('navlink');
	}

    public function viewAction()
    {
		$this->view->users = Users::find();
    }
		
    public function healthAction()
    {
    }
        
    public function indexAction()
    {
        $this->view->users = Users::find();
    }

}

