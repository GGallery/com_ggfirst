<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelPartecipanti  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($id_edizione,$id_studente){

        $query=$this->_db->getQuery(true);
        $query->select('max(id)');
        $query->from('first_gg_partecipanti');
        $this->_db->setQuery($query);
        $id=$this->_db->loadResult()+1;
        $object = new StdClass;
        $object->id=$id;
        $object->id_edizione=$id_edizione;
        $object->id_studente=$id_studente;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_partecipanti',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_partecipanti where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }



    public function getPartecipanti($id=null, $id_edizione,$cognome=null, $offset=0, $limit=10){

        $query=$this->_db->getQuery(true);
        $query->select('p.id as id,s.nome as nome, s.cognome as cognome, s.data_nascita as data_nascita, e.codice_edizione as codice_edizione, e.minimo_partecipanti as minimo, s.id as id_studente,c.titolo as titolo');
        $query->from('first_gg_studenti as s');
        $query->join('inner','first_gg_partecipanti as p on s.id=p.id_studente');
        $query->join('inner','first_gg_edizioni as e on e.id=p.id_edizione');
        $query->join('inner','first_gg_corsi as c on c.id=e.id_corso');
        if($id!=null)
            $query->where('p.id='.$id);
        if($cognome!=null)
            $query->where('s.cognome like \'%'.$cognome.'%\'');
        if($id_edizione!=null)
            $query->where('p.id_edizione='.$id_edizione);
        $this->_db->setQuery($query);
        $rowscount=count($this->_db->loadAssocList());
        $query->setLimit($limit,$offset);
        //echo $query;die;
        $this->_db->setQuery($query);
        $studenti=$this->_db->loadAssocList();
        return [$studenti,$rowscount];
    }



}



