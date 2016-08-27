@extends('inoplate-foundation::layouts.default')

@php($title = 'Daftar mahasiswa')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-filter with-border">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        Program studi
                                    </span>
                                    <select class="form-control" name="program" data-placeholder="Program studi">
                                        <option value="0">Tanpa filter</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        Tahun masuk
                                    </span>
                                    <select class="form-control" name="entry_year" data-placeholder="Tahun masuk">
                                        <option value="0">Tanpa filter</option>
                                        @foreach($entryYears as $entryYear)
                                            <option value="{{ $entryYear->entry_year }}">{{ $entryYear->entry_year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        {{ trans('inoplate-account::labels.users.status') }}
                                    </span>
                                    <select class="form-control" name="status">
                                        <option value="active">Aktif</option>
                                        <option value="graduated">Lulus</option>
                                        <option value="mutation">Mutasi</option>
                                        <option value="do">Drop out</option>
                                        <option value="resign">Mengundurkan diri</option>
                                        <option value="leave">Cuti</option>
                                        <option value="die">Meninggal</option>
                                        <option value="lost">Hilang</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('student.student.table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['student/student/index.js', 'student/student/import-form.js'])