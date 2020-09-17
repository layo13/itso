<?php

namespace Console;

use Epic\Console\Command;

class BuildSelections extends Command {

    const PRODUCTS_MOST_LIKED = 'most_liked';
    const PRODUCTS_MOST_SOLD = 'most_sold';
    const PRODUCTS_MOST_PROFITABLE = 'most_profitable';
    const CELEBRITIES_MOST_FOLLOWED = 'most_followed';
    const CELEBRITIES_WITH_MOST_PRODUCTS = 'with_most_products';
    const CELEBRITIES_WITH_MOST_FAVORITES = 'with_most_favorites';

    public function exec() {
        $celebrityTypes = $this->getCelebrityTypes();

        foreach ($celebrityTypes as $celebrityType) {
            switch ($celebrityType) {
                case self::CELEBRITIES_MOST_FOLLOWED:
                    $this->processMostFollowed();

                    break;
                case self::CELEBRITIES_WITH_MOST_PRODUCTS:
                    $this->processWithMostProducts();
                    break;
                case self::CELEBRITIES_WITH_MOST_FAVORITES:
                    $this->processWithMostFavorites();
                    break;
                default:exit(__FILE__ . '::' . __LINE__);
                    break;
            }
        }

        $productTypes = $this->getProductTypes();
        foreach ($productTypes as $productType) {
            switch ($productType) {
                case self::PRODUCTS_MOST_LIKED: $this->processMostLiked();
                    break;
                case self::PRODUCTS_MOST_SOLD: $this->processMostSold();
                    break;
                case self::PRODUCTS_MOST_PROFITABLE: $this->processMostProfitable();
                    break;

                default:exit(__FILE__ . '::' . __LINE__);
                    break;
            }
        }
    }

    private function getProductTypes() {
        return [
            self::PRODUCTS_MOST_LIKED,
            //self::PRODUCTS_MOST_SOLD,
            //self::PRODUCTS_MOST_PROFITABLE,
        ];
    }

    private function getCelebrityTypes() {
        return [
            self::CELEBRITIES_MOST_FOLLOWED,
            self::CELEBRITIES_WITH_MOST_PRODUCTS,
            //self::CELEBRITIES_WITH_MOST_FAVORITES,
        ];
    }
    
    private function getSelectionLabel($type) {
        switch ($type) {
            case self::PRODUCTS_MOST_LIKED : $label = 'Produits les plus likés'; break;
            case self::PRODUCTS_MOST_SOLD : $label = 'Produits les plus vendus'; break;
            case self::PRODUCTS_MOST_PROFITABLE : $label = 'Produits les plus rentables'; break;
            case self::CELEBRITIES_MOST_FOLLOWED : $label = 'Personnalités les plus suivies'; break;
            case self::CELEBRITIES_WITH_MOST_PRODUCTS : $label = 'Personnalités avec la plus belle penderie'; break;
            case self::CELEBRITIES_WITH_MOST_FAVORITES : $label = 'Personnalités avec le plus de sélections'; break;
            default:exit(__FILE__ . '::' . __LINE__); break;
        }
        return $label;
    }

    private function getSelectionId($type) {
        $stmt = $this->pdo->prepare("SELECT * FROM `selection` WHERE `target` LIKE :target AND `type` LIKE :type");

        switch ($type) {
            case self::PRODUCTS_MOST_LIKED :
            case self::PRODUCTS_MOST_SOLD :
            case self::PRODUCTS_MOST_PROFITABLE : $target = 'product';
                break;
            case self::CELEBRITIES_MOST_FOLLOWED :
            case self::CELEBRITIES_WITH_MOST_PRODUCTS :
            case self::CELEBRITIES_WITH_MOST_FAVORITES : $target = 'user';
                break;
            default:exit(__FILE__ . '::' . __LINE__);
                break;
        }

        $stmt->execute([
            ':target' => $target,
            ':type' => $type,
        ]);

        $selection = $stmt->fetch();

        if ($selection) {
            $selectionId = $selection['id'];
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO `selection` (`label`, `target`, `type`, `state`, `active`) VALUES (:label, :target, :type, :state, :active)");

            $stmt->execute([
                ':label' => $this->getSelectionLabel($type),
                ':target' => $target,
                ':type' => $type,
                ':state' => 1,
                ':active' => 1,
            ]);

            $selectionId = $this->pdo->lastInsertId();
        }
        return $selectionId;
    }

