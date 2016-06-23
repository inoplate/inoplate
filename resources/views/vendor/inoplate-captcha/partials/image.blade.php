<div class="captcha-container form-group has-feedback {{ $errors->has('captcha_code') ? 'has-error' : '' }}">
    <div class="captcha-image-holder">
        <img src="{{ $imageUrl }}/" />
    </div>
    <div class="input-group">
        <input data-rule-required=true class="form-control" type="text" name="captcha_code" placeholder="{{ trans('inoplate-captcha::labels.input_code') }}" required/>
        <span class="input-group-btn">
          <button class="btn btn-info btn-flat captcha-refresh" type="button"><i class="fa fa-refresh"></i></button>
        </span>
    </div>
    @if($errors->has('captcha_code'))
        <label class="control-label" for="inputError">
            <i class="fa fa-times-circle-o"></i> 
            {{ $errors->first('captcha_code') }}
        </label>
    @endif
</div>