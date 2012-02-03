<?php

class DefaultController extends BlogController {

    public function __construct($tf, $pathToViews) {
        parent:: __construct($tf, $pathToViews);
    }

    public function null(Request $r) {
        $p = '';
        if(!$this->notificationsList){$p = 'default page';}
           echo $this->render('IndexView', $p);
    }

    public function message(Request $r) {
        $textMessage = $r->getParam('text');
        switch ($textMessage) {
            case 'authRequired':
                $this->notificationsList[] = 'Для выполнения этого действия пользователь должен быть авторизированным';
            case 'nopost':
                $this->notificationsList[] = 'Указанный пост не найден';
            case 'noedit':
                $this->notificationsList[] = 'Отсутствуют основные данные. Изменения не сохранены';
        }
        $this->null($r);
    }
}

?>