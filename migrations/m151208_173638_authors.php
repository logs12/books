<?php

use yii\db\Migration;

class m151208_173638_authors extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%authors}}',[
            'id'=>$this->primaryKey(),
            'firstname'=>$this->string()." COMMENT 'firstname name authors'",
            'lastname'=>$this->string()." COMMENT 'lastname name authors'"
        ],$tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
