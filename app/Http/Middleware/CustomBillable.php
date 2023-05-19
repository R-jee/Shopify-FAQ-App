<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class CustomBillable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // info(json_encode($request));
        if( Config::get('shopify-app.billing_enabled') === true  ){
            $shop = auth()->user();

            if(!$shop->isFreemium() && !$shop->isGrandfathered() && $shop->plan == null ){
                // if(!$shop->shopify_freemium && !$shop->shopify_grandfathered && $shop->plan == null ){
                return redirect()->route('plans');
            }
        }
        return $next($request);
    }
}