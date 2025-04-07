@extends('components.layouts.main')

@section('template_title')
    {{ $state->name ?? __('Show') . " " . __('State') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} State</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('states.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $state->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Country Id:</strong>
                                    {{ $state->country_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
