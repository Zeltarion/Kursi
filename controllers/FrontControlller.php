<?php
 class FrontController
 {
     private $pathC;
     private $tf;
     private $pathV;

     public function __construct($pathToControllers, $tf, $pathToViews)
     {
         $this->pathC = $pathToControllers;
         $this->tf = $tf;
         $this->pathV = $pathToViews;

     }

     private function getController($nameControllers)
     {
       if (file_exists($this->pathC . 'Controller.php'))
       {
        require_once($this->pathC . 'Controller.php');
        if ($nameControllers == 'null')
        {
         if (file_exists($this->pathC . 'DefaultController.php'))
         {
          require_once($this->pathC . 'DefaultController.php');
          return new DefaultController($this->tf,$this->pathV);
         }
         else
         {
          throw new Exception('Файл ' . $this->pathC . 'DefaultController.php' . ' не найден!');
         }
        }
        else
        {
         $nameControllers = ucwords($nameControllers);
         if (file_exists($this->pathC . $nameControllers . 'Controller.php'))
         {
          require_once($this->pathC . $nameControllers . 'Controller.php');
          $nameControllers.='Controller';
          $a=new $nameControllers($this->tf,$this->pathV);
          return $a;
         }
         else
         {
          throw new Exception('Файл ' . $this->pathC . $nameControllers . 'Controller.php' . ' не найден!');
         }
        }
       }
       else
       {
        throw new Exception('Файл ' . $this->pathC . 'Controller.php' . ' не найден!');
       }
     }

     public function dispatch(Request $r) {
         $c = $this->getController($r->getParam('cntr'));
         $method = $r->getParam('action');
         if (method_exists($c,$method)) {
             $c->{$method}($r);
         } else {
             throw new Exception('Метод '.$method.' не найден!');
         }
     }

 }
?>