<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ivampiresp\Cocoa\Models\Admin;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        // if is local
        if (app()->environment() == 'local') {
            $this->info('由于是 local 环境，将会自动创建 Admin 用户。');
            (new Admin)->create([
                'name' => 'Test',
                'email' => 'im@ivampiresp.com',
                'password' => bcrypt('123456'),
            ]);
            $this->info('邮箱: im@ivampiresp.com, 密码: 123456');

            return 0;
        }
        // ask for the name of the admin to create
        $name = $this->ask('请输入用户名');
        // ask for the email of the admin to create
        $email = $this->ask('请输入邮箱');

        // enter password
        $password = $this->secret('请输入密码(密码不会显示在终端)');

        // create the admin
        (new Admin)->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info('管理员创建成功！');
        return 0;
    }
}
