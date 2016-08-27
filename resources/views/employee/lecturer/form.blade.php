<div class="row">
    <div class="col-md-7">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Umum</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <label for="reg_no" class="control-label">NIDN / NUP / NIDK</label>
                  <input type="text" name="reg_no" id="reg_no" class="form-control" data-rule-required=true value="{{ old('reg_no', isset($lecturer['reg_no']) ? $lecturer['reg_no'] : '' ) }}" placeholder="NIDN / NUP / NIDK">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'reg_no'])
                </div>
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <label for="local_reg_no" class="control-label">NIP</label>
                  <input type="text" name="local_reg_no" id="local_reg_no" class="form-control" data-rule-required=true value="{{ old('local_reg_no', isset($lecturer['local_reg_no']) ? $lecturer['local_reg_no'] : '' ) }}" placeholder="NIP">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'reg_no'])
                </div>
                <div class="form-group">
                  <label for="name" class="control-label">Nama</label>
                  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($lecturer['name']) ? $lecturer['name'] : '' ) }}" placeholder="Nama">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
                </div>
                <div class="form-group">
                  <label for="program_id" class="control-label">Status kepegawaian</label>
                  <select class="form-control" name="status">
                      <option value="pns">PNS</option>
                      <option value="pnsb">PNS Diperbantukan</option>
                      <option value="pnsd">PNS Depag</option>
                      <option value="gtypty">GTY/PTY</option>
                      <option value="gttpttp">GTT/PTT Propinsi</option>
                      <option value="gttpttk">GTT/PTT Kab/Kota</option>
                      <option value="gbp">Guru Bantuan Pusat</option>
                      <option value="ghs">Guru Honorer Sekolah</option>
                      <option value="ths">Tenaga Honor Sekolah</option>
                      <option value="nonpns">NON PNS</option>
                      <option value="tni">TNI</option>
                      <option value="other">Lainnya</option>
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
                  <input type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number', isset($lecturer['id_number']) ? $lecturer['id_number'] : '' ) }}" placeholder="NIK">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'id_number'])
                </div>
                <div class="form-group">
                  <label for="mother_maiden_name" class="control-label">Nama ibu</label>
                  <input type="text" name="mother_maiden_name" id="mother_maiden_name" class="form-control" value="{{ old('mother_maiden_name', isset($lecturer['mother_maiden_name']) ? $lecturer['mother_maiden_name'] : '' ) }}" placeholder="Nama ibu">
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'id_number'])
                </div>
                <div class="form-group">
                  <label for="country_id" class="control-label">Kewarganegaraan</label>
                  <select type="text" name="country_id" id="country_id" class="form-control not-select2"  style="width:100%">
                    @if(isset($lecturer->country_id))
                        <option value="{{$lecturer->country_id}}" selected>{{ $lecturer->country->name }}</option>
                    @endif
                  </select>
                  @include('inoplate-adminutes::partials.form-error', ['field' => 'country_id'])
                </div>  
            </div>
        </div>
    </div>
    <div class="col-md-5">
        @include('employee.lecturer.widget')
    </div>
</div>

@addJs([
  'employee/lecturer/form.js'
])