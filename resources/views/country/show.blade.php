@extends('components.layouts.main')

@section('title')
    {{ $country->name ?? __('Show') . " " . __('Country') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} {{ __('Country') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('countries.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>{{ __('Name') }}:</strong>
                                    {{ $country->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Code ISO 3166-1:</strong>
                                    {{ $country->code }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
