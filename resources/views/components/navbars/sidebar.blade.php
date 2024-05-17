<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/custom/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Paginas</h6>
            </li>
            <?php
            $items = [
                ['title' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'dashboard'],
                ['title' => 'Logs', 'route' => 'activity log', 'icon' => 'history'],
                ['title' => 'Usuarios', 'route' => 'usuarios', 'icon' => 'person'],
                ['title' => 'Products', 'route' => 'products', 'icon' => 'category'],
            ];
            ?>

        @foreach ($items as $item)
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == $item['route'] ? ' active bg-gradient-info' : '' }}"
                        href="{{ route($item['route']) }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">{{ $item['icon'] }}</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ $item['title'] }}</span>
                    </a>
                </li>
        @endforeach
        </ul>
    </div>

    {{-- Botones footer aside perfil usuario --}}
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <a class="nav-link text-white {{ Route::currentRouteName() == 'usuario' ? 'active bg-gradient-info' : '' }}"
            href="{{ route('usuario', ['id' => auth()->id()]) }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <span class="nav-link-text ms-1">{{ auth()->user()->name }}</span>
            </div>
        </a>
    </div>

</aside>
