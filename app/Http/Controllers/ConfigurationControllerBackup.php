<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Osiset\ShopifyApp\Actions\CancelCurrentPlan;
use Osiset\ShopifyApp\Storage\Commands\Shop as IShopCommand;
use Osiset\ShopifyApp\Storage\Models\Plan;
use Osiset\ShopifyApp\Storage\Queries\Shop as IShopQuery;

class ConfigurationController extends Controller
{
    //
    public function index(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Origin: *.myshopify.com');
        header('Content-Security-Policy: frame-ancestors *');
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $configuration = Configuration::where('shop_url', $domain)->first();
        return view('configuration')->with(array_merge(['configuration' => $configuration, 'shop' => $domain, 'request' => $request]));
        // return view('configuration');
    }

    public function getFileJson(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Origin: *.myshopify.com');
        header('Content-Security-Policy: frame-ancestors *');
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();

        $configuration = Configuration::where('shop_url', $domain)->first();

        return view('configuration')->with(array_merge(['configuration' => $configuration, 'shop' => $domain, 'request' => $request]));
        // return view('configuration');
    }

    public function get_themeid(Request $request){
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $activeThemeId = "";
        $themes = $shop->api()->rest('GET', '/admin/themes.json');
        foreach ($themes['body']->container['themes'] as $theme) {
            if ($theme['role'] == "main") {
                $activeThemeId = $theme['id'];
            }
        }
        return $activeThemeId;
    }

    public function storepreviousthemeid(Request $request){
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $themes = $shop->api()->rest('GET', '/admin/themes.json');
        $ThemeId = "";
        foreach ($themes['body']->container['themes'] as $theme) {
            if ($theme['role'] == "unpublished") {
                $ThemeId = $theme['id'];
            }
        }
        $new_config = new Configuration();
        $new_config->shop_url = $domain;
        $new_config->theme_id = $ThemeId;
        if ($new_config->save()) {
            return "Theme Id saved!!!";
        }
    }

    public function getAllPlans(Request $request){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Origin: *.myshopify.com');
        header('Content-Security-Policy: frame-ancestors *');
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative() ?? $request->input('shop');
        $plans = Plan::all();
        return view("billing")->with(array_merge($request->input(), ['plans' => $plans, 'shop' => $domain, 'request' => $request]));
    }

    public function freePlan( Request $request, IShopCommand $shopCommand , IShopQuery $shopQuery, CancelCurrentPlan $cancelCurrentPlanAction ){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Origin: *.myshopify.com');
        header('Content-Security-Policy: frame-ancestors *');
        ///////////////////////////////////////////////////
        $shop = Auth::user();
        $cancelRecurring_application_charges = DB::table('charges')->where('user_id' , $shop->id)->where('status' , "ACTIVE")->where('plan_id', $shop->plan_id)->first();
        if( $cancelRecurring_application_charges ){
            $charge_canceled = $shop->api()->rest('DELETE', "/admin/api/". env('SHOPIFY_API_VERSION') ."/recurring_application_charges/". $cancelRecurring_application_charges->charge_id .".json", array());
            $get_charge_data = $shop->api()->rest('PUT', "/admin/api/". env('SHOPIFY_API_VERSION') ."/recurring_application_charges/". $cancelRecurring_application_charges->charge_id ."/customize.json", array(
                "recurring_application_charge" => [
                    'status' => "cancelled"
                ]
            ));
            DB::table('charges')->where([ 'user_id' => auth()->user()->id, 'status' => "ACTIVE"] )->update(
                array(
                    'cancelled_on' => date('Y-m-d 00:00:00'),
                    'expires_on' => date('Y-m-d 00:00:00'),
                    'trial_days' => 0,
                    'status' => "CANCELLED"
                )
            );
            User::where('id' , auth()->user()->id )->update([
                'plan_id' => NULL,
                'shopify_freemium' => 1
            ]);
        }else{
            User::where('id' , auth()->user()->id )->update([
                'plan_id' => NULL,
                'shopify_freemium' => 1
            ]);
        }
        return redirect()->route('home', array_merge($request->input(), ['request' => $request, 'shop' => $shop->name]) );
        // return $this->index($request);
    }
    /**
     * Get User selected plan
     *
     * @param Request $request
     * @return "" | null | mixed;
     */
    public function userSelectedPlan(Request $request)
    {
        if( Auth::user() ){
            if( Auth::user()->shopify_freemium == 1 ){
                $shop = Auth::user()->shop;
                return view('liquid.active_plan')->with(['shop'=> $shop , 'activePlan' => null ])->render();
            }else{
                $shop = Auth::user()->shop;
                $plan_id = Auth::user()->plan_id;
                if( !empty($plan_id)  ){
                    $config = Configuration::where('shop_url', $shop)->where('');
                    $plan = DB::table('charges')->where('plan_id', $plan_id)->where('user_id', Auth::user()->id )->where('status', "ACTIVE")->first();
                    if( $plan ){
                        return view('liquid.active_plan')->with(['shop'=> $shop , 'activePlan' => $plan ])->render();
                    }
                }else{
                    return "";
                }
            }
        }
        return '';
    }

