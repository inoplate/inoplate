@extends('inoplate-foundation::layouts.default')

@php($title = 'Update periode akademik')

@section('content')
    @include('inoplate-foundation::partials.content-header')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                <form class="ajax no-reset" method="post" action="{{route('admin.institute.academic-year.update', ['academic-year' => $academic-year->id])}}" id="academic-year-update-form">
                    <div class="box-body">
                        <input type="hidden" name="_method" value="put" />
                        @include('institute.academic-year.form')
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">{{ trans('inoplate-foundation::labels.form.save') }}</button>
                    </div>
                </form>
                <div class="overlay hide">
                    <div class="loading">Loading..</div>
                </div>
              </div>
            </div>
        </div>
    </section>
@endsection