@extends('components.layouts.main')

@section('title')
    {{ $city->name ?? __('Show') . " " . __('City') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} {{ __('City') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('Name')}}:</strong>
                                    {{ $city->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('State') }}</strong>
                                    {{ $city->state->name }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
