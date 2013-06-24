<?php $this->title='Mon compte'?>
<?php $this->titleImg='profil'?>
<script type="text/javascript">
    function openItem(name){
        $('#edit').html('<center style="margin-top: 25px;">' + Assets.img('loading.gif', 'Chargement...') + '</center>');
        $('#edit').load(Url.generate('user/action/' + name));
    }
</script>
<?php echo Assets::js('form')?>
<fieldset>
            <legend>Mes informations</legend>
            <table style="width: 100%;">
                <tr>
                    <td>Nom de Compte : </td>
                    <td colspan="2"><?php echo $this->session->account?></td>
                    <td><a href="#edit" onclick="openItem('delete')"><?php echo Assets::img("devtool/delete.png")?></a></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b><?php echo $this->session->pseudo?></b></td>
                    <td colspan="2">Rang : <b><?php echo $this->session->banned == 1 ? 'Banni' : Core::conf('admin.rank.'.($this->session->level))?></b></td>
                    <td><a href="<?php echo Url::genUrl('home/staff')?>"><?php echo Assets::img("devtool/help.png")?></a></td>
                </tr>
                <tr>
                    <td rowspan="4"><?php echo Assets::img('avatars/'.(!empty($this->session->avatar) ? $this->session->avatar : '53.jpg'))?></td>
                    <td>Mot de passe : </td>
                    <td>******</td>
                    <td><?php echo Assets::img("devtool/edit.png")?></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td><?php echo $account['email']?></td>
                    <td><a href="#edit" onclick="openItem('changemail')"><?php echo Assets::img("devtool/edit.png")?></a></td>
                </tr>
                <tr>
                    <td>Question : </td>
                    <td><?php echo $account['question']?></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="vertical-align: top;width: 270px;">
                        <b><u><font color="red">Informations :</font><br/></u></b>
                        <div style="width: 255px;"><?php echo $this->session->info ? $this->session->info : 'Aucunes informations disponible...'?></div>
                    </td>
                    <td><?php echo Assets::img("devtool/edit.png")?></td>
                </tr>
            </table>
</fieldset>
<div id="edit"></div>
