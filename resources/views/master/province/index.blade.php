@extends('inoplate-foundation::layouts.default')

@php($title = 'Daftar propinsi')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        @include('master.province.table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['master/province/index.js'])