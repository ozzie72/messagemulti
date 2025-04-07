@extends('components.layouts.main')

@section('template_title')
    {{ __('Update') }} State
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} State</span>
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
