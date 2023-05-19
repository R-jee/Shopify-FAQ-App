<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\ShopModel;

class AfterAuthenticateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's instance.
     *
     * @var ShopModel
     */
    protected $shop;

    /**
     * Create a new job instance.
     *
     * @param ShopModel $shop The shop's object
     *
     * @return void
     */
    public function __construct(ShopModel $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // info($this->shop);
        if ($this->shop->created_at->diffInDays(Carbon::today()) !== 0) {
            // Shop is older than a day, we should've ran this by now, kill it
            return;
        }
        if (!$this->shop->isGrandfathered()) {
            $planName = $this->shop->api()->rest('GET', '/admin/shop.json')['body']['container']['shop']['plan_name'];
            // info($planName);
            if ($planName === 'affiliate' || $planName === 'staff_business') {
                $this->shop->shopify_grandfathered = true;
                $this->shop->save();
            }
        }
    }
}
