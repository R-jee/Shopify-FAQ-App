<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemePublishController extends Controller
{
    //
    public function getthemeid(Request $request)
    {
            $shop = Auth::user();
            $domain = $shop->getDomain()->toNative();
            $themes = $shop->api()->rest('GET', '/admin/themes.json');
            $activeThemeId = "";
            foreach ($themes['body']->container['themes'] as $theme) {
                if ($theme['role'] == "main") {
                    $activeThemeId = $theme['id'];
                }
            }
            //return $activeThemeId;
    }

//    public function getpreviousthemeid(Request $request){
//        $shop = Auth::user();
//        $domain = $shop->getDomain()->toNative();
//        $themes = $shop->api()->rest('GET', '/admin/themes.json');
//        $previousThemeId = "";
//        foreach ($themes['body']->container['themes'] as $theme) {
//            if ($theme['role'] == "unpublished") {
//                $previousThemeId = $theme['id'];
//            }
//        }
//        return $previousThemeId;
//    }



//    public function storepreviousthemeid(Request $request){
//        $shop = Auth::user();
//        $domain = $shop->getDomain()->toNative();
//        $themes = $shop->api()->rest('GET', '/admin/themes.json');
//        $previousThemeId = "";
//        foreach ($themes['body']->container['themes'] as $theme) {
//            if ($theme['role'] == "unpublished") {
//                $previousThemeId = $theme['id'];
//            }
//        }
//        $new_config = new Configuration();
//        $new_config->shop_url = $domain;
//        $new_config->previous_theme_id = $previousThemeId;
//        if ($new_config->save()) {
//            return "Previous Theme Id saved!!!";
//        }
//    }


    }
