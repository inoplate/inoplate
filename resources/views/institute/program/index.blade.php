@extends('inoplate-foundation::layouts.default')

@php($title = 'Daftar program studi')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        @include('institute.program.table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['institute/program/index.js'])