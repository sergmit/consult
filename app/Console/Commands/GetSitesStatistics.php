<?php

namespace App\Console\Commands;

use App\Services\CallibriService;
use Illuminate\Console\Command;

class GetSitesStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callibri:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var CallibriService
     */
    private $callibriService;

    /**
     * Create a new command instance.
     *
     * @param CallibriService $callibriService
     */
    public function __construct(CallibriService $callibriService)
    {
        parent::__construct();
        $this->callibriService = $callibriService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->callibriService->getSitesStatistics();
        $this->info('Statistics is loaded');
        return 0;
    }
}
