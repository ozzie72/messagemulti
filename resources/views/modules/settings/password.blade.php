@extends('components.layouts.main')
@section('content')
<div>
      
    <section class="content container">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">

                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Actualizar') }} {{ __('Contraseña') }}</span>
                        </div>
                        
                    </div>

                    <div class="card-body bg-white">
                        
                        <livewire:settings.password />
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
       
   
</div>
@endsection