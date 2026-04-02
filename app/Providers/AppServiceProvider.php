<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (auth()->check()) {

                $notifications = Notifikasi::where('user_id', auth()->user()->user_id)
                    ->orderByDesc('tanggal_dikirim')
                    ->limit(5)
                    ->get();

                $notifCount = Notifikasi::where('user_id', auth()->user()->user_id)
                    ->where('sudah_dibaca', false)
                    ->count();

                $view->with(compact('notifications', 'notifCount'));
            }
        });
    }
}
