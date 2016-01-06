<?php

use yii\db\Schema;
use yii\db\Migration;

class m151208_174319_authors_insert_line extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->batchInsert('{{%authors}}',
            ['firstname', 'lastname'],
            [
                ['Иван', 'Иванов'],
                ['Петр', 'Петров'],
                ['Сидор', 'Сидоров'],
                ['Коля', 'Колянов'],
            ]
        );
    }

    public function safeDown()
    {
        $this->delete('{{%authors}}',
            [
                ['firstname' => 'Иван'],
                ['lastname' => 'Иванов'],
                ['firstname' => 'Петр'],
                ['lastname' => 'Петров'],
                ['firstname' => 'Сидор'],
                ['lastname' => 'Сидоров'],
                ['firstname' => 'Коля'],
                ['lastname' => 'Колянов'],
            ]
        );
    }

}
