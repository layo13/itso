<?php

namespace Http\Itso\Front\Modules\Home;

use Epic\BaseController;

class HomeController extends BaseController {

    public function indexAction() {
        $url = URL;
        $app = $this->application;
        $user = $app->user();

        $pdo = \PdoProvider::getInstance();
         
        $selectionManager = new \Manager\SelectionManager($pdo);

        $selections = $selectionManager->all();
        require ROOT . '/public/views/front/home/index.php';
    }

}
