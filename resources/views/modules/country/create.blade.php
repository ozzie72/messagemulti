@extends('components.layouts.main')

@section('title')
    {{ __('Create') }} {{ __('Country') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Create') }} {{ __('Country') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('countries.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('countries.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('modules.country.form')

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
