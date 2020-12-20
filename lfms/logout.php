<?php
session_start();
if(session_destroy())
{
?>
<script type="text/javascript">
    window.location = "index.php";
</script>

<?php
}
?>