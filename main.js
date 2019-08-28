$(document).ready(function () {
    $('a.delete').on('click', function () {
        // debugger;
        var tr = $(this).closest('tr');
        var id = tr.children('td').first().html();
        $('#container').load('index.php?action=delete&id=' + id,
            function () {
                    // $('#container').html('<div class="alert alert-warning">ID#'+id+' Deleted.</div>')
                    tr.fadeOut('slow', function () {
                    $(this).remove();
                });
            }
        );
    });
});

