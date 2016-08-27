@extends('inoplate-foundation::layouts.default')

@php($title = 'Update mata kuliah')

@section('content')
    @include('inoplate-foundation::partials.content-header')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                <form class="ajax no-reset" method="post" action="{{route('admin.academic.subject.update', ['subject' => $subject->id])}}" id="subject-update-form">
                    <div class="box-body">
                        <input type="hidden" name="_method" value="put" />
                        @include('academic.subject.form')
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