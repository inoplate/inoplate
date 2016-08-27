<div class="form-group">
  <label for="name" class="control-label">Jurusan</label>
  <select name="department_id" id="department_id" class="form-control not-select2 department-id" data-rule-required=true  placeholder="Jurusan" style="width:100%"></select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'department_id'])
</div>
<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="code" class="control-label">Kode</label>
  <input type="text" name="code" id="code" class="form-control" data-rule-required=true value="{{ old('code', isset($program['code']) ? $program['code'] : '' ) }}" placeholder="Kode">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
</div>
<div class="form-group">
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($program['name']) ? $program['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>

@addJs(['institute/program/form.js'])