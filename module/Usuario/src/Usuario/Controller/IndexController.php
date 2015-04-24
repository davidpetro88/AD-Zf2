<?php
namespace Usuario\Controller;

// Authentication with Remember Me
// http://samsonasik.wordpress.com/2012/10/23/zend-framework-2-create-login-authentication-using-authenticationservice-with-rememberme/
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuario\Entity\Usuario; // only for the filters
use Usuario\Form\LoginForm; // <-- Add this import
use Usuario\Form\LoginFilter;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $em = $this->getEntityManager();
        
        $usuario = $em->getRepository('Usuario\Entity\Usuario')->findAll();
        
        $message = $this->params()->fromQuery('message', 'foo');
        
        return new ViewModel(array(
            'message' => $message,
            'users' => $usuario
        ));
        // 'myUsers' => $myUsers
    }

    public function loginAction()
    {
        //change layout
        $this->layout('layout/custom');

        $form = new LoginForm();
        $form->get('submit')->setValue('Login');
        $messages = null;
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            // Filters have been fixed
            $form->setInputFilter(new LoginFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $data = $form->getData();
                // $data = $this->getRequest()->getPost();
                
                // If you used another name for the authentication service, change it here
                // it simply returns the Doctrine Auth. This is all it does. lets first create the connection to the DB and the Entity
                $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                // Do the same you did for the ordinar Zend AuthService
                $adapter = $authService->getAdapter();
                $adapter->setIdentityValue($data['nome']); // $data['usr_name']
                
                $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $user = $entityManager->getRepository('Usuario\Entity\Usuario')->findOneBy(array(
                    'nome' => $data['nome']
                )); //
                $password = $data['password'];
                $passwordHash = $this->encriptPassword($this->getStaticSalt(), $password, $user->getPasswordsalt());
                $user->setPassword($passwordHash);
                
                $adapter->setCredentialValue($user->getPassword()); // $data['usr_password']
                $authResult = $authService->authenticate();
                
                // $adapter->setCredentialValue($data['password']); // $data['usr_password']
                $authResult = $authService->authenticate();
                
                // echo "<h1>I am here</h1>";
                if ($authResult->isValid()) {
                    $identity = $authResult->getIdentity();
                    $authService->getStorage()->write($identity);
                    
                    $time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
                                     // - if ($data['rememberme']) $authService->getStorage()->session->getManager()->rememberMe($time); // no way to get the session
                    if ($data['rememberme']) {
                        $sessionManager = new \Zend\Session\SessionManager();
                        $sessionManager->rememberMe($time);
                    }
                    // - return $this->redirect()->toRoute('home');
                }
                
                foreach ($authResult->getMessages() as $message) {
                    $messages .= "$message\n";
                }
            }
            
            
            return $this->redirect()->toRoute('home');
            
        }

        return new ViewModel(array(
            'error' => 'Your authentication credentials are not valid',
            'form' => $form,
            'messages' => $messages
        ));
        
        //echo $this->url('home')
    }

    public function logoutAction()
    {
        // in the controller
        // $auth = new AuthenticationService();
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        
        // @todo Set up the auth adapter, $authAdapter
        
        if ($auth->hasIdentity()) {
            // Identity exists; get it
            $identity = $auth->getIdentity();
        }
        $auth->clearIdentity();
        // - $auth->getStorage()->session->getManager()->forgetMe(); // no way to get to the sessionManager from the storage
        $sessionManager = new \Zend\Session\SessionManager();
        $sessionManager->forgetMe();
        
        return $this->redirect()->toRoute('index/auth');
//         return $this->redirect()->toRoute('index', array(
//             'controller' => 'index',
//             'action' => 'auth'
//         ));
    }

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function generateDynamicSalt()
    {
        $dynamicSalt = '';
        for ($i = 0; $i < 50; $i ++) {
            $dynamicSalt .= chr(rand(33, 126));
        }
        return $dynamicSalt;
    }

    public function getStaticSalt()
    {
        $staticSalt = '';
        $config = $this->getServiceLocator()->get('Config');
        $staticSalt = $config['static_salt'];
        return $staticSalt;
    }

    public function encriptPassword($staticSalt, $password, $dynamicSalt)
    {
        return $password = md5($staticSalt . $password . $dynamicSalt);
    }

    public function generatePassword($l = 8, $c = 0, $n = 0, $s = 0)
    {
        // get count of all required minimum special chars
        $count = $c + $n + $s;
        $out = '';
        // sanitize inputs; should be self-explanatory
        if (! is_int($l) || ! is_int($c) || ! is_int($n) || ! is_int($s)) {
            trigger_error('Argument(s) not an integer', E_USER_WARNING);
            return false;
        } elseif ($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
            trigger_error('Argument(s) out of range', E_USER_WARNING);
            return false;
        } elseif ($c > $l) {
            trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
            return false;
        } elseif ($n > $l) {
            trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
            return false;
        } elseif ($s > $l) {
            trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
            return false;
        } elseif ($count > $l) {
            trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
            return false;
        }
        
        // all inputs clean, proceed to build password
        
        // change these strings if you want to include or exclude possible password characters
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $caps = strtoupper($chars);
        $nums = "0123456789";
        $syms = "!@#$%^&*()-+?";
        
        // build the base password of all lower-case letters
        for ($i = 0; $i < $l; $i ++) {
            $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        
        // create arrays if special character(s) required
        if ($count) {
            // split base password to array; create special chars array
            $tmp1 = str_split($out);
            $tmp2 = array();
            
            // add required special character(s) to second array
            for ($i = 0; $i < $c; $i ++) {
                array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
            }
            for ($i = 0; $i < $n; $i ++) {
                array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
            }
            for ($i = 0; $i < $s; $i ++) {
                array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
            }
            
            // hack off a chunk of the base password array that's as big as the special chars array
            $tmp1 = array_slice($tmp1, 0, $l - $count);
            // merge special character(s) array with base password array
            $tmp1 = array_merge($tmp1, $tmp2);
            // mix the characters up
            shuffle($tmp1);
            // convert to string for output
            $out = implode('', $tmp1);
        }
        
        return $out;
    }
}