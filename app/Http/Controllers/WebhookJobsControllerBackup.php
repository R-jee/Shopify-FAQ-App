<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Psy\Util\Str;

class WebhookJobsController extends Controller
{

    public function createScriptTag(Request $request)
    {
        try{
            if(Auth::user()){
                $shop = Auth::user();
                $domain = $shop->getDomain()->toNative();
                $configuration = Configuration::where('shop_url', $domain)->first();
                $SHOPIFY_API_VERSION = env('SHOPIFY_API_VERSION');
                $script_URL = env('SHOPIFY_SCRIPTTAG_1_SRC');
                if($configuration){
                    if( ($configuration['shopify_scripttag_id']) == "null"){
                        $scriptTagArray = array(
                            "script_tag" => array(
                                "event" => 'onload',
                                "src" => "$script_URL"
                            )
                        );
                        $script_tag = $shop->api()->rest('POST', "/admin/api/$SHOPIFY_API_VERSION/script_tags.json", $scriptTagArray);
                        $script_tag_id = $script_tag['body']['script_tag']['id'];
                        $edit_config = Configuration::where('shop_url',  $domain)->first();
                        $edit_config->shopify_scripttag_id = $script_tag_id;
                        if ($edit_config->update()) {
                            info('ScriptTags Created!.');
                        }
                    }elseif( ($configuration['shopify_scripttag_id']) != "null" )  {
                        $get_config = Configuration::where('shop_url', $domain)->first();
                        $scriptTag_id = $get_config['shopify_scripttag_id'];
                        $scriptTagPutArray = array(
                            "script_tag" => array(
                                "id" => "$scriptTag_id",
                                "src" => "$script_URL"
                            )
                        );
                        $script_tag = $shop->api()->rest('PUT', "/admin/api/$SHOPIFY_API_VERSION/script_tags/" . $scriptTag_id . ".json", $scriptTagPutArray);
                        $script_tag_id = $script_tag['body']['script_tag']['id'];
                        $edit_config = Configuration::where('shop_url', $domain)->first();
                        $edit_config->shopify_scripttag_id = $script_tag_id;
                        if ($edit_config->update()) {
                            info('ScriptTags PUT Updated!.');
                        }
                    }
                }
            }
        }
        catch(Exception $e){
            return dd( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }
    public function createScriptTagCallback(Request $request): void
    {
        try{
            info("ScriptTag createScriptTagCallback function :: --- Shop_url :: " .$request->input("shop_url"));
            $domain = $request->input("shop_url");
            $shop = $this->getShopModelShopifyUser($domain);
            $SHOPIFY_API_VERSION = env('SHOPIFY_API_VERSION');
            $script_URL = env('SHOPIFY_SCRIPTTAG_1_SRC');
            $configuration = Configuration::where('shop_url', $domain)->first();
            if($configuration){
                if( ($configuration['shopify_scripttag_id']) == "null"){
                    $scriptTagArray = array(
                        "script_tag" => array(
                            "event" => 'onload',
                            "src" => "$script_URL"
                        )
                    );
                    $script_tag = $shop->api()->rest('POST', "/admin/api/$SHOPIFY_API_VERSION/script_tags.json", $scriptTagArray);
                    $script_tag_id = $script_tag['body']['script_tag']['id'];
                    $edit_config = Configuration::where('shop_url',  $domain)->first();
                    $edit_config->shopify_scripttag_id = $script_tag_id;
                    if ($edit_config->update()) {
                        info('ScriptTags Created!.');
                    }
                }elseif( ($configuration['shopify_scripttag_id']) != "null" )  {
                    $get_config = Configuration::where('shop_url', $domain)->first();
                    $scriptTag_id = $get_config['shopify_scripttag_id'];
                    $scriptTagPutArray = array(
                        "script_tag" => array(
                            "id" => "$scriptTag_id",
                            "src" => "$script_URL"
                        )
                    );
                    $script_tag = $shop->api()->rest('PUT', "/admin/api/$SHOPIFY_API_VERSION/script_tags/" . $scriptTag_id . ".json", $scriptTagPutArray);
                    $script_tag_id = $script_tag['body']['script_tag']['id'];
                    $edit_config = Configuration::where('shop_url', $domain)->first();
                    $edit_config->shopify_scripttag_id = $script_tag_id;
                    if ($edit_config->update()) {
                        info('ScriptTags PUT Updated!.');
                    }
                }
            }
        }
        catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }

    public function createOrCheckScriptTags($shop__domain): void
    {
        $url = redirect()->route("handle-create-scriptTagCallback-request")->getTargetUrl();
        $curl_url = "$url?shop_url=$shop__domain";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
        curl_exec($ch);
        curl_close($ch);

    }

    public function createAllWebhooks(Request $request): void
    {
        try{
            $shop = Auth::user();
            $domain = $shop->getDomain()->toNative();
            $configuration = Configuration::where('shop_url', $domain)->first();
            //return $request->input();
            //die();
            $webhook_array = array(
                "webhook" => array(
                    "topic"   => "app/uninstalled",
                    "address" =>  env('APP_URL') . "/webhook/app-uninstalled",
                    "format"  => "json"
                )
            );
            $webhook_result = $shop->api()->rest('POST', '/admin/api/'. env('SHOPIFY_API_VERSION') .'/webhooks.json', $webhook_array );
            $webhook_array = array(
                "webhook" => array(
                    "topic"   => "products/create",
                    "address" =>  env('APP_URL') . "/webhook/products-create",
                    "format"  => "json"
                )
            );
            $webhook_result = $shop->api()->rest('POST', '/admin/api/'. env('SHOPIFY_API_VERSION') .'/webhooks.json', $webhook_array );
            info('Webhooks Created.');
            // return redirect()->route('configuration' , array_merge($request->input(), ['request' => $request , 'shop' => $domain]) );
        }
        catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine() );
        }
    }
    /**
     * @param Request $request
     * working on themes amd webhooks in tjis function
     */
    public function checkWebHooks(Request $request)
    {
        try{
            if (isset(auth()->user()->name)) {
                $shop = Auth::user();
                $domain = $shop->getDomain()->toNative();
                $configuration = Configuration::where('shop_url', $domain)->first();
                /*  Getting theme id  */
                $activeThemeId = "";
                $themes = $shop->api()->rest('GET', '/admin/themes.json');
                foreach ($themes['body']->container['themes'] as $theme) {
                    if ($theme['role'] == "main") {
                        $activeThemeId = $theme['id'];
                    }
                }
                if (empty($configuration)) {
                    $this->createAllWebhooks($request);
                    /* This function will create assets when our app first time installed */
                    $new_config = new Configuration();
                    $new_config->shop_url = $domain;
                    $new_config->webhook_status = 1;
                    $new_config->theme_id = $activeThemeId;
                    if ($new_config->save()) {
                        if($new_config['themepublish_assets_status'] == 0){
                            $this->checkForAssetsInThemeFirstTime($domain, $activeThemeId);
                            $edit_config = Configuration::where('shop_url',  $domain)->first();
                            $edit_config->themepublish_assets_status = 1;
                            if ($edit_config->update()) {
                                $this->createOrCheckScriptTags($domain);
                                return redirect()->route('configuration' , array_merge($request->input(), ['request' => $request , 'shop' => $domain]));
                            }
                        }
                        $this->createOrCheckScriptTags($domain);
                        return redirect()->route('configuration' , array_merge($request->input(), ['request' => $request , 'shop' => $domain]) );
                    }
                } else {
                    if ($configuration['webhook_status'] == 0) {
                        $this->createAllWebhooks($request);
                        $edit_config = Configuration::where('shop_url',  $domain)->first();
                        $edit_config->webhook_status = 1;
                        $edit_config->theme_id = $activeThemeId;
                        if ($edit_config->update()) {
                            $this->createOrCheckScriptTags($domain);
                            return redirect()->route('configuration' , array_merge($request->input(), ['request' => $request , 'shop' => $domain]));
                        }
                    }
                    if ($configuration['themepublish_assets_status'] == 0) {
                        $this->checkForAssetsInThemeFirstTime($domain, $activeThemeId);
                        $edit_config = Configuration::where('shop_url',  $domain)->first();
                        $edit_config->themepublish_assets_status = 1;
                        if ($edit_config->update()) {
                            $this->createOrCheckScriptTags($domain);
                            return redirect()->route('configuration' , array_merge($request->input(), ['request' => $request , 'shop' => $domain]));
                        }
                    }
                    $this->createOrCheckScriptTags($domain);
                    return redirect()->route('configuration', ['request' => $request , 'shop' => $domain] );
                }
            }
            return redirect('/configuration');
        }
        catch(Exception $e){
            return dd( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }

    public function getAllWebhooks(Request $request)
    {
        try{
            $shop = Auth::user();
            $webhook_result = $shop->api()->rest('GET', '/admin/api/'. env('SHOPIFY_API_VERSION') .'/webhooks.json', array() );
            echo '<pre>';
            print_r( ($webhook_result['body']['container']['webhooks']) );
            echo '</pre>';
        }  catch(Exception $e){
            return dd( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }

    public function handleThemePublishWebhookRequest(Request $request)
    {
        try{
            info("ActiveThemeId :: ". $request->input("activeThemeId") . " --- Shop_url :: " .$request->input("shop_url") . " --- Previous_theme_id :: " .$request->input("previous_theme_id"));
            $activeThemeId = $request->input("activeThemeId");
            $shop__ = User::where('name', $request->input("shop_url"))->get()->toArray();
            if( $shop__ ){
                if( isset($shop__[0]) ) {
                    $shopId = $shop__[0]['id'];
                    info("Shop_ID" . $shopId);
                    $shop = User::find($shopId);
                    $configuration = Configuration::where('shop_url', $request->input("shop_url"))->first();
                    $previous_theme_id = $configuration->theme_id;
                    if( asset($previous_theme_id) ):
                        $this->deleteAssetOnOtherThemePublished($shop, $previous_theme_id);
                        $this->AssetCreatedOnAppInstalledOrThemeChanged($shop, $activeThemeId);
                        $configuration->theme_id = $activeThemeId;
                        if ($configuration->save()) {
                            info("Done Updating Theme ID");
                        }
                    endif;
                }
            }
        } catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
        return;
    }

    public function AssetCreatedOnAppInstalledOrThemeChangedRequest(Request $request)
    {
        try{
            info("ActiveThemeId :: ". $request->input("activeThemeId") . " --- Shop_url :: " .$request->input("shop_url"));
            $shop_url = $request->input("shop_url") ?? "";
            $activeThemeId = $request->input("activeThemeId") ?? null;
            if($shop_url != "" && $activeThemeId != 0){
                $configuration = Configuration::where('shop_url', $shop_url)->first();
                if ($configuration){
                    if ($configuration['themepublish_assets_status'] == 0) {
                        $this->AssetCreatedOnAppInstalledOrThemeChanged( $this->getShopModelShopifyUser($shop_url), $activeThemeId);
                        $configuration->themepublish_assets_status = 1;
                        if($configuration->update()){
                            info("First Time Assets Added In Theme ($activeThemeId) Due to App Installed");
                        }
                    }
                }
            }
        } catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }

    public function checkForAssetsInThemeFirstTime($domain, $activeThemeId): void
    {
        try {
            $url = redirect()->route("handle-asset-created-onAppInstalled-Or-themeChanged-request")->getTargetUrl();
            $curl_url = "$url?shop_url=$domain&activeThemeId=$activeThemeId";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
            curl_exec($ch);
            curl_close($ch);
        }
        catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine());
        }
    }

    public function CreateAssetsFromLiquidFile($shop, $activeThemeId, $assetType, $assetFileName, $fileExtension, $fileViewLiquidPathName): void
    {
        $file_path = resource_path("views/liquid/$fileViewLiquidPathName");
        $file_contents = file_get_contents($file_path);
        if($fileExtension == "ttf" || $fileExtension == "woff2"){
            $font_base64_data = base64_encode($file_contents);
            $file_contents = $font_base64_data;
            // info( $file_contents );
        }
        $fileURL = "$assetType/$assetFileName.$fileExtension";
        $Data = array(
            'asset' => array(
                'key' => $fileURL,
                'value' => $file_contents
            )
        );
        $shop->api()->rest('PUT', '/admin/themes/' . $activeThemeId . '/assets.json', $Data);
        // info( json_encode($theme_assetCreated) );
    }

    public function EmptyOutAssetsFromLiquidFile($shop, $previousThemeId, $assetType, $assetFileName, $fileExtension): void
    {
        $fileURL = "$assetType/$assetFileName.$fileExtension";
        // info($fileURL);
        if($assetType == "templates"){
            $file_path = resource_path("views/liquid/empty.json");
            $file_contents = file_get_contents($file_path);
            $Data = array(
                'asset' => array(
                    'key' => $fileURL,
                    'value' => $file_contents
                )
            );
        }else{
            $Data = array(
                'asset' => array(
                    'key' => $fileURL,
                    'value' => ""
                )
            );
        }
        $shop->api()->rest('PUT', '/admin/api/themes/' . $previousThemeId . '/assets.json', $Data);
        // info( json_encode($theme_assetEmptyOut) );
    }

    public function AssetCreatedOnAppInstalledOrThemeChanged($shop, $activeThemeId): void
    {
        try {
            $this->CreateAssetsFromLiquidFile($shop, $activeThemeId, "sections", "rjee_faqs_section", "liquid","rjee_faqs_section.liquid");
            $this->CreateAssetsFromLiquidFile($shop, $activeThemeId, "templates", "page.rjee_FAQs", "json","rjee_FAQs.json");

            $this->CreateAssetsFromLiquidFile($shop, $activeThemeId, "assets", "rjee_vendor", "css","vendor.css.liquid");
            $this->CreateAssetsFromLiquidFile($shop, $activeThemeId, "assets", "rjee_vendor", "js","vendor.js.liquid");
        } catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine() );
        }
    }
    public function deleteAssetOnOtherThemePublished($shop, $previous_theme_id): void
    {
        try {
            $this->EmptyOutAssetsFromLiquidFile($shop, $previous_theme_id, "templates", "page.rjee_FAQs", "json");
            $this->EmptyOutAssetsFromLiquidFile($shop, $previous_theme_id, "sections", "rjee_faqs_section", "liquid");

            $this->EmptyOutAssetsFromLiquidFile($shop, $previous_theme_id, "assets", "rjee_vendor", "css");
            $this->EmptyOutAssetsFromLiquidFile($shop, $previous_theme_id, "assets", "rjee_vendor", "js");

            info("Done deleting Assets");
        } catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }

    public function getShopModelShopifyUser($shop_url) : User
    {
        $shopModel = new User() ?? null;
        $shop__domain = $shop_url;
        $shop__ = User::where('name', $shop__domain)->get()->toArray();
        if( $shop__ ){
            if( isset($shop__[0]) ) {
                $shopId = $shop__[0]['id'];
                $shopModel = User::find($shopId);
            }
        }
        return $shopModel;
    }
}
