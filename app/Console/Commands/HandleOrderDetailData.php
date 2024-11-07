<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class HandleOrderDetailData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:order-details';

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
        $orders = Order::all();

        $orders->each(function ($order) {
            $order->orderDetails()->create([
                'order_id' => $order->id,
                'collection_id' => $order->collection_id,
                'color' => $order->color,
                'size' => $order->size,
                'amount' => $order->amount
            ]);
        });

        $this->info('success');
    }
}
