<?php
//---------------//
// BLOCK CONTENT //
//---------------//

/** @var Epic\BaseApplication $app */
$app;

ob_start();
?>

<div class="row">
    <div class="col-12">
        <?php
        //var_dump($personality, $favoriteCategory, $favorites);
        ?>
    </div>
</div>

<div class="row">
    <?php foreach ($favorites as $favorite) { ?>
    
        <?php for($i = 0; $i < 10; ++$i) { ?>
    
    
        <!--div class="col-4" style="padding-left: 0px; padding-right: 0px;"-->
        <div class="col-4" style="padding: 1px;">
            <a href="<?= $app->router()->getRoute('front_personality_product_read', [
                'id' => $personality['id'],
                'product' => $favorite['id'],
            ]) ?>">
            <?php if (!empty($favorite['pictures'])) { ?>
                <img src="<?= $url ?>public/assets/images/product/<?= $favorite['pictures'][0]['name']; ?>" class="img-fluid" alt="...">
            <?php } else { ?>
                <img src="<?= $url ?>public/assets/images/no-image-available.jpg" class="img-top" alt="...">
            <?php } ?>
            </a>
        </div>
    
    
        <?php } ?>
    <?php } ?>
</div>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
