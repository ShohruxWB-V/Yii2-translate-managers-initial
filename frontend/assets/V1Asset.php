<?php

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * BusinessTaxAsset bundle for the Theme BusinessTax css and js files.
 */
class V1Asset extends AssetBundle
{
    public $basePath = '@webroot/themes/v1';
    public $baseUrl = '@web/themes/v1';
    public $css = [
        'assets/css/main.css',
        'assets/css/breakpoints.css',
    ];
    public $js = [
        'assets/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();

        $v = '?v=0.0.1';
        foreach ($this->css as $key => $path) {
            $file_path = Yii::getAlias('@webroot/themes/v1/'.$path);
            if (file_exists($file_path)) {
                $v = '?v=' . filemtime($file_path);
            }
            $this->css[$key] = $path.$v;
        }
        foreach ($this->js as $key => $path) {
            $file_path = Yii::getAlias('@webroot/themes/v1/'.$path);
            if (file_exists($file_path)) {
                $v = '?v=' . filemtime($file_path);
            }
            $this->js[$key] = $path.$v;
        }
    }

}
