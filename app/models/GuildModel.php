<?php
class GuildModel extends Model{
    public function ladder(){
        return $this->database->queryAll('SELECT xp, lvl, id, name FROM guilds ORDER BY xp DESC LIMIT 20');
    }
}
