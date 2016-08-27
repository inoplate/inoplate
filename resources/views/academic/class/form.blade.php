<div class="form-group">
  <label for="academic_year_id" class="control-label">Tahun ajaran</label>
  <select type="text" name="academic_year_id" id="academic_year_id" class="form-control not-select2" placeholder="Tahun ajaran" style="width:100%">
    @if(isset($class->academic_year_id))
        <option value="{{$class->academic_year_id}}" selected>{{ $class->academicYear->name }}</option>
    @endif
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'academic_year_id'])
</div>
<div class="form-group">
  <label for="lecturer_id" class="control-label">Dosen pengampu</label>
  <select type="text" name="lecturer_id" id="lecturer_id" class="form-control not-select2" placeholder="Dosen pengampu" style="width:100%">
    @if(isset($class->lecturer_id))
        <option value="{{$class->lecturer_id}}" selected>{{ $class->lecturer->name }}</option>
    @endif
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'lecturer_id'])
</div>
<div class="form-group">
  <label for="subject_id" class="control-label">Matak kuliah</label>
  <select type="text" name="subject_id" id="subject_id" class="form-control not-select2" placeholder="Matak kuliah" style="width:100%">
    @if(isset($class->subject_id))
        <option value="{{$class->subject_id}}" selected>{{ $class->subject->name }}</option>
    @endif
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'subject'])
</div>
<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($class['name']) ? $class['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>
<div class="form-group">
  <label for="code" class="control-label">Kode</label>
  <input type="text" name="code" id="code" class="form-control" data-rule-required=true value="{{ old('code', isset($class['code']) ? $class['code'] : '' ) }}" placeholder="Kode">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
</div>

@addJs([
  'academic/class/form.js'
])