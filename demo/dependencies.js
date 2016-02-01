(function () {
    pipas.define("jquery-ui", [
        "bower_components/jquery-ui/themes/flick/jquery-ui.min.css",
        "bower_components/jquery-ui/jquery-ui.min.js"
    ]);

    pipas.define("bootstrap-tagsinput", [
        "bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
        "bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"
    ], "jquery-ui");

    pipas.define("moment-base", "bower_components/moment/min/moment.min.js");
    pipas.define("moment", "bower_components/moment/min/locales.min.js", "moment-base");

    pipas.define("eonasdan-bootstrap-datetimepicker", [
        "bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css",
        "bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"
    ], "moment");

    pipas.define("forms.styles", [
        "../media/forms.styles.css"
    ]);
})(pipas);