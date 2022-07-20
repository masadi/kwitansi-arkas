<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $text_class = ['class' => 'd-flex align-items-center'];
        \Menu::make('MyNavBar', function ($menu) use ($text_class, $request){
            $menu->add('Beranda')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('home'))->link->attr($text_class);
            $menu->add('Profile', 'user/profile')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('user'))->link->attr($text_class);
            $menu->add('Sekolah', 'sekolah')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('book'))->link->attr($text_class);
            $menu->add('BKU', 'bku')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('dollar-sign'))->link->attr($text_class);
            /*
            $menu->add('Page Layouts', 'javascript:void(0)')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('mail'))->link->attr($text_class);
            $menu->pageLayouts->add('Collapsed Menu', 'layouts/collapsed-menu')->data('role', ['admin', 'ptk'])->append('</span>')->prepend($this->icon('circle'))->link->attr($text_class);
            $menu->pageLayouts->add('Layout Full', 'layouts/full')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('circle'))->link->attr($text_class);
            $menu->pageLayouts->add('Without Menu', 'layouts/without-menu')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('circle'))->link->attr($text_class);
            $menu->pageLayouts->add('Layout Empty', 'layouts/empty')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('circle'))->link->attr($text_class);
            $menu->pageLayouts->add('Layout Blank', 'layouts/blank')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('circle'))->link->attr($text_class);
            */
            $menu->add('Keluar Aplikasi', 'logout')->data('role', ['admin', 'sekolah'])->append('</span>')->prepend($this->icon('power'))->link->attr([
                'class'         => 'd-flex align-items-center text-danger',
                'onclick'   => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();',
            ]);
        })->filter(function($item) use ($request){
            $user = auth()->user();
            if($user && $user->hasRole( $item->data('role'), session('tahun_anggaran'))) {
                return true;
            }
            return false;
        });
        return $next($request);
    }
    public function icon($icon){
        //return '<i class="fa-solid fa-'.$icon.'"></i><span class="menu-title text-truncate">';
        return '<i data-feather="'.$icon.'"></i><span class="menu-title text-truncate">';
    }
}
