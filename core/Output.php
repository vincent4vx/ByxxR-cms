<?php

class Output {

    protected $contents = '';
    protected $_vars = array();
    protected $cache_id;
    protected $cache_vars = array();
    protected $cache_on = false;
    protected $ext = null;
    public $layout = 'layouts/layout';

    /**
     * The current session
     * @var Session
     */
    protected $session;

    /**
     * the current instance
     * @var Core
     */
    protected $_instance;

    public function __construct() {
        $this->_instance = & Core::get_instance();
        $this->session = & $this->_instance->loader->get('Session');
        ob_start();
    }

    /**
     * Add string into contents
     * @param string $contents
     */
    public function add($contents) {
        if ($this->cache_on)
            $this->cache_contents.=$contents;
        else
            $this->contents.=$contents;
    }

    /**
     * Add a content in the header inclusion
     * @param mixed $var
     */
    public function addHeaderInc($var) {
        if (!is_array($var))
            $this->headerInc.=$var;
        else
            $this->headerInc.=implode($var);
    }

    public function addFooterInc($var) {
        if (!is_array($var))
            $this->footerInc .= $var;
        else
            $this->footerInc .= implode($var);
    }

    public function __get($name) {
        if (isset($this->_vars[$name]))
            return $this->_vars[$name];
    }

    public function __set($name, $value) {
        $this->_vars[$name] = $value;
        if ($this->cache_on)
            $this->cache_vars[$name] = $value;
    }

    public function view($file, array $vars = array()) {
        $tpl = APP . 'views/' . $file;

        $tpl .= $this->getExt() . EXT;

        if (!file_exists($tpl))
            throw new BException('Template "' . $tpl . '" inexistant !');

        extract($vars);
        include $tpl;
    }

    public function error_404() {
        header('HTTP/1.1 404 Not Found');
        $this->view('statuts/error_404');
    }

    public function display() {
        
        header('Content-Type: '.Mimes::ext2mime($this->getExt()).'; charset=utf-8');
        
        $this->contents = ob_get_clean();
        if (empty($this->contents))
            return;

        if (!empty($this->layout)) {
            $file = APP . 'views/' . $this->layout;
            $file .= $this->getExt() . EXT;

            if (file_exists($file))
                return require $file;
        }
        echo $this->contents;
    }

    public function startCache($id) {
        $data = $this->_instance->loader->get('Cache')->get('pages.' . $id);
        if ($data === null || DEBUG) {
            ob_start();
            $this->cache_on = true;
            $this->cache_id = 'pages.' . $id;
            return true;
        }
        echo $data['contents'];
        $this->_vars+=$data['vars'];
        return false;
    }

    public function endCache($time = 60) {
        echo $contents = ob_get_clean();
        Core::get_instance()->loader->get('Cache')->set(
                $this->cache_id, array(
            'vars' => $this->cache_vars,
            'contents' => $contents
                ), $time
        );
    }

    public function getExt() {
        if ($this->ext === null) {
            $this->ext = $this->_instance->loader->get('Router')->ext;
        }

        return $this->ext;
    }

}
