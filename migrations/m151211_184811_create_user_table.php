<?php

use yii\db\Schema;
use yii\db\Migration;

class m151211_184811_create_user_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}',[
            'id' => $this->primaryKey()." COMMENT 'id ������������'",
            'username' => $this->string()->notNull()." COMMENT '��� ������������'",
            'email' => $this->string()->notNull()." COMMENT '����� ������������'",
            'password_hash' => $this->string()->notNull()." COMMENT '��� ��� ���������� ������'",
            'status' => $this->smallInteger()->notNull()." COMMENT '������ ������������(���, �� �����������, �����������)'",
            'auth_key' => $this->string(32)->notNull()." COMMENT '���������� ���� ��� ������ `��������� ����`'",
            'created_at' => $this->integer()->notNull()." COMMENT '���� � ����� �������� ������������'",
            'updated_at' => $this->integer()->notNull()." COMMENT '���� � ����� ��������� ������������'",
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
