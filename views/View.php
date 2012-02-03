<?php
class View
{
    private $view;

    public function __construct($view) {
        $this->view = $view;
    }

    public function render_view($data)
    {
     if(!empty($data))
     {
      foreach ($data as $nameParam => $value)
      {
        $$nameParam=$value;
          //echo $nameParam.'</br>'.$value;
      }
     }
        $html='';
        if (file_exists($this->view))
        {
            ob_start();
            require_once($this->view);
            $html=ob_get_contents();
            ob_end_clean();
        }
        return $html;
    }
}
?>