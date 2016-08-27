<div class="box box-widget widget-user">
  <div class="widget-user-header {{ $cardCover or 'bg-aqua-active' }}">
  </div>

  
  <div class="media-selector-wrapper" data-non-image-error="{{ trans('inoplate-account::messages.student.avatar_must_be_image') }}">
    @include('inoplate-media::library.finder')
    <div class="widget-user-image media-selector">
      <img class="img-circle" src="{{ $student['avatar'] or '/vendor/inoplate-adminutes/img/user-128x128.png' }}" alt="User Avatar">
      <div class="overlay img-circle">
        <i class="fa fa-image"></i>
      </div>
      <input type="hidden" name="avatar" value="{{ $student['avatar'] or '/vendor/inoplate-adminutes/img/user-128x128.png' }}"/>
    </div>
  </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-sm-12">
          <div class="description-block">
            <h5 class="description-header">&nbsp;</h5>
            <span class="description-text">&nbsp;</span>
          </div>
        </div>
      </div>
    </div>
</div>

@addJs([
  'student/student/widget.js'
])