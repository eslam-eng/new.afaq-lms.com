<?php

namespace App\Jobs;

use App\Payments\Gateways\Hyber\Hyber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CheckPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment_getway = new Hyber();

        $all_payments = DB::table('all_payments')->get();
        foreach ($all_payments as $payment) {
          $result = $payment_getway->getPaymentStatus($payment->invoice_id);
          dd($result);
        }
    }
}
