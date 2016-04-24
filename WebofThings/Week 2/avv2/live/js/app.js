$(document).ready(function() {

    // Get data from text file
    $.get('ldr.txt', function(data) {
        var txt = data;
        var lines = txt.split("\n");
        var ldrArray = ["LDR"];

        for (var i = 0, len = lines.length; i < len; i++) {
            if (lines[i].length > 0) {
              ldrArray.push(lines[i]);

                // $(".data-melvin ul").append('<li>' + lines[i] + '</li>');
            }
        }
        var chart = c3.generate({
          bindto: '#chart',
          data: {
            columns: [
              ldrArray.reverse()
            ]
          }
        });
    }, 'text');
});
