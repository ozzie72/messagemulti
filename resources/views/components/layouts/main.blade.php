<!doctype html>
<html class="fixed">
	
@include('partials.head')
@stack('styles')

<body>
    <section class="body">


    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    
    @include('partials.header')
    @include('partials.sidebar')
    <div class="inner-wrapper">
        @if ($message = Session::get('success'))
            <div class="alert alert-success m-4">
                <p>{{ $message }}</p>
            </div>
        @endif
        <section role="main" class="content-body">
            @include('partials.heading')
            @yield('content')
        </section>

        @livewireScripts
    </div>

    

    </section>

         <!-- Full Screen Search Start -->
         <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-primary" >
                <div class="modal-header border-0">
                    <button type="button"  class="btn btn-square bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
               
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->



    @include('partials.footer')
    
    
    @stack('scripts')


</body>

</html>
