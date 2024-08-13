@php
    $menus = [
        'dashboard' =>  [
            'title'  => 'Dashboard',
            'url'    => '/admin/dashboard',
            'name'   => 'admin/dashboard',
            'icon'   => 'home'
        ],
        'chse' =>  [
            'title'  => 'Analisis CHSE',
            'url'    => '/admin/analisis-chse',
            'name'   => 'admin/analisis-chse',
            'icon'   => 'bar-chart-2'
        ],
        'gizi' =>  [
            'title'  => 'Analisis Gizi',
            'url'    => '/admin/analisis-gizi',
            'name'   => 'admin/analisis-gizi',
            'icon'   => 'cross'
        ],
        'imt' =>  [
            'title'  => 'Pengukuran IMT',
            'url'    => '/admin/pengukuran-imt',
            'name'   => 'admin/pengukuran-imt',
            'icon'   => 'heart'
        ],
        // 'riwayat' =>  [
        //     'title'  => 'Riwayat',
        //     'url'    => '/admin/riwayat',
        //     'name'   => 'admin/riwayat',
        //     'icon'   => 'history'
        // ],
        // 'rekap' =>  [
        //     'title'  => 'Data Rekap',
        //     'url'    => '/admin/data-rekap',
        //     'name'   => 'admin/data-rekap',
        //     'icon'   => 'book'
        // ],
        'health' =>  [
            'title'  => 'Worker Health',
            'url'    => '/admin/worker-health',
            'name'   => 'admin/worker-health',
            'icon'   => 'contact'
        ],
        'report' =>  [
            'title'  => 'Report',
            'url'    => '/admin/reports',
            'name'   => 'admin/reports',
            'icon'   => 'info'
        ],
        'callcenter' =>  [
            'title'  => 'Call Center',
            'url'    => '/admin/call-center',
            'name'   => 'admin/call-center',
            'icon'   => 'phone'
        ],
        'd1' =>  [
            'title'  => 'divider',
        ],
        'history' =>  [
            'title'  => 'History',
            'name'   => 'admin/history',
            'icon'   => 'history',
            'menus' => [
                [
                    'title'  => 'History CHSE',
                    'url'    => '/admin/history/analisis-chse',
                    'name'   => 'admin/history/analisis-chse',
                    'icon'   => 'shield'
                ],
                [
                    'title'  => 'History Gizi Kerja',
                    'url'    => '/admin/history/analisis-gizi',
                    'name'   => 'admin/history/analisis-gizi',
                    'icon'   => 'heart'
                ],
                // [
                //     'title'  => 'Safety',
                //     'url'    => '/admin/master-data/safety',
                //     'name'   => 'admin/master-data/safety',
                //     'icon'   => 'clipboard-check'
                // ],
                // [
                //     'title'  => 'Environment',
                //     'url'    => '/admin/master-data/environment',
                //     'name'   => 'admin/master-data/environment',
                //     'icon'   => 'archive'
                // ],
            ],
        ],
        'user' =>  [
            'title'  => 'User',
            'url'    => '/admin/users',
            'name'   => 'admin/users',
            'icon'   => 'user'
        ],
        'admin' =>  [
            'title'  => 'Admin',
            'url'    => '/admin/admin',
            'name'   => 'admin/admin',
            'icon'   => 'users'
        ],
        'setting' =>  [
            'title'  => 'Setting',
            'url'    => '/admin/settings',
            'name'   => 'admin/settings',
            'icon'   => 'settings'
        ],
        // 'd1' =>  [
        //     'title'  => 'divider',
        // ],
    ];
@endphp

<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-2 pt-4 mt-3">
        <img alt="" style="height: 48px" src="{{ asset('image/login/logo-1.png') }}">
        <span class="hidden xl:block text-white font-bold text-xl ml-3"> Turetality </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        @foreach ($menus as $item)
            @if (array_key_exists('menus', $item))
                <li>
                    <a href="javascript:;.html" class="side-menu @if (request()->is($item['name'].'*')) side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-lucide="{{ $item['icon'] }}"></i> </div>
                        <div class="side-menu__title">
                            {{ $item['title'] }}
                            <div class="side-menu__sub-icon transform rotate-180">
                                @if (request()->is($item['name'].'*'))
                                    <i data-lucide="chevron-down"></i>
                                @else
                                    <i data-lucide="chevron-up"></i>
                                @endif
                            </div>
                        </div>
                    </a>
                    <ul class="@if (request()->is($item['name'].'*')) side-menu__sub-open @endif">
                        @foreach ($item['menus'] as $dropdown)
                            <li>
                                <a href="{{ $dropdown['url'] }}" class="side-menu @if (request()->is($dropdown['name'].'*')) side-menu--active @endif">
                                    <div class="side-menu__icon"> <i data-lucide="{{ $dropdown['icon'] }}"></i> </div>
                                    <div class="side-menu__title"> {{ $dropdown['title'] }} </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @elseif ($item['title'] != 'divider')
                <li>
                    <a href="{{ $item['url'] }}" class="side-menu @if (request()->is($item['name'].'*')) side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-lucide="{{ $item['icon'] }}"></i> </div>
                        <div class="side-menu__title"> {{ $item['title'] }} </div>
                    </a>
                </li>
            @else
                <li class="side-nav__devider my-6"></li>
            @endif
        @endforeach
    </ul>
</nav>
