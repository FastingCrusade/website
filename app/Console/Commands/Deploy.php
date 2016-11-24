<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class Deploy
 *
 * Handles deployment from Github.
 *
 * @package App\Console\Commands
 */
class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploys updates to servers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO DRY out the logging into a single method.
        // TODO Use the ProcessBuilder factory.
        $path = base_path();
        /** @var Process $process */
        // TODO Composer install script should handle more of this.
        $process = App::make('Symfony\Component\Process\Process', ["git pull && composer install && npm install && gulp"]);
        $process->setWorkingDirectory($path);
        Log::info("Beginning to deploy...");
        $this->info("Beginning to deploy.");
        // TODO This is noisy as fuck! Maybe look for silencing NPM skips.

        try {
            $process->mustRun(function ($type, $buffer) {
                if ($type === Process::ERR) {
                    $this->error($buffer);
                    Log::error($buffer);
                    // TODO Send failed deployment event.
                }
            });
        } catch (ProcessFailedException $exception) {
            $this->error("FAILED {$exception->getMessage()}.");
        }

        if ($process->isSuccessful()) {
            $this->info('Deployment complete.');
            Log::info('Deployment complete.');
        } else {
            Log::error('Deployment failed.');
            $this->error('Deployment failed.');
        }

        return $process->isSuccessful();
    }
}
