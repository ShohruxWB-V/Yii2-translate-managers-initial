<?php

define("MAIN_DOMAIN_NAME", "sitename.uz");
define("LOCAL_DOMAIN_NAME", "qovoq.lc");

define("CAR_NUMBER_PATTERN_FIZ", "/[0-9]{2}[A-Za-z]{1}[0-9]{3}[A-Za-z]{2}/");

define("BASE_URL_INS", "https://main.qovoq.uz/");
define("BASE_URL_DIDOX_API", "https://api.goodsign.biz/");
define("EBASE_URL_INS_TOKEN", "29725cfaee56149c24b586dad2eb2abd");

define("BOT_TOKENT_SALE", "5200097983:AAHMt6jSaVdWarnKMHKieLF2XUCOx9_MJ5k");

define("CHAT_ID_ME", "127566656");
define("CHAT_ID_GROUP_SALE", "-887395551");

$domainName = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
if ($domainName == MAIN_DOMAIN_NAME) {
    define("EBASE_URL_INS", "https://main.qovoq.uz/");
} else {
    define("EBASE_URL_INS", "https://main.qovoq.uz/");
}

if ($domainName == LOCAL_DOMAIN_NAME) {
    define("LOCAL_DOMAIN", true);
} else {
    define("LOCAL_DOMAIN", false);
}

define("HEADER_APP_PARAM", "MobileAgent");
define("LOG_DEBUG_SITE", true);

use common\library\request_logger\models\RequestHistory;
use common\models\User;
use yii\httpclient\Client;

if (!function_exists('d')) {

    /**
     * Debug function
     * d($var);
     */
    function d($var,$caller=null)
    {
        if(!isset($caller)){
            $debug_backtrace = debug_backtrace(1);
            $caller = array_shift($debug_backtrace);
        }
        echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
        echo '<pre>';
        yii\helpers\VarDumper::dump($var, 10, true);
        echo '</pre>';
    }
}

if (!function_exists('dd')) {

    /**
     * Debug function with die() after
     * dd($var);
     */
    function dd($var)
    {
        $debug_backtrace = debug_backtrace(1);
        $caller = array_shift($debug_backtrace);
        d($var,$caller);
        die();
    }
}

if (!function_exists('_lang')) {

    /**
     * @return mixed
     */
    function _lang()
    {
        $lang = explode('-',Yii::$app->language);
        return $lang[0];
    }
}

if (!function_exists('_blackWords')) {

    /**
     * @param $force
     * @return string[]
     */
    function _blackWords($force = false) {
        $blackWords = ['YandexBot', 'Eric', 'TwitterBot', 'apple-touch-icon', 'We need money to survive'];

        return $blackWords;
    }

}

if (!function_exists('_getBirthdayFromPinfl')) {

    /**
     * @param $pinfl
     * @return string
     */
    function _getBirthdayFromPinfl($pinfl)
    {
        $asr = [['3','4'],['5','6']];
        $chars = str_split($pinfl);
        $year_prefix = '20';
        if (in_array($chars[0],$asr[0])) {
            $year_prefix = '19';
        }
        return $chars[1].$chars[2].'.'.$chars[3].$chars[4].'.'.$year_prefix.$chars[5].$chars[6];
    }
}

if (!function_exists('_getCarAutoNumberPrefix')) {

    /**
     * @param $auto_number
     * @return int
     */
    function _getCarAutoNumberPrefix($auto_number)
    {
        return intval(mb_substr($auto_number,0,2));
    }
}


