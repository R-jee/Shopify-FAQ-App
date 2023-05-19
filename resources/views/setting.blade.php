@extends('layout.main')
@section('content')
    <div class="page-heading">
        <h1 class="page-title">Settings</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('settings', [ 'shop' => $shop]) }}"><i class="fa fa-gear"></i></a>
            </li>
            <li class="breadcrumb-item">Settings</li>
        </ol>
    </div>
    <div class="loader toggle-loader">
        <div class="spinner"></div>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?php $SHOPIFY_ALL_themes = $SHOPIFY_ALL_themes; ?>
                <div class="bg-white p-8 rounded-md w-full">
                    <div class=" flex items-center justify-between pb-6">
                        <div>
                            <h2 class="text-gray-600 font-semibold">Shopify Themes</h2>
                            <span class="text-xs">All installed & Published themes in shopify store.</span>
                        </div>
                        <div class="flex items-center justify-between">
                            {{--
                            <div class="flex bg-gray-50 items-center p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd" />
                                </svg>
                                <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
                            </div>
                            <div class="lg:ml-40 ml-10 space-x-8">
                                <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">New Report</button>
                                <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Create</button>
                            </div>
                            --}}
                        </div>
                    </div>
                    <div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Sr No.</th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Name</th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Theme ID</th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Created At</th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Updated At</th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Active Status</th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"> Change Theme</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($SHOPIFY_ALL_themes as $key => $theme) : ?>
                                        <tr>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm"><p class="text-gray-900 whitespace-no-wrap"><?php echo ($key + 1); ?></p></td>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    {{-- <div class="flex-shrink-0 w-10 h-10">
                                                        <img class="w-full h-full rounded-full"
                                                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                             alt="" />
                                                    </div>--}}
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            <?php echo $theme['name']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm"><p class="text-gray-900 whitespace-no-wrap"><?php echo $theme['id']; ?></p></td>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm"><p class="text-gray-900 whitespace-no-wrap"><?php echo $theme['created_at']; ?></p></td>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm"><p class="text-gray-900 whitespace-no-wrap"><?php echo $theme['updated_at']; ?></p></td>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm">
                                                <span class="relative inline-block px-3 py-1 font-semibold <?php echo ($theme['role'] == "main") ? "text-green-900" : "text-yellow-900"; ?> leading-tight">
                                                    <span aria-hidden class="absolute inset-0 <?php echo ($theme['role'] == "main") ? "bg-green-200" : "bg-yellow-200"; ?> opacity-50 rounded-full"></span>
                                                    <span class="relative whitespace-nowrap"><?php echo ($theme['role'] == "main") ? "Main Published" : "Not-Published"; ?></span>
                                                </span>
                                            </td>
                                            <td class="px-5  border-b border-gray-200 bg-white text-sm">
                                                <button type="button" class="change-theme-published whitespace-no-wrap inline-block rounded-full border-2 <?php echo ($theme['role'] == "main") ? "border-success text-success hover:border-success-600 hover:text-success-600 focus:border-success-600 focus:text-success-600 active:border-success-700 active:text-success-700" : "border-primary-100 text-primary-700 hover:border-primary-accent-100 hover:bg-opacity-10 focus:border-primary-accent-100 active:border-primary-accent-200 dark:text-primary-100 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10 hover:bg-neutral-500 focus:outline-none"; ?> px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:ring-0"
                                                        data-theme-id="<?php echo $theme['id']; ?>" data-te-ripple-init><?php echo ($theme['role'] == "main") ? "Active" : "Change"; ?></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                {{--
                                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                                        <span class="text-xs xs:text-sm text-gray-900">Showing 1 to 4 of 50 Entries</span>
                                        <div class="inline-flex mt-2 xs:mt-0">
                                            <button class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">Prev</button>
                                            &nbsp; &nbsp;
                                            <button class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">Next</button>
                                        </div>
                                    </div>
                                --}}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


{{--    /*  */--}}

{{--    /*  */--}}
@endsection
