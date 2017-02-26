$(document).ready(function () {
  $('body').on('click', '#selectAll', function () {
    if ($(this).hasClass('allChecked')) {
        $('input[type="checkbox"]').prop('checked', false);
    } else {
        $('input[type="checkbox"]').prop('checked', true);
    }
    $(this).toggleClass('allChecked');
  })
});