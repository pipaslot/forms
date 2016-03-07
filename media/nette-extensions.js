/**
 * Created by pipaslot on 31.01.2016.
 */
(function ($, nette, pipas) {
    nette.ext("forms-file-input", {
        load: function () {
            pipas.get("bootstrap-filestyle", function () {
                $(":file").filestyle();
            });
        }
    });
    nette.ext("forms-tags", {
        load: function () {
            pipas.get("bootstrap-tagsinput", function () {
                $("input[data-role=tagsinput]").tagsinput("input");
            });
        }
    });
    nette.ext("forms-datetime", {
        load: function () {
            var that = this;
            pipas.get(["eonasdan-bootstrap-datetimepicker", "forms-styles"], function () {
                $(".input-group.date input").each(function () {
                    var $elm = $(this);
                    var format = $elm.data("format");
                    $elm.parent().datetimepicker({
                        locale: pipas.locale(),
                        format: that.PHPFormatToMoment(format)
                    });
                });
            });
        }
    }, {
        /**
         * Converts time format to moment.js format
         * @param {string} format
         * @return string
         */
        PHPFormatToMoment: function (format) {
            var replacements = {
                'd': 'DD',
                'D': 'ddd',
                'j': 'D',
                'l': 'dddd',
                'N': 'E',
                'S': 'o',
                'w': 'e',
                'z': 'DDD',
                'W': 'W',
                'F': 'MMMM',
                'm': 'MM',
                'M': 'MMM',
                'n': 'M',
                't': '', // no equivalent
                'L': '', // no equivalent
                'o': 'YYYY',
                'Y': 'YYYY',
                'y': 'YY',
                'a': 'a',
                'A': 'A',
                'B': '', // no equivalent
                'g': 'h',
                'G': 'H',
                'h': 'hh',
                'H': 'HH',
                'i': 'mm',
                's': 'ss',
                'u': 'SSS',
                'e': 'zz', // deprecated since version 1.6.0 of moment.js
                'I': '', // no equivalent
                'O': '', // no equivalent
                'P': '', // no equivalent
                'T': '', // no equivalent
                'Z': '', // no equivalent
                'c': '', // no equivalent
                'r': '', // no equivalent
                'U': 'X'
            };
            var formatted = "";
            for (var i in format) {
                if (replacements.hasOwnProperty(format[i])) {
                    formatted += replacements[format[i]];
                } else {
                    formatted += format[i];
                }
            }
            return formatted;
        }
    });
})(jQuery, jQuery.nette, pipas);