    private function processMostFollowed() {

        $selectionId = $this->getSelectionId(self::CELEBRITIES_MOST_FOLLOWED);

        $stmt = $this->pdo->prepare("DELETE FROM selection_user WHERE selection_id = :id");
        $stmt->execute([':id' => $selectionId]);

        $results = $this->pdo->query(<<<SQL
SELECT `subscription`.`celebrity_id`, COUNT(`subscription`.`member_id`)
FROM `subscription`
GROUP BY `subscription`.`celebrity_id`
ORDER BY COUNT(`subscription`.`member_id`) DESC
LIMIT 10
SQL
            )->fetchAll();

        $celebrityIds = [];

        foreach ($results as $result) {
            $celebrityIds[] = (int) $result['celebrity_id'];
        }

        $this->linkSelection($selectionId, $celebrityIds, 'user');

        /*
          SELECT `user`.`id`, COUNT(`subscription`.`member_id`)
          FROM `user`
          RIGHT JOIN `subscription` ON (`user`.`id` = `subscription`.`celebrity_id`)
          WHERE `user`.`user_type_id` = 2
          GROUP BY `user`.`id`
          ORDER BY COUNT(`subscription`.`member_id`) DESC
          LIMIT 10
         */
    }

    private function processWithMostProducts() {
        $selectionId = $this->getSelectionId(self::CELEBRITIES_WITH_MOST_PRODUCTS);

        $stmt = $this->pdo->prepare("DELETE FROM selection_user WHERE selection_id = :id");
        $stmt->execute([':id' => $selectionId]);

        $results = $this->pdo->query(<<<SQL
SELECT `user_product`.`user_id`, COUNT(`user_product`.`product_id`)
FROM `user_product`
GROUP BY `user_product`.`user_id`
ORDER BY COUNT(`user_product`.`product_id`) DESC
LIMIT 10
SQL
            )->fetchAll();

        $userIds = [];

        foreach ($results as $result) {
            $userIds[] = (int) $result['user_id'];
        }

        $this->linkSelection($selectionId, $userIds, 'user');
    }

    private function processWithMostFavorites() {
        exit(__METHOD__ . ' must be implemented');
    }

    private function processMostLiked() {

        $selectionId = $this->getSelectionId(self::PRODUCTS_MOST_LIKED);

        $stmt = $this->pdo->prepare("DELETE FROM selection_product WHERE selection_id = :id");
        $stmt->execute([':id' => $selectionId]);

        $results = $this->pdo->query(<<<SQL
SELECT `liked`.`product_id`, COUNT(`liked`.`user_id`)
FROM `liked`
GROUP BY `liked`.`product_id`
ORDER BY COUNT(`liked`.`user_id`) DESC
LIMIT 10
SQL
            )->fetchAll();

        $productIds = [];

        foreach ($results as $result) {
            $productIds[] = (int) $result['product_id'];
        }

        $this->linkSelection($selectionId, $productIds, 'product');
    }

    private function processMostSold() {
        exit(__METHOD__ . ' must be implemented');
    }

    private function processMostProfitable() {
        exit(__METHOD__ . ' must be implemented');
    }

    private function linkSelection($selectionId, array $ids, $target) {
        var_dump($selectionId, $ids, $target);
        // selection_user selection_product

        if ($target == 'user') {
            $stmt = $this->pdo->prepare('INSERT INTO selection_user (selection_id, user_id) VALUES (:selection_id, :user_id)');
        } else if ($target == 'product') {
            $stmt = $this->pdo->prepare('INSERT INTO selection_product (selection_id, product_id) VALUES (:selection_id, :product_id)');
        } else {
            exit(__FILE__ . '::' . __LINE__);
        }

        foreach ($ids as $id) {
            if ($target == 'user') {
                $stmt->execute([':selection_id' => $selectionId, ':user_id' => $id]);
            } else if ($target == 'product') {
                $stmt->execute([':selection_id' => $selectionId, ':product_id' => $id]);
            } else {
                exit(__FILE__ . '::' . __LINE__);
            }
        }
    }

}
