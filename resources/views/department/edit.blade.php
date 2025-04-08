@extends('components.layouts.main')

@section('title')
    {{ __('Update') }} {{ __('Department') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">

                        <div class="float-left">
                            <span class="card-title">{{ __('Update') }} {{ __('Department') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('departments.index') }}"> {{ __('Back') }}</a>
                        </div>

                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('departments.update', $department->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('department.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
