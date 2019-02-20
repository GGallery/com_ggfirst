<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelAttestati  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($id_studente,$numero,$data_attestato,$certificatore,$id_credito_map,$scadenza){


        $object = new StdClass;
        $object->id_studente=$id_studente;
        $object->numero=$numero;
        $object->data_attestato=$data_attestato;
        $object->certificatore=$certificatore;
        $object->id_credito_map=$id_credito_map;
        $object->scadenza=$scadenza;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_attestati',$object);
        return $result;
    }


    public function delete($id){


        $sql="delete from first_gg_attestati where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$id_studente,$numero,$data_attestato,$certificatore,$id_credito_map,$scadenza){


        $sql="update first_gg_attestati set id_studente='".$id_studente."', numero='".$numero."', data_attestato='".$data_attestato."', certificatore='".$certificatore."', id_credito_map='".$id_credito_map."', scadenza='".$scadenza."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getAttestati($id=null,$id_studente=null,$numero=null,$data_attestato=null,$certificatore=null,$id_credito_map=null, $scadenza_data_minore=null,$scadenza_data_maggiore=null){

        $query=$this->_db->getQuery(true);
        $query->select('a.id as id, concat( c.titolo,\' \',cr.ruolo,\' \', cr.rischio) as credito, concat(s.cognome,\' \',s.nome) as studente, s.nome as nome, s.cognome as cognome, 
        a.numero as numero, a.data_attestato as data_attestato, a.scadenza as scadenza, a.certificatore as certificatore, c.titolo as titolo_corso, cr.durata as durata');
        $query->from('first_gg_attestati as a');
        $query->join('inner','first_gg_studenti as s on a.id_studente=s.id');
        $query->join('inner','first_gg_corsi_crediti_map as cm on a.id_credito_map=cm.id');
        $query->join('inner','first_gg_crediti as cr on cm.id_credito=cr.id');
        $query->join('inner','first_gg_corsi as c on cm.id_corso=c.id');
        if($id!=null)
            $query->where('id='.$id);
        if($id_studente!=null)
            $query->where('id_studente='.$id_studente);
        if($numero!=null)
            $query->where('numero=\''.$numero.'\'');
        if($data_attestato!=null)
            $query->where('data_attestato=\''.$data_attestato.'\'');
        if($certificatore!=null)
            $query->where('certificatore like\''.$certificatore.'\'');
        if($id_credito_map!=null)
            $query->where('id_credito_map='.$id_credito_map);
        if($scadenza_data_maggiore!=null && $scadenza_data_minore!=null)
            $query->where('scadenza<=\''.$scadenza_data_maggiore.'\' and scadenza>=\''.$scadenza_data_minore.'\'');
        //echo $query;die;
        $this->_db->setQuery($query);

        $attestati=$this->_db->loadAssocList();
        return $attestati;
    }

}



