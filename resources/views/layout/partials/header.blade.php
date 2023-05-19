<style>
    .header .page-brand {
        width: 230px;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0 15px;
        font-size: 22px;
        font-weight: bolder;
        letter-spacing: 1px;
        color: #2d2223;
        background-color: #7c7e82 !important;
        text-transform: uppercase;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        overflow: hidden;
    }

    .page-sidebar {
        width: 230px;
        background-color: #7c7e82;
        min-height: 100%;
        position: absolute;
        top: 0;
        margin-top: 66px;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        z-index: 1001;
    }

    .side-menu>li.active>a {
        font-size: var(--p-font-size-100) !important;
        color: #427b72;
        background-color: #edeeef;
        font-weight: 600;
    }
    .side-menu>li a {
        white-space: nowrap;
        overflow: hidden;
        color: #56585d;
        font-weight: 600;
    }
    .side-menu>li a:focus, .side-menu>li a:hover {
        color: #56585d;
        background-color: #edeeef;
    }
    .side-menu>li a:focus, .side-menu>li a {
        color: #56585d;
        background-color: #f6f6f7;
    }

    .side-menu>li.active>a .arrow, .side-menu>li.active>a .sidebar-item-icon {
        color: #427b72;
    }
    .side-menu>li>a .sidebar-item-icon:hover {
        color: #427b72;
    }
    i.fa {
        line-height: inherit;
    }
    .side-menu>li.active::before{
        background-color: #427b72;
        border-bottom-right-radius: var(--p-border-radius-1);
        border-top-right-radius: var(--p-border-radius-1);
        bottom: .0625rem;
        content: "";
        left: calc(var(--p-space-2)*-1);
        position: absolute;
        top: .0625rem;
        width: .1875rem;
    }
    body {
        color: #5c5f62;
    }
    .to-top {
        color: #636c72;
    }
    .to-top:hover {
        color: #f6f6f7;
    }
    .side-menu>li {
        background-color: #7c7e82;
    }
    .side-menu>li a {
        border-bottom-right-radius: 5px;
        border-right: 5px #7c7e82 solid;
        border-top-right-radius: 5px;
    }
    .side-menu>li.active {
        background-color: none;
    }
    .side-menu>li.active a {
        border-bottom-right-radius: 0px;
        border-right: 0px transparent solid;
        border-top-right-radius: 0px;
    }
    .page-sidebar ul li {
        position: relative;
        display: block;
        margin-top: 4px;
    }

    .oAuth_social__login__ {
        border: 1px dashed #CCCCCC;
        border-radius: 15px;
        display: inline-flex;
        align-items: center;
        flex-direction: column;
        width: -webkit-fill-available;
    }
    .start-with-text {
        padding-left: 5px;
    }
    .ibox-head {
        background: #f0f8ffa8;
    }
    .ibox-body- {
        background: #f1f1f1;
    }
    .ibox-top-hr{
        border-top: 1px solid #eee;
    }
    /* .ibox hr {
        margin-top: 0.1rem;
        margin-bottom: 0.3rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,0);
    } */
    .oauth-img {
        width: 110px;
        height: 30px;
    }
    .oauth-img-disabled {
        background: black;border-radius: 5px;opacity: 0.3;
    }
    .form_control_color_picker {
        display: block;
        width: 100%;
        padding: .5rem .75rem;
        font-size: 1rem;
        line-height: 1.25;
        background-image: none;
        background-clip: padding-box;
        /* border: 1px solid rgba(0,0,0,.15); */
        border-radius: .25rem;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        padding: 0px !important;
        height: 39px;
    }
    .custom_hr {
        border: 0;
        border-top: 2px solid #000;
        height: 1px;
        overflow: visible;
        padding: 0;
        color: #000;
        text-align: center;
    }
    .custom_hr::after {
        content: "OR";
        display: inline-block;
        position: relative;
        top: -0.9em;
        font-size: 1.4em;
        padding: 0 0.3em;
        background:white;
    }
</style>

<link href="https://fonts.googleapis.com/css?family=Rubik+Maze:200,300,400,500,600,700,800,900|Zen+Tokyo+Zoo:200,300,400,500,600,700,800,900|ZCOOL+QingKe+HuangYou:200,300,400,500,600,700,800,900|Rakkas:200,300,400,500,600,700,800,900|Zen+Dots:200,300,400,500,600,700,800,900|Suez+One:200,300,400,500,600,700,800,900|Alatsi:200,300,400,500,600,700,800,900|Black+Han+Sans:200,300,400,500,600,700,800,900|Lalezar:200,300,400,500,600,700,800,900|Fugaz+One:200,300,400,500,600,700,800,900|Antic+Slab:200,300,400,500,600,700,800,900|Alata:200,300,400,500,600,700,800,900|Public+Sans:200,300,400,500,600,700,800,900|Cabin:200,300,400,500,600,700,800,900|Raleway:200,300,400,500,600,700,800,900|Yanone+Kaffeesatz:200,300,400,500,600,700,800,900|Montez|Lobster|Josefin+Sans|Shadows+Into+Light|Pacifico|Amatic+SC:200,300,400,500,600,700,800,900|Orbitron:200,300,400,500,600,700,800,900|Rokkitt|Righteous|Dancing+Script:700|Bangers|Chewy|Sigmar+One|Architects+Daughter|Abril+Fatface|Covered+By+Your+Grace|Kaushan+Script|Gloria+Hallelujah|Satisfy|Lobster+Two:700|Comfortaa:700|Cinzel|Courgette|Hammersmith+One|Josefin+Sans:200,300,400,500,600,700,800,900|Sansita:200,300,400,500,600,700,800,900|Balsamiq+Sans:200,300,400,500,600,700,800,900|Anton:200,300,400,500,600,700,800,900|Lato:200,300,400,500,600,700,800,900" rel="stylesheet" type="text/css">

<header class="header">
    <div class="page-brand">
        <a href="{{ route('configuration') }}">
            <span class="brand flex items-center"><img src="{{ asset('assets/images/FAQ.png') }}" alt="" class="" style="height: 45px; width:45px;">&ensp;Linkify</span>
            <span class="brand-mini">LSA</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar" id="hamburger-sidebar-toggler">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            </li>
        </ul>

        {{-- <div class="flex flex-wrap w-full">
            <div class="">
                <a class="plans-btn btn btn-outline-primary text-xs mr-3 ml-3 md:p-2" href="{{ route('plans') }}"><span class="">Change Plan</span></a>
            </div>
        </div> --}}


        <!-- END TOP-LEFT TOOLBAR-->
    </div>
</header>

