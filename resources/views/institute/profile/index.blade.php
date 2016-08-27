@extends('inoplate-foundation::layouts.default')

@php($title = 'Profile Instansi')
@php($subtitle = 'Garis besar profil instansi')

@section('content')
    @include('inoplate-foundation::partials.content-header')
    <section class="content">
        <form class="ajax no-reset" method="post" action="/admin/institute/profile">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">{{ trans('inoplate-foundation::labels.form.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_method" value="put" />
                        <div class="box-header with-border">
                            <h3 class="box-title">Umum</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="control-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', $profile['name']) }}" placeholder="Nama">
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
                            </div>
                            <div class="form-group">
                                <label for="code" class="control-label">Kode</label>
                                <input type="text" name="code" id="code" class="form-control" data-rule-required=true value="{{ old('code', $profile['code']) }}" placeholder="Kode">
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
                            </div>
                        </div>
                    </div>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Alamat</h3>
                        </div>
                        <div class="box-body">
                            <!-- <div class="form-group">
                                <label for="name" class="control-label">Propinsi</label>
                                <select class="form-control"></select>
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
                            </div>
                            <div class="form-group">
                                <label for="code" class="control-label">Kab / Kota</label>
                                <select class="form-control"></select>
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
                            </div>
                            <div class="form-group">
                                <label for="code" class="control-label">Kecamatan</label>
                                <select class="form-control"></select>
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
                            </div> -->
                            <div class="form-group">
                                <label for="address" class="control-label">Alamat</label>
                                <textarea class="form-control" name="address">{{$profile['address']}}</textarea>
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'address'])
                            </div>
                            <div class="form-group">
                                <label for="alternate_address" class="control-label">Alamat alternatif</label>
                                <textarea class="form-control" name="alternate_address">{{$profile['alternate_address']}}</textarea>
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'alternate_address'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('institute.profile.widget')
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kontak</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="phone" class="control-label">No telp</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $profile['phone']) }}" placeholder="Nama">
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'phone'])
                            </div>
                            <div class="form-group">
                                <label for="fax" class="control-label">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control" value="{{ old('fax', $profile['fax']) }}" placeholder="Fax">
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'fax'])
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $profile['email']) }}" placeholder="Email" data-rule-email=true>
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'email'])
                            </div>
                            <div class="form-group">
                                <label for="website" class="control-label">Website</label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $profile['website']) }}" placeholder="Website">
                                @include('inoplate-adminutes::partials.form-error', ['field' => 'website'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="overlay hide">
            <div class="loading">Loading..</div>
        </div>
    </section>
@endsection