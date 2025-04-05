@extends('components.layouts.main')

@section('template_title')
    {{ __('Update') }} Divition
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Divition</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('divitions.update', $divition->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('divition.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
