<?php $this->title = 'Changer d\'adresse e-mail'?>

<?php echo HForm::open($form)?>
<table>
    <tr>
        <td>Nouvelle adresse e-mail :</td>
        <td><?php echo $form->email.$form->email->error()?></td>
    </tr>
    <tr>
        <td>Mot de passe :</td>
        <td><?php echo $form->pass.$form->pass->error()?></td>
    </tr>
    <tr>
        <td>Valider :</td>
        <td><?php echo HForm::submit('Enregister')?></td>
    </tr>
</table>
