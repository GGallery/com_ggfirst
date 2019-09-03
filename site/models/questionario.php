<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 04/05/2017
 * Time: 17:03
 */


class ggcmModelQuestionario  extends JModelLegacy {

    protected $_db;
    private $_params;
    private $_app;


    public function __construct($config = array()) {
        parent::__construct($config);


        $this->_db = $this->getDbo();
        $this->_app = JFactory::getApplication();
        $this->_params = $this->_app->getParams();

    }

    public function insert($id_corso,$data,$risposta1,$risposta2,$risposta3,$risposta4,$risposta5,$risposta6,$risposta7,$risposta8,$risposta9,$risposta10,$risposta11,$risposta12,$risposta13,$risposta14,$risposta15){

        $object = new StdClass;
        $object->id_corso=$id_corso;
        $object->data=$data;
        $object->risposta1=$risposta1;
        $object->risposta2=$risposta2;
        $object->risposta3=$risposta3;
        $object->risposta4=$risposta4;
        $object->risposta5=$risposta5;
        $object->risposta6=$risposta6;
        $object->risposta7=$risposta7;
        $object->risposta8=$risposta8;
        $object->risposta9=$risposta9;
        $object->risposta10=$risposta10;
        $object->risposta11=$risposta11;
        $object->risposta12=$risposta12;
        $object->risposta13=$risposta13;
        $object->risposta14=$risposta14;
        $object->risposta15=$risposta15;
        $object->timestamp=Date('Y-m-d h:i:s',time());

        $result=$this->_db->insertObject('first_gg_questionari',$object);
        return $result;
    }


}



