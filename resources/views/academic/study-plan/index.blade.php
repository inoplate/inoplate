@extends('inoplate-foundation::layouts.default')

@php($title = 'Kelas mahasiswa')

@addAsset('datatables')

@section('content')
    @include('inoplate-foundation::partials.content-header')

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-filter with-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        Periode akademik
                                    </span>
                                    <select class="form-control" name="academic_year_id" data-placeholder="Periode akademik">
                                        @foreach($academicYears as $academicYear)
                                            <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('academic.study-plan.unassigned-student-table')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-filter with-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        Kelas
                                    </span>
                                    <select class="form-control" name="class_id" data-placeholder="Kelas">
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('academic.study-plan.assigned-student-table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@addJs(['academic/study-plan/index.js'])