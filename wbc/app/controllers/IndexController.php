<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher->getActionName();

        // $this->view->titlePanel = 'Guest';
        // $this->view->username = $this->getSession('user');

        $this->view->setTemplateAfter('navlink');
    }

    public function indexAction()
    {
        // $this->flash->success("Hi");
    }

	public function signinAction()
    {
    	if ($this->request->isPost()) {
    		$auth = [
    			'login' => $this->request->getPost('login'), 
    			'password' => $this->request->getPost('password')
    		];

    		$aUser = Users::find("login = '{$auth['login']}' AND is_active = 1");

    		if ($aUser->count() == 1 && $aUser[0]->checkPassword($auth['password'])) {
    			$this->setSession('user', $aUser[0]);
	            $this->response->redirect(($aUser[0]->role == 'admin') ? 'admin' : 'user');
    		} else {
		        $this->flash->error("Hi, '{$auth['login']}'. Are you registered?");
    		}
    	}
    }

    public function registerAction()
    {
        if ($this->request->isPost()) {
            $user = new Users();

            $user->setLogin($this->request->getPost('login'));
            $user->setName($this->request->getPost('name'));
            $user->setEmail($this->request->getPost('email'));
            $user->setPassword($this->request->getPost('password'));
            $user->setRole($this->request->getPost('role'));
            $user->setIsActive(1);

            $keep = $user->save();

            if ($keep) {
                $this->response->redirect(($user->role == 'admin') ? 'admin' : 'user');
            } else {
                $this->flash->error(implode(", ", $user->getMessages()));
            }
        }
    }

    public function logoutAction()
    {
        $this->setSession('user', null);
        $this->response->redirect('/');
    }

    public function domesticAction()
    {
        $this->dispatcher->forward(['controller' => 'index', 'action' => 'index']);
    }
    public function worldAction()
    {
        $this->dispatcher->forward(['controller' => 'index', 'action' => 'index']);
    }

    public function show404Action()
    {
    }

}

