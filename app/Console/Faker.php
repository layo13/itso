<?php

namespace Console;

use Epic\Console\Command;

class Faker extends Command {

    public function exec() {
        //$this->fakeUsers();
        //$this->fakeProducts();
        //$this->fakeLinks();
        //$this->fakeSubscriptions();
        $this->fakeLiked();
    }

    private function fakeUsers() {
        $pdo = $this->pdo;

        $pdo->exec("DELETE FROM picture WHERE name LIKE 'RAND-%'");

        $dirname = __DIR__ . '/public/assets/images/user';

        $scandir = scandir($dirname);

        foreach ($scandir as $element) {
            if (substr($element, 0, strlen('RAND-')) == 'RAND-') {
                unlink($dirname . '/' . $element);
            }
        }

        $client = new RandomUser\Client();

        $json = ($client->call([
                Client::PARAM_FORMAT => Client::FORMAT_PRETTY,
                Client::PARAM_NAT => 'FR',
                Client::PARAM_RESULTS => 200,
                Client::PARAM_EXCLUDING => 'location,registered,id,nat,phone,cell',
        ]));

        $randomUsers = json_decode($json);

        $sql = "INSERT INTO `user` (last_name, first_name, day_of_birth, email, password, gender, picture_id, language, nationality, created_at, updated_at, state, active, user_type_id, charity_id) VALUES (:last_name, :first_name, :day_of_birth, :email, :password, :gender, :picture_id, :language, :nationality, :created_at, :updated_at, :state, :active, :user_type_id, :charity_id)";
        $stmt = $pdo->prepare($sql);

        $cachePhotos = [];

        foreach ($randomUsers->results as $randomUser) {

            $pictureName = 'RAND-' . md5($randomUser->email) . '.jpg';
            $filename = $dirname . '/' . $pictureName;

            if (empty($cachePhotos[$randomUser->picture->large])) {
                $data = $cachePhotos[$randomUser->picture->large] = file_get_contents($randomUser->picture->large);
            } else {
                $data = $cachePhotos[$randomUser->picture->large];
            }

            file_put_contents($filename, $data);

            $stmtPicture = $pdo->prepare('INSERT INTO picture (name) VALUES (:name)');
            $stmtPicture->execute([':name' => $pictureName]);
            $pictureId = $pdo->lastInsertId();

            $lastName = $randomUser->name->last;
            $firstName = $randomUser->name->first;
            $dayOfBirth = substr($randomUser->dob->date, 0, 10) . ' ' . substr($randomUser->dob->date, 11, 6);
            $email = $randomUser->email;
            $password = password_hash('password', PASSWORD_BCRYPT);
            $gender = $randomUser->gender == 'female' ? 1 : 2;
            $language = 1;
            $nationality = 1;
            $createdAt = date('Y-m-d H:i:s');
            $updatedAt = date('Y-m-d H:i:s');
            $state = 1;
            $active = 1;
            $userTypeId = rand(1, 10) == 10 ? 2 : 4;
            $charityId = null;

            $stmt->execute([
                ':last_name' => $lastName,
                ':first_name' => $firstName,
                ':day_of_birth' => $dayOfBirth,
                ':email' => $email,
                ':password' => $password,
                ':gender' => $gender,
                ':picture_id' => $pictureId,
                ':language' => $language,
                ':nationality' => $nationality,
                ':created_at' => $createdAt,
                ':updated_at' => $updatedAt,
                ':state' => $state,
                ':active' => $active,
                ':user_type_id' => $userTypeId,
                ':charity_id' => $charityId
            ]);
            var_dump($pdo->lastInsertId() . ' : ' . $firstName . ' ' . $lastName . ' (' . $userTypeId . '/' . $pictureId . ')');
        }
    }

