<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'make:admin';
    protected $description = 'Create an admin user';

    public function handle()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@kornatitours.com',
            'password' => Hash::make('password'),
        ]);

        $this->info('Admin user created successfully!');
        $this->info('Email: admin@kornatitours.com');
        $this->info('Password: password');
    }
} 