if (!function_exists('_getRegionInfoList')) {

    /**
     * @return array[]
     */
    function _getRegionInfoList()
    {
        return [
            1 => [
                'name' => Yii::t('policy', 'Toshkent shahri'),
                'auto_numbers' => [1,2,3,4,5,6,7,8,9],
            ],
            2 => [
                'name' => Yii::t('policy', 'Toshkent viloyati'),
                'auto_numbers' => [10,11,12,13,14,15,16,17,18,19],
            ],
            3 => [
                'name' => Yii::t('policy', 'Andijon viloyati'),
                'auto_numbers' => [60,61,62,63,64,65,66,67,68,69],
            ],
            4 => [
                'name' => Yii::t('policy', 'Buxoro viloyati'),
                'auto_numbers' => [80,81,82,83,84],
            ],
            5 => [
                'name' => Yii::t('policy', 'Jizzax viloyati'),
                'auto_numbers' => [25,26,27,28,29],
            ],
            6 => [
                'name' => Yii::t('policy', 'Qashqadaryo viloyati'),
                'auto_numbers' => [70,71,72,73,74],
            ],
            7 => [
                'name' => Yii::t('policy', 'Qoraqalpog`iston Respublikasi'),
                'auto_numbers' => [95,96,97,98,99],
            ],
            8 => [
                'name' => Yii::t('policy', 'Navoiy viloyati'),
                'auto_numbers' => [85,86,87,88,89],
            ],
            9 => [
                'name' => Yii::t('policy', 'Namangan viloyati'),
                'auto_numbers' => [50,51,52,53,54,55,56,57,58,59],
            ],
            10 => [
                'name' => Yii::t('policy', 'Samarqand viloyati'),
                'auto_numbers' => [30,31,32,33,34,35,36,37,38,39],
            ],
            11 => [
                'name' => Yii::t('policy', 'Sirdaryo viloyati'),
                'auto_numbers' => [20,21,22,23,24],
            ],
            12 => [
                'name' => Yii::t('policy', 'Surxondaryo viloyati'),
                'auto_numbers' => [75,76,77,78,79],
            ],
            13 => [
                'name' => Yii::t('policy', 'Farg`ona viloyati'),
                'auto_numbers' => [40,41,42,43,44,45,46,47,48,49],
            ],
            14 => [
                'name' => Yii::t('policy', 'Xorazm viloyati'),
                'auto_numbers' => [90,91,92,93,94],
            ],
        ];
    }
}

if (!function_exists('_checkRegionByUseTerritory')) {

    /**
     * @param $id
     * @return array|int[]
     */
    function _checkRegionByUseTerritory($id)
    {
        $ar = [
            1 => [1,2],
            3 => [3,4,5,6,7,8,9,10,11,12,13,14],
        ];
        return !empty($ar[$id]) ? $ar[$id] : [];
    }
}

if (!function_exists('_langFull')) {

    /**
     * @return mixed
     */
    function _langFull()
    {
        return Yii::$app->language;
    }
}

if (!function_exists('_date_current')) {

    /**
     * @param bool $short
     * @return false|string
     */
    function _date_current($short=false)
    {
        $date = date('Y-m-d H:i:s');
        if ($short) {
            $date = date('Y-m-d');
        }
        return $date;
    }
}

if (!function_exists('is_mobile_app')) {

    /**
     * @return bool
     */
    function is_mobile_app()
    {
        $headers = Yii::$app->request->getHeaders();
        $session = Yii::$app->session;
        if (!$session->isActive) $session->open();

        if( $headers->get(HEADER_APP_PARAM) == HEADER_APP_PARAM || $session->get('is_mobile_app')){
            $session->set('is_mobile_app', 'is_mobile_app');
            if (!Yii::$app->user->isGuest) {
                $session->set('mobile_app_user_id', Yii::$app->user->id);
            } else {
                if (!empty($headers) && $headers->get('Authorization')) {
                    $user = User::find()->where(['access_token' => getBearerToken($headers->get('Authorization'))])->andWhere(['status' => User::STATUS_ACTIVE])->one();
                    if (!empty($user)) {
                        Yii::$app->user->login($user, 1 ? 3600 * 24 * 30 : 0);
                        $session->set('mobile_app_user_id', $user->id);
                    }
                }
            }
            return true;
        }
        return false;
    }
}

