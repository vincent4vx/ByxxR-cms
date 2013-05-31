<?php
class ThreadsModel extends Model{
    public function create($forum_id, $name, $author, $content){
        $path = $this->db->selectFirst('byxxr_forums', 'path', array('id'=>$forum_id));
        $path = $path['path'];

        $this->db->create('byxxr_threads', array(
            'name' => $name,
            'author' => $author,
            'forum' => $forum_id,
            'path' => $path.'.'.base64_encode($name),
            'creation_time' => time(),
        ));
        $this->db->create('byxxr_posts', array(
            'thread_id' => $this->db->lastInsertId(),
            'author' => $author,
            'content' => $content,
            'creation_time' => time()
        ));

        $path = explode('.', $path);
        $path[] = $name;
        return array_map('base64_decode', $path);
    }

    public function getList($forum_id){
        return $this->db->executeAll('SELECT COUNT(p.thread_id) as msg_num, t.name FROM byxxr_threads t JOIN byxxr_posts p ON p.thread_id = t.id WHERE forum = ? GROUP BY p.thread_id', array($forum_id));
    }
}
