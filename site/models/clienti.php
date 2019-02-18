<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelClienti  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($denominazione,$riferimento,$email,$indirizzo,$cap,$citta,$piva,$codice_univoco,$codice_fiscale,$codice_ateco){


        $object = new StdClass;
        $object->denominazione=$denominazione;
        $object->riferimento=$riferimento;
        $object->email=$email;
        $object->indirizzo=$indirizzo;
        $object->cap=$cap;
        $object->citta=$citta;
        $object->piva=$piva;
        $object->codice_univoco=$codice_univoco;
        $object->codice_fiscale=$codice_fiscale;
        $object->codice_ateco=$codice_ateco;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_clienti',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_clienti where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$denominazione,$riferimento,$email,$indirizzo,$cap,$citta,$piva,$codice_univoco,$codice_fiscale,$codice_ateco){


        $sql="update first_gg_clienti set denominazione='".$denominazione."', riferimento='".$riferimento."', email='".$email."', indirizzo='".$indirizzo."', cap='".$cap."', citta='".$citta."', 
        codice_univoco='".$codice_univoco."',
        codice_fiscale='".$codice_fiscale."',
        codice_ateco='".$codice_ateco."', 
        piva='".$piva."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getClienti($id=null,$denominazione=null){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_clienti');
        if($id!=null)
            $query->where('id='.$id);
        if($denominazione!=null)
            $query->where('denominazione like \'%'.$denominazione.'%\'');

        $this->_db->setQuery($query);
        $dipendenti=$this->_db->loadAssocList();
        return $dipendenti;
    }



}