    private function fakeProducts() {

        $pdo = $this->pdo;

        $dirname = __DIR__ . '/../../public/assets/images/product';

        $scandir = scandir($dirname);

        foreach ($scandir as $element) {
            if (substr($element, 0, strlen('RAND-')) == 'RAND-') {
                unlink($dirname . '/' . $element);
            }
        }

        $pdo->exec('DELETE FROM product');
        $pdo->exec('DELETE FROM product_link WHERE product_id NOT IN (SELECT id FROM product)');
        $pdo->exec('DELETE FROM product_picture WHERE product_id NOT IN (SELECT id FROM product)');

        $stmtProduct = $pdo->prepare('INSERT INTO product (name, brand_id, main_color_id, product_type_id, state, active) VALUES (:name, :brand_id, :main_color_id, :product_type_id, :state, :active)');
        $stmtProductLink = $pdo->prepare('INSERT INTO product_link (url, product_id, state, active) VALUES (:url, :product_id, :state, :active)');
        $stmtPicture = $pdo->prepare('INSERT INTO picture (name) VALUES (:name)');
        $stmtProductPicture = $pdo->prepare('INSERT INTO product_picture (product_id, picture_id, created_at) VALUES (:product_id, :picture_id, :created_at)');

        $findItemsByKeywords = new \Ebay\Operation\FindItemsByKeywords();
        $getSingleItem = new \Ebay\Operation\GetSingleItem();

        $recherches = [
            ['chaussures', 'nike'],
            ['t-shirt', 'adidas'],
            ['sweat', 'puma'],
            ['robe', 'channel'],
            //['bracelet', 'dior'],
            ['sac', 'louis', 'vuitton'],
        ];

        foreach ($recherches as $recherche) {

            var_dump($recherche);
            try {
                $products = $findItemsByKeywords->find($recherche, 100);
                sleep(60);
                foreach ($products as $product) {

                    if (empty($product['galleryPlusPictureURL']))
                        continue;

                    try {

                        $stmtProduct->execute([
                            ':name' => $product['title'],
                            ':brand_id' => 3, // Adidas
                            ':main_color_id' => rand(1, 14),
                            ':product_type_id' => 13, // Autre
                            ':state' => 1,
                            ':active' => 1
                        ]);

                        $productId = $pdo->lastInsertId();

                        var_dump("productId $productId");

                        $stmtProductLink->execute([
                            ':url' => $product['viewItemURL'],
                            ':product_id' => $productId,
                            ':state' => 1,
                            ':active' => 1
                        ]);

                        $picture = $product['galleryPlusPictureURL'];

                        $pictureName = 'RAND-' . md5($picture) . '.jpg';
                        $filename = $dirname . '/' . $pictureName;

                        $data = file_get_contents($picture);

                        file_put_contents($filename, $data);

                        $stmtPicture->execute([':name' => $pictureName]);
                        $pictureId = $pdo->lastInsertId();

                        var_dump("pictureId $pictureId");

                        $stmtProductPicture->execute([
                            ':product_id' => $productId,
                            ':picture_id' => $pictureId,
                            ':created_at' => date('Y-m-d H:i:s')
                        ]);
                    } catch (Exception $e) {
                        var_dump($e->getMessage());
                    }
                }
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    private function fakeSubscriptions() {
        $influencers = $this->pdo->query("SELECT * FROM user WHERE user_type_id = 2")->fetchAll();
        $members = $this->pdo->query("SELECT * FROM user WHERE user_type_id = 4")->fetchAll();

        foreach ($influencers as $influencer) {
            foreach ($members as $member) {

                if (rand(1, 5) == 1) {
                    if (0 == $this->pdo->query("SELECT COUNT(*) FROM subscription WHERE celebrity_id = " . $influencer['id'] . " AND member_id = " . $member['id'])->fetchColumn()) {
                        $stmt = $this->pdo->prepare("INSERT INTO subscription (celebrity_id, member_id) VALUES (:celebrity_id, :member_id)");
                        var_dump($stmt->execute([
                                ':celebrity_id' => $influencer['id'],
                                ':member_id' => $member['id']
                        ]));
                    }
                }
            }
        }
    }

    private function fakeLiked() {
        $products = $this->pdo->query("SELECT * FROM product WHERE id IN (SELECT product_id FROM product_picture)")->fetchAll();
        $members = $this->pdo->query("SELECT * FROM user WHERE user_type_id = 4")->fetchAll();

        foreach ($members as $member) {
            foreach ($products as $product) {
                if (rand(1, 10) == 1) {
                    if (0 == $this->pdo->query("SELECT COUNT(*) FROM liked WHERE product_id = " . $product['id'] 
                        . " AND user_id = " . $member['id'])->fetchColumn()) {
                        $stmt = $this->pdo->prepare("INSERT INTO liked (product_id, user_id, state) VALUES (:product_id, :user_id, :state)");
                        var_dump($stmt->execute([
                                ':product_id' => $product['id'],
                                ':user_id' => $member['id'],
                                ':state' => 1
                        ]));
                    }
                }
            }
        }
    }

    private function fakeLinks() {
        $filename = ROOT . '/db/products_ebay.json';
        $json = file_get_contents($filename);
        $products = json_decode($json);

        $influencers = $this->pdo->query("SELECT * FROM user WHERE user_type_id = 2")->fetchAll();
        $j = 0;

        for ($i = 0; $i < count($products); $i++) {

            if ($j > count($influencers) - 1) {
                $j = 0;
            }

            $product = $products[$i];
            $influencer = $influencers[$j];

            //var_dump($product->name, $influencer['first_name'], $influencer['last_name']);

            $productId = $this->addProduct($product->name, $product->url, $product->picture);

            $stmt = $this->pdo->prepare("INSERT INTO user_product (user_id, product_id) VALUES (:user_id, :product_id)");
            $stmt->execute([':user_id' => $influencer['id'], ':product_id' => $productId]);

            $j++;
        }
    }

    private function addProduct($name, $url, $picture) {
        $directory = realpath(ROOT . '/public/assets/images/product');
        $pictureName = uniqid("RAND-", true) . '.jpg';
        $filename = $directory . '/' . $pictureName;

        $stmt = $this->pdo->prepare("INSERT INTO picture (name) VALUES (:name)");
        $stmt->execute([':name' => $pictureName]);
        $pictureId = (int) $this->pdo->lastInsertId();

        file_put_contents($filename, base64_decode($picture));

        $stmt = $this->pdo->prepare("INSERT INTO product (name, brand_id, main_color_id, product_type_id, state, active) VALUES (:name, 3, 13, 13, 1, 1)");
        $stmt->execute([':name' => $name]);
        $productId = (int) $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("INSERT INTO product_picture (product_id, picture_id) VALUES (:product_id, :picture_id)");
        $stmt->execute([':product_id' => $productId, ':picture_id' => $pictureId]);

        $stmt = $this->pdo->prepare("INSERT INTO product_link (url, product_id, state, active) VALUES (:url, :product_id, 1, 1)");
        $stmt->execute([':url' => $url, ':product_id' => $productId]);
        $productLinkId = $this->pdo->lastInsertId();

        return $productId;
    }

}
