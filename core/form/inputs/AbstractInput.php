<?php
abstract class AbstractInput
{
    public $label='';
    /**
     * the row name and id
     * @var string
     */
    protected $name='';
    /**
     * the validation pattern
     * @var string
     */
    protected $pattern='';
    /**
     * The html attributes
     * @var array
     */
    protected $attributes = array();
    /**
     * The parrent form
     * @var Form
     */
    protected $_form;
    /**
     * The validate function
     * @var array
     */
    protected $function;
    /**
     * If is required
     * @var bool
     */
    protected $required = false;

    public function __construct(Form &$form, $name, array $attributes = array(), $function = '') {
        $this->_form =& $form;
        $this->name = $name;
        $this->attributes = $attributes;
        $this->function = $function;
        $this->loadAttributes();
    }

    public abstract function __toString();

    private final function loadAttributes(){
        if(in_array('required', $this->attributes))
            $this->required = true;

        if(isset($this->attributes['pattern']))
            $this->pattern = $this->attributes['pattern'];
        else
            $this->pattern = $this->defaultPattern();
    }

    protected final function setLabel(&$label){
	if($label===false)
	    $this->label='';
	else
	    $this->label=&$label;
    }
    
    public function value(){
	if(!empty($_POST[$this->name]))
	    return $_POST[$this->name];
	return '';
    }

    protected abstract function defaultPattern();
    
    public final function label(){
	return HForm::label($this);
    }
    
    public final function error(){
	return HForm::error($this);
    }
    
    public function validate(){
	if($this->required and $this->value()==='')
	    return array($this->name=>'Ce champ est obligatoire !');
	
	if($this->value() !== '' and $this->pattern !== '' and !preg_match('#'.$this->pattern.'#', $this->value()))
	    return array($this->name=>'Champ invalide !');

        if($this->function!==''){
            $matches = array();
            if(!preg_match('#(equal|diff)\(([a-z0-9_]+)\)#i', $this->function, $matches)){
                throw new BException('Une erreur est survenue lors de l\'analyse de la fonction de comparaison de l\'input <b>%s</b>', array($this->name));
            }

            $obj =& $this->_form->{$matches[2]};

            if($matches[1]==='equal'){
                if($obj->value()!==$this->value())
                    return array($this->name=>'La valeur de ce champ doit etre la meme que pour '.$obj->getName().' !');
            }else{
                if($obj->value()===$this->value())
                    return array($this->name=>'La valeur de ce champ doit etre differente de '.$obj->getName().' !');
            }
        }

        return true;
    }


    public function getScript()
    {
        $script = 'function validate'.$this->name.'(){';
        $script.= 'var id = "'.$this->name.'";var elem = document.getElementById(id);';

        if($this->required){
            $script.='if(elem.value==""){formManager.displayError(id, "Ce champ est obligatoire !");return;}';
        }

        if($this->pattern!==''){
            $script.='var regex = new RegExp("'.str_replace('\\', '\\\\', $this->pattern).'");';
            $script.='if(!regex.test(elem.value) && elem.value!=""){';
            $script.='formManager.displayError(id, "Champ invalide !");';
            $script.='return;}';
        }

        if($this->function!==''){
            $matches = array();
            if(preg_match('#(equal|diff)\(([a-z0-9_]+)\)#i', $this->function, $matches)){
                $name = $matches[2];
                $script.='if(document.getElementById("'.$name.'").value';

                if($matches[1]==='equal'){
                    $script.='!=elem.value){';
                    $script.='formManager.displayError(id, "Le champ doit être égual au champ '.$name.' !");return}';
                }else{
                    $script.='==elem.value){';
                    $script.='formManager.displayError(id, "Le champ doit être différent du champ '.$name.' !");return}';
                }
            }else{
                trigger_error('La fonction de comparaison de l\'input <b>'.$this->name.'</b> n\'est pas valide !', E_USER_WARNING);
            }
        }

        $script.='formManager.rowValid(id);}'.PHP_EOL;
	
	return $script;
    }

    public function getName(){
        return $this->name;
    }

    public final function toHTML(){
        return $this->__toString().$this->error();
    }
}
