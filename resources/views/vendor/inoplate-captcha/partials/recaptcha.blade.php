<div class="form-group has-feedback {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
    <div class="g-recaptcha" data-sitekey="{{ $options['key'] }}" data-expired-callback="reloadRecaptcha" ></div>
    @if($errors->has('g-recaptcha-response'))
        <label class="control-label" for="inputError">
            <i class="fa fa-times-circle-o"></i> 
            {{ $errors->first('g-recaptcha-response') }}
        </label>
    @endif
</div>

<script type="text/javascript">
    var reloadRecaptcha = function() {
        grecaptcha.reset();
    }
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>