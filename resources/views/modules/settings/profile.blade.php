@extends('components.layouts.main')
@section('content')
<div >
      
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">

                    <div class="card-header card-responsive" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Update') }} {{ __('Profile') }}</span>
                        </div>
                       
                    </div>

                    <div class="card-body bg-white">
                        
                        <livewire:settings.profile />
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
       
   
</div>
@endsection