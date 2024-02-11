var $form = $("#forem");
var $input = $form.find(".komah");
$input.on("keyup", function(event) {
    // When user select text in the document, also abort.
    var selection = window.getSelection().toString();
    if (selection !== '') {
        return;
    }

    // When the arrow keys are pressed, abort.
    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
        return;
    }

    var $this = $(this);

    // Get the value.
    var nStr = $this.val();

    //nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    
    x1 = x1.replace(/,/g,'');
    //console.log(x1);
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    $this.val(function() {
        return x1 + x2;
    });

    //console.log(x3);
    //console.log(x3.toLocaleString("en-US"));

    /*
    var $this = $(this);

    // Get the value.
    var input = $this.val();

    var x1x = x1.replace(/[\s-][\-*\D\._]+/g, "");
    var input = input.replace(/[\D\s\._\-]+/g, "");
    input = input ? parseInt(input, 10) : 0;

    $this.val(function() {
        return (input === 0) ? "" : input.toLocaleString("en-US");
    });
    */
});
    
function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2") + "e-2");
}

function roundToFour(num) {
    return +(Math.round(num + "e+4") + "e-4");
}

$(document).on('focus', '.dapick', function() {
    $(this).datepicker({
        autoclose: true,
        orientation: "bottom left",
        format: 'yyyy-mm-dd'
    });
});

function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}