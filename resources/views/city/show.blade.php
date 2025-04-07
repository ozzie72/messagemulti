@extends('components.layouts.main')

@section('template_title')
    {{ $city->name ?? __('Show') . " " . __('City') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} City</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $city->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>State Id:</strong>
                                    {{ $city->state_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
