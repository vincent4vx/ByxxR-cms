<?php $this->title = 'Inscription'?>
<?php $this->titleImg = 'inscription'?>

<?php echo HForm::open($form)?>
<table>
    <tr>
        <td><?php echo HForm::label($form->account)?></td>
        <td><?php echo $form->account->toHTML()?></td>
    </tr>
    <tr>
        <td><?php echo HForm::label($form->pseudo)?></td>
        <td><?php echo $form->pseudo->toHTML()?></td>
    </tr>
    <tr>
        <td><?php echo HForm::label($form->pass1)?></td>
        <td><?php echo $form->pass1->toHTML()?></td>
    </tr>
    <tr>
        <td><?php echo HForm::label($form->pass2)?></td>
        <td><?php echo $form->pass2->toHTML()?></td>
    </tr>
    <tr>
        <td><?php echo HForm::label($form->answer)?></td>
        <td><?php echo $form->answer->toHTML()?></td>
    </tr>
    <tr>
        <td><?php echo HForm::label($form->response)?></td>
        <td><?php echo $form->response->toHTML()?></td>
    </tr>
    <tr>
        <td><?php echo HForm::label($form->email)?></td>
        <td><?php echo $form->email->toHTML()?></td>
    </tr>
    <tr>
        <td>Validation</td>
        <td><?php echo HForm::submit('Enregister')?></td>
    </tr>
</table>
<?php echo HForm::close()?>
