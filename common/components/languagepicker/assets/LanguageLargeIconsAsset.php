<?php

namespace common\components\languagepicker\assets;

use yii\web\AssetBundle;

/**
 * LanguageLargeIcons asset bundle
 */
class LanguageLargeIconsAsset extends AssetBundle
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
        'css/flags-large.css',
    ];

}