if (!function_exists('getBearerToken')) {
    /**
     * get access token from header
     * */
    function getBearerToken($HTTP_AUTHORIZATION) {
        $headers = trim($HTTP_AUTHORIZATION);
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}

if (!function_exists('set_history')) {

    /**
     * @param $request
     * @param $response
     */
    function set_history($request, $response, $method = 'api', $params = null)
    {
        try {
            $user = Yii::$app->user->identity;
            $model = new RequestHistory();
            $model->method = $method;
            $model->params = !empty($params) ? json_encode($params, JSON_UNESCAPED_UNICODE) : null;
            $model->user_id = !empty($user['id']) ? $user['id'] : null;
            $model->request = json_encode($request, JSON_UNESCAPED_UNICODE);
            $model->response = json_encode($response, JSON_UNESCAPED_UNICODE);
            if (!$model->save()) {
                Yii::warning($model->errors);
                _send_error('helpers set_history model error', json_encode($model->errors,JSON_UNESCAPED_UNICODE));
            }
            $model->save();
        } catch (\Exception $e) {
            dd($e);
            $title = $e->getMessage();
            $message = "Code: " . $e->getCode();
            $message .= "\nFile: " . $e->getFile();
            $message .= "\nLine: " . $e->getLine();
            _send_error($title, $message, $e);

            $message = [
                $title,
                Yii::t('frontend', 'Пожалуйста попробуйте позже'),
            ];
            Yii::$app->session->setFlash('error', $message);
        }
    }
}

if (!function_exists('sendTelegramData')) {
    /**
     * @param string $route
     * @param array $params
     * @param string $method
     */
    function sendTelegramData($route = '', $params= [], $bot_token=BOT_TOKENT_SALE, $method='POST')
    {
        $base_url = 'https://api.telegram.org/bot' . $bot_token . '/'.$route;

//        set_history($base_url, [], $method.'_before_send',$params);

        $client = new Client(['baseUrl' => $base_url]);

        $request = $client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('POST')
            ->addHeaders([
                'Content-type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->setData($params);

        $response = $request->send();

        if (empty($response->data['ok'])) {
            _send_error('sendTelegramData not Send message', json_encode($response->data));
            if (LOG_DEBUG_SITE) {
                Yii::warning("\n\n\nsendTelegramData not Send message");
                Yii::warning($response->data);
            }
        }
//        set_history($request, $response->data, $method.'_after_send', $params);
        return $response->data;

    }
}

if (!function_exists('_sendNewPolisInfo')) {

    /**
     * @param array $chat_ids
     * @param $text
     * @param string $bot_token
     * @param null $contoller_name
     * @param null $product_code
     */
    function _sendNewPolisInfo($text, $bot_token = BOT_TOKENT_SALE, $product_code = null)
    {

        //127566656 Shohrux
        //125708395 Sardor
        //144528462 Hikmat
        //138759338 Azamat aka
        //636771019 Gulrux
        //600439260 Bunyod
        //93708862 Nargiz
        //437177217 Yodgor
        //-365754054 smart and online insurance department
        //612621295 Smart sugurta

        $chat_ids = [
            127566656,
            144528462,
            93708862,
            636771019,
            437177217,
            165393178,
        ];

        $contoller_name = Yii::$app->controller->id;

        foreach ($chat_ids as $chat_id) {
            sendTelegramData('sendMessage', [
                'chat_id' => $chat_id,
                'text' => $text,
                'parse_mode' => 'HTML'
            ],$bot_token,'POLIS_'.$contoller_name.'_'.$product_code.'_'.$chat_id);
        }
    }
}

if (!function_exists('my_mb_ucfirst')) {

    /**
     * @param $str
     * @return string
     */
    function my_mb_ucfirst($str) {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));
        return $fc.mb_substr($str, 1);
    }
}

if (!function_exists('my_tag_decoder')) {

    /**
     * @param $str
     * @return array|null
     */
    function my_tag_decoder($str) {
        $fc = explode(',',$str);
        return $fc;
    }
}

if (!function_exists('is_front')) {

    function is_front() {
        return (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index');
    }
}

if (!function_exists('_slug_generate')) {

    /**
     * @param $string
     * @return string
     */
    function _slug_generate($string) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $string)));
        return $slug;
    }
}


