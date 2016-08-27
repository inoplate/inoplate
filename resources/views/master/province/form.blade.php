<div class="form-group">
  <label for="name" class="control-label">Negara</label>
  <select name="country_id" id="country_id" class="form-control not-select2 country-id" data-rule-required=true  placeholder="Negara" style="width:100%"></select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'country_id'])
</div>
<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($province['name']) ? $province['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>

@addJs(['master/province/form.js'])