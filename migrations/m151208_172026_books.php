<?php

use yii\db\Migration;

class m151208_172026_books extends Migration
{
      // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%books}}',[
            'id' => $this->primaryKey(),
            'author_id' => $this->smallInteger(),
            'name' => $this->string(32),
            'preview' => $this->string(),
            'date_create_book' => $this->integer()->notNull()." COMMENT 'released books'",
            'date_create' => $this->integer()->notNull()." COMMENT 'data create entry'",
            'date_update' => $this->integer()->notNull()." COMMENT 'data update entry'",
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'search' => $this->smallInteger()->defaultValue(1)->notNull()." COMMENT 'key for search'",
        ],$tableOptions);

        $this->createIndex('index_author_id', '{{%books}}',['author_id']);

    }

    public function safeDown()
    {
        $this->dropIndex('index_author_id','{{%books}}');
        $this->dropTable('{{%books}}');
    }
}
