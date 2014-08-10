(function($) {
    setInterval(function() {
        $('.source-watch').each(function() {
            var target = $(this).data('target');
            if (target) {
                target = $(target);
            } else {
                target = $(this);
            }
            var html = target.html();
            if (this.previousHtml != html) {
                this.previousHtml = html
                html = style_html(html, {
                    max_char: 0
                });

                var output = $(this).data('output');

                if (typeof CodeMirror !== 'undefined') {
                    $(output).html('');
                    CodeMirror($(output).get(0), {
                        value: html,
                        mode: 'htmlmixed'
                    });
                } else {
                    $(output).text(html);
                }
            }

        });
    }, 400);
})(init);