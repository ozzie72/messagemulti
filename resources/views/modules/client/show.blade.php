@extends('components.layouts.main')

@section('title')
    {{ $client->name ?? __('Show') . " " . __('Client') }}
@endsection

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Client</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('clients.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $client->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ip:</strong>
                                    {{ $client->ip }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Port:</strong>
                                    {{ $client->port }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Server User:</strong>
                                    {{ $client->server_user }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Server Pass:</strong>
                                    {{ $client->server_pass }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Image:</strong>
                                    {{ $client->image }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $client->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Divition Id:</strong>
                                    {{ $client->divition_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Department Id:</strong>
                                    {{ $client->department_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
