<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class dev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post =Post::find(12);
        dd($post->users);
    }
}
