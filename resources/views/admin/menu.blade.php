<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="/">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0" style="color: rgb({{auth()->user()->style_menu->style}}) !important;">{{ config('app.name') }}</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                        <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
                <li class=" nav-item">
                    <a href="#">
                        <i class="bx bx-home-alt" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                        <span class="menu-title" data-i18n="Dashboard" style="color: rgb({{auth()->user()->style_menu->style}}) !important;">Dashboard</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::path() == 'home') active @endif">    
                            <a href="/home">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span class="menu-item" data-i18n="Analytics">Analiticas</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header">
                    <span>Administración</span>
                </li>
                <!-- recorremos la lista de menu existente -->
                <?php  
                       $ruta = explode("/", Request::path());
                       $ruta2 = explode("\/", Request::path());
                       $path = $ruta[0];
                       $path2 = $ruta2[0];
                ?>
                @foreach(user_menu() as $menu)
                    <li class="nav-item has-sub">
                        <a href="#">
                            <i class="{{ $menu->icon }}" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                            <span class="menu-title" data-i18n="Content" style="color: rgb({{auth()->user()->style_menu->style}}) !important;">{{ $menu->title }} </span>
                        </a>
                        <ul class="menu-content">
                            @foreach(user_submenu() as $submenu)
                                @if($submenu->id_menu == $menu->id_menu)
                                    <li class="@if($path == $submenu->url || $path2 == $submenu->url) active @endif" @if($path == $submenu->url || $path2 == $submenu->url) style="background: rgba({{auth()->user()->style_menu->style}}, 0.2); border-color: rgb({{auth()->user()->style_menu->style}});" @endif>
                                        <a href="/{{ $submenu->url }}" @if($path == $submenu->url || $path2 == $submenu->url) style="color: rgb({{auth()->user()->style_menu->style}});" @endif>
                                            <i class="{{ $submenu->icon }}" @if($path == $submenu->url || $path2 == $submenu->url) style="color: rgb({{auth()->user()->style_menu->style}});" @endif></i>
                                            <span class="menu-item" data-i18n="Grid" @if($path == $submenu->url || $path2 == $submenu->url) style="color: rgb({{auth()->user()->style_menu->style}}) !important;" @endif>
                                                {{ $submenu->title }}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                     </li>
                @endforeach
        </ul>
    </div>
</div>