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
        //var_dump($personality, $charity, $favoriteCategories);exit
        ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($personalityPicture)) { ?>
                    <img class="rounded-circle mx-auto d-block" src="<?= $url ?>public/assets/images/user/<?= $personalityPicture['name'] ?>"/>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6 text-sm-left">
                <i class="fa fa-heart"></i> <?= $subscriptions ?> Abonné(s)
            </div>
            <div class="col-6 text-sm-right">
                <?php if (!empty($charity)) { ?>
                    <?= $personality['first_name'] ?> soutient <?= $charity['name'] ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-12">
        <h4>Articles les plus humanitaires</h4>
    </div>
</div>

<?php if (!empty($favoriteCategories)) { ?>
    <div class="row">
        <div class="col-12">
            <h4>Parcourir tout</h4>
        </div>
    </div>
    <div class="row">
        <?php foreach ($favoriteCategories as $favoriteCategory) { ?>
            <div class="col-4">
                <a href="<?= $app->router()->getRoute('front_personality_favority_read', ['id' => $personality['id'], 'favorite' => $favoriteCategory['id']]) ?>">
                    <div class="card">
                        <div style="color: #333;" class="card-body">
                            <?= $favoriteCategory['name'] ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php
$blockContent = ob_get_clean();
require __DIR__ . '/../base.php';
