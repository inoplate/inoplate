@extends('inoplate-foundation::layouts.default')

@php($title = 'Tambah mahasiswa baru')

@addJs('student/student/create.js')

@section('content')
    @include('inoplate-foundation::partials.content-header')
    <section class="content">
        <form class="ajax" method="post" action="/admin/student/student" id="student-create-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">{{ trans('inoplate-foundation::labels.form.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('student.student.form')
        </form>
        <div class="overlay hide">
            <div class="loading">Loading..</div>
        </div>
    </section>
@endsection