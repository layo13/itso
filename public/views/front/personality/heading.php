<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($personalityPicture)) { ?>
					<a href="<?= $app->router()->getRoute('front_personality_read', ['id' => $personalityId]) ?>">
						<img class="rounded-circle mx-auto d-block profile_read_first" src="<?= $url ?>public/assets/images/user/<?= $personalityPicture['name'] ?>"/>
					</a>
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