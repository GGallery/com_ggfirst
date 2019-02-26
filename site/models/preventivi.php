<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelPreventivi  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($id_corso,$id_cliente,$budget,$id_stato_preventivo){


        $object = new StdClass;
        $object->id_corso=$id_corso;
        $object->id_cliente=$id_cliente;

        $object->budget=$budget;
        $object->id_stato_preventivo=$id_stato_preventivo;

        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_preventivi',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_preventivi where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$id_corso,$id_cliente,$budget,$id_stato_preventivo){


        $sql="update first_gg_preventivi set 
        id_corso=".$id_corso.", 
        id_cliente=".$id_cliente.", 
         
        budget=".$budget.", 
        id_stato_preventivo=".$id_stato_preventivo." where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getPreventivi($id=null, $nome_corso=null, $nome_cliente=null, $offset=0, $limit=10,$id_stato=null){

        $query=$this->_db->getQuery(true);
        $query->select('p.*,c.titolo as corso, cl.denominazione as cliente, s.stato_preventivo as stato,e.minimo_partecipanti as minimo_partecipanti,
        (select count(*) from first_gg_partecipanti where id_edizione=e.id) as numero_partecipanti, if((select count(*) from first_gg_partecipanti where id_edizione=e.id)>=minimo_partecipanti,1,0) as edizione_attiva
        ');
        $query->from('first_gg_preventivi as p');
        $query->join('inner','first_gg_corsi as c on c.id=p.id_corso');
        $query->join('inner','first_gg_edizioni as e on c.id=e.id_corso');
        $query->join('inner','first_gg_clienti as cl on cl.id=p.id_cliente');
        $query->join('inner','first_gg_stato_preventivi as s on s.id=p.id_stato_preventivo');
        if($id!=null)
            $query->where('id='.$id);
        if($nome_corso!=null)
            $query->where("c.titolo like '%".$nome_corso."%'");
        if($nome_cliente!=null)
            $query->where("cl.denominazione like '%".$nome_cliente."%'");
        if($id_stato!=null)
            $query->where("s.id=".$id_stato);
        $this->_db->setQuery($query);

        $rowscount=count($this->_db->loadAssocList());
        $query->setLimit($limit,$offset);
        //echo $query;die;
        $this->_db->setQuery($query);
        $studenti=$this->_db->loadAssocList();
        return [$studenti,$rowscount];
    }

    public function getStati(){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_stato_preventivi');

        $this->_db->setQuery($query);
        $stati=$this->_db->loadAssocList();
        return $stati;
    }

}



