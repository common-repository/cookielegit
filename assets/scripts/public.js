import CookieLegitNotice from "./public/cookielegit";

jQuery(function($) {

  const updateBlocked = function() {
    console.log('should update screens')
    $("iframe[data-cl-src]").each(function() {
      $(this).attr("src", $(this).attr("data-cl-src"));
    });

    $("script[type=cookielegitblock]").each(function() {
      $(this).attr("src", $(this).attr("data-cl-src"));
      $(this).attr("type", $(this).attr("data-cl-type"));
    });
  }

  CookieLegitNotice.subscribe("consent-given", updateBlocked);

  window.cookieLegitNotice = new CookieLegitNotice("body", {
    consentMode: cl_config.consent_mode !== "",
    userOpt: cl_config.user_opt !== "",
    baseUrl: cl_config.ajax_url,
    themeUrl: cl_config.themeUrl
  });
});
