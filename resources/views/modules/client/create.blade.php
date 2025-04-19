@extends('components.layouts.main')
@section('content')
<div>
    

      
            <section class="content container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-default">

                            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="float-left">
                                    <span class="card-title">{{ __('Create') }} {{ __('Client') }}</span>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('clients.index') }}"> {{ __('Back') }}</a>
                                </div>
                            </div>

                            <div class="card-body bg-white">
                                <form method="POST" action="{{ route('clients.store') }}"  role="form" enctype="multipart/form-data">
                                    @csrf

                                    @include('modules.client.form')

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
       
   
</div>
@endsection
