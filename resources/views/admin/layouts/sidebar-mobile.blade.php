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

<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="" style="height: 48px" src="{{ asset('image/login/logo-1.png') }}">
        </a>
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        <ul class="scrollable__content py-2">
            @foreach ($menus as $item)
                @if (array_key_exists('menus', $item))
                    <li>
                        <a href="javascript:;.html" class="menu @if (request()->is($item['name'].'*')) menu--active @endif">
                            <div class="menu__icon"> <i data-lucide="{{ $item['icon'] }}"></i> </div>
                            <div class="menu__title">
                                {{ $item['title'] }}
                                <div class="menu__sub-icon transform rotate-180">
                                    @if (request()->is($item['name'].'*'))
                                        <i data-lucide="chevron-down"></i>
                                    @else
                                        <i data-lucide="chevron-up"></i>
                                    @endif
                                </div>
                            </div>
                        </a>
                        <ul class="@if (request()->is($item['name'].'*')) menu__sub-open @endif">
                            @foreach ($item['menus'] as $dropdown)
                                <li>
                                    <a href="{{ $dropdown['url'] }}" class="menu @if (request()->is($dropdown['name'].'*')) menu--active @endif">
                                        <div class="menu__icon"> <i data-lucide="{{ $dropdown['icon'] }}"></i> </div>
                                        <div class="menu__title"> {{ $dropdown['title'] }} </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @elseif ($item['title'] != 'divider')
                    <li>
                        <a href="{{ $item['url'] }}" class="menu @if (request()->is($item['name'].'*')) menu--active @endif">
                            <div class="menu__icon"> <i data-lucide="{{ $item['icon'] }}"></i> </div>
                            <div class="menu__title"> {{ $item['title'] }} </div>
                        </a>
                    </li>
                @else
                    <li class="nav__devider my-6"></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
