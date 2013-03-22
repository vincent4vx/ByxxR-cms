<?php $this->title = 'Inscription'?>
<?php $this->titleImg = 'inscription'?>

<?php echo HForm::open($form)?>
<table>
    <tr>
        <td></td>
        <td><?php echo $form->account.HForm::error($form->account)?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $form->pseudo?></td>
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
