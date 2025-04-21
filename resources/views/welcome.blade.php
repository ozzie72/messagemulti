<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Favicon -->
		<link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/message.css')}}">
        </script><script src="{{asset('assets/js/scrollreveal.js')}}"></script>
        <!-- Styles -->
      
    </head>
    <body class="flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col" style="background-image: url('{{asset('assets/img/fondo_principal.png')}}') ">
        <header class="header-section-wrapper">
            <div>
                <section class="main-section-container">
                    @if (Route::has('login'))
                        <div class="txt-principal">
                            <img class="message" src="{{asset('assets/img/message.png')}}" alt="">
                            <h1 class="sld-principal-tittle">Broadcast SMS / E-Mail</h1>
                            <p class="txt-p">
                                Plataforma Web de autogestión para el envío
                                masivo de un SMS/E-mail a muchos usuarios
                                de una lista, en tiempo real o programado,
                                con una o múltiples variables.             
                            </p>
                            @auth
                                <a class="btn-1 w-75 " style="float: inline-end;" href="{{ url('/dashboard') }}">Panel principal</a>            
                            @else
                                <a class="btn-1 w-75 " style="float: inline-end;" href="{{ route('login') }}">Ingresar</a>     
                            @endauth
                        </div>
                        <div class="img-wrapper ">
                            <img class="s1" src="{{asset('assets/img/welcome/sobre.png')}}" alt="">
                            <img class="s2" src="{{asset('assets/img/welcome/sobre1.png')}}" alt="">
                            <img class="s3" src="{{asset('assets/img/welcome/sobre2.png')}}" alt="">
                            <img class="s4" src="{{asset('assets/img/welcome/sobre3.png')}}" alt="">
                            <img class="xo" src="{{asset('assets/img/welcome/xoxo.png')}}" alt="">

                            <img class="line1" src="{{asset('assets/img/welcome/lineas1.png')}}" alt="">
                            <img class="line2" src="{{asset('assets/img/welcome/lineas2.png')}}" alt=" ">
                            <img class="line3" src="{{asset('assets/img/welcome/lineas3.png')}}" alt="">
                            <img class="line4" src="{{asset('assets/img/welcome/lineas4.png')}}" alt="">
                            <img class="line5" src="{{asset('assets/img/welcome/lineas5.png')}}" alt="">

                            
                            <img class="tlf1" src="{{asset('assets/img/welcome/tlf.png')}}" alt="">
                            <img class="tlf2" src="{{asset('assets/img/welcome/tlf1.png')}}" alt="">
                            <img class="tlf3" src="{{asset('assets/img/welcome/tlf2.png')}}" alt="">
                            <img class="tlf4" src="{{asset('assets/img/welcome/tlf3.png')}}" alt="">
                            <img class="tlf5" src="{{asset('assets/img/welcome/tlf4.png')}}" alt="">
                        </div>
                    @endif
                </section>
            </div>
        </header>
       

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
        <script src="{{asset('assets/js/messageanimation.js')}}"></script> 
    </body>
</html>
