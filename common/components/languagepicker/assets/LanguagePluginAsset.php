<?php

namespace common\components\languagepicker\assets;

use yii\web\AssetBundle;

/**
 * LanguagePlugin asset bundle
 */
class LanguagePluginAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/components/languagepicker/web';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/language-picker.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
