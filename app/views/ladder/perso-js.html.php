<?php $this->title = 'Classement des personnages' ?>
<?php $this->titleImg = 'ladder' ?>
<table style="width: 95%;margin: auto;">
    <thead>
        <tr>
            <th width="8"></th>
            <th>Nom</th>
            <th width="30"><?php echo Assets::img("heads/SmallHead_0.png") ?></th>
            <th>Level</th>
            <th><a href="#" data-column="xp">Xp</a></th>
            <th><a href="#" data-column="kamas">Kamas</a></th>
        </tr>
    </thead>
    <tbody id="ladder"></tbody>
</table>

<?php echo Assets::js('ladder')?>
