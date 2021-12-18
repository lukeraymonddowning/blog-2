<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Contracts\Services\YouTube;
use Illuminate\Console\Command;

final class ImportVideosCommand extends Command
{
    protected $signature = 'site:import-videos';

    protected $description = 'Import videos from my YouTube channel.';

    public function handle(YouTube $youtube): int
    {
        $youtube->importVideos();

        $this->info('Videos imported successfully!');

        return Command::SUCCESS;
    }
}
