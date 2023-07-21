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
<div class="wrap" style="min-height: calc(100vh - 72px);">
    <nav class="navbar bg-dark border-bottom border-bottom-dark navbar-expand-lg " data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= Yii::$app->homeUrl; ?>">
                <img class="img-thumbnail border-0" src="/themes/v1/assets/img/icon.png" width="40"><?= Yii::$app->name; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/"><?= Yii::t('language', 'Home') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/about/"><?= Yii::t('language', 'About') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/contact/"><?= Yii::t('language', 'Contact') ?></a>
                    </li>
                </ul>
                <?php if (Yii::$app->user->isGuest) : ?>
                    <ul class="navbar-nav ms-auto me-4 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/site/login/"><?= Yii::t('language', 'Login') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/site/signup/"><?= Yii::t('language', 'Signup') ?></a>
                        </li>
                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav mb-2 ms-auto me-4 mb-lg-0">
                        <li class="nav-item">
                            <?= Html::a(Yii::t('language', 'Logout') .' '. '(' . Yii::$app->user->identity->username . ')',
                                ['/site/logout'], ['data-method' => 'POST', 'class' => 'nav-link']) ?>
                        </li>
                    </ul>
                    <form action="/site/logout" method="post" class="mb-2 ms-auto me-4 mb-lg-0 d-none">

                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <input type="hidden" name="_csrf-frontend"
                                       value="vfU_Pdu8JJI0lU_zDTO3m6zxiqQDXbyklktsW8pRyaP2xAkN7pFH9l_ZF8dsV_PJ1JbS8XBp_-j6Bjk0hRiTwA==">
                                <button type="submit" class="btn btn-light logout"><?= Yii::t('language', 'Logout') ?>
                                    (<?= Yii::$app->user->identity->username; ?>)
                                </button>
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
        <?php if (empty($this->params['empty_breadcrumb'])): ?>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                 class="breadcrumb p-3 my-3 bg-primary-subtle text-dark-emphasis rounded-3"
                 aria-label="breadcrumb">
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => '<i class="bx bx-home-alt fs-lg me-1"></i>' . Yii::t('language', 'Home'),
                        'url' => Yii::$app->homeUrl,
                        'encode' => false, // Requested feature
                        'class' => ['nav-link fw-bold text-primary'],
                    ],
                    'itemTemplate' => "<li class='breadcrumb-item'> {link} </li>\n",
                    'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",

                    'links' => $this->params['breadcrumbs'] ?? [],
                    'options' => ['class' => 'breadcrumb mb-0'],
                ]) ?>
            </nav>
        <?php endif; ?>
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
