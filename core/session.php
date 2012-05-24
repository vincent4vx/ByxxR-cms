<?php
class session
{
    private $logged = false;
    private $admin = false;
    private $super_admin = false;
    private $account;
    private $pseudo;
    private $level;
    private $id;
    
    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['time']))
        {
            $_SESSION['time'] = time();
        }
        if(($_SESSION['time'] + $GLOBALS['config']['destr_session_time']) <= time())
        {
            $this->logout();
        }
        if(($_SESSION['time'] + $GLOBALS['config']['update_session_time']) <= time())
        {
            $_SESSION['time'] = time();
        }
        if(!empty($_SESSION['account']))
        {
            $this->logged = true;
            $this->loadData();
        }
    }
    
    public function login($accountData)
    {
        if(!$this->logged)
        {
            $_SESSION += $accountData;
            $this->logged = true;
            $this->loadData();
            return true;
        }else
        {
            return false;
        }
    }
    
    public function logout()
    {
        session_destroy();
        $this->logged = false;
        $this->loadData();
    }

    private function loadData()
    {
        if($this->logged)
        {
            $this->account =& $_SESSION['account'];
            $this->id =& $_SESSION['guid'];
            $this->level =& $_SESSION['level'];
            $this->pseudo =& $_SESSION['pseudo'];
            $this->super_admin = $this->id == $GLOBALS['config']['admin']['super_admin'];
            $this->admin = $this->level >= $GLOBALS['config']['admin']['level'];
            if($this->super_admin)
            {
                $this->admin = true;
            }
        }else
        {
            $this->account = null;
            $this->id = null;
            $this->level = null;
            $this->admin = false;
            $this->super_admin = false;
        }
    }
    
    /*
     * getters et setters
     */
    
    public function getAccount()
    {
        return $this->account;
    }
    
    public function getPseudo()
    {
        return $this->pseudo;
    }


    public function getId()
    {
        return $this->id;
    }
    
    public function getLevel()
    {
        return $this->level;
    }


    public function isLog()
    {
        return $this->logged;
    }
    
    public function isAdmin()
    {
        return $this->admin;
    }
    
    public function superAdmin()
    {
        return $this->super_admin;
    }
    
    public function set($var, $value)
    {
        $_SESSION[$var] = $value;
    }
    
    public function dec($var)
    {
        if(isset($_SESSION[$var]))
        {
            $_SESSION[$var] = $_SESSION[$var] - 1;
            return $_SESSION[$var];
        }else
        {
            return false;
        }
    }


    public function get($var)
    {
        if(isset($_SESSION[$var]))
        {
            return $_SESSION[$var];
        }else
        {
            return false;
        }
    }
    
    public function destroy($var)
    {
        unset($_SESSION[$var]);
    }
}
