<?php


use Phinx\Migration\AbstractMigration;

class CreatePosts extends AbstractMigration
{
    public function up()
    {
        $this->table('posts')
            ->addColumn('title', 'string')
            ->addColumn('body', 'string')
            ->addColumn('path', 'string')
            ->addIndex(['path'], ['unique' => true])
        ->save();
    }

    public function down()
    {
        $this->dropTable('posts');
    }
}
