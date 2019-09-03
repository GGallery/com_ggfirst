<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggcmModelCrediti  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($ruolo,$rischio,$durata,$informazioni,$aggiornamento,$elearning){


        $object = new StdClass;
        $object->ruolo=$ruolo;
        $object->rischio=$rischio;
        $object->durata=$durata;
        $object->informazioni=$informazioni;
        $object->aggiornamento=$aggiornamento;

        $object->elearning=$elearning;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_crediti',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_crediti where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$ruolo,$rischio,$durata,$informazioni,$aggiornamento,$elearning){


        $sql="update first_gg_crediti set ruolo='".$ruolo."', rischio='".$rischio."', durata='".$durata."', informazioni='".$informazioni."', aggiornamento='".$aggiornamento."', elearning='".$elearning."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getCrediti($id=null){

        $query=$this->_db->getQuery(true);
        $query->select('*,concat(cr.ruolo,\' \', cr.rischio) as credito');
        $query->from('first_gg_crediti as cr');
        if($id!=null)
            $query->where('id='.$id);

        $this->_db->setQuery($query);
        $dipendenti=$this->_db->loadAssocList();
        return $dipendenti;
    }

    public function getCreditiAggiornamento($id=null){

        $query=$this->_db->getQuery(true);
        $query->select('cr.id as id, concat(cr.ruolo,\' \', cr.rischio) as credito, cr.aggiornamento as aggiornamento, 
concat((select SUBSTRING(numero,1,3) from first_gg_attestati as a INNER JOIN first_gg_corsi_crediti_map as cm on cm.id=a.id_corsi_crediti_map where cm.id_credito=cr.id limit 1),
(select max(SUBSTRING(a.numero,4,1))+1 from first_gg_attestati as a INNER JOIN first_gg_corsi_crediti_map as cm on cm.id=a.id_corsi_crediti_map where cm.id_credito=cr.id )) as prossimo_codice ');
        $query->from('first_gg_crediti as cr');

        if($id!=null)
            $query->where('id='.$id);


        $this->_db->setQuery($query);
        $dipendenti=$this->_db->loadAssocList();

        return $dipendenti;
    }

    public function getCreditiEdizione($id=null){

        $query=$this->_db->getQuery(true);
        $query->select('cr.id as id, concat(cr.ruolo,\' \', cr.rischio) as credito');
        $query->from('first_gg_crediti as cr');
        $query->join('inner','first_gg_corsi_crediti_map as cm on cm.id_credito=cr.id');
        $query->join('inner','first_gg_corsi as c on cm.id_corso=c.id');
        $query->join('inner','first_gg_edizioni as e on e.id_corso=c.id');
        if($id!=null)
            $query->where('e.id='.$id);

        $this->_db->setQuery($query);
        $crediti=$this->_db->loadAssocList();
        return $crediti;
    }

    public function insert_map($id_corso, $id_credito){

        $object = new StdClass;
        $object->id_corso=$id_corso;
        $object->id_credito=$id_credito;
        $object->timestamp=Date('Y-m-d h:i:s',time());
        $result=$this->_db->insertObject('first_gg_corsi_crediti_map',$object);
        return $result;

        return $result;
    }
    public function delete_map($id){


        $sql="delete from first_gg_corsi_crediti_map where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

}



