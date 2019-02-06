<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelAule  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($denominazione,$indirizzo,$citta,$note){


        $object = new StdClass;
        $object->denominazione=$denominazione;
        $object->indirizzo=$indirizzo;
        $object->note=$note;
        $object->citta=$citta;

        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_aule',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_aule where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$denominazione,$indirizzo,$citta,$note){


        $sql="update first_gg_aule set denominazione='".$denominazione."', 
        indirizzo='".$indirizzo."', 
        note='".$note."', 
        citta='".$citta."' where id=".$id;

        $this->_db->setQuery($sql);

        $result=$this->_db->execute();

        return $result;
    }

    public function getAule($id=null, $denominazione=null, $offset=0, $limit=10){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_aule');
        if($id!=null)
            $query->where('id='.$id);
        if($denominazione!=null)
            $query->where('denominazione like \'%'.$denominazione.'%\'');

        $this->_db->setQuery($query);
        $rowscount=count($this->_db->loadAssocList());
        $query->setLimit($limit,$offset);
        //echo $query;die;
        $this->_db->setQuery($query);
        $studenti=$this->_db->loadAssocList();
        return [$studenti,$rowscount];
    }



}



