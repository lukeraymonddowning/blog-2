<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Wink\WinkAuthor;

final class SetupCommand extends Command
{
    protected $signature = 'site:setup
        {name? : The name of the author}
        {email? : The email to use for the author}
        {password? : The password to use for the author}
        {--force : Force this command, even if it destroys existing data}
    ';

    protected $description = 'Install this site on a new server.';

    public function handle(): int
    {
        $this->call($this->option('force') ? 'migrate:fresh' : 'migrate');
        $this->call('migrate', [
            '--path' => 'vendor/themsaid/wink/src/Migrations',
        ]);

        $this->line('Let\'s set up an author account.');
        $this->newLine();

        $name = strval($this->argument('name') ?? $this->ask('Name'));
        $email = strval($this->argument('email') ?? $this->ask('Email address'));
        $password = strval($this->argument('password') ?? $this->secret('Password'));

        WinkAuthor::query()->create([
            'id' => Str::uuid(),
            'name' => $name,
            'bio' => '',
            'slug' => Str::slug($name),
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Successfully created {$name} with the email address {$email}.");

        return Command::SUCCESS;
    }
}
