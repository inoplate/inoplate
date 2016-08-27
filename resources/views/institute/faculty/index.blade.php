@extends('inoplate-foundation::layouts.default')

@php($title = 'Daftar fakultas')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        @include('institute.faculty.table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['institute/faculty/index.js'])