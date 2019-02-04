<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggpmModelLezioni  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($id_corso,$id_docente,$id_aula,$data,$ora_inizio,$ora_fine,$titolo,$note){


        $object = new StdClass;
        $object->id_corso=$id_corso;
        $object->id_docente=$id_docente;
        $object->id_aula=$id_aula;
        $object->data=$data;
        $object->ora_inizio=$ora_inizio;
        $object->ora_fine=$ora_fine;
        $object->titolo=$titolo;
        $object->note=$note;
        $object->timestamp=Date('Y-m-d h:i:s',time());
        $result=$this->_db->insertObject('first_gg_lezioni',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_lezioni where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$id_corso,$id_docente,$id_aula,$data,$ora_inizio,$ora_fine,$titolo,$note){


        $sql="update first_gg_lezioni set id_corso='".$id_corso."', 
        id_docente='".$id_docente."', 
        id_aula='".$id_aula."', 
        data='".$data."', 
        ora_inizio='".$ora_inizio."', 
        ora_fine='".$ora_fine."', 
        titolo='".$titolo."',
        note='".$note."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getLezioni($id_corso=null,$id_aula=null,$data=null){

        $query=$this->_db->getQuery(true);
        $query->select('d.nome as nome,d.cognome as cognome,a.denominazione as denominazione, l.id_docente as id_docente,a.id as id_aula,l.note as note, 
                        c.titolo as titolo, l.data as data, l.id_corso as id_corso, l.titolo as titolo_lezione, l.ora_inizio as ora_inizio, l.ora_fine as ora_fine, l.id as id_lezione,
                        if((select count(*) from first_gg_partecipanti where id_corso=c.id)>=(select minimo_partecipanti from first_gg_preventivi where id_corso=c.id),1,0) as corso_attivo');
        $query->from('first_gg_lezioni as l');
        $query->join('inner','first_gg_docenti as d on l.id_docente=d.id ');
        $query->join('inner','first_gg_aule as a on l.id_aula=a.id ');
        $query->join('inner','first_gg_corsi as c on l.id_corso=c.id ');
        if($id_corso)
            $query->where('c.id='.$id_corso);
        if($id_aula)
            $query->where('a.id='.$id_aula);
        if($data)
            $query->where('l.data=\''.$data.'\'');
        $query->order('c.id,l.data ASC');
        $this->_db->setQuery($query);
        $lezioni=$this->_db->loadAssocList();

        return $lezioni;
    }



}