if (!function_exists('encrypt_decrypt')) {

    /**
     * @param $string
     * @param string $action
     * @return false|string
     */
    function encrypt_decrypt($string, $action = 'encrypt')
    {
        $encrypt_method = "AES-256-CBC"; // !!! DO NoT CHANGE THIS METHOD
        $secret_key = 'AA74CDCC2BBGO935136INSB63C'; // user define private key !!! DO NoT CHANGE THIS KEY
        $secret_iv = '5fgf5HJNipfo'; // user define secret key !!! DO NoT CHANGE THIS IV
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

if (!function_exists('_model_encrypt')) {

    /**
     * Returns an encrypted & utf8-encoded
     */
    function _model_encrypt($model = null, $params = null) {
        if (!empty($model)) {
            $hashStr = $model->id .'|'.$model->formName();
        } else {
            $hashStr = $params['id'] . '|' . $params['formName'];
        }
        return encrypt_decrypt($hashStr);
    }

}

if (!function_exists('_model_decrypt')) {

    /**
     * Returns an encrypted & utf8-encoded
     */
    function _model_decrypt($string) {
        $string = encrypt_decrypt($string, 'decrypt');
        $result = explode('|',$string);
        return [
            'id' => $result[0] ?: null,
            'formName' => !empty($result[1]) ? $result[1] : null,
        ];
    }

}

if (!function_exists('_getFileType')) {

    /**
     * @param $extension
     * @return int|string
     */
    function _getFileType($extension) {
        $type = 'other';
        $files = [
            'image' => [
                'jpg',
                'jpeg',
                'png',
                'gif',
                'svg',
                'bmp',
            ],
            'video' => [
                'avi',
                '3gp',
                'mp4',
                'mov',
                'flv',
                'wmv',
                'mpeg',
            ],
            'office' => [
                'doc',
                'docx',
                'xls',
                'xlsx',
                'ppt',
                'pptx',
                'odt',
                'rtf',
            ],
            'gdocs' => [
                'tif',
                'ai',
                'eps',
            ],
            'pdf' => [
                'pdf',
            ],
            'text' => [
                'txt',
            ],
            'html' => [
                'html',
            ],
            'xml' => [
                'xml',
            ],
            'document' => [
                'zip',
                'gz',
                'odp',
                'ods',
                'bz2',
                'dmg',
                'gz',
                'jar',
                'rar',
                'sit',
            ]
        ];
        foreach ($files as $type => $formats) {
            if (in_array($extension,$formats))
                return $type;
        }
        return $type;
    }

}

if (!function_exists('_uploadFile')) {
    /**
     * @param null $file
     * @param string $type
     * @param string $module
     * @param null $order
     * @param bool $miniOrig
     * @return array
     * @throws \yii\base\Exception
     */
    function _uploadFile($file = null, $type = 'image', $module = 'file', $order = null, $miniOrig = false)
    {
        $_file = [
            'name' => null,
            'path' => null,
            'size' => null,
            'mime' => null,
            'extension' => null,
            'type' => null,
        ];
        $prefix = '/'.$module.'/'.$type;
        $directory = Yii::getAlias('@uploads'.$prefix) . DIRECTORY_SEPARATOR ;
        if (!is_dir($directory)) {
            \yii\helpers\FileHelper::createDirectory($directory);
        }
        $path = null;
        if ($file) {
            $uid = uniqid();
            $order_prefix = !empty($order) ? $order.'_' : '';
            $fileName = $order_prefix . $uid . '.' . $file->extension;
            $filePath = $directory . $fileName;
            $fileSize = $file->size;
            $fileExtension = $file->extension;
            $fileType = $file->type;
            $path = $prefix . '/' . $fileName;
            if ($file->saveAs($filePath)) {
                if ($miniOrig && $type === 'image') {
                    $image = \yii\imagine\Image::getImagine();
                    $img = $image->open($filePath);
                    $size = $img->getSize();
                    $orig_width = $size->getWidth();
                    $orig_height = $size->getHeight();
                    $delimer = 2;
                    $delimer_min = 3;
                    if ($orig_width>1000 && $orig_width<2000) {
                        $delimer = 3;
                        $delimer_min = 4;
                    } elseif ($orig_width>=2000 && $orig_width<4000) {
                        $delimer = 4;
                        $delimer_min = 5;
                    } elseif ($orig_width<1000) {
                        $delimer = 1;
                        $delimer_min = 1.5;
                    }

                    $width = intval($orig_width/$delimer);
                    $height = intval($orig_height/$delimer);
                    $f1 = "m_".$fileName;
                    $f2 = "o_".$fileName;
                    $mini_width = intval($orig_width/$delimer_min);
                    $mini_height = intval($orig_height/$delimer_min);

//                \yii\imagine\Image::thumbnail("@webroot{$path}", $orig_width, $orig_height)
//                    ->save($directory.$f2, ['quality' => 90]);

                    \yii\imagine\Image::thumbnail("@uploads{$path}", $width, $height)
                        ->save($directory.$fileName, ['quality' => 90]);

                    \yii\imagine\Image::thumbnail("@uploads{$path}", $mini_width, $mini_height)
                        ->save($directory.$f1, ['quality' => 90]);

                }
                $_file['name'] = $fileName;
                $_file['path'] = $path;
                $_file['size'] = $fileSize;
                $_file['mime'] = $fileType;
                $_file['extension'] = $fileExtension;
                $_file['type'] = _getFileType($fileExtension);
            }
        }

        return $_file;

    }
}

if (!function_exists('deleteFile')) {

    /**
     * @param $path
     * @return bool
     */
    function deleteFile ($path) {
        $deleted = false;

        $directory = Yii::getAlias('@uploads') ;

        $file_path = $directory.$path;
        if (file_exists($file_path)) {
            $deleted = unlink($file_path);
        }
        if ($deleted) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('is_dir_empty')) {

    /**
     * @param $dir
     * @return bool
     */
    function is_dir_empty($dir) {
        if (!is_readable($dir)) return NULL;
        return (count(scandir($dir)) == 2);
    }

}


if (!function_exists('_cache_file')) {

    function _cache_file($force = false) {
        $current = _lang();
//        $sourcePathes = [
//            'backend',
//            'frontend',
//        ];

        $f = Yii::getAlias("@runtime/cache/lang.txt");
        if (file_exists($f)) {
            $langfile_ = file_get_contents($f);
            if ($langfile_ != $current || $force) {
                $fp = fopen($f, 'w+');
                fwrite($fp, $current);
            }
        } else {
            $fp = fopen($f, 'w+');
            fwrite($fp, $current);
        }
    }

}

if (!function_exists('_cache_clear_expired')) {

    /**
     * @param bool $force
     * @throws \yii\base\ErrorException
     */
    function _cache_clear_expired($force = false) {
        $sourcePathes = [
            'backend',
            'frontend',
        ];
        $message_all = '';
        $message_tmp = '';
        foreach ($sourcePathes as $sourcePath) {
            $folder = Yii::getAlias("@{$sourcePath}/runtime/cache");
            $dirs = glob($folder.'/*');
            $dateFormat = "D d M Y H:i:s";
            foreach ($dirs as $dir) {
                $dir_is_empty = false;
                if (is_dir($dir)) {
                    $files = \yii\helpers\FileHelper::findFiles($dir);
                    if (!empty($files)) {
                        foreach ($files as $file) {
                            $file_path = $file;
                            $time = time();
                            if (file_exists($file_path)) {
                                $atime = fileatime($file_path);
                                $mtime = filemtime($file_path);
                                $ctime = filectime($file_path);
                                $removed_time = $time-2*60*60;
                                if ($removed_time>$mtime || $force) {
                                    $deleted = unlink($file_path);
                                    $message = Yii::t('frontend','Cache cleared');
                                } else {
                                    $message = Yii::t('frontend','Cache modified: ').date($dateFormat, $mtime);
                                }
                            }
                        }
                        $files_ = \yii\helpers\FileHelper::findFiles($dir);
                        if (empty($files_) && is_dir_empty($dir)) {
                            if (!file_exists($dir)) {
                                $dir_is_empty = true;
                            }
                        }
                    } else {
                        $dir_is_empty = true;
                    }
                    if ($dir_is_empty) {
                        $message = Yii::t('frontend','Cache folders cleared');
                        $dirRemoved = \yii\helpers\FileHelper::removeDirectory($dir);
                    }
                }
            }
            $date = date($dateFormat);
            $message_tmp .= "in <b>{$sourcePath}</b> at: <b>{$date}</b>\n";
        }
        $url = Yii::$app->request->absoluteUrl;
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->identity['id'];
            $user_name = Yii::$app->user->identity['username'];
            $user_info = "<i>id:</i> <b>{$user_id}</b> <i>username:</i> <b>{$user_name}</b>";
        } else {
            $user_info = "<b>Guest</b>\n";
        }
        $message_all .= $message."\n".$message_tmp;
        $ip = Yii::$app->request->userIP;
        $method = Yii::$app->request->method;
        $message_all .= "\nUser: ".$user_info."\n";
        $message_all .= "Method: <code>{$method}</code>"."\n";
        $message_all .= "Ip: <code>{$ip}</code>"."\n";
        $message_all .= '<a href="'.$url.'">'.$url.'</a>'."\n";

//        sendTelegramData('sendMessage', [
//            'chat_id' => 127566656,
//            'text' => $message_all,
//            'parse_mode' => 'HTML'
//        ]);

        return true;
    }

}

if (!function_exists('_send_error')) {

    function _send_error($title, $message, $exception = [], $app = null) {
        $blackWords = ['YandexBot', 'TwitterBot', 'apple-touch-icon', 'e-bazar.uz', '/mp/page/service_center', '/category/95ed', '/frontend/web/uploads/', '/themes/mp/assets/fonts/'];
        $userAgent = Yii::$app->request->userAgent;
        $url = Yii::$app->request->absoluteUrl;
        $referrer = Yii::$app->request->referrer;
        $noNeedError = false;
        foreach ($blackWords as $blackWord) {
            $str_tmp = $array = array($userAgent, $url, $referrer);
            $str_tmp = implode(',', $str_tmp);
            $blackWord_ar = explode($blackWord,$str_tmp);
            if (count($blackWord_ar)>=2) {
                $noNeedError = true;
            }
        }
        if (!$noNeedError) {

            $dateFormat = "D d M Y H:i:s";
            $date = date($dateFormat);

            $query = Yii::$app->request->queryParams;
            $app_id = Yii::$app->controller->module->id;

            $userIP = Yii::$app->request->userIP;
            $userHost = Yii::$app->request->userHost;
            $method = Yii::$app->request->method;

            $message_ = "<b>{$title}</b>: in <b>{$app_id}</b> on <b>{$date}</b>\n";
            $message_ .= '<a href="'.$url.'">'.$url.'</a>'."\n";
            $message_ .= "<b>{$message}</b>\n";
            $message_ .= '<code>'.json_encode($exception).'</code>'."\n";
            $message_ .= '<code>'.json_encode($query).'</code>'."\n";

            if (!Yii::$app->user->isGuest) {
                $user_id = Yii::$app->user->identity['id'];
                $user_name = Yii::$app->user->identity['username'];
                $user_info = "<i>id:</i> <b>{$user_id}</b> <i>username:</i> <b>{$user_name}</b>\n";
            } else {
                $user_info = "<b>Guest</b>\n";
            }
            $message_ .= "\nUser: ".$user_info;
            if ($referrer) {
                $message_ .= "Referrer: ".'<a href="'.$referrer.'">'.$referrer.'</a>'."\n";
            }
            $message_ .= "Method: <code>{$method}</code>"."\n";
            $message_ .= "userAgent: <code>{$userAgent}</code>"."\n";
            $message_ .= "userIP: <code>{$userIP}</code>"."\n";
            if ($userHost) {
                $message_ .= "userHost: <code>{$userHost}</code>"."\n";
            }

            sendTelegramData('sendMessage', [
                'chat_id' => CHAT_ID_ME,
                'text' => $message_,
                'parse_mode' => 'HTML'
            ]);

        }
    }

}

if (!function_exists('encrypt_date')) {

    /**
     * Custom encrypt function
     * return string;
     */
    function encrypt_date() {

        $year = intval(date('y'));
        $day = date('z');

        $prefix = ($year*1000);
        $prefix += $day;

        return $prefix;
    }

}

if (!function_exists('encrypt_unique_number')) {

    /**
     * @param int $a
     * @param null $b
     * @return mixed|null|string|string[]
     */
    function encrypt_unique_number($a = 0, $b = null) {

        if (empty($b)) {
            $b = encrypt_date();
        }
        $_1 = ($a + $b);
        $_2 = ($a + $b + 1);
        $_3 = ($_1 * $_2);
        $_4 = ($_3/2);
        $result = $_4 + $b;
        $base_convert_32 = base_convert($result,10,32);
        $base_convert_32 = mb_strtoupper($base_convert_32);
        return $base_convert_32;
    }

}

if (!function_exists('encrypt_unique_number')) {

    /**
     * @param $number
     * @return array
     */
    function decrypt_unique_number($number) {

        $result = [
            'a' => null,
            'b' => null,
        ];

        $base_convert_32 = mb_strtolower($number);
        $number = base_convert($base_convert_32,32,10);

        $_1 = (8 * $number);
        $_2 = sqrt($_1 + 1);
        $_3 = ($_2 - 1);
        $_4 = floor($_3 / 2);

        $_5 = ($_4 + 1);
        $_6 = ($_4 * $_5);
        $_7 = ($_6 / 2);
        $_8 = ($number - $_7);

        $_9 = ($_4 - $_8);
        $result['a'] = $_9;
        $result['b'] = $_8;

        return $result;
    }
}

if (!function_exists('clear_phone')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function clear_phone($phone)
    {
        $number = preg_replace('/\D/', '', $phone);
        if (strlen($number) < 9)
            return false;
        return substr($number, -9);
    }
}

if (!function_exists('clear_phone_full')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function clear_phone_full($phone)
    {
        $number = preg_replace('/\D/', '', $phone);
        if ($number && ctype_digit($number) && strlen($number) === 9) {
            $number = '998' . $number;
        }
        return $number;
    }
}

if (!function_exists('clear_card')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function clear_card($phone)
    {
        $number = preg_replace('/\D/', '', $phone);
        if (strlen($number) < 16)
            return false;
        return substr($number, -16);
    }
}

if (!function_exists('clear_card_expire')) {
    /**
     * @param $card_expire
     * @return bool|string
     */
    function clear_card_expire($card_expire)
    {
        $card_expire = preg_replace('/\D/', '', $card_expire);
        if (strlen($card_expire) < 4)
            return false;
        return substr($card_expire, -4);
    }
}

if (!function_exists('_generate_error')) {

    function _generate_error($errors = []) {
        $flash_errors = null;
        $index= 0;
        if (is_array($errors)) {
            foreach ($errors as $model_error) {
                if (is_array($model_error)) {
                    foreach ($model_error as $error) {
                        $flash_errors[$index++] = $error;
                    }
                } else {
                    $flash_errors[$index++] = $model_error;
                }
            }
        } else {
            $flash_errors = [$errors];
        }
        return $flash_errors;
    }
}

if (!function_exists('str_split_unicode')) {

    function str_split_unicode($str, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($str, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
            }
            return $ret;
        }
        return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    }
}

if (!function_exists('translit')) {

    /**
     * Translit UZ-RU RU-UZ
     *
     * @param  string $text
     * @param  string $lang
     * @return string
     */
    function translit($text, $lang = 'uz') {

        $rus = array('Ю', 'Я', 'Ч', 'Ш', 'Щ', 'А', 'Б', 'В', 'Г', 'Д', ' Е','Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', ' Ц', 'Ц', 'Ъ', 'Ы', 'Ь', 'Э', 'ч', 'ш', 'щ', 'ю', 'я', 'а', 'б', 'в', 'г', 'д', ' е', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', ' ц', 'ц', 'ъ', 'ы', 'ь', 'э', 'Ҳ', 'ҳ', 'Қ', 'қ', 'Ғ', 'ғ', 'Ў', 'ў');

        $lat = array('Yu', 'Ya', 'Ch', 'Sh', 'Sh', 'A', 'B', 'V', 'G', 'D', ' Ye', 'E', 'Yo', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'X', ' S', 'Ts', '’', 'I', '', 'E', 'ch', 'sh', 'sch', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', ' ye', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', ' s', 'ts', '’', 'i', '', 'e', 'H', 'h', 'Q', 'q', 'G’', 'g’', 'O’', 'o’');

        if($lang == 'uz') {
            return str_replace($rus, $lat, $text);
        }
        else if($lang == 'ru') {
            return str_replace($lat, $rus, $text);
        }

        return $text;
    }
}

if (!function_exists('ceiling_custom')) {


    /**
     * @param $number
     * @param $significance
     * @return false|float|int
     */
    function ceiling_custom($number, $significance = 1)
    {
        return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
    }

}


if (!function_exists('mask_to_phone_format')) {


    /**
     * @param $phoneNumber
     * @return array|string|string[]|null
     */
    function mask_to_phone_format($phoneNumber)
    {
        $phoneNumber = clear_phone_full($phoneNumber);
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 9);
            $areaCode = substr($phoneNumber, -9, 2);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);

            $phoneNumber = '+' . $countryCode . '(' . $areaCode . ')' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);

            $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);

            $phoneNumber = $nextThree . '-' . $lastFour;
        }
        return $phoneNumber;
    }

}