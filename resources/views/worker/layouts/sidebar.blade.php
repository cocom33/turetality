@php
    $menus = [
        'dashboard' =>  [
            'title'  => 'Dashboard',
            'url'    => '/dashboard',
            'name'   => 'dashboard',
            'icon'   => 'home'
        ],
        'chse' =>  [
            'title'  => 'Analisis CHSE',
            'url'    => '/analisis-chse',
            'name'   => 'analisis-chse',
            'icon'   => 'bar-chart-2'
        ],
        'gizi' =>  [
            'title'  => 'Analisis Gizi',
            'url'    => '/analisis-gizi',
            'name'   => 'analisis-gizi',
            'icon'   => 'cross'
        ],
        'imt' =>  [
            'title'  => 'Pengukuran IMT',
            'url'    => '/pengukuran-imt',
            'name'   => 'pengukuran-imt',
            'icon'   => 'heart'
        ],
        // 'riwayat' =>  [
        //     'title'  => 'Riwayat',
        //     'url'    => '/riwayat',
        //     'name'   => 'riwayat',
        //     'icon'   => 'history'
        // ],
        // 'rekap' =>  [
        //     'title'  => 'Data Rekap',
        //     'url'    => '/data-rekap',
        //     'name'   => 'data-rekap',
        //     'icon'   => 'book'
        // ],
        'health' =>  [
            'title'  => 'Worker Health',
            'url'    => '/worker-health',
            'name'   => 'worker-health',
            'icon'   => 'contact'
        ],
        'report' =>  [
            'title'  => 'Report',
            'url'    => '/reports',
            'name'   => 'reports',
            'icon'   => 'info'
        ],
        'callcenter' =>  [
            'title'  => 'Call Center',
            'url'    => '/call-center',
            'name'   => 'call-center',
            'icon'   => 'phone'
        ],
        'd1' =>  [
            'title'  => 'divider',
        ],
        'history' =>  [
            'title'  => 'History',
            'name'   => 'history',
            'icon'   => 'history',
            'menus' => [
                [
                    'title'  => 'History CHSE',
                    'url'    => '/history/analisis-chse',
                    'name'   => 'history/analisis-chse',
                    'icon'   => 'shield'
                ],
                [
                    'title'  => 'History Gizi Kerja',
                    'url'    => '/history/analisis-gizi',
                    'name'   => 'history/analisis-gizi',
                    'icon'   => 'heart'
                ],
                // [
                //     'title'  => 'Safety',
                //     'url'    => '/master-data/safety',
                //     'name'   => 'master-data/safety',
                //     'icon'   => 'clipboard-check'
                // ],
                // [
                //     'title'  => 'Environment',
                //     'url'    => '/master-data/environment',
                //     'name'   => 'master-data/environment',
                //     'icon'   => 'archive'
                // ],
            ],
        ],
        'setting' =>  [
            'title'  => 'Setting',
            'url'    => '/settings',
            'name'   => 'settings',
            'icon'   => 'settings'
        ],
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
