<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\V1Asset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

V1Asset::register($this);
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

<div class="wrap min-vh-100">
    <nav class="navbar bg-dark border-bottom border-bottom-dark navbar-expand-lg " data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/"><?= Yii::t('language','Home') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/about/"><?= Yii::t('language','About') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/contact/"><?= Yii::t('language','Contact') ?></a>
                    </li>
                </ul>
                <?php if (Yii::$app->user->isGuest) : ?>
                    <ul class="navbar-nav ms-auto me-4 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/site/login/"><?= Yii::t('language','Login') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/site/signup/"><?= Yii::t('language','Signup') ?></a>
                        </li>
                    </ul>
                <?php else : ?>
                    <form action="/site/logout" method="post" class="mb-2 ms-auto me-4 mb-lg-0">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <input type="hidden" name="_csrf-frontend"
                                       value="vfU_Pdu8JJI0lU_zDTO3m6zxiqQDXbyklktsW8pRyaP2xAkN7pFH9l_ZF8dsV_PJ1JbS8XBp_-j6Bjk0hRiTwA==">
                                <button type="submit" class="btn btn-light logout"><?= Yii::t('language','Logout') ?> (<?= Yii::$app->user->identity->username; ?>)</button>
                            </li>
                        </ul>
                    </form>
                <?php endif; ?>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <!-- Language -->
                        <?= \common\widgets\LanguageSwitcherWidget::widget(['is_front' => true, 'flag' => true, 'container_tag' => 'li', 'container_class' => 'dropdown-item dropdown-item-language']) ?>
                        <!-- End Language -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer bg-dark py-4" data-bs-theme="dark">
    <div class="container">
        <p class="pull-left text-light m-0">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
