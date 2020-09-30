<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($personalityPicture)) { ?>
					<a href="<?= $app->router()->getRoute('front_personality_read', ['id' => $personalityId]) ?>">
						<img class="rounded-circle d-block profile_read_first" src="<?= $url ?>public/assets/images/user/<?= $personalityPicture['name'] ?>"/>
					</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>