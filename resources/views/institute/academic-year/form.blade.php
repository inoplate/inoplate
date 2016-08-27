<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="code" class="control-label">Kode</label>
  <input type="text" name="code" id="code" class="form-control" data-rule-required=true value="{{ old('code', isset($academicYear['code']) ? $academicYear['code'] : '' ) }}" placeholder="Kode">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
</div>
<div class="form-group">
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($academicYear['name']) ? $academicYear['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>