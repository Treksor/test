// $( document ).ready(function()
// {
//     $('a.delete').on('click',function()
//     {
//         // debugger;
//         var tr=$(this).closest('tr');
//         // var id=tr.children('td').first().html();
//         $('#container').load('index.php',
//             // $('#container').load('index.php?action=delete&id='+id,
//
//                 function()
//             {
//                 tr.fadeOut('slow',function()
//                 {
//                     $(this).remove();
//                 })
//             }
//         );
//     });
// });

$( document ).ready(function()
{
    $('a.delete').on('click',function()
    {
        var tr=$(this).closest('tr');
        tr.fadeOut('slow',function()
        {
            $(this).remove();
        })
    })
}