    /*   public function Save configuration page settings

        @param Request $request
        @return void
    */
//    public function saveConfiguration(Request $request)

//    {
//        // Validate the request data
//        /** @var TYPE_NAME $validatedData */
//
//        $validatedData = $request->validate([
//            'is_enabled' => 'required|boolean',
//            'rjee_faqs_background_color' => 'required|string',
//            'rjee_faqs_margin_top' => 'required|integer',
//            'rjee_faqs_margin_bottom' => 'required|integer',
//            'rjee_faqs_margin_left' => 'required|integer',
//            'rjee_faqs_margin_right' => 'required|integer',
//
//            'rjee_faqs_padding_top' => 'required|integer',
//            'rjee_faqs_padding_bottom' => 'required|integer',
//            'rjee_faqs_padding_left' => 'required|integer',
//            'rjee_faqs_padding_right' => 'required|integer',
//
//            'rjee_faqs_header_text' => 'required|string',
//            'rjee_faqs_header_text_font' => 'required|string',
//            'rjee_faqs_header_text_color' => 'required|string',
//            'rjee_faqs_header_text_font_size' => 'required|integer',
//            'rjee_faqs_header_align_text' => 'required|string',
//
//            'rjee_faqs_header_text_margin_top' => 'required|integer',
//            'rjee_faqs_header_text_margin_bottom' => 'required|integer',
//            'rjee_faqs_header_text_margin_left' => 'required|integer',
//            'rjee_faqs_header_text_margin_right' => 'required|integer',
//
//            'rjee_faqs_header_text_padding_top' => 'required|integer',
//            'rjee_faqs_header_text_padding_bottom' => 'required|integer',
//            'rjee_faqs_header_text_padding_left' => 'required|integer',
//            'rjee_faqs_header_text_padding_right' => 'required|integer',
//
//            'accordion_item_margin_top' => 'required|integer',
//            'accordion_item_margin_bottom' => 'required|integer',
//            'accordion_item_margin_left' => 'required|integer',
//            'accordion_item_margin_right' => 'required|integer',
//
//            'accordion_item_question_background_color' => 'required|string',
//            'accordion_item_question_background_active_color' => 'required|string',
//
//            'accordion_item_question_text_font_size' => 'required|integer',
//            'accordion_item_question_align_text' => 'required|string',
//            'accordion_item_question_text_font' => 'required|string',
//            'accordion_item_question_text_color' => 'required|string',
//            'accordion_item_question_text_active_color' => 'required|string',
//
//            'accordion_item_question_border_color' => 'required|string',
//            'accordion_item_question_border_active_color' => 'required|string',
//            'accordion_item_question_focus_color' => 'required|string',
//
//            'accordion_item_question_border_size' => 'required|integer',
//            'accordion_item_question_border_radius_topleft' => 'required|integer',
//            'accordion_item_question_border_radius_topright' => 'required|integer',
//            'accordion_item_question_border_radius_bottomleft' => 'required|integer',
//            'accordion_item_question_border_radius_bottomright' => 'required|integer',
//
//            'accordion_item_question_border_radius_after_topleft' => 'required|integer',
//            'accordion_item_question_border_radius_after_topright' => 'required|integer',
//            'accordion_item_question_border_radius_after_bottomleft' => 'required|integer',
//            'accordion_item_question_border_radius_after_bottomright' => 'required|integer',
//
//            'accordion_item_question_collapse_icon_align' => 'required|string',
//            'accordion_item_question_non_collapse_icon' => 'required|string',
//            'accordion_item_question_collapse_icon_font_size' => 'required|integer',
//            'accordion_item_question_collapse_icon_line_height' => 'required|integer',
//            'accordion_item_question_collapse_icon_padding_left' => 'required|integer',
//            'accordion_item_question_collapse_icon_padding_right' => 'required|integer',
//            'accordion_item_question_collapse_icon_padding_top' => 'required|integer',
//            'accordion_item_question_collapse_icon_padding_bottom' => 'required|integer',
//        ]);
//
//        // Get the current user's configuration (assuming you have a user_id column in your configuration table)
//        $configuration = Configuration::where('user_id', auth()->user()->id)->first();
//
//        // If the configuration doesn't exist, create a new one
//        if (!$configuration) {
//            $configuration = new Configuration();
//            $configuration->user_id = auth()->user()->id;
//        }
//
//        // Update the configuration values with the validated data
//        $configuration->is_enabled = $validatedData['is_enabled'] ?? 0;
//        $configuration->rjee_faqs_background_color = $validatedData['rjee_faqs_background_color'] ?? null;
//
//        $configuration->rjee_faqs_margin_top = $validatedData['rjee_faqs_margin_top'] ?? 10;
//        $configuration->rjee_faqs_margin_bottom = $validatedData['rjee_faqs_margin_bottom'] ?? 10;
//        $configuration->rjee_faqs_margin_left = $validatedData['rjee_faqs_margin_left'] ?? 10;
//        $configuration->rjee_faqs_margin_right = $validatedData['rjee_faqs_margin_right'] ?? 10;
//
//        $configuration->rjee_faqs_padding_top = $validatedData['rjee_faqs_padding_top'] ?? 20;
//        $configuration->rjee_faqs_padding_bottom = $validatedData['rjee_faqs_padding_bottom'] ?? 20;
//        $configuration->rjee_faqs_padding_left = $validatedData['rjee_faqs_padding_left'] ?? 20;
//        $configuration->rjee_faqs_padding_right = $validatedData['rjee_faqs_padding_right'] ?? 20;
//
//        $configuration->rjee_faqs_header_text = $validatedData['rjee_faqs_header_text'] ?? 'FAQ > ORDER/PAYMENT/CANCELLATION';
//        $configuration->rjee_faqs_header_text_font = $validatedData['rjee_faqs_header_text_font'] ?? 'Regular';
//        $configuration->rjee_faqs_header_text_color = $validatedData['rjee_faqs_header_text_color'] ?? '#000000';
//        $configuration->rjee_faqs_header_text_font_size = $validatedData['rjee_faqs_header_text_font_size'] ?? 24;
//        $configuration->rjee_faqs_header_align_text = $validatedData['rjee_faqs_header_align_text'] ?? 'left';
//
//        $configuration->rjee_faqs_header_text_margin_top = $validatedData['rjee_faqs_header_text_margin_top'] ?? 20;
//        $configuration->rjee_faqs_header_text_margin_bottom = $validatedData['rjee_faqs_header_text_margin_bottom'] ?? 0;
//        $configuration->rjee_faqs_header_text_margin_left = $validatedData['rjee_faqs_header_text_margin_left'] ?? 0;
//        $configuration->rjee_faqs_header_text_margin_right = $validatedData['rjee_faqs_header_text_margin_right'] ?? 0;
//
//        $configuration->rjee_faqs_header_text_padding_top = $validatedData['rjee_faqs_header_text_padding_top'] ?? 0;
//        $configuration->rjee_faqs_header_text_padding_bottom = $validatedData['rjee_faqs_header_text_padding_bottom'] ?? 10;
//        $configuration->rjee_faqs_header_text_padding_left = $validatedData['rjee_faqs_header_text_padding_left'] ?? 10;
//        $configuration->rjee_faqs_header_text_padding_right = $validatedData['rjee_faqs_header_text_padding_right'] ?? 10;
//
//        $configuration->accordion_item_margin_top = $validatedData['accordion_item_margin_top'] ?? 0;
//        $configuration->accordion_item_margin_bottom = $validatedData['accordion_item_margin_bottom'] ?? 5;
//        $configuration->accordion_item_margin_left = $validatedData['accordion_item_margin_left'] ?? 20;
//        $configuration->accordion_item_margin_right = $validatedData['accordion_item_margin_right'] ?? 20;
//
//        $configuration->accordion_item_question_background_color = $validatedData['accordion_item_question_background_color'] ?? '#EC9D17';
//        $configuration->accordion_item_question_background_active_color = $validatedData['accordion_item_question_background_active_color'] ?? '#FCEACC';
//
//        $configuration->accordion_item_question_text_color = $validatedData['accordion_item_question_text_color'] ?? '#FFFFFF';
//        $configuration->accordion_item_question_text_active_color = $validatedData['accordion_item_question_text_active_color'] ?? '#000000';
//        $configuration->accordion_item_question_text_font_size = $validatedData['accordion_item_question_text_font_size'] ?? 14;
//        $configuration->accordion_item_question_align_text = $validatedData['accordion_item_question_align_text'] ?? 'left';
//        $configuration->accordion_item_question_text_font = $validatedData['accordion_item_question_text_font'] ?? 'Regular';
//
//        $configuration->accordion_item_question_border_color = $validatedData['accordion_item_question_border_color'] ?? '#FFFFFF';
//        $configuration->accordion_item_question_border_active_color = $validatedData['accordion_item_question_border_active_color'] ?? '#000000';
//        $configuration->accordion_item_question_focus_color = $validatedData['accordion_item_question_focus_color'] ?? '#FFFFFF';
//
//        $configuration->accordion_item_question_border_size = $validatedData['accordion_item_question_border_size'] ?? 1;
//        $configuration->accordion_item_question_border_radius_topleft = $validatedData['accordion_item_question_border_radius_topleft'] ?? 0;
//        $configuration->accordion_item_question_border_radius_topright = $validatedData['accordion_item_question_border_radius_topright'] ?? 0;
//        $configuration->accordion_item_question_border_radius_bottomleft = $validatedData['accordion_item_question_border_radius_bottomleft'] ?? 0;
//        $configuration->accordion_item_question_border_radius_bottomright = $validatedData['accordion_item_question_border_radius_bottomright'] ?? 0;
//
//        $configuration->accordion_item_question_border_radius_after_topleft = $validatedData['accordion_item_question_border_radius_after_topleft'] ?? 0;
//        $configuration->accordion_item_question_border_radius_after_topright = $validatedData['accordion_item_question_border_radius_after_topright'] ?? 0;
//        $configuration->accordion_item_question_border_radius_after_bottomleft = $validatedData['accordion_item_question_border_radius_after_bottomleft'] ?? 0;
//        $configuration->accordion_item_question_border_radius_after_bottomright = $validatedData['accordion_item_question_border_radius_after_bottomright'] ?? 0;
//
//        $configuration->accordion_item_question_collapse_icon_align = $validatedData['accordion_item_question_collapse_icon_align'] ?? 'Right';
//        $configuration->accordion_item_question_collapse_icon = $validatedData['accordion_item_question_collapse_icon'] ?? 'angle-down';
//        $configuration->accordion_item_question_non_collapse_icon = $validatedData['accordion_item_question_non_collapse_icon'] ?? 'angle-up';
//        $configuration->accordion_item_question_collapse_icon_font_size = $validatedData['accordion_item_question_collapse_icon_font_size'] ?? 24;
//        $configuration->accordion_item_question_collapse_icon_line_height = $validatedData['accordion_item_question_collapse_icon_line_height'] ?? 9;
//        $configuration->accordion_item_question_collapse_icon_padding_left = $validatedData['accordion_item_question_collapse_icon_padding_left'] ?? 2;
//        $configuration->accordion_item_question_collapse_icon_padding_right = $validatedData['accordion_item_question_collapse_icon_padding_right'] ?? 5;
//        $configuration->accordion_item_question_collapse_icon_padding_top = $validatedData['accordion_item_question_collapse_icon_padding_top'] ?? 2;
//        $configuration->accordion_item_question_collapse_icon_padding_bottom = $validatedData['accordion_item_question_collapse_icon_padding_bottom'] ?? 2;
//        // Save the configuration to the database
//        $configuration->save();
//
//        // Save the configuration to the database
//        if (!$configuration->save()) {
//            // Handle error if configuration save fails
//            return redirect()->back()->with('error', 'Failed to save configuration.');
//        } else {
//            // Handle success if configuration save succeeds
//            return redirect()->back()->with('success', 'Configuration saved successfully.');
//
//
//        }
//    }

