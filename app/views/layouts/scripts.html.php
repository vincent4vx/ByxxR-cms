<script type="text/javascript">
    var base_url = "<?php echo Core::conf('root')?>";
</script>
<?php echo Assets::js('helpers')?>
<?php echo Assets::js('jquery')?>
<?php echo is_string($this->headerInc)?$this->headerInc:''?>
