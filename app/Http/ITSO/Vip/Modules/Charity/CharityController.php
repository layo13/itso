<?php

namespace Http\Itso\Vip\Modules\Charity;

use Epic\BaseController;

class CharityController extends BaseController {

	public function updateAction() {
        $url = URL;
        $app = $this->application;

        $q = $this->pdo()->query("SELECT * FROM user where id = " . $app->user()->getAttribute('id'));
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT charity_association.*, picture.name  as charity_picture FROM charity_association LEFT JOIN picture ON (picture.id = charity_association.picture_id) order by charity_association.name");
        $imgCharity = '';
        $nb = 0;
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $charities[$nb]['id'] = $datas['id'];
            $charities[$nb]['name'] = $datas['name'];

            if($datas['id'] == $user['charity_id']){
                $imgCharity = $url."public/assets/images/charity_association/".$datas['charity_picture'];
            }
            if(!empty($datas['charity_picture'])){
                $charities[$nb]['charity_picture'] = $url."public/assets/images/charity_association/".$datas['charity_picture'];
            }else{
                $charities[$nb]['charity_picture'] = "";
            }
            $nb++;
        }
        if(!empty($charities[0]['charity_picture']) && empty($imgCharity)) {
            $imgCharity = $url . "public/assets/images/charity_association/" . $charities[0]['charity_picture'];
        }
        require ROOT . '/public/views/vip/charity/update.php';
	}

	public function editAction() {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT * FROM user where id = " . $app->user()->getAttribute('id'));
        $user = $q->fetch(\PDO::FETCH_ASSOC);
        $updated_at = $user['updated_at'];
        $charity_id = intval($_REQUEST['formContactCharity']);
        $id = $user['id'];

        $sqlUpdateUser ="UPDATE `user` SET updated_at = ?, charity_id = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$updated_at,$charity_id ,$id]);

        redirect($app->router()->getRoute('vip_charity_choice'));
	}

	public function listAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT charity_association.*, picture.name as charity_picture FROM charity_association LEFT JOIN picture ON (picture.id = charity_association.picture_id)");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
			$charities[] = $datas;
		}
		require ROOT . '/public/views/vip/charity/index.php';
	}

	public function viewAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT charity_association.*,picture.name as charity_picture FROM charity_association LEFT JOIN picture ON (picture.id = charity_association.picture_id) where id = " . intval($GLOBALS['matches'][0]));
		$charity = $q->fetch(\PDO::FETCH_ASSOC);
        require ROOT . '/public/views/vip/charity/view.php';
	}

}
