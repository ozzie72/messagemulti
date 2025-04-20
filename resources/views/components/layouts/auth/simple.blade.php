<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900" style="background-image: url('{{asset('assets/img/fondo_principal_linea.png')}}') ">
        <div class="bg-background flex min-h-svh flex-col gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
               
                <div class="flex flex-col gap-6">
                   
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
