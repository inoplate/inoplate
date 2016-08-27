<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="name" class="control-label">Nama</label>
  <input type="text" name="name" id="name" class="form-control" data-rule-required=true value="{{ old('name', isset($subject['name']) ? $subject['name'] : '' ) }}" placeholder="Nama">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'name'])
</div>
<div class="form-group">
  <label for="code" class="control-label">Kode</label>
  <input type="text" name="code" id="code" class="form-control" data-rule-required=true value="{{ old('code', isset($subject['code']) ? $subject['code'] : '' ) }}" placeholder="Kode">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'code'])
</div>
<div class="form-group">
  <label for="type" class="control-label">Jenis</label>
  <select type="text" name="type" id="type" class="form-control not-select2" data-rule-required=true placeholder="Jenis" style="width:100%">
    <option value="w">Wajib</option>
    <option value="p">Pilihan</option>
    <option value="wp">Wajib peminatan</option>
    <option value="pp">Pilihan peminatan</option>
    <option value="ta">Tugas akhir/Skripsi/Tesis/Disertasi</option>
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'type'])
</div>
<div class="form-group">
  <label for="program_id" class="control-label">Program studi</label>
  <select type="text" name="program_id" id="program_id" class="form-control not-select2" placeholder="Program studi" style="width:100%">
    @if(isset($subject->program_id))
        <option value="{{$subject->program_id}}" selected>{{ $subject->program->name }}</option>
    @endif
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'program'])
</div>
<div class="form-group">
  <label for="group" class="control-label">Komponen</label>
  <select type="text" name="group" id="group" class="form-control not-select2"placeholder="Komponen" style="width:100%">
    <option value="mpk">MPK - Pengembangan Kepribadian</option>
    <option value="mkk">MKK - Keilmuan dan Ketrampilan</option>
    <option value="mkb">MKB - Keahlian Berkarya</option>
    <option value="mpb">MPB - Perilaku Berkarya</option>
    <option value="mbb">MBB - Berkehidupan Bermasyarakat</option>
    <option value="mku">MKU/MKDU</option>
    <option value="mkdk">MKDK</option>
    <option value="mkk">MKK</option>
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'group'])
</div>
<div class="form-group">
  <label for="sks_tm" class="control-label">SKS Tatap muka</label>
  <input type="text" name="sks_tm" id="sks_tm" class="form-control" value="{{ old('sks_tm', isset($subject['sks_tm']) ? $subject['sks_tm'] : '' ) }}" placeholder="SKS Tatap muka">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'sks_tm'])
</div>
<div class="form-group">
  <label for="sks_p" class="control-label">SKS Praktikum</label>
  <input type="text" name="sks_p" id="sks_p" class="form-control" value="{{ old('sks_p', isset($subject['sks_p']) ? $subject['sks_p'] : '' ) }}" placeholder="SKS Praktikum">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'sks_p'])
</div>
<div class="form-group">
  <label for="sks_pl" class="control-label">SKS Praktek lapangan</label>
  <input type="text" name="sks_pl" id="sks_pl" class="form-control" value="{{ old('sks_pl', isset($subject['sks_pl']) ? $subject['sks_pl'] : '' ) }}" placeholder="SKS Praktek lapangan">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'sks_pl'])
</div>
<div class="form-group">
  <label for="sks_s" class="control-label">SKS Simulasi</label>
  <input type="text" name="sks_s" id="sks_s" class="form-control" value="{{ old('sks_s', isset($subject['sks_s']) ? $subject['sks_s'] : '' ) }}" placeholder="SKS Simulasi">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'sks_s'])
</div>

@addJs([
  'academic/subject/form.js'
])