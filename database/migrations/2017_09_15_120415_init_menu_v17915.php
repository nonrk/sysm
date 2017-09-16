<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class InitMenuV17915 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create a user.
        \DB::table('admin_users')->truncate();
        \DB::table('admin_users')->insert([
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
            'name'      => 'Administrator',
        ]);

        // create a role.
        \DB::table('admin_roles')->truncate();
        \DB::table('admin_roles')->insert([
            'name'  => 'Administrator',
            'slug'  => 'administrator',
        ]);

        // add role to user.
        \DB::table('admin_role_users')->truncate();
        \DB::table('admin_role_users')->insert([
            'role_id'  =>1,
            'user_id'  =>1,
        ]);

        //create a permission
        \DB::table('admin_permissions')->truncate();
        \DB::table('admin_permissions')->insert([
            [
                'name'        => '所有角色',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => '控制面板',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => '登录',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => '用户设置',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => '认证管理',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);

        \DB::table('admin_role_permissions')->truncate();
        \DB::table('admin_role_permissions')->insert([
            'role_id'  =>1,
            'permission_id'  =>1,
        ]);
        // add default menus.
        \DB::table('admin_menu')->truncate();
        \DB::table('admin_menu')->insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => '首页',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '管理中心',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => '用户管理',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => '角色管理',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => '权限管理',
                'icon'      => 'fa-ban',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => '菜单管理',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => '操作日志',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => '辅助工具',
                'icon'      => 'fa-cogs',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 8,
                'order'     => 9,
                'title'     => '脚手架',
                'icon'      => 'fa-code',
                'uri'       => 'helpers/scaffold',
            ],
            [
                'parent_id' => 8,
                'order'     => 10,
                'title'     => '数据库',
                'icon'      => 'fa-database',
                'uri'       => 'helpers/terminal/database',
            ],
            [
                'parent_id' => 8,
                'order'     => 11,
                'title'     => '命令行',
                'icon'      => 'fa-terminal',
                'uri'       => 'helpers/terminal/artisan',
            ],
            [
                'parent_id' => 8,
                'order'     => 12,
                'title'     => '路由信息',
                'icon'      => 'fa-crosshairs',
                'uri'       => 'helpers/routes',
            ],
        ]);

        // add role to menu.
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert([
            'role_id'  =>1,
            'menu_id'  =>2,
        ]);
    }
}
