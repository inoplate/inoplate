@extends('inoplate-foundation::layouts.default')

@php($title = 'Daftar kelas')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        @include('academic.class.table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['academic/class/index.js'])