@extends('inoplate-foundation::layouts.default')

@php($title = 'Tambah negara baru')

@addJs('master/country/create.js')

@section('content')
    @include('inoplate-foundation::partials.content-header')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                <form class="ajax" method="post" action="/admin/master/country" id="country-create-form">
                    <div class="box-body">
                      @include('master.country.form')
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