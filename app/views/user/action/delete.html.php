<?php $this->title = 'Supression du compte'?>
<font color=red><b>Attention :</b> cette action est irréversible !</font>
<br/><br/>
<?php echo HForm::open($form)?>
    <table>
        <tr>
            <td>Mot de passe : </td>
            <td><?php echo $form->pass.$form->pass->error()?></td>
        </tr>
        <tr>
            <td>Question : </td>
            <td><b><?php echo $account['question']?></b></td>
        </tr>
        <tr>
            <td>Réponse : </td>
            <td><?php echo $form->response.$form->response->error()?></td>
        </tr>
        <tr>
            <td>Valider : </td>
            <td><?php echo HForm::submit('Supprimer')?></td>
        </tr>
    </table>
<?php echo HForm::close()?>