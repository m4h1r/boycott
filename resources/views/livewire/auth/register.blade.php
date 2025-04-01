<?php

use App\Models\User;
use App\Models\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component 
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email'] = $validated['email'];

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Log::create([
            'user_id' => $user->id,
            'action' => $user->member_id.' sisteme kayıt oldu.',
        ]);

        $this->redirectIntended(route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Hesap Oluştur')" :description="__('Aşağıda bilgilerini girerek üye ol.')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        {{-- <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        /> --}}

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('E-Posta Adresi')"
            type="email"
            required
            autocomplete="email"
            placeholder="eposta@ornek.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Şifre')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Şifre')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Şifre Tekrarı')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Şifreni tekrar gir')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Hesabı Oluştur') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Zaten üye misin?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Giriş') }}</flux:link>
    </div>
</div>
