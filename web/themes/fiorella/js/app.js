(($, Drupal, once) => {
    $.fn.ajaxCallback = (email) => alert(email);

    // DOM Chargé / Site classique
    $(document).ready(() => {
        $('article h2').click((e) => {
            e.preventDefault();

            $(element).prev().hide();
            $(element).next().show();
            $(element).hide();
        });
    });

    // Changement d'état dans Drupal
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
