<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\MakeOrderNotify;
use App\User;

class ParentOrderNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parent:ordernotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Parents on making meal orders on weekends for their children Thursday at 5.00PM for the following days or weeks.';

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
        $parentdet = User::all();
        foreach ($parentdet as $parent) {
            Mail::to($parent->email, $parent->username)->send(new MakeOrderNotify($parent));
        }
        $this->info('All Parents have been notified to make meal orders for entire week school session.');
    }
}
