<link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/all.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/brands.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/fontawesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/regular.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/solid.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/svg-with-js.min.css') }}" rel="stylesheet" />

<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <ul class="side-menu metismenu">
            <li class="">
                <a href="{{ route('configuration', [ 'shop' => $shopDomain ?? Auth::user()->name]) }}"><i class="fa fa-gears"></i></i>
                    &ensp;<span class="nav-label">Configuration</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('billingPlan', [ 'shop' => $shopDomain ?? Auth::user()->name]) }}"><i class="fa fa-screwdriver-wrench"></i>
                    &ensp;<span class="nav-label">Social Network Settings</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('settings', [ 'shop' => $shopDomain ?? Auth::user()->name]) }}"><i class="fa-regular fa-chart-network"></i>
                    &ensp;<span class="nav-label">other</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/all.min.js') }}"></script>
<script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/brands.min.js') }}"></script>
<script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/conflict-detection.min.js') }}"></script>
<script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/fontawesome.min.js') }}"></script>
<script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/regular.min.js') }}"></script>
<script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/solid.min.js') }}"></script>


{{-- M_WRS328430_img.png --}}
