<?php

require_once "../Config/autoload.php";


?>
<!DOCTYPE html>
<html lang="lt">
<?php include "header.php";?>
<body>
<?php include "controler.php";?>
    <script>
        $(document).ready(function(){
            load_data();
            function load_data(page)
            {
                $.ajax({
                    type: 'post',
                    url: 'pagination.php',
                    data: {page:page},
                    success:function(data)
                    {
                        $('#table-data').html(data);
                    }
            })
            }
            $(document).on('click', '.pagination_link', function (){
                var page = $(this).attr('id');
                load_data(page);
            });
})
        function search_data(){
            var search = jQuery('#search').val();
                jQuery.ajax({
                    type: 'post',
                    url:  'search.php',
                    data: 'search='+search,
                    success:function (data){
                        jQuery('#table-data').html(data);
                    }
                });
        }



    </script>
</body>
</html>
