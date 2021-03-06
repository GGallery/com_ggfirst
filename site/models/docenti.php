<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggfirstModelDocenti  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($nome,$cognome,$provincia,$codice_fiscale,$data_nascita,$luogo_nascita,$prov_nascita,$email,$indirizzo,$cap,$citta,$telefono,$cellulare,$materie){


        $object = new StdClass;
        $object->nome=$nome;
        $object->cognome=$cognome;
        $object->provincia=$provincia;
        $object->codice_fiscale=$codice_fiscale;
        $object->data_nascita=$data_nascita;
        $object->luogo_nascita=$luogo_nascita;
        $object->prov_nascita=$prov_nascita;
        $object->email=$email;
        $object->indirizzo=$indirizzo;
        $object->cap=$cap;
        $object->citta=$citta;
        $object->telefono=$telefono;
        $object->cellulare=$cellulare;
        $object->materie=$materie;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_docenti',$object);
        return $result;
    }

    public function delete($id){


        $sql="delete from first_gg_docenti where id=".$id;
        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function modify($id,$nome,$cognome,$provincia,$codice_fiscale,$data_nascita,$luogo_nascita,$prov_nascita,$email,$indirizzo,$cap,$citta,$telefono,$cellulare,$materie){


        $sql="update first_gg_docenti set nome='".$nome."', 
        cognome='".$cognome."', 
        provincia='".$provincia."', codice_fiscale='".$codice_fiscale."', 
        data_nascita='".$data_nascita."', 
        luogo_nascita='".$luogo_nascita."', 
        prov_nascita='".$prov_nascita."',
        email='".$email."',
        indirizzo='".$indirizzo."',
        cap='".$cap."',
        citta='".$citta."',
        telefono='".$telefono."',
        materie='".$materie."',
        cellulare='".$cellulare."' where id=".$id;

        $this->_db->setQuery($sql);
        $result=$this->_db->execute();

        return $result;
    }

    public function getDocenti($id=null, $cognome=null, $offset=0, $limit=10){

        $query=$this->_db->getQuery(true);
        $query->select('*');
        $query->from('first_gg_docenti');
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
        return [$studenti,$rowscount];
    }



}



