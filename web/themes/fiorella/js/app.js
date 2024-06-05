(($, Drupal, once) => {
    $.fn.ajaxCallback = (email) => alert(email);

    Drupal.behaviors.myFeature = {
        attach: function (context, settings) {
            once('myFeature', '.fio-truncate-btn', context).forEach(function (element) {
                $(element).click((e) => {
                    e.preventDefault();

                    $(element).prev().hide();
                    $(element).next().show();
                    $(element).hide();
                });
            });
        }
    };
})(jQuery, Drupal, once);
