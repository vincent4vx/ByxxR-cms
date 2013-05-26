<fieldset>
    <legend>Supprimer le compte</legend>
    <font color=red><b>Attention :</b> cette action est irréversible !</font>
    <br/><br/>
    <form action="" method="post">
	<table>
	    <tr>
		<td>Mot de passe : </td>
		<td><input type="password" name="pass" /></td>
	    </tr>
	    <tr>
		<td>Question : </td>
		<td><b><?php echo $account['question']?></b></td>
	    </tr>
	    <tr>
		<td>Réponse : </td>
		<td><input type="text" name="reponse" /></td>
	    </tr>
	    <tr>
		<td>Valider : </td>
		<td><input type="submit" value="Supprimer !" /></td>
	    </tr>
	</table>
    </form>
</fieldset>
