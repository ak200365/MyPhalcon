<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

use Phalcon\Acl\Enum As AclEnum;
use Phalcon\Acl\Adapter\Memory As AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Component;


// class Security extends \Phalcon\Mvc\User\Plugin
class Security extends \Phalcon\Di\Injectable
{
    private $aclFile = null;
    
    public function setAclFile($aclFile)
    {
        $this->aclFile = $aclFile;
    }
    
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $user = $this->session->get('user');
        $role = (!$user) ? 'guest' : $user->role;
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        $acl = $this->_getAcl();
        $allowed = $acl->isAllowed($role, $controller, $action);
        if ($allowed != AclEnum::ALLOW) {
            $this->flash->error("You don't have access to c:$controller.a:$action ($role).");
            $dispatcher->forward(['controller' => 'index', 'action' => 'index']);
            return false; // говорим диспечеру остановить текущую
        }
    }

    private function _getAcl()
    {
        // global $config;
        
        // if (!file_exists($config->application->aclFile)) {
        if (empty($this->aclFile) || !file_exists($this->aclFile)) {
            $acl = new AclList();

            $roleUser = new Role('user');
            $roleAdmin = new Role('admin');

            $acl->addRole('guest');
            $acl->addRole($roleUser);
            // $acl->addRole($roleAdmin, $roleUser);
            $acl->addRole($roleAdmin);

            $admin = new Component('admin', 'Administration Pages');
            $user = new Component('user', 'User Pages');
            $guest = new Component('index', 'Common Pages');

            $acl->addComponent($admin, ['index', 'health', 'opinion', 'science']);
            $acl->addComponent($user, ['index', 'technology', 'design', 'business']);
            $acl->addComponent($guest, ['index', 'login', 'logout', 'register']);

            $acl->setDefaultAction(AclEnum::ALLOW);
            $acl->deny('guest', $admin, '*');
            $acl->deny('guest', $user, '*');
            $acl->deny('user', $admin, '*');
            $acl->deny('admin', $admin, 'health');
            
            file_put_contents($this->aclFile, serialize($acl));
        } else {
            $acl = unserialize(file_get_contents($this->aclFile));
        }

        return $acl;
    }
}