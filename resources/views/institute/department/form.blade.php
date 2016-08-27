<div class="form-group">
  <label for="name" class="control-label">Fakultas</label>
  <select name="faculty_id" id="faculty_id" class="form-control not-select2 faculty-id" data-rule-required=true  placeholder="Fakultas" style="width:100%"></select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'faculty_id'])
</div>
<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="code" class="control-label">Kode</label>
  <input type="text" name="code" id="code" class="form-control" data-rule-required=true value="{{ old('code', isset($department['code']) ? $department['code'] : '' ) }}" placeholder="Kode">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
</div>
<div class="form-group">
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($department['name']) ? $department['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>

@addJs(['institute/department/form.js'])