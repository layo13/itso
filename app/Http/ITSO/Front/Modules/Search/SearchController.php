<?php

namespace Http\Itso\Front\Modules\Search;

use Epic\BaseController;

class SearchController extends BaseController {

    public function indexAction() {
        $url = URL;
        $app = $this->application;
        $user = $app->user();
        require ROOT . '/public/views/front/search/index.php';
    }

    public function execAction() {
        header('Content-Type: application/json; charset=utf-8');
        $query = $this->request()->post('query');
        if (strlen($query) < 3) {
            return json_encode([]);
        } else {
            $json = [];

            $sql = <<<SQL
SELECT `user`.`id`, CONCAT(`user`.`first_name`, ' ', `user`.`last_name`) as `name`, `picture`.`name` as `picture`, 'user' as `type`
FROM `user` LEFT JOIN `picture` ON (`user`.`picture_id` = `picture`.`id`)
WHERE (`user`.`first_name` LIKE CONCAT('%', ?, '%')
	OR `user`.`last_name` LIKE CONCAT('%', ?, '%')
	OR CONCAT(`user`.`first_name`, ' ', `user`.`last_name`) LIKE CONCAT('%', ?, '%')
	OR CONCAT(`user`.`last_name`, ' ', `user`.`first_name`) LIKE CONCAT('%', ?, '%')
)
AND `user`.`user_type_id` = 2
SQL;
            //UNION
            //SELECT `brand`.`id`, `brand`.`name` as `name`, `picture`.`name` as `picture`, 'brand' as `type`
            //FROM `brand` LEFT JOIN `picture` ON (`brand`.`picture_id` = `picture`.`id`)
            //WHERE `brand`.`name` LIKE CONCAT('%', ?, '%')

            $stmt = $this->pdo()->prepare($sql);
            $stmt->execute([$query, $query, $query, $query, $query]);
            $results = $stmt->fetchAll();

            foreach ($results as $result) {
                $json[] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'picture' => $result['picture'],
                    'type' => $result['type']
                ];
            }
            return json_encode($json);
        }
    }

}
