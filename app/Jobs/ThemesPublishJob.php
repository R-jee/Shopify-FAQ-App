<?php namespace App\Jobs;

use App\Models\Configuration;
use App\Models\User;
use http\Client;
use http\Client\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;

class ThemesPublishJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain.
     * @param stdClass $data       The webhook data (JSON decoded).
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $activeThemeId = $this->data->id;
        $this->shopDomain = ShopDomain::fromNative($this->shopDomain);
         info( json_encode($this->data->id) );
        // info( $this->shopDomain->toNative() );
        $shop__domain = $this->shopDomain->toNative();
        $shop__ = User::where('name', $shop__domain)->get()->toArray();

        if( $shop__ ){
            if( isset($shop__[0]) ) {
                $shopId = $shop__[0]['id'];
                $shop = User::find($shopId);
                $configuration = Configuration::where('shop_url', $shop__domain)->first();
                $previous_theme_id = $configuration->theme_id;
                $url = redirect()->route("handle-themePublishWebhook-request")->getTargetUrl();
                $curl_url = "$url?shop_url=$shop__domain&activeThemeId=$activeThemeId&previous_theme_id=$previous_theme_id";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $curl_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
                curl_exec($ch);
                curl_close($ch);
                info("ThemesPublishJob Done.");
            }
        }
    }
    public function CreateAssetsFromLiquidFile($shop, $activeThemeId, $assetType, $assetFileName, $fileExtension, $fileViewLiquidPathName){
        $file_path = resource_path("views/liquid/$fileViewLiquidPathName");
        $file_contents = file_get_contents($file_path);
        // info( $file_contents );
        $fileURL = $assetType ."/". $assetFileName .".". $fileExtension;
        $Data = array(
            'asset' => array(
                'key' => $fileURL,
                'value' => $file_contents
            )
        );
        $shop->api()->rest('PUT', '/admin/themes/' . $activeThemeId . '/assets.json', $Data);
        // info( json_encode($theme_assetCreated) );
    }

    public function EmptyOutAssetsFromLiquidFile($shop, $previousThemeId, $assetType, $assetFileName, $fileExtension){
        $file_path = resource_path("views/liquid/empty.txt");
        // $file_contents = file_get_contents($file_path);
        $fileURL = $assetType ."/". $assetFileName .".". $fileExtension;
        // info($fileURL);
        $Data = array(
            'asset' => array(
                'key' => $fileURL,
                'value' => ""
            )
        );
        $shop->api()->rest('PUT', '/admin/themes/' . $previousThemeId . '/assets.json', $Data);
        //        info( json_encode($theme_assetEmptyOut['body']) );
    }

}
