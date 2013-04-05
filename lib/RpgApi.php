<?php
/**
 * API pour RPG paradize
 * @author v4vx
 */
class RpgApi{
    /**
     * l'id RPG
     * @var int
     */
    private $id;
    /**
     * Le code source de la page
     * @var string
     */
    private $page_code='';
    /**
     * La position dans RPG paradize
     * @var int
     */
    private $position=0;
    /**
     * Le nombre de click vers le site
     * @var int
     */
    private $out=-1;
    /**
     * Le nombre de votes
     * @var int
     */
    private $votes=-1;

    /**
     * Initialise l'api RPG paradise
     * @param int $rpg_id l'id de la page RPG
     */
    public function __construct($rpg_id){
        $this->id=$rpg_id;
    }

    /**
     * Capture le script du captcha de la page de vote
     * /!\ Cette opération est très lourde, veuillez utiliser un système de cache, ou limiter
     * le nombre d'affichage du captcha /!\
     * @return mixed retourne le script à afficher ou FALSE en cas d'erreur (404, ou autres)
     */
    public function getCaptcha(){
        $page_data = file_get_contents('http://www.rpg-paradize.com/?page=vote&vote='.$this->id);

        if(!$page_data){
            trigger_error('RpgApi->getCaptcha() : une erreur est survenue lors de la récupération de la page. FALSE retourné !', E_USER_NOTICE);
            return false;
        }

        $matches = array();

        $start_tag = '<script src=\'http://api.adscaptcha.com/Get.aspx';
        $end_tag = '\' type=\'text/javascript\'></script>';

        if(!preg_match('#'.$start_tag.'(\?.+)'.$end_tag.'#', $page_data, $matches)){
            trigger_error('RpgApi->getCaptcha() : La page a été récupéré avec succès, mais son contenue est invalide. L\'id RPG est peut-être invalide... FALSE retourné.', E_USER_NOTICE);
            return false;
        }

        return $start_tag.$matches[1].$end_tag;
    }

    /**
     * Envoit le vote à RPG paradize et test sont autenticité
     * @param mixed $get Mettre TRUE si l'on passe par $_GET, ou mettre le tableau d'entrés
     * si vous utiliser un système d'input particulier. Laissez FALSE (par defaut) sinon.
     * @return boolean TRUE si le captacha est bon, FALSE sinon
     */
    public function submitVote($get = false){
        if(!$get)
            $in = $_POST;
        elseif($get===true)
            $in = $_GET;
        elseif(is_array($get))
            $in = $get;
        else{
            trigger_error('RpgApi->submitVote() : Argument passé à la méthode invalide, vous avez donné un '.gettype($get).' au lieu d\'un booléen (true/false) ou un tableau !', E_USER_WARNING);
            return false;
        }

        if(empty($in['adscaptcha_response_field']) || empty($in['adscaptcha_challenge_field']))
            return false;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'http://www.rpg-paradize.com/?page=vote2');
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'adscaptcha_response_field'=>$in['adscaptcha_response_field'],
            'adscaptcha_challenge_field'=>$in['adscaptcha_challenge_field'],
            'submitvote'=>$this->id,
            'submit'=>'Voter'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($curl);
        curl_close($curl);

        if($data===false){
            trigger_error('RpgApi->submitVote() : Une erreur est survenue lors du test du captcha...', E_USER_NOTICE);
            return false;
        }

        $err_page = <<<EOD
<!-- ***************************************************************** -->
<!-- PAGE MIDDLE -->
</td><td valign="top">

OK









<br />

<!-- ***************************************************************** -->
<!-- END PAGE -->
EOD;

        if(strpos($data, '<span style="font-size:20px;color:red;">Captcha incorrect</span>')!==false || strpos($data, $err_page)!==false)
                return false;

        return true;
    }

    /**
     * Charge la page et retourne son contenue
     * @return mixed
     */
    private function loadPage(){
        if($this->page_code!=='')
            return $this->page_code;

        $this->page_code = file_get_contents('http://www.rpg-paradize.com/site--'.$this->id);

        if(!$this->page_code){
            trigger_error('RpgApi->loadPage() : impossible de charger la page...', E_USER_NOTICE);
            return false;
        }

        return $this->page_code;
    }

    /**
     * Retourne la position dans la classement de RPG Paradize
     * Il est préférable de mettre en cache cette valeur !
     * @return int
     */
    public function getPosition(){
        if($this->position!==0)
            return $this->position;

        $matches = array();
        if(!$code = $this->loadPage()){
            trigger_error('RpgApi->getPosition() : récupération impossible de la position.', E_USER_NOTICE);
            return 0;
        }

        if(!preg_match('#<b>Position ([0-9]+)</b>#', $code, $matches)){
            trigger_error('RpgApi->getPosition() : La page à été chargée avec succès, mais il est impossible de trouver la position. L\'id est peut-être incorrect.', E_USER_NOTICE);
            return 0;
        }

        return $this->position = $matches[1];
    }

    /**
     * Retourne le nombre de votes
     * Il est préférable de mettre en cache cette valeur pour éviter de charger inutilement la page
     * @return int
     */
    public function getVotes(){
        if($this->votes!==-1)
            return $this->votes;

        $matches = array();
        if(!$code = $this->loadPage()){
            trigger_error('RpgApi->getVotes() : récupération impossible du nombre de votes...', E_USER_NOTICE);
            return 0;
        }
        
        if(!preg_match('#>Vote : ([0-9]+)</a>#', $code, $matches)){
            trigger_error('RpgApi->getVotes() : La page à été chargée avec succès, mais il est impossible de trouver le nombre de votes. L\'id est peut-être incorrect.', E_USER_NOTICE);
            return 0;
        }

        return $this->votes = $matches[1];
    }

    /**
     * Récupère le nombre de redirection vers le site (nombre de click sur le lien du site depuis RPG)
     * Il est préférable de mettre en cache cette valeur pour éviter de charger inutilement la page
     * @return int
     */
    public function getOut(){
        if($this->out!==-1)
            return $this->out;

        $matches = array();
        if(!$code = $this->loadPage()){
            trigger_error('RpgApi->getOut() : récupération impossible du nombre de redirection vers le site...', E_USER_NOTICE);
            return 0;
        }

        if(!preg_match('#Clic Sortant : ([0-9]+)#', $code, $matches)){
            trigger_error('RpgApi->getOut() : La page à été chargée avec succès, mais il est impossible de trouver le nombre de redirection vers le site. L\'id est peut-être incorrect.', E_USER_NOTICE);
            return 0;
        }

        return $this->out = $matches[1];
    }

    /**
     * Redirige vers la page de vote RPG Paradize
     */
    public function redirectVote(){
        if(!headers_sent())
            header('location: http://www.rpg-paradize.com/?page=vote&vote='.$this->id);
        else
            echo '<meta http-equiv="refresh" content="0;url=http://www.rpg-paradize.com/?page=vote&vote='.$this->id.'"/>';
    }

    /**
     * Redirige vers la page de description de RPG Paradize
     */
    public function redirectDescription(){
        if(!headers_sent())
            header('location: http://www.rpg-paradize.com/site--'.$this->id);
        else
            echo '<meta http-equiv="refresh" content="0;url=http://www.rpg-paradize.com/site--'.$this->id.'"/>';
    }

    /**
     * Permet de linéariser la classe (pour le cache)
     * @return array
     */
    public function __sleep() {
        return array('id', 'page_code', 'position', 'votes', 'out');
    }
}
