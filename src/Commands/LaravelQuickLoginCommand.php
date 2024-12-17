<?php

namespace GustavoVasquez\LaravelQuickLogin\Commands;

use Illuminate\Console\Command;

class LaravelQuickLoginCommand extends Command
{
    public $signature = 'laravel-quick-login';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
