<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $languages yii\web\View */
/* @var $short yii\web\View */
/* @var $native yii\web\View */
/* @var $flag yii\web\View */
/* @var $is_front yii\web\View */
/* @var $is_mobile yii\web\View */
/* @var $container_tag yii\web\View */
/* @var $container_class yii\web\View */

?>

<?php if (!$is_front && !$is_mobile): ?>
    <?php foreach ($languages as $language => $object): ?>
        <?php $language_key = $object['language_id']; ?>
        <<?= $container_tag; ?> class="<?= $language ?> nav-item <?= (Yii::$app->language == $language) ? 'active' : ''; ?>">
        <?php
        $lang_name = ($native) ? $object['native'] : $object['name'];
        $lang_name = ($short) ? $language : $lang_name;
        ?>
        <?php if ($flag): ?>
            <?php $img = Html::img('@web/themes/v1/assets/img/svg/lang/flag-' . $language . '.svg', ['alt' => '', 'class' => 'img-flag-svg', 'width' => 30]); ?>
            <?= Html::a($img . ' ' . $lang_name, Url::current(['language-picker-language' => $language_key]), ['class' => 'nav-link']); ?>
        <?php else: ?>
            <?= Html::a($lang_name, Url::current(['language-picker-language' => $language_key]), ['class' => 'nav-link']); ?>
        <?php endif; ?>
        </<?= $container_tag; ?>>
    <?php endforeach; ?>
<?php elseif ($is_front && !$is_mobile): ?>
    <?php $cur_lang = _lang(); ?>
    <?php $cur_lang_object = $languages[$cur_lang]; ?>

    <?php
    $lang_name = ($native) ? $cur_lang_object['native'] : $cur_lang_object['name'];
    $lang_name = ($short) ? mb_strtoupper($cur_lang) : ($lang_name);
    ?>

    <a class="nav-link text-white pt-2 pb-2 px-md-0 d-flex align-items-center" href="#" id="navbarDropdownLang" role="button"
       data-bs-toggle="dropdown" aria-expanded="false"><!-- me-xl-3 me-md-3-->
        <?php if ($flag): ?>
            <?php $img = Html::img('@web/themes/v1/assets/img/svg/lang/flag-' . $cur_lang . '.svg', ['alt' => '', 'class' => 'img-flag-svg',]); ?>
            <div class="nav-icon-flag me-1 d-flex align-items-center justify-content-center">
                <?= $img; ?>
            </div>
        <?php endif; ?>
<!--<span class="me-2" style="width: 24px; height: 24px">-->
<!--<img src="/themes/v1/images/svg/icons/language-icon.svg" alt="language" class="d-block">-->
<!--</span>-->
        <?= $lang_name; ?>
    </a>
    <ul class="dropdown-menu dropdown-transition text-gray fs-7" aria-labelledby="navbarDropdownLang"
        style="min-width: auto">

        <?php foreach ($languages as $language => $object): ?>
            <?php $language_key = $object['language_id']; ?>
            <?php
            $lang_name = ($native) ? $object['native'] : $object['name'];
            $lang_name = ($short) ? mb_strtoupper($language) : $lang_name;
            ?>
            <li class="language-list">
                <?php if ($flag): ?>
                    <?php $img = Html::img('@web/themes/v1/assets/img/svg/lang/flag-' . $language . '.svg', ['alt' => '', 'class' => 'img-flag-svg',]); ?>
                    <?= Html::a($img . ' ' . $lang_name, Url::current(['language-picker-language' => $language_key]), ['class' => $language . '  ' . $container_class . ' hover-primary transition']); ?>
                <?php else: ?>
                    <?= Html::a($lang_name, Url::current(['language-picker-language' => $language_key]), ['class' => $language . ' ' . $container_class . ' hover-primary transition']); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php elseif ($is_mobile): ?>
    <?php foreach ($languages as $language => $object): ?>
        <?php $language_key = $object['language_id']; ?>
        <?php
        $lang_name = ($short) ? $language : $object['name'];
        ?>
        <?= Html::a($lang_name, Url::current(['language-picker-language' => $language_key]), ['class' => (_lang() == $language) ? 'active' : '']); ?>
    <?php endforeach; ?>
<?php else: ?>
    <div class="active-language">
        <span><?= ($short) ? _lang() : $languages[_lang()]['name'] ?></span>
    </div>
    <?php unset($languages[_lang()]) ?>
    <div class="popup-language">
        <?php foreach ($languages as $language => $object): ?>
            <?php $language_key = $object['language_id']; ?>
            <?php
            $lang_name = ($native) ? $object['native'] : $object['name'];
            $lang_name = ($short) ? $language : $object['name'];
            ?>
            <?= Html::a($lang_name, Url::current(['language-picker-language' => $language_key])); ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
