<div class="form-group">
  <label for="name" class="control-label">Kab/Kota</label>
  <select name="district_id" id="district_id" class="form-control not-select2 district-id" data-rule-required=true  placeholder="Kab/Kota" style="width:100%"></select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'district_id'])
</div>
<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($subDistrict['name']) ? $subDistrict['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>

@addJs(['master/sub-district/form.js'])