@extends('components.layouts.main')

@section('template_title')
    {{ __('Create') }} City
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} City</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('cities.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('city.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
