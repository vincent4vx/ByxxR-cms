<?php
class CharacterModel extends Model{
    public function ladder($start = 0, $num = 20, $order = 'xp'){
        if($order!=='xp' && $order!=='kamas')
            $order='xp';
        
        $stmt = $this->db->prepare('SELECT p.name, p.level, p.honor, p.xp, p.kamas FROM personnages p JOIN accounts ON p.account = accounts.guid WHERE accounts.level < 1 ORDER BY p.'.$order.' DESC LIMIT :s,:n');
        $stmt->bindParam('s', $start, PDO::PARAM_INT);
        $stmt->bindParam('n', $num, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
