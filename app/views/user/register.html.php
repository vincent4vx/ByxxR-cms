<?php $this->title = 'Inscription'?>
<?php $this->titleImg = 'inscription'?>

<?php echo HForm::open($form)?>
<table>
    <tr>
        <td></td>
        <td><?php echo $form->account->toHTML()?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $form->pseudo->toHTML()?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $form->pass1->toHTML()?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $form->pass2->toHTML()?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $form->email->toHTML()?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo HForm::submit('Enregister')?></td>
    </tr>
</table>
<script>
<?php echo $form->account->getScript()?>
        </script>
<?php echo HForm::close()?>
