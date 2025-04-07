@extends('components.layouts.main')

@section('template_title')
    {{ __('Update') }} City
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} City</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('cities.update', $city->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('city.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
