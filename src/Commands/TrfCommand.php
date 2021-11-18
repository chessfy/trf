<?php

namespace Chessfy\Trf\Commands;

use Illuminate\Console\Command;

class TrfCommand extends Command
{
    public $signature = 'trf';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
