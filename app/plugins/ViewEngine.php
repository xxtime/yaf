<?php
/**
 * Class ViewsEnginePlugin
 * @see https://twig.symfony.com/doc/2.x/templates.html
 * @link http://www.laruence.com/manual/yaf.class.view.html
 * @link http://www.laruence.com/manual/yaf.class.dispatcher.setView.html
 */


class ViewEnginePlugin implements Yaf_View_Interface
{

    public $twig;

    protected $_tpl_vars = [];

    protected $_script_path;

    public function __construct($config)
    {
        $loader = new Twig_Loader_Filesystem($config['path']);
        $this->twig = new Twig_Environment($loader, array(
            'cache'       => $config['cache'],
            'auto_reload' => true,
            //'debug' => true
        ));
    }

    public function render($tpl, $tpl_vars = null)
    {
        if (is_array($tpl_vars)) {
            $this->_tpl_vars = array_merge($tpl_vars, $this->_tpl_vars);
        }
        echo $this->twig->render($tpl, $this->_tpl_vars);
        exit;
    }

    public function display($tpl, $tpl_vars = null)
    {
        $this->render($tpl, $tpl_vars);
    }

    public function assign($name, $value = null)
    {
        $this->_tpl_vars[$name] = $value;
    }

    public function setScriptPath($template_dir)
    {
        $this->_script_path = $template_dir;
    }

    public function getScriptPath()
    {
        return $this->_script_path;
    }

}
