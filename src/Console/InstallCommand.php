<?php

namespace Timsteinhauer\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'livewirecrud:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Livewire Crud resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Livewire Crud resources...');
        $this->callSilent('vendor:publish', ['--tag' => 'livewirecrud-views']);

        $this->info('Livewire Crud scaffolding installed successfully.');
    }

}
