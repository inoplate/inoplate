@extends('inoplate-foundation::layouts.default')

@php($title = 'Daftar dosen')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-filter with-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        {{ trans('inoplate-account::labels.users.status') }}
                                    </span>
                                    <select class="form-control" name="status">
                                        <option value="pns">PNS</option>
                                        <option value="pnsb">PNS Diperbantukan</option>
                                        <option value="pnsd">PNS Depag</option>
                                        <option value="gtypty">GTY/PTY</option>
                                        <option value="gttpttp">GTT/PTT Propinsi</option>
                                        <option value="gttpttk">GTT/PTT Kab/Kota</option>
                                        <option value="gbp">Guru Bantuan Pusat</option>
                                        <option value="ghs">Guru Honorer Sekolah</option>
                                        <option value="ths">Tenaga Honor Sekolah</option>
                                        <option value="nonpns">NON PNS</option>
                                        <option value="tni">TNI</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('employee.lecturer.table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['employee/lecturer/index.js', 'employee/lecturer/import-form.js'])