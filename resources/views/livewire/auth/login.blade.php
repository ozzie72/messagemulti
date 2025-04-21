    <header class="header-section-wrapper">
        <div>
            <section class="section-container-4">
                <div class="container-txt-4">
                    <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium mt-4" wire:navigate>
                    
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                  
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a> 
                    {{-- <div class="flex flex-col gap-6 "> --}}
                        <x-auth-header :title="__('Ingresa a tu cuenta')" :description="__('Ingresa con tu correo electrónico y contraseña')" />

                        <!-- Session Status -->
                        <x-auth-session-status class="text-center" :status="session('status')" />

                        <form wire:submit="login" class="flex flex-col gap-6 text- ">
                            <!-- Email Address -->
                            <flux:input
                                wire:model="email"
                                :label="__('Correo Electrónico')"
                                type="email"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="email@example.com"
                            />

                            <!-- Password -->
                            <div class="relative">
                                <flux:input
                                    wire:model="password"
                                    :label="__('Contraseña')"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    :placeholder="__('Contraseña')"
                                />

                                @if (Route::has('password.request'))
                                    <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                                        {{ __('Olvidaste contraseña?') }}
                                    </flux:link>
                                @endif
                            </div>

                            <!-- Remember Me -->
                            <flux:checkbox wire:model="remember" :label="__('Recordarme')" />

                            <div class="flex items-center justify-end">
                                <flux:button variant="outline" type="submit" class="w-full">{{ __('Ingresar') }}</flux:button>
                            </div>
                        </form>
                    {{-- </div> --}}
                </div>
                <div class="img-wrapper-4">
                    <img class="screen2" src="{{asset('assets/img/login/screen.png')}}" alt="">
                    <img class="line-1" src="{{asset('assets/img/login/Lineas verdes1.png')}}" alt="">
                    <img class="line-2" src="{{asset('assets/img/login/Lineas verdes2.png')}}" alt="">
                    <img class="sms" src="{{asset('assets/img/login/sms.png')}}" alt="">
                    <img class="mail" src="{{asset('assets/img/login/email.png')}}" alt="">
                    <img class="otp" src="{{asset('assets/img/login/otp.png')}}" alt="">
                    <img class="reloj" src="{{asset('assets/img/login/RelojV.png')}}" alt="">
                    <img class="r1" src="{{asset('assets/img/login/R1.png')}}" alt="">
                    <img class="r2" src="{{asset('assets/img/login/R1.png')}}" alt="">
                    <img class="r3" src="{{asset('assets/img/login/Recurso 5.png')}}" alt="">
                    <img class="r4" src="{{asset('assets/img/login/R1.png')}}" alt="">
                    <img class="r5" src="{{asset('assets/img/login/R3.png')}}" alt="">
                    <img class="r6" src="{{asset('assets/img/login/R4.png')}}" alt="">
                    <img class="r7" src="{{asset('assets/img/login/lineas rojas.png')}}" alt="">
                    <img class="r8" src="{{asset('assets/img/login/RelojR.png')}}" alt="">
                    <img class="r9" src="{{asset('assets/img/login/XRoja.png')}}" alt="">
    
                </div>
            </section>
        </div>
    </header>
<script src="{{asset('assets/js/messageanimation.js')}}"></script> 

