<?php

namespace Manager;

class SelectionManager {

    /**
     *
     * @var \PDO 
     */
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        $selections = $this->pdo->query("SELECT * FROM `selection`")->fetchAll();

        for ($i = 0; $i < count($selections); ++$i) {
            $selection = $selections[$i];
            $selectionId = $selection['id'];

            if ($selection['target'] == 'user') {
                $selection['items'] = $this->pdo->query(<<<SQL
SELECT `user`.*, `picture`.`name` as `picture`
FROM `selection_user`
INNER JOIN `user` ON (`selection_user`.`user_id` = `user`.`id`)
LEFT JOIN `picture` ON (`user`.`picture_id` = `picture`.`id`)
WHERE `selection_user`.`selection_id` = $selectionId
SQL
                    )->fetchAll();
            } else if ($selection['target'] == 'product') {
                $selection['items'] = $this->pdo->query("SELECT `product`.* FROM `selection_product` LEFT JOIN `product` ON (`selection_product`.`product_id` = `product`.`id`) WHERE `selection_product`.`selection_id` = " . $selection['id'])->fetchAll();

                for ($j = 0; $j < count($selection['items']); ++$j) {
                    $product = $selection['items'][$j];

                    $picture = $this->pdo->query("SELECT `picture`.* FROM `product_picture` LEFT JOIN `picture` ON (`product_picture`.`picture_id` = `picture`.`id`) WHERE `product_picture`.`product_id` = " . $product['id'])->fetch();
                    $product['picture'] = $picture['name'];

                    $selection['items'][$j] = $product;
                }
            } else {
                exit(__FILE__ . '::' . __LINE__);
            }
            $selections[$i] = $selection;
        }
        return $selections;
    }

}
