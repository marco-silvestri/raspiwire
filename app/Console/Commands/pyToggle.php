<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class switchOnServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relay:toggle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Switch on the NAS, by sending a GPIO pulse on a relay and mounting a disk on fstab';

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
     * @return int
     */
    public function handle()
    {
        $cmd = 'python '.base_path().'/switchOn.py';
        exec($cmd);
    }
}
