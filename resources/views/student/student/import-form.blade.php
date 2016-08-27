<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="program_id" class="control-label">Program studi</label>
  <select type="text" name="program_id" id="program_id" class="form-control not-select2" data-rule-required=true placeholder="Program studi" style="width:100%">
    @if(isset($student->program_id))
        <option value="{{$student->program_id}}" selected>{{ $student->program->name }}</option>
    @endif
  </select>
  @include('inoplate-adminutes::partials.form-error', ['field' => 'program'])
</div>
<div class="form-group">
  <label for="file" class="control-label">File</label>
  <input type="text" name="file" id="file" class="form-control" data-rule-required=true placeholder="File">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'file'])
</div>