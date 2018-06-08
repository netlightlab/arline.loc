<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.06.2018
 * Time: 16:41
 */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>


<?php $this->beginBody() ?>

<main id="main">
    <aside>
        <div class="logo">
            <?= HTML::a('TOO "AR LINE SERVICE"', Yii::$app->homeUrl) ?>
        </div>
        <div class="user-block">
            <div class="user-thumb">
                <?= HTML::img('@web/common/main/user.png') ?>
            </div>
            <div class="user-info">
                <p class="name"><?= Yii::$app->user->identity->username ?></p>
            </div>
        </div>
        <div class="sidebar">
            <div class="plawka"></div>
            <ul class="sitemap">
                <li class="sitemap-item">
                    <?= html::a('Главная', Url::to(['admin/index']), ['class' => 'sitemap-link']) ?>
                </li>
                <li class="sitemap-item">
                    <?= html::a('Водители', Url::to(['driver/index']), ['class' => 'sitemap-link']) ?>
                </li>
                <li class="sitemap-item">
                    <?= html::a('Автомобили', Url::to(['auto/index']), ['class' => 'sitemap-link']) ?>
                </li>
                <li class="sitemap-item">
                    <?= html::a('Координаторы', Url::to(['user/index']), ['class' => 'sitemap-link']) ?>
                </li>
                <?php
                echo '<li class="sitemap-item">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'sitemap-link']
                    )
                    . Html::endForm()
                    . '</li>'
                ?>
            </ul>
            <span class="copyright">&copy; copyright</span>
        </div>
    </aside>
    <section>
        <div class="top-line">
<!--            <p>ТЕСТ ПЕСТ ХЕСТ</p>-->
        </div>
        <?= Alert::widget() ?>
        <div class="wrapper">
            <?= $content ?>
        </div>
    </section>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
