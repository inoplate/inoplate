<div class="form-group">
  <label for="name" class="control-label">Propinsi</label>
  <select name="province_id" id="province_id" class="form-control not-select2 province-id" data-rule-required=true  placeholder="Propinsi" style="width:100%"></select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'province_id'])
</div>
<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($district['name']) ? $district['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>

@addJs(['master/district/form.js'])