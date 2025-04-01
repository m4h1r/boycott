<?php

use App\Models\Boycott;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoycottController;
use App\Models\Log;

Route::get('/', function () {
    // Son 10 boykotu başlangıç tarihine göre getir (en yeni en üstte)
    // Marka bilgisini (brand) ve kullanıcı sayısını (users_count) önceden yükle (Eager Load)
    $latestBoycotts = Boycott::with('brand')
                              ->withCount('users') // Katılımcı sayısını hesaplar ('users_count' olarak ekler)
                              ->orderBy('start_date', 'desc') // En yeni başlangıç tarihine göre sırala
                              ->take(5) // Sadece 10 tane al
                              ->get();
    // Son işlemler
    $latestLogs = Log::orderBy('created_at', 'desc') // En yeni logları al
                        ->take(20) // Sadece 5 tane al
                        ->get();

    // Veriyi view'e gönder
    return view('welcome', compact('latestBoycotts', 'latestLogs'));
})->name('home');

Route::get('boycotts', function () {
    // Tüm boykotları başlangıç tarihine göre sırala (en yeni en üstte)
    // Marka bilgisini (brand) ve kullanıcı sayısını (users_count) önceden yükle (Eager Load)
    $boycotts = Boycott::with('brand')
                        ->withCount('users') // Katılımcı sayısını hesaplar ('users_count' olarak ekler)
                        ->orderBy('start_date', 'desc') // En yeni başlangıç tarihine göre sırala
                        ->paginate(10); // Sayfalandırma (her sayfada 10 boykot)

    // Veriyi view'e gönder
    return view('boycotts.index', compact('boycotts'));
})->name('boycotts.index');

Route::get('boycotts/{boycott:slug}', function (Boycott $boycott) {
    // Boykot detayını ve katılımcı sayısını yükle
    // $boycott->loadCount('users');
    // Veriyi view'e gönder
    $isParticipating = false;
    if (Auth::check()) {
        $isParticipating = Auth::user()->boycotts()->where('boycott_id', $boycott->id)->exists();
    }
    return view('boycotts.show', compact('boycott', 'isParticipating'));
})->name('boycott.show');

Route::middleware('auth')->group(function () {
    Route::post('/boykotlar/{boycott}/participate', [BoycottController::class, 'participate'])->name('boycotts.participate');
    Route::post('/boykotlar/{boycott}/leave', [BoycottController::class, 'leave'])->name('boycotts.leave');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
