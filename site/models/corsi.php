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

    public function insert($titolo,$data_inizio,$data_fine){


        $object = new StdClass;
        $object->titolo=$titolo;
        $object->data_inizio=$data_inizio;
        $object->data_fine=$data_fine;
        $object->timestamp=Date('Y-m-d h:i:s',time());
        $result=$this->_db->insertObject('first_gg_corsi',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_corsi where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$titolo,$data_inizio,$data_fine){


        $sql="update first_gg_corsi set titolo='".$titolo."', 
        data_inizio='".$data_inizio."', 
        data_fine='".$data_fine."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getCorsi($id=null, $titolo=null, $offset=0, $limit=10){

        $query=$this->_db->getQuery(true);
        $query->select('*, if((select count(*) from first_gg_partecipanti where id_corso=c.id)>=(select minimo_partecipanti from first_gg_preventivi where id_corso=c.id),1,0) as corso_attivo');
        $query->from('first_gg_corsi as c');

        if($id!=null)
            $query->where('id='.$id);
        if($titolo!=null)
            $query->where('titolo like \'%'.$titolo.'%\'');

        $this->_db->setQuery($query);
        $rowscount=count($this->_db->loadAssocList());
        $query->setLimit($limit,$offset);
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



}



