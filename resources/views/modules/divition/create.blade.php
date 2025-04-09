@extends('components.layouts.main')

@section('title')
    {{ __('Create') }} Divition
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Divition</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('divitions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('divition.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
