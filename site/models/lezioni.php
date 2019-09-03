<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggcmModelLezioni  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($id_edizione,$id_docente,$id_luogo,$id_aula,$data,$ora_inizio,$ora_fine,$titolo,$note){


        $object = new StdClass;
        $object->id_edizione=$id_edizione;
        $object->id_docente=$id_docente;
        $object->id_luogo=$id_luogo;
        $object->id_aula=$id_aula;
        $object->data=$data;
        $object->ora_inizio=$ora_inizio;
        $object->ora_fine=$ora_fine;
        $object->titolo=$titolo;
        $object->note=$note;
        $object->timestamp=Date('Y-m-d h:i:s');
        $result=$this->_db->insertObject('first_gg_lezioni',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_lezioni where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$id_edizione,$id_docente,$id_luogo,$id_aula,$data,$ora_inizio,$ora_fine,$titolo,$note){


        $sql="update first_gg_lezioni set id_edizione='".$id_edizione."', 
        id_docente='".$id_docente."', 
        id_luogo='".$id_luogo."', 
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

    public function getLezioni($id_corso=null,$id_edizione=null,$id_luogo=null,$data=null,$data_iniziale=null,$data_finale=null){

        $query=$this->_db->getQuery(true);
        $query->select('l.id_docente as cognome,a.denominazione as denominazione,lu.id as id_luogo, lu.denominazione as luogo, l.id_docente as id_docente,a.id as id_aula,l.note as note,c.titolo as titolo,c.id as id_corso, 
                        e.codice_edizione as codice_edizione, l.data as data, l.id_edizione as id_edizione, l.titolo as titolo_lezione, l.ora_inizio as ora_inizio, l.ora_fine as ora_fine, l.id as id_lezione,
                        if((select count(*) from first_gg_partecipanti where id_edizione=l.id_edizione)>=(select minimo_partecipanti from first_gg_edizioni where id=l.id_edizione),1,0) as corso_attivo');
        $query->from('first_gg_lezioni as l');
        //$query->join('inner','first_gg_docenti as d on l.id_docente=d.id ');
        $query->join('inner','first_gg_luoghi as lu on l.id_luogo=lu.id ');
        $query->join('left','first_gg_aule as a on l.id_aula=a.id ');
        $query->join('inner','first_gg_edizioni as e on l.id_edizione=e.id ');
        $query->join('inner','first_gg_corsi as c on c.id=e.id_corso');
        if($id_edizione)
            $query->where('e.id='.$id_edizione);
        if($id_luogo)
            $query->where('lu.id='.$id_luogo);
        if($data)
            $query->where('l.data=\''.$data.'\'');
        if($id_corso)
            $query->where('c.id='.$id_corso);
        if($data_iniziale)
            $query->where('l.data>=\''.$data_iniziale.'\'');
        if($data_finale)
            $query->where('l.data<=\''.$data_finale.'\'');
        $query->order('c.id,l.data ASC,l.ora_inizio ASC');
//echo $query; die;
        $this->_db->setQuery($query);

        $lezioni=$this->_db->loadAssocList();

        return $lezioni;
    }

    public function getDateInizioFineEdizione($id_edizione){

        $query=$this->_db->getQuery(true);
        $query->select('min(data)as inizio,max(data) as fine');
        $query->from('first_gg_lezioni as l');
        $query->join('inner','first_gg_edizioni as e on l.id_edizione=e.id ');
        $query->where('e.id='.$id_edizione);

//echo $query; die;
        $this->_db->setQuery($query);

        $lezioni=$this->_db->loadAssocList();

        return $lezioni[0];

    }


}



