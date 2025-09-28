(function ($) {
  $(document).ready(function () {
    const successFlag = new URLSearchParams(window.location.search).get('lop_entry_submitted');
    if (successFlag) {
      const notice = $('<div class="lop-notice lop-notice--success" role="status"></div>').text(
        window.lopMembership && window.lopMembership.entrySuccess
          ? window.lopMembership.entrySuccess
          : 'Thanks! Your Champions Month signup is pending admin approval.'
      );
      $('.lop-form').first().before(notice);
    }
  });
})(jQuery);
