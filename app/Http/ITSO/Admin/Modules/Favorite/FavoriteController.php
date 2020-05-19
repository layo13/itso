<?php

namespace Http\Itso\Admin\Modules\Favorite;

use Epic\BaseController;

class FavoriteController extends BaseController {

	public function createAction() {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT * FROM user");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = $datas;
        }
        require ROOT . '/public/views/admin/favorite/create.php';
	}

	public function updateAction($id) {
        $url = URL;
        $app = $this->application;
        $q = $this->pdo()->query("SELECT * FROM user");
        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = $datas;
        }
        $q = $this->pdo()->query("SELECT * FROM user_favorite_category where id = " . intval($id));
        $user_favorite_category = $q->fetch(\PDO::FETCH_ASSOC);

        require ROOT . '/public/views/admin/favorite/update.php';
	}

	public function editAction($id) {
        $url = URL;
        $app = $this->application;

        //-- $q = $this->pdo()->query("SELECT * FROM user_favorite_category where id = " . intval($id));
        //-- $user_favorite_category = $q->fetch(\PDO::FETCH_ASSOC);
        $name = $_REQUEST['formFavoriteName'];
        $user_id = $_REQUEST['formFavoriteUserId'];
        $state = 1;
        if(!empty($_REQUEST['formFavoriteState'])) {
            $state = $_REQUEST['formFavoriteState'];
        }
        $active = $_REQUEST['formFavoriteActive'];

        $sqlUpdateUser ="UPDATE `user_favorite_category` SET name = ?, user_id = ?, state = ?, active = ? WHERE id=?";
        $stmt = $this->pdo()->prepare($sqlUpdateUser)->execute([$name,$user_id,$state,$active,$id]);

        redirect($app->router()->getRoute('admin_favorite_list'));
	}

	public function addAction() {
        $url = URL;
        $app = $this->application;

		$name = $_REQUEST['formFavoriteName'];
        $user_id = $_REQUEST['formFavoriteUserId'];
        $state = 1;
        if(!empty($_REQUEST['formFavoriteState'])) {
            $state = $_REQUEST['formFavoriteState'];
        }
        $active = $_REQUEST['formFavoriteActive'];

        $sqlCreate = "INSERT INTO `user_favorite_category`(`name`, `user_id`, `state`, `active`) VALUES (?,?,?,?)";
        //-- penser à vérifier si l'email existe déjà
		$stmt = $this->pdo()->prepare($sqlCreate);
		$stmt->bindParam(1, $name);
        $stmt->bindParam(2, $user_id);
        $stmt->bindParam(3, $state);
        $stmt->bindParam(4, $active);
		$stmt->execute();

        redirect($app->router()->getRoute('admin_favorite_list'));
	}

	public function listAction() {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT user_favorite_category.*,user.first_name, user.last_name FROM user_favorite_category left join user on (user_favorite_category.user_id = user.id) order by user_id");
		while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $user_favorite_category[$datas['user_id']][] = $datas;
		}
		require ROOT . '/public/views/admin/favorite/index.php';
	}

	public function viewAction($id) {
        $url = URL;
        $app = $this->application;
		$q = $this->pdo()->query("SELECT user_favorite_category.*,user.first_name, user.last_name FROM user_favorite_category left join user on (user_favorite_category.user_id = user.id) where user_favorite_category.id = " . intval($id));
        $user_favorite_category = $q->fetch(\PDO::FETCH_ASSOC);

        $q = $this->pdo()->query("SELECT product.*,
         picture.name as brand_picture,
         brand.name as brand_name,
         product_category.name as product_category,
         color.name as main_color
         FROM product
         LEFT JOIN color ON (product.main_color_id = color.id)
         LEFT JOIN product_category ON (product.product_type_id = product_category.id)
         LEFT JOIN brand ON (brand.id = product.brand_id)
         LEFT JOIN picture ON (picture.id = brand.picture_id)
         where product.id in(SELECT user_favorite.product_id FROM `user_favorite` where favorite_categorie_id =".intval($id).")");
        $products = [];
        $productsId = [];
        $nbProductLinkClick = [];
        $productsLink = [];
        $productsLinkId = [];
        $nbProductLike = [];
        $users = [];

        while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
            $products[] = $datas;
            $productsId[] = $datas['id'];
        }
        if(!empty($productsId)) {
            $q = $this->pdo()->query("SELECT picture.*,product_picture.product_id FROM picture  
LEFT JOIN product_picture ON (product_picture.picture_id = picture.id) where product_picture.product_id in(" . implode(',', $productsId) . ") ");
            $productsPicture = [];
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $productsPicture[$datas['product_id']][] = $datas;
            }
            $q = $this->pdo()->query("SELECT * FROM product_link where product_id in(" . implode(',', $productsId) . ") and state <> 5");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $productsLink[$datas['product_id']][] = $datas;
                $productsLinkId[] = $datas['id'];
            }
            $q = $this->pdo()->query("SELECT count(*) as nb_product_link_click,product_link.product_id FROM product_link_click LEFT JOIN product_link ON (product_link_click.product_link_id = product_link.id) where product_link_id in (" . implode(',', $productsLinkId) . ") group by product_link_id");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbProductLinkClick[$datas['product_id']] = $datas;
            }
            $q = $this->pdo()->query("SELECT count(*) as nb_product_like,product_id FROM liked where product_id in (" . implode(',', $productsId) . ") and user_id <> " . intval($app->user()->getAttribute('id')) . " group by product_id");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $nbProductLike[$datas['product_id']] = $datas;
            }
            /**
             * user
             */
            $q = $this->pdo()->query("SELECT user.*,product_id
 FROM user_product
         LEFT JOIN user ON (user_product.user_id = user.id)
  where product_id in (" . implode(',', $productsId) . ")");
            while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                $users[$datas['product_id']] = $datas;
            }
        }
        require ROOT . '/public/views/admin/favorite/view.php';
	}

    public function listByUserAction() {
        $url = URL;
        $app = $this->application;
        if(!empty($_REQUEST['user_id'])) {
            $q = $this->pdo()->query("SELECT user_favorite_category.* FROM user_favorite_category where user_id = " . $_REQUEST['user_id'] . " AND user_favorite_category.id not in (SELECT favorite_categorie_id FROM user_favorite where product_id = " . intval($_REQUEST['product_id']) . ") order by user_id");
            $nb = $q->rowCount();
            $form = "";
            $form .= "<h4>Ajouter une nouvelle catégorie de favorie</h4>";
            $form .= "<form method='post' class='frmNewFavoriteProduct'>";
            $form .= "<div class=\"form-group row\">";
            $form .= "<label class=\"col-2 col-form-label\">Nom</label>";
            $form .= "<div class=\"col-8\">";
            $form .= "<input type='text' class='frmFavoriteCategoryName form-control' name='frmFavoriteCategoryName'>";
            $form .= "<input type='hidden' name='frmFavoriteProductId' class='frmFavoriteProductId form-control' value='" . $_REQUEST['product_id'] . "'>";
            $form .= "<input type='hidden' name='frmFavoriteUserId' class='frmFavoriteUserId form-control' value='" . $_REQUEST['user_id'] . "'>";
            $form .= "</div>";
            $form .= "</div>";
            $form .= "<div class=\"form-group row\">";
            $form .= "<div class=\"col-2\"></div>";
            $form .= "<div class=\"col-8\">";
            $form .= "<input type='submit' class='btn btn-success validFavoriteCategorieProduct' value='Valider'>";
            $form .= "</div>";
            $form .= "</div>";
            $form .= "</form>";

            if ($nb > 0) {
                $form .= "<hr>
<p><strong>Ou</strong></p>
</hr>";
                $form .= "<h4>Ajouter à la rubrique favorie</h4>";
                $form .= "<form method='post' class='frmFavoriteProduct'>";
                $form .= "<div class=\"form-group row\">";
                $form .= "<label class=\"col-2 col-form-label\">Catégorie</label>";
                $form .= "<div class=\"col-8\">";
                $form .= "<select class=\"form-control frmFavoriteCategorieId\" name=\"frmFavoriteCategorieId\">";
                while ($datas = $q->fetch(\PDO::FETCH_ASSOC)) {
                    $form .= "<option value=\"" . $datas['id'] . "\">" . utf8_encode($datas['name']) . "</option>";
                }
                $form .= "</select>";
                $form .= "</div>";
                $form .= "</div>";
                $form .= "<div class=\"form-group row\">";
                $form .= "<label class=\"col-2 col-form-label\">Renommer votre favorie</label>";
                $form .= "<div class=\"col-8\">";
                $form .= "<input type='text' class='form-control frmFavoriteName' name='frmFavoriteName'>";
                $form .= "<input type='hidden' class='frmFavoriteProductId' name='frmFavoriteProductId' value='" . $_REQUEST['product_id'] . "'>";
                $form .= "</div>";
                $form .= "</div>";
                $form .= "<div class=\"form-group row\">";
                $form .= "<div class=\"col-2\"></div>";
                $form .= "<div class=\"col-4\"><input type='submit' class='btn btn-success validFavoriteProduct' value='Valider'></div>";
                $form .= "</div>";
                $form .= "</form>";
            } else {
                $form .= "<p>Votre produit se trouve déjà dans toutes les catégories de favorie</p>";
            }
            return $form;
        }else{
            return 'erreur';
        }
    }

    public function addFavoriteAction() {
        $url = URL;
        $app = $this->application;

        $name = $_REQUEST['frmFavoriteName'];
        $product_id = $_REQUEST['frmFavoriteProductId'];
        $favorite_categorie_id = $_REQUEST['frmFavoriteCategorieId'];
        $state = 1;
        $active = 1;

        $q = $this->pdo()->query("SELECT * FROM user_favorite where product_id = " . intval($product_id) . " and favorite_categorie_id = " . intval($favorite_categorie_id));
        $user_favorite = $q->fetch(\PDO::FETCH_ASSOC);
        if(empty($user_favorite)) {
            $sqlCreate = "INSERT INTO `user_favorite`(`name`, `product_id`, `favorite_categorie_id`, `state`, `active`) VALUES (?,?,?,?,?)";
            //-- penser à vérifier si l'email existe déjà
            $stmt = $this->pdo()->prepare($sqlCreate);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $product_id);
            $stmt->bindParam(3, $favorite_categorie_id);
            $stmt->bindParam(4, $state);
            $stmt->bindParam(5, $active);
            $stmt->execute();

            return 1;
        }else{
            return 0;
        }
    }

    public function addCategoryAndFavoriteAction() {
        $url = URL;
        $app = $this->application;

        $name = $_REQUEST['frmFavoriteCategoryName'];
        $user_id = $_REQUEST['frmFavoriteUserId'];
        $state = 1;
        if(!empty($_REQUEST['formFavoriteState'])) {
            $state = $_REQUEST['formFavoriteState'];
        }
        $active = 1;
        if(!empty($_REQUEST['formFavoriteActive'])) {
            $active = $_REQUEST['formFavoriteActive'];
        }

        $sqlCreate = "INSERT INTO `user_favorite_category`(`name`, `user_id`, `state`, `active`) VALUES (?,?,?,?)";
        //-- penser à vérifier si l'email existe déjà
        $stmt = $this->pdo()->prepare($sqlCreate);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $user_id);
        $stmt->bindParam(3, $state);
        $stmt->bindParam(4, $active);
        $stmt->execute();

        $resultCategorie = $this->pdo()->lastInsertId();
        $favorite_categorie_id = intval($resultCategorie);
        $product_id = $_REQUEST['frmFavoriteProductId'];
        $q = $this->pdo()->query("SELECT * FROM user_favorite where product_id = " . intval($product_id) . " and favorite_categorie_id = " . intval($favorite_categorie_id));
        $user_favorite = $q->fetch(\PDO::FETCH_ASSOC);
        if(empty($user_favorite)) {
            $name = '';
            $sqlCreate = "INSERT INTO `user_favorite`(`name`, `product_id`, `favorite_categorie_id`, `state`, `active`) VALUES (?,?,?,?,?)";
            //-- penser à vérifier si l'email existe déjà
            $stmt = $this->pdo()->prepare($sqlCreate);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $product_id);
            $stmt->bindParam(3, $favorite_categorie_id);
            $stmt->bindParam(4, $state);
            $stmt->bindParam(5, $active);
            $stmt->execute();

            return 1;
        }else{
            return 0;
        }
    }
}
