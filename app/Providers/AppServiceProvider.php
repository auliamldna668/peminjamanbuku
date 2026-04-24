<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function store(Request $request)
{
    $request->authenticate();

    $request->session()->regenerate();

    if (Auth::user()->role === 'admin') {
        return redirect()->intended('/admin/dashboard');
    }

    return redirect()->intended('/user/dashboard');
}
}
