<?php
namespace common\widgets;

use lajax\translatemanager\models\Language;
use yii\base\Widget;
use Yii;

class LanguageSwitcherWidget extends Widget
{
    public $languages;
    public $native = true;
    public $short = true;
    public $flag = false;
    public $container_tag = 'li';
    public $container_class = null;
    public $is_front = false;
    public $is_mobile = false;

    public function init()
    {
        parent::init();
        if ($this->languages === null) {
            $cache_db = !empty(Yii::$app->params['cache']['db.language']) ? Yii::$app->params['cache']['db.language'] : null;
            if ($cache_db) {
                $languages_ = Language::getDb()->cache(function ($db) {
                    return Language::find()
                        ->select(['language','language_id','name_ascii as name','name as native'])
                        ->where(['status'=>Language::STATUS_ACTIVE])
                        ->orderBy('country')
                        ->indexBy('language')
                        ->asArray()
                        ->all();
                },$cache_db);
            } else {
                $languages_ = Language::find()
                    ->select(['language','language_id','name_ascii as name','name as native'])
                    ->where(['status'=>Language::STATUS_ACTIVE])
                    ->orderBy('country')
                    ->indexBy('language')
                    ->asArray()
                    ->all();
            }

            $this->languages = $languages_;
        }

    }

    public function run()
    {
        return $this->render('language',[
            'languages' => $this->languages,
            'short' => $this->short,
            'native' => $this->native,
            'flag' => $this->flag,
            'is_front' => $this->is_front,
            'is_mobile' => $this->is_mobile,
            'container_tag' => $this->container_tag,
            'container_class' => $this->container_class,
        ]);
    }

}