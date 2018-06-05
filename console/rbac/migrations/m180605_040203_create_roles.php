<?php

use yii2mod\rbac\migrations\Migration;
use yii2mod\rbac\rules\UserRule;

class m180605_040203_create_roles extends Migration
{
    public function Up()
    {
        $this->createRule('editor', UserRule::class);
        $this->createRole('admin', 'Admin has all available permissions.');
        $this->createRole('editor', 'Editor', 'editor');
    }

    public function Down()
    {
        $this->removeRule('editor');
        $this->removeRole('admin');
        $this->removeRole('editor');
    }
}