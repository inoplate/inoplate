$(function(){
  $('input[name="file"]').on('click', function(){
    $('.library-finder').libraryFinder('show');
  });

  $('.library-finder').on('media.finder.selected', function(e, id, library) {
    $('input[name="file"]').val(library.description.path);
  });
});