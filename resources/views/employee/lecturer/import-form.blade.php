<div class="form-group">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <label for="file" class="control-label">File</label>
  <input type="text" name="file" id="file" class="form-control" data-rule-required=true placeholder="File">
  @include('inoplate-adminutes::partials.form-error', ['field' => 'file'])
</div>