<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Binarcode\LaravelMailator\Tests\Fixtures\InvoiceReminderMailable;
use Binarcode\LaravelMailator\Tests\Fixtures\SerializedConditionCondition;

class notifyAbsent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Scheduler::init('Invoice reminder.')
        ->mailable(new InvoiceReminderMailable($invoice))
        ->recipients('foo@binarcode.com', 'baz@binarcode.com')
        ->constraint(new SerializedConditionCondition($invoice))
        ->days(3)
        ->before($invoice->due_date)
        ->save();
        return Command::SUCCESS;
    }
}
