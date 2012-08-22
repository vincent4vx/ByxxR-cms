<?php $this->pageTitle='test'?>
<?php $this->titleImg='accueil'?>
<?php $form=&$this->formManager?>

<?php echo $form->open()?>
<table>
    <tr>
	<td><?php echo $form->text->label()?></td>
	<td><?php echo $form->text?></td>
	<td><?php echo $form->text->error()?></td>
    </tr>
    <tr>
	<td><?php echo $form->email->label()?></td>
	<td><?php echo $form->email?></td>
	<td><?php echo $form->email->error()?></td>
    </tr>
    <tr>
	<td>Valider</td>
	<td><?php echo $form->submit('Valider')?></td>
    </tr>
</table>
<?php echo $form->close()?>

<pre>
<?php $this->headerInc=$form->getScript()?>
</pre>
