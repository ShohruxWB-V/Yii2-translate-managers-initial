<?php

use yii\db\Schema;
use yii\db\Migration;

class m170330_064101_i18n extends Migration
{
    /**
     * @var array The language table contains the list of languages.
     */
    protected $languages = [
        ['en-US', 'en', 'us', 'English', 'English (US)', 1],
        ['en-GB', 'en', 'gb', 'English', 'English (UK)', 0],
        ['ru-RU', 'ru', 'ru', 'Русский', 'Russian', 1],
        ['uz-UZ', 'uz', 'uz', 'O`zbekcha', 'Uzbek', 1],
        ['oz-OZ', 'oz', 'oz', 'Ўзбекча', 'Uzbek', 0],
    ];

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%language}}', [
            'language_id' => Schema::TYPE_STRING . '(5) NOT NULL',
            'language' => Schema::TYPE_STRING . '(3) NOT NULL',
            'country' => Schema::TYPE_STRING . '(3) NOT NULL',
            'name' => Schema::TYPE_STRING . '(32) NOT NULL',
            'name_ascii' => Schema::TYPE_STRING . '(32) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'PRIMARY KEY (language_id)',
        ], $tableOptions);

        $this->batchInsert('{{%language}}', [
            'language_id',
            'language',
            'country',
            'name',
            'name_ascii',
            'status',
        ], $this->languages);

        $this->createTable('{{%language_source}}', [
            'id' => Schema::TYPE_PK,
            'category' => Schema::TYPE_STRING . '(32) DEFAULT NULL',
            'message' => Schema::TYPE_TEXT,
        ], $tableOptions);

        $this->createTable('{{%language_translate}}', [
            'id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'language' => Schema::TYPE_STRING . '(5) NOT NULL',
            'translation' => Schema::TYPE_TEXT,
            'PRIMARY KEY (id, language)',
        ], $tableOptions);

        $this->createIndex('language_translate_idx_language', '{{%language_translate}}', 'language');

        $this->addForeignKey('language_translate_ibfk_1', '{{%language_translate}}', ['language'], '{{%language}}', ['language_id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('language_translate_ibfk_2', '{{%language_translate}}', ['id'], '{{%language_source}}', ['id'], 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%language_translate}}');
        $this->dropTable('{{%language_source}}');
        $this->dropTable('{{%language}}');
    }
}
