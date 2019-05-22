<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * Controller for single contact view
 *
 * @since  1.5.19
 */
class ggfirstControllerPdf extends JControllerLegacy
{

    private $_user;
    private $_japp;
    public  $_params;


    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_japp = JFactory::getApplication();
        $this->_params = $this->_japp->getParams();
        $this->_filterparam = new stdClass();
        $this->_filterparam->id_attestato=JRequest::getVar('id_attestato');
        $this->_filterparam->data_attestato=JRequest::getVar('data_attestato');
        $this->_filterparam->id_template=JRequest::getVar('id_template');
        $this->_filterparam->nome=JRequest::getVar('nome');
        $this->_filterparam->cognome=JRequest::getVar('cognome');
        $this->_filterparam->titolo_corso=JRequest::getVar('titolo_corso');
        $this->_filterparam->credito=JRequest::getVar('credito');
        $this->_filterparam->durata=JRequest::getVar('durata');
        $this->_filterparam->data_corso=JRequest::getVar('data');
        $this->_filterparam->data_scadenza=JRequest::getVar('data_scadenza');
        $this->_filterparam->orario_corso=JRequest::getVar('orario');
        $this->_filterparam->riferimento_legislativo=JRequest::getVar('riferimento_legislativo');
        $this->_filterparam->luogo_data_nascita=JRequest::getVar('luogo_data');
        $this->_filterparam->p_cf=JRequest::getVar('codice_fiscale');
        $this->_filterparam->titolo=JRequest::getVar('titolo_studio');
        $this->_filterparam->email=JRequest::getVar('email');
        $this->_filterparam->profilo=JRequest::getVar('profilo');
        $this->_filterparam->ragione_sociale=JRequest::getVar('denominazione');
        $this->_filterparam->piva=JRequest::getVar('piva');
        $this->_filterparam->f_cf=JRequest::getVar('c_codice_fiscale');
        $this->_filterparam->codice_univoco=JRequest::getVar('codice_univoco');
        $this->_filterparam->pec=JRequest::getVar('pec');
        $this->_filterparam->indirizzo=JRequest::getVar('indirizzo');
        $this->_filterparam->comune_provincia=JRequest::getVar('comune_provincia');
        $this->_filterparam->tel_fax=JRequest::getVar('tel_fax');
        $this->_filterparam->riferimento=JRequest::getVar('riferimento');
        $this->_filterparam->email_riferimento=JRequest::getVar('email_riferimento');
        $this->_filterparam->ateco=JRequest::getVar('ateco');
        $this->_filterparam->figura=JRequest::getVar('figura');
        $this->_filterparam->data_lezione=JRequest::getVar('data_lezione');
        $this->_filterparam->l_id=JRequest::getVar('l_id');
        $this->_filterparam->id_edizione=JRequest::getVar('id_edizione');
        $this->_filterparam->tipo=JRequest::getVar('tipo');


        define('SMARTY_DIR', JPATH_COMPONENT.'/libraries/smarty/smarty/');
        define('SMARTY_COMPILE_DIR', JPATH_COMPONENT.'/models/cache/compile/');
        define('SMARTY_CACHE_DIR', JPATH_COMPONENT.'/models/cache/');
        define('SMARTY_TEMPLATE_DIR', JPATH_COMPONENT.'/models/templates/');
        define('SMARTY_CONFIG_DIR', JPATH_COMPONENT.'/models/');
        define('SMARTY_PLUGINS_DIRS', JPATH_COMPONENT.'/libraries/smarty/extras/');

    }
    public function generateRegistro() {

        try {


            $model = $this->getModel('pdf');

            $model->generate_registro($this->_filterparam->l_id,$this->_filterparam->data_lezione,$this->_filterparam->id_edizione,$this->_filterparam->tipo);

        }catch (Exception $e){

            DEBUGG::log($e, 'Exception in generateAttestato ', 1);
        }
        $this->_japp->close();
    }

    public function generateAttestato() {

        try {


            $model = $this->getModel('pdf');

            $orientamento = "P";
            $user["nome"]=$this->_filterparam->nome;
            $user['cognome']=$this->_filterparam->cognome;
            //$this->_filterparam->data_attestato='2018-02-06';
            //$this->_filterparam->id_attestato=4;
            $model->_generate_attestato($user, $orientamento,$this->_filterparam->id_template, $this->_filterparam->data_attestato);

        }catch (Exception $e){

            DEBUGG::log($e, 'Exception in generateAttestato ', 1);
        }
        $this->_japp->close();
    }

    public function generateIscrizione() {

        try {


            $model = $this->getModel('pdf');

            $orientamento = "P";
            $user['c_titolo']=$this->_filterparam->titolo_corso;
            $user['c_credito']=$this->_filterparam->credito;
            $user['c_ore']=$this->_filterparam->durata;
            $user['c_data']=$this->_filterparam->data_corso;
            $user['c_data_scadenza']=$this->_filterparam->data_scadenza;
            $user['c_orario']=$this->_filterparam->orario_corso;
            $user['c_riferimento_legislativo']=$this->_filterparam->riferimento_legislativo;
            $user["p_nome"]=$this->_filterparam->nome;
            $user['p_cognome']=$this->_filterparam->cognome;
            $user['p_luogo_data_nascita']=$this->_filterparam->luogo_data_nascita;
            $user['p_cf']=$this->_filterparam->p_cf;
            $user['p_titolo']=$this->_filterparam->titolo;
            $user['p_email']=$this->_filterparam->email;
            $user['p_profilo']=$this->_filterparam->profilo;
            $user['f_ragione_sociale']=$this->_filterparam->ragione_sociale;
            $user['f_piva']=$this->_filterparam->piva;
            $user['f_cf']=$this->_filterparam->f_cf;
            $user['f_codice_univoco']=$this->_filterparam->codice_univoco;
            $user['f_pec']=$this->_filterparam->pec;
            $user['f_indirizzo']=$this->_filterparam->indirizzo;
            $user['f_comune_provincia']=$this->_filterparam->comune_provincia;
            $user['f_tel_fax']=$this->_filterparam->tel_fax;
            $user['f_referente']=$this->_filterparam->riferimento;
            $user['f_email_referente']=$this->_filterparam->email_riferimento;
            $user['f_ateco']=$this->_filterparam->ateco;
            $user['p_figura']=$this->_filterparam->figura;

            $model->_generate_iscrizione($user, $orientamento,$this->_filterparam->id_template, $this->_filterparam->data_attestato);

        }catch (Exception $e){

            DEBUGG::log($e, 'Exception in generateAttestato ', 1);
        }
        $this->_japp->close();
    }

    public function generate_attestato() {

        try {


            $model = $this->getModel('pdf');

            $orientamento = "P";


            $model->generate_attestato($this->_filterparam->id_attestato, $orientamento,$this->_filterparam->id_template);

        }catch (Exception $e){

            DEBUGG::log($e, 'Exception in generateAttestato ', 1);
        }
        $this->_japp->close();
    }



}
