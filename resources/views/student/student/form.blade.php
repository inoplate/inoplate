<div class="row">
    <div class="col-md-7">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Umum</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <label for="reg_no" class="control-label">NIM</label>
                  <input type="text" name="reg_no" id="reg_no" class="form-control" data-rule-required=true value="{{ old('reg_no', isset($student['reg_no']) ? $student['reg_no'] : '' ) }}" placeholder="NIM">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'reg_no'])
                </div>
                <div class="form-group">
                  <label for="name" class="control-label">Nama</label>
                  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($student['name']) ? $student['name'] : '' ) }}" placeholder="Nama">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
                </div>
                <div class="form-group">
                  <label for="entry_year" class="control-label">Tahun masuk</label>
                  <input type="text" name="entry_year" id="entry_year" class="form-control" data-rule-required=true value="{{ old('entry_year', isset($student['entry_year']) ? $student['entry_year'] : '' ) }}" placeholder="Tahun masuk">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'entry_year'])
                </div>
                <div class="form-group">
                  <label for="program_id" class="control-label">Program studi</label>
                  <select type="text" name="program_id" id="program_id" class="form-control not-select2" data-rule-required=true placeholder="Program studi" style="width:100%">
                    @if(isset($student->program_id))
                        <option value="{{$student->program_id}}" selected>{{ $student->program->name }}</option>
                    @endif
                  </select>
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'program'])
                </div>
            </div>
        </div>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Identitas</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="id_number" class="control-label">NIK</label>
                  <input type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number', isset($student['id_number']) ? $student['id_number'] : '' ) }}" placeholder="NIK">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'id_number'])
                </div>
                <div class="form-group">
                  <label for="mother_maiden_name" class="control-label">Nama ibu</label>
                  <input type="text" name="mother_maiden_name" id="mother_maiden_name" class="form-control" value="{{ old('mother_maiden_name', isset($student['mother_maiden_name']) ? $student['mother_maiden_name'] : '' ) }}" placeholder="Nama ibu">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'id_number'])
                </div>
                <div class="form-group">
                  <label for="country_id" class="control-label">Kewarganegaraan</label>
                  <select type="text" name="country_id" id="country_id" class="form-control not-select2"  style="width:100%">
                    @if(isset($student->country_id))
                        <option value="{{$student->country_id}}" selected>{{ $student->country->name }}</option>
                    @endif
                  </select>
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'country_id'])
                </div>  
            </div>
        </div>
    </div>
    <div class="col-md-5">
        @include('student.student.widget')
    </div>
</div>

@addJs([
  'student/student/form.js'
])