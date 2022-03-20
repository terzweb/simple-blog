<?php

/* 
 * terzweb cms
 * teruhito
 */
?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{base_url}assets/{theme_folder_name}/js/bootstrap.min.js"></script>
<script src="{base_url}assets/{theme_folder_name}/js/mooz.scripts.min.js"></script>

<script type="text/javascript">
    $().ready(function() {

        $('#searchbtn').click(function() {

            $('#searchform').submit();

        });
    })
</script>