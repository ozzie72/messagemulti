@extends('components.layouts.main')

@section('title')
    {{ __('Update') }} {{ __('State') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="card-title">{{ __('Update') }} {{ __('State') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('states.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>
                    
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('states.update', $state->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('state.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
