<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelCorsi  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($titolo){


        $object = new StdClass;
        $object->titolo=$titolo;

        $object->timestamp=Date('Y-m-d h:i:s',time());
        $result=$this->_db->insertObject('first_gg_corsi',$object);
        return $result;
    }

    public function insertedizioni($id_corso,$codice_edizione,$stato,$minimo_partecipanti){


        $object = new StdClass;
        $object->id_corso=$id_corso;
        $object->codice_edizione=$codice_edizione;
        $object->stato=$stato;
        $object->minimo_partecipanti=$minimo_partecipanti;
        $object->timestamp=Date('Y-m-d h:i:s',time());
        $result=$this->_db->insertObject('first_gg_edizioni',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_corsi where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$titolo){


        $sql="update first_gg_corsi set titolo='".$titolo."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getCorsi($id=null, $titolo=null){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_corsi as c');

        if($id!=null)
            $query->where('id='.$id);
        if($titolo!=null)
            $query->where('titolo like \'%'.$titolo.'%\'');

        $this->_db->setQuery($query);
        $rowscount=count($this->_db->loadAssocList());

        //echo $query;die;
        $this->_db->setQuery($query);
        $corsi=$this->_db->loadAssocList();
        foreach ($corsi as &$corso){
            $query=$this->_db->getQuery(true);
            $query->select('m.id as credito_id, cr.*');
            $query->from('first_gg_crediti as cr');
            $query->join('inner','first_gg_corsi_crediti_map as m on m.id_credito=cr.id');
            $query->where('m.id_corso='.$corso['id']);
            $this->_db->setQuery($query);
            $crediti=$this->_db->loadAssocList();
            $corso['crediti']=$crediti;
        }

        return [$corsi,$rowscount];
    }

    public function getEdizioni($id=null, $id_corso=null){

        $query=$this->_db->getQuery(true);
        $query->select('*, if((select count(*) from first_gg_partecipanti where id_edizione=e.id)>=minimo_partecipanti,1,0) as edizione_attiva');
        $query->from('first_gg_edizioni as e');

        if($id!=null)
            $query->where('id='.$id);
        if($id_corso!=null)
            $query->where('id_corso='.$id_corso);

        $this->_db->setQuery($query);
        $rowscount=count($this->_db->loadAssocList());

        //echo $query;die;
        $this->_db->setQuery($query);
        $edizioni=$this->_db->loadAssocList();
        foreach ($edizioni as &$edizione){
            $query=$this->_db->getQuery(true);
            $query->select('*');
            $query->from('first_gg_lezioni as l');

            $query->where('l.id_edizione='.$edizione['id']);
            $this->_db->setQuery($query);
            $crediti=$this->_db->loadAssocList();
            $edizione['lezioni']=$crediti;
        }

        return [$edizioni,$rowscount];
    }

    public function getStati(){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_stato_edizioni');
        $this->_db->setQuery($query);
        $stati=$this->_db->loadAssocList();
        return $stati;

    }

}



