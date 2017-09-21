<?php


use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function up()
    {
        $this->table('user')
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')
        ->save();

        $primaryUser = [
            'username'  => 'johndoe',
            'password'  => crypt('somepass', '$2a$08$Cf1f11ePArKlBJomM0F6aJ$')
        ];

        $table = $this->table('user');
        $table->insert($primaryUser);
        $table->saveData();
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
