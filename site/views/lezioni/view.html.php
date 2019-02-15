<?php

/**
 * @version		1
 * @package		webtv
 * @author 		antonio
 * @author mail	tony@bslt.it
 * @link
 * @copyright	Copyright (C) 2011 antonio - All rights reserved.
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

jimport('joomla.application.component.helper');

require_once JPATH_COMPONENT . '/models/docenti.php';
require_once JPATH_COMPONENT . '/models/aule.php';
require_once JPATH_COMPONENT . '/models/corsi.php';
require_once JPATH_COMPONENT . '/models/luoghi.php';

class ggfirstViewLezioni extends JViewLegacy {

    public $lezioni,$docenti,$aule,$corsi;





    function display($tpl = null)
    {
        //JHtml::_('stylesheet', 'components/com_ggfirst/libraries/css/bootstrap.min.css');
        JHtml::_('stylesheet', 'components/com_ggfirst/libraries/open-iconic/font/css/open-iconic-bootstrap.css');
        JHtml::_('stylesheet', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous');
        $data_iniziale=JRequest::getVar('data_iniziale');
        if($data_iniziale==null)
            $data_iniziale=date("Y-m-d");
        $data_finale=JRequest::getVar('data_finale');
        $this->lezioni = $this->getModel()->getLezioni(null,null,null,null,$data_iniziale,$data_finale);
        $auleModel=new ggfirstModelAule();
        $this->aule=$auleModel->getAule();
        $luoghiModel=new ggfirstModelLuoghi();
        $this->luoghi=$luoghiModel->getLuoghi();
        $docentiModel=new ggfirstModelDocenti();
        $this->docenti=$docentiModel->getDocenti();
        $corsiModel=new ggfirstModelCorsi();
        $this->corsi=$corsiModel->getCorsi();
        $this->edizioni=$corsiModel->getEdizioni();
        $this->calendario=$this->createCalendario();
        parent::display($tpl);
    }


    private function createCalendario()
    {

        if ($this->lezioni) {
            $calendario = [];
            $calendarioaule = [];
            $prima_data = date_create(min(array_column($this->lezioni, 'data')));
            $ultima_data = date_create(max(array_column($this->lezioni, 'data')));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($prima_data, $interval, $ultima_data->modify('+1 day'));

            $calendarrow = [''];
            $datecalendario = [];
            foreach ($period as $dt) {

                array_push($calendarrow, $dt);
                array_push($datecalendario, $dt);
            }


            /* foreach ($this->corsi[0] as $corso){
                 $corsorow=[[$corso['titolo'],$corso['corso_attivo']]];

                 foreach ($datecalendario as $dt){

                     $lezione = $this->getModel()->getLezioni($corso['id'],null,date_format($dt,'Y-m-d'));

                             if ($lezione) {

                                 array_push($corsorow, $lezione);

                             } else {

                                 array_push($corsorow, null);
                             }

                         }


                 array_push($calendario,$corsorow);

             }*/
            foreach ($this->luoghi[0] as $luogo) {
                $luogorow = [$luogo['denominazione']];
                foreach ($datecalendario as $dt) {

                    $lezione = $this->getModel()->getLezioni(null, null, $luogo['id'], date_format($dt, 'Y-m-d'));

                    if ($lezione) {

                        array_push($luogorow, $lezione);

                    } else {

                        array_push($luogorow, null);
                    }

                }


                array_push($calendarioaule, $luogorow);
            }
            //var_dump($calendarioaule);die;
            return [$calendarrow, $calendario, $calendarioaule];
        }else{
            return null;
        }
    }


}
    