<?php

namespace Http\Itso\Admin\Modules\Selection;

use Epic\BaseController;

class SelectionController extends BaseController {

    public function listAction() {
        $url = URL;
        $app = $this->application;

        $selectionManager = new \Manager\SelectionManager($this->pdo());

        $selections = $selectionManager->all();

        require ROOT . '/public/views/admin/selection/list.php';
    }

}
