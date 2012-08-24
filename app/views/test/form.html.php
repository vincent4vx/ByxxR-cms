<?php $this->pageTitle='test'?>
<?php $this->titleImg='accueil'?>
<?php $form=&$this->formManager?>
<?php $this->headerInc=$this->assets->js('form').$this->assets->js('ajax')?>

<?php echo $form->open('#')?>
<table>
    <tr>
	<td><?php echo $form->text->label()?></td>
	<td><?php echo $form->text?><?php echo $form->text->error()?></td>
    </tr>
    <tr>
	<td><?php echo $form->email->label()?></td>
	<td><?php echo $form->email?><?php echo $form->email->error()?></td>
    </tr>
    <tr>
	<td><?php echo $form->url->label()?></td>
	<td><?php echo $form->url?><?php echo $form->url->error()?></td>
    </tr>
    <tr>
	<td>Valider</td>
	<td><?php echo $form->submit('Valider')?></td>
    </tr>
</table>
<?php echo $form->close()?>

<?php $this->footerInc=$form->getScript()?>