    /**
     * Save Configuration Settings
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveConfigurationSettings(Request $request)
    {
        //        header('Access-Control-Allow-Origin: *');
        //        header('Access-Control-Allow-Origin: *.myshopify.com');
        //        header('Content-Security-Policy: frame-ancestors *');
        try{
            $shop = Auth::user();
            $domain = $shop->getDomain()->toNative();
            $configuration = Configuration::where('shop_url', $domain)->first();
            if ($configuration->is_enabled == 1) {
                //Section Background Color
                $configuration->rjee_faqs_background_color = ($request->rjee_faqs_background_color) ?? "#ffffff";
                //Section Magin
                $configuration->rjee_faqs_section_margin_top = ($request->rjee_faqs_section_margin_top) ?? 10;
                $configuration->rjee_faqs_section_margin_bottom = ($request->rjee_faqs_section_margin_bottom) ?? 10;
                $configuration->rjee_faqs_section_margin_left = ($request->rjee_faqs_section_margin_left) ?? 10;
                $configuration->rjee_faqs_section_margin_right = ($request->rjee_faqs_section_margin_right) ?? 10;
                //Section Magin-MD(Tablet)
                $configuration->rjee_faqs_section_margin_top_md = ($request->rjee_faqs_section_margin_top_md) ?? 20;
                $configuration->rjee_faqs_section_margin_bottom_md = ($request->rjee_faqs_section_margin_bottom_md) ?? 20;
                $configuration->rjee_faqs_section_margin_left_md = ($request->rjee_faqs_section_margin_left_md) ?? 20;
                $configuration->rjee_faqs_section_margin_right_md = ($request->rjee_faqs_section_margin_right_md) ?? 20;
                //Section Magin-XS(Mobile)
                $configuration->rjee_faqs_section_margin_top_xs = ($request->rjee_faqs_section_margin_top_xs) ?? 20;
                $configuration->rjee_faqs_section_margin_bottom_xs = ($request->rjee_faqs_section_margin_bottom_xs) ?? 20;
                $configuration->rjee_faqs_section_margin_left_xs = ($request->rjee_faqs_section_margin_left_xs) ?? 20;
                $configuration->rjee_faqs_section_margin_right_xs = ($request->rjee_faqs_section_margin_right_xs) ?? 20;
                //Section Padding
                $configuration->rjee_faqs_section_padding_top = ($request->rjee_faqs_section_padding_top) ?? 20;
                $configuration->rjee_faqs_section_padding_bottom = ($request->rjee_faqs_section_padding_bottom) ?? 20;
                $configuration->rjee_faqs_section_padding_left = ($request->rjee_faqs_section_padding_left) ?? 20;
                $configuration->rjee_faqs_section_padding_right = ($request->rjee_faqs_section_padding_right) ?? 20;
                //Section Padding-MD(Tablet)
                $configuration->rjee_faqs_section_padding_top_md = ($request->rjee_faqs_section_padding_top_md) ?? 20;
                $configuration->rjee_faqs_section_padding_bottom_md = ($request->rjee_faqs_section_padding_bottom_md) ?? 20;
                $configuration->rjee_faqs_section_padding_left_md = ($request->rjee_faqs_section_padding_left_md) ?? 20;
                $configuration->rjee_faqs_section_padding_right_md = ($request->rjee_faqs_section_padding_right_md) ?? 20;
                //Section Padding-XS(Mobile)
                $configuration->rjee_faqs_section_padding_top_xs = ($request->rjee_faqs_section_padding_top_xs) ?? 20;
                $configuration->rjee_faqs_section_padding_bottom_xs = ($request->rjee_faqs_section_padding_bottom_xs) ?? 20;
                $configuration->rjee_faqs_section_padding_left_xs = ($request->rjee_faqs_section_padding_left_xs) ?? 20;
                $configuration->rjee_faqs_section_padding_right_xs = ($request->rjee_faqs_section_padding_right_xs) ?? 20;
                //Title Typography
                $configuration->rjee_faqs_title = ($request->rjee_faqs_title) ?? "ORDER/PAYMENT/CANCELLATION";
                $configuration->rjee_faqs_header_text_font = ($request->rjee_faqs_header_text_font) ?? "Regular";
                $configuration->rjee_faqs_header_text_color = ($request->rjee_faqs_header_text_color) ?? "#000000";
                $configuration->rjee_faqs_header_text_font_size = ($request->rjee_faqs_header_text_font_size) ?? 24;
                $configuration->rjee_faqs_header_align_text = ($request->rjee_faqs_header_align_text) ?? "left";
                //Sub-Title Typography
                $configuration->rjee_faqs_sub_title = ($request->rjee_faqs_sub_title) ?? "fahad";
                $configuration->rjee_faqs_header_sub_text_font = ($request->rjee_faqs_header_sub_text_font) ?? "Regular";
                $configuration->rjee_faqs_header_sub_text_color = ($request->rjee_faqs_header_sub_text_color) ?? "#000000";
                $configuration->rjee_faqs_header_sub_text_font_size = ($request->rjee_faqs_header_sub_text_font_size) ?? 24;
                $configuration->rjee_faqs_header_align_sub_text = ($request->rjee_faqs_header_align_sub_text) ?? "left";
                //Tab Typography
                $configuration->accordion_item_faq_gap = ($request->accordion_item_faq_gap) ?? 10;

                $configuration->accordion_item_question_text_color = ($request->accordion_item_question_text_color) ?? "#FFFFFF";
                $configuration->accordion_item_question_text_active_color = ($request->accordion_item_question_text_active_color) ?? "#000000";
                $configuration->accordion_item_question_text_font_size = ($request->accordion_item_question_text_font_size) ?? 14;
                $configuration->accordion_item_question_align_text = ($request->accordion_item_question_align_text) ?? "left";
                $configuration->accordion_item_question_text_font = ($request->accordion_item_question_text_font) ?? "Regular";

                $configuration->accordion_item_answer_text_color = ($request->accordion_item_answer_text_color) ?? "#FFFFFF";
                $configuration->accordion_item_answer_text_font_size = ($request->accordion_item_answer_text_font_size) ?? 14;
                $configuration->accordion_item_answer_align_text = ($request->accordion_item_answer_align_text) ?? "left";
                $configuration->accordion_item_answer_text_font = ($request->accordion_item_answer_text_font) ?? "Regular";

                //Border color Settings
                $configuration->accordion_item_question_border_color = ($request->accordion_item_question_border_color) ?? "#FFFFFF";
                $configuration->accordion_item_question_border_active_color = ($request->accordion_item_question_border_active_color) ?? "#000000";
                $configuration->accordion_item_question_focus_color = ($request->accordion_item_question_focus_color) ?? "#FFFFFF";

                //Border Width
                $configuration->accordion_item_question_border_size = ($request->accordion_item_question_border_size) ?? 1;
                $configuration->accordion_item_question_border_top = ($request->accordion_item_question_border_top) ?? 1;
                $configuration->accordion_item_question_border_bottom = ($request->accordion_item_question_border_bottom) ?? 1;
                $configuration->accordion_item_question_border_left = ($request->accordion_item_question_border_left) ?? 1;
                $configuration->accordion_item_question_border_right = ($request->accordion_item_question_border_right) ?? 1;

                //Border Radius
                $configuration->accordion_item_question_border_radius_topleft = ($request->accordion_item_question_border_radius_topleft) ?? 0;
                $configuration->accordion_item_question_border_radius_topright = ($request->accordion_item_question_border_radius_topright) ?? 0;
                $configuration->accordion_item_question_border_radius_bottomleft = ($request->accordion_item_question_border_radius_bottomleft) ?? 0;
                $configuration->accordion_item_question_border_radius_bottomright = ($request->accordion_item_question_border_radius_bottomright) ?? 0;
                //Border Radius After
                $configuration->accordion_item_question_border_radius_after_topleft = ($request->accordion_item_question_border_radius_after_topleft) ?? 0;
                $configuration->accordion_item_question_border_radius_after_topright = ($request->accordion_item_question_border_radius_after_topright) ?? 0;
                $configuration->accordion_item_question_border_radius_after_bottomleft = ($request->accordion_item_question_border_radius_after_bottomleft) ?? 0;
                $configuration->accordion_item_question_border_radius_after_bottomright = ($request->accordion_item_question_border_radius_after_bottomright) ?? 0;
                //Accordion signs
                $configuration->accordion_item_question_collapse_icon_align = ($request->accordion_item_question_collapse_icon_align) ?? "Right";
                $configuration->accordion_item_question_non_collapse_icon = ($request->accordion_item_question_non_collapse_icon) ?? "Angle-up";
                $configuration->accordion_item_question_collapse_icon_font_size = ($request->accordion_item_question_collapse_icon_font_size) ?? 14;
                $configuration->accordion_item_question_collapse_icon_line_height = ($request->accordion_item_question_collapse_icon_line_height) ?? 9;
                $configuration->accordion_item_question_collapse_icon_padding_left = ($request->accordion_item_question_collapse_icon_padding_left) ?? 2;
                $configuration->accordion_item_question_collapse_icon_padding_right = ($request->accordion_item_question_collapse_icon_padding_right) ?? 5;
                $configuration->accordion_item_question_collapse_icon_padding_top = ($request->accordion_item_question_collapse_icon_padding_top) ?? 2;
                $configuration->accordion_item_question_collapse_icon_padding_bottom = ($request->accordion_item_question_collapse_icon_padding_bottom) ?? 2;
                if ($configuration->update()) {
                    return redirect('configuration')->with(['configuration' => $configuration, 'shop' => $domain]);
                }
            }
            return redirect('configuration')->with(['configuration' => $configuration, 'shop' => $domain]);
        } catch(Exception $e){
            info( "\nMESSAGE :: ". $e->getMessage() ."\nCODE :: ". $e->getCode() ."\nLINE :: ". $e->getLine()  );
        }
    }


    /**
     * @return array
     */
    public function settingPage(Request $request)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $configuration = Configuration::where('shop_url', $domain)->first();
        $SHOPIFY_API_VERSION = env('SHOPIFY_API_VERSION');
        $shopModel = $this->getShopModelShopifyUser($domain);
        $SHOPIFY_ALL_themes = $shopModel->api()->rest("GET", "/admin/api/$SHOPIFY_API_VERSION/themes.json")['body']['container']['themes'];
        return view('setting')->with(array_merge($request->input(), ['SHOPIFY_ALL_themes' => $SHOPIFY_ALL_themes, 'request' => $request , 'shop' => $domain]));
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
    /**
     * Enable module and create pages on storeFront
     *
     * @param Request $request
     * @return void
     */
    public function enableModule(Request $request)
    {
        $domain = $request->input('shop') ?? "";
        // $domain = $shop->getDomain()->toNative();
        $en_configuration = Configuration::where('shop_url', $domain)->first();
        if ($en_configuration == null) {
            $en_configuration = new Configuration();
        }
        if ($request->is_enabled == 1) {
            // $this->createPage();
            $en_configuration->is_enabled = 1;
        } else {
            // $this->deletePage();
            $en_configuration->is_enabled = 0;
        }
        if ($en_configuration->update()) {
            return redirect()->route('configuration' , array_merge($request->input(), ['configuration'=> $en_configuration ,'request' => $request , 'shop' => $domain]) );
        }
    }

    /**
     * sync FAQs settings schema on storeFront
     *
     * @param Request $request
     * @return void
     */
    public function pushFAQSchemaOnStore(Request $request){

    }




}


