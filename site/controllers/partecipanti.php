<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . '/models/partecipanti.php';
require_once JPATH_COMPONENT . '/models/lezioni.php';
require_once JPATH_COMPONENT . '/models/corsi.php';

/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggcmControllerPartecipanti extends JControllerLegacy
{
    protected $_db;
    private $_app;
    private $params;
    private $_filterparam;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_app = JFactory::getApplication();
        $this->_filterparam = new stdClass();
        $this->_filterparam->id=JRequest::getVar('id');
        $this->_filterparam->id_edizione=JRequest::getVar('id_edizione');
        $this->_filterparam->id_studente=JRequest::getVar('id_studente');
        $this->_filterparam->id_credito=JRequest::getVar('id_credito');
        $this->_filterparam->id_figura=JRequest::getVar('id_figura');


    }
    public function insert(){

        $model=new ggcmModelPartecipanti();
        if($model->insert($this->_filterparam->id_edizione,$this->_filterparam->id_studente,$this->_filterparam->id_credito,$this->_filterparam->id_figura)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function delete(){

        $model=new ggcmModelPartecipanti();
        if($model->delete($this->_filterparam->id)) {
            echo "1";
        }else{
            echo "0";
        }
        $this->_app->close();

    }

    public function getVerbale(){

        $id_edizione=$this->_filterparam->id_edizione;
        if ($id_edizione==null){
            echo null;
            $this->_app->close();
        }
        $modelCorsi=new ggcmModelCorsi();
        $edizione=$modelCorsi->getEdizioni($id_edizione);
        $modelLezioni=new ggcmModelLezioni();
        $date_inizio_fine_edizione=$modelLezioni->getDateInizioFineEdizione($id_edizione);
        $model=new ggcmModelPartecipanti();
        $partecipanti=$model->getPartecipantiCSV(null,$id_edizione);
        $rows=[];
        array_push($rows,["Organizzazione, gestione e supporto didattico:"]);
        array_push($rows,[""]);
        array_push($rows,["CODICE CORSO",$edizione[0][0]['codice_edizione']]);
        array_push($rows,["DATA INIZIO",$date_inizio_fine_edizione['inizio']]);
        array_push($rows,["DATA FINE",$date_inizio_fine_edizione['fine'],'VERBALE DELLE PROVE DI ACCERTAMENTO FINALE PER IL CONSEGUIMENTO DELL\'ATTESTATO']);
        array_push($rows,["TIPOLOGIA","",'con verifica dell\'apprendimento']);
        array_push($rows,["","",'Dati anagrafici e giudizio per ciascun partecipante - parte 2a del Verbale']);
        array_push($rows,["N","Cognome",'Nome','Luogo di nascita','data di nascita','Profilo professionale','Codice Fiscale','Giudizio Finale*','%frequenza','N° Attestato']);
        $i=1;
        foreach($partecipanti[0] as $partecipante) {
            array_unshift($partecipante,$i);
            array_push($rows, $partecipante);
            $i++;
        }
        $csv_save ='';

        foreach ($rows as $row) {
            if (!empty($row)) {
                $comma = ';';
                $quote = '"';
                $CR = "\015\012";
                // Make csv rows for field name
                $i = 0;
                // Make csv rows for data
                $csv_values = '';
                $i = 0;
                $comma = ';';

                if(count($row)>0 ) {
                    foreach ($row as $val) {
                        $i++;
                        $csv_values .= $quote . $val . $quote . $comma;
                    }
                }
                $csv_values .= $CR;

            }
            $csv_save .= $csv_values;
        }

        echo $csv_save;

        $filename = "verbale.csv";

        //var_dump($filename);die;


        header("Content-Type: text/plain");
        header("Content-disposition: attachment; filename=$filename");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");
        $this->_app->close();


    }



}
