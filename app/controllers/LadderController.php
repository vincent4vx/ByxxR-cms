<?php
class LadderController extends Controller{
    public function indexAction(){
        $this->persoAction();
    }

    public function persoAction($order = 'xp'){
        if($order!=='xp' && $order!=='kamas')
            $order='xp';

        if($this->output->startCache('ladder.perso.'.$order)){
            $chars = $this->model('character')->ladder(0, 20, $order);
            $this->output->view('ladder/perso', array('chars'=>$chars));
            $this->output->endCache(900);
        }
    }
}
