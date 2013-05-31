<script type="text/javascript">
    var base_url = "<?php echo Core::conf('root')?>";
</script>
<?php echo Assets::js('helpers')?>
<!--[if lt IE  9]>
<?php echo Assets::js('jquery1')?>
<![endif]-->
<!--[if gte IE 9]-->
<?php echo Assets::js('jquery2')?>
<!--[end if]-->
<?php echo is_string($this->headerInc)?$this->headerInc:''?>
