<?php

namespace common\components\languagepicker\assets;

use yii\web\AssetBundle;

/**
 * LanguageSmallIcons asset bundle
 */
class LanguageSmallIconsAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/components/languagepicker/web';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/language-picker.css',
        'css/flags-small.css',
    ];

}
