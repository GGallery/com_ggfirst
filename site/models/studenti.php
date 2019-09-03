<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggcmModelStudenti  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function delete($id){


        $sql="delete from first_gg_studenti where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function insert($nome,$cognome,$codice_fiscale,$data_nascita,$luogo_nascita,$prov_nascita,$email,$titolo,$profilo,$telefono,$cellulare,$idcliente){


        $object = new StdClass;
        $object->nome=$nome;
        $object->cognome=$cognome;

        $object->codice_fiscale=$codice_fiscale;
        $object->data_nascita=$data_nascita;
        $object->luogo_nascita=$luogo_nascita;
        $object->prov_nascita=$prov_nascita;
        $object->email=$email;
        $object->titolo=$titolo;
        $object->profilo=$profilo;
        $object->telefono=$telefono;
        $object->cellulare=$cellulare;
        $object->idcliente=$idcliente;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_studenti',$object);
        return $result;
    }

    public function modify($id,$nome,$cognome,$codice_fiscale,$data_nascita,$luogo_nascita,$prov_nascita,$email,$titolo,$profilo,$telefono,$cellulare,$idcliente){


        $sql="update first_gg_studenti set nome='".$nome."', 
        cognome='".$cognome."', 
        codice_fiscale='".$codice_fiscale."', 
        data_nascita='".$data_nascita."', 
        luogo_nascita='".$luogo_nascita."', 
        prov_nascita='".$prov_nascita."',
        email='".$email."',
        titolo='".$titolo."',
        profilo='".$profilo."',
        
        telefono='".$telefono."',
        idcliente='".$idcliente."',
        cellulare='".$cellulare."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getStudenti($id=null, $cognome=null, $offset=0, $limit=10){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_studenti as s');

        if($id!=null)
            $query->where('id='.$id);
        if($cognome!=null)
            $query->where('cognome like \'%'.$cognome.'%\'');

        $this->_db->setQuery($query);
        $rowscount=count($this->_db->loadAssocList());
        $query->setLimit($limit,$offset);
        //echo $query;die;
        $this->_db->setQuery($query);
        $studenti=$this->_db->loadAssocList();

        foreach($studenti as &$studente){
            $query=$this->_db->getQuery(true);
            $query->select('c.titolo as titolo_corso,e.codice_edizione as codice_edizione');
            $query->from('first_gg_partecipanti as p ');
            $query->join('inner','first_gg_edizioni as e on p.id_edizione=e.id');
            $query->join('inner','first_gg_corsi as c on c.id=e.id_corso');
            $query->where('p.id_studente='.$studente['id']);
            $this->_db->setQuery($query);
            $edizioni_iscritto=$this->_db->loadAssocList();
            $studente["edizioni_iscritto"]=$edizioni_iscritto;
        }

        return [$studenti,$rowscount];
    }



}



