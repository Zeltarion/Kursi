<?php

class Controller
{
    protected $tf;
    protected $pathToViews;

    public function __construct($tf, $pathToViews)
    {
        $this->tf = $tf;
        $this->$pathToViews = $pathToViews;
    }

    public function redirect($controller, $action, $param) {
        $url = '?';
        if (isset($controller) && !empty($controller)) {
            $url.='cntr=' . $controller;
        }
        if (isset($action) && !empty($action)) {
            $url.='&action=' . $action;
        }
        if (isset($param) && !empty($param)) {
            $url.='&' . $param;
        }
        header('Location: ' . $url);
        exit;
    }

    public function arrayfieldsIsset() {
        $arrayfields = array();
        return $arrayfields;
    }

    public function controlParam($param, $controller, $action, $param) {
        if (!isset($param) || empty($param)) {
            parent::redirect($controller, $action, $param);
        }
    }

    public function getViewName($view)
    {
        return $this->pathToViews.$view.'.php';
    }

}

?>