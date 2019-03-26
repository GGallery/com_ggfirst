<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');



/**
 * GGlms Attestato Model
 *
 * @package    Joomla.Components
 * @subpackage GGLms
 * @author Diego Brondo <diego@ggallery.it>
 * @version 0.9
 */
class ggfirstModelPdf extends JModelLegacy {

    private $_user_id;
    //    private $_user;
    private $_quiz_id;
    private $_item_id;
    protected $_db;

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->_db = $this->getDbo();
        $this->id_elemento= JRequest::getInt('content', 0);

        $user = JFactory::getUser();
        $this->_user_id = $user->get('id');
    }

    public function __destruct() {
    }


    public function _generate_attestato($user, $orientamento,$id_template, $data_attestato) {
        try {
            require_once JPATH_COMPONENT . '/libraries/pdf/certificatePDF.class.php';
            $orientation=$orientamento;
            $pdf = new certificatePDF($orientation);


            $info['data_superamento']=$data_attestato;
            $info['path_id'] = $id_template;
            $info['path'] = $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/';
            $info['content_path'] = $info['path'] . $info['path_id'];

            $template = "file:" . $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/'. $id_template . "/" . $id_template . ".tpl";

            $pdf->add_data((array)$user);
            $pdf->add_data($info);

            $nomefile = "attestato_" . $user['nome'] . "_" . $user['cognome'] . ".pdf";

            $pdf->fetch_pdf_template($template, null, true, false, 0);
            $pdf->Output($nomefile, 'D');

            return 1;
        } catch (Exception $e) {
            // FB::log($e);
            DEBUGG::error($e, 'error generate_pdf');
        }
        return 0;
    }

    public function _generate_registro($id_lezione) {
        try {
            require_once JPATH_COMPONENT . '/libraries/pdf/certificatePDF.class.php';
            $orientation='P';
            $pdf = new certificatePDF($orientation);

            $id_template='registro';

            $info['path_id'] = 'registro';
            $info['path'] = $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/';
            $info['content_path'] = $info['path'] . $info['path_id'];

            $template = "file:" . $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/'. $id_template . "/" . $id_template . ".tpl";
            $query=$this->_db->getQuery(true);
            $query->select('d.nome as nome_docente, d.cognome as cognome_docente,s.nome as nome_studente,s.cognome as cognome_studente,l.`data` as data_lezione,l.ora_inizio,l.ora_inizio,au.denominazione,l.titolo');
            $query->from('first_gg_lezioni as l');
            $query->join('inner','first_gg_docenti as d on l.id_docente=d.id');
            $query->join('inner','first_gg_edizioni as e on l.id_edizione=e.id');
            $query->join('inner','first_gg_partecipanti as p on p.id_edizione=e.id');
            $query->join('inner','first_gg_studenti as s on p.id_studente=s.id');
            $query->join('inner','first_gg_aule as au on au.id=l.id_aula');
            $query->where('l.id='.$id_lezione);
            $this->_db->setQuery($query);


            $data=$this->_db->loadAssocList();
            $pdf->add_data((array)$data);
            $pdf->add_data($info);

            $pdf->add_data($data[0]);
            $pdf->add_data($info);

            $nomefile = $data[0]['titolo']."_registro_" . $data[0]['data_lezione'] . ".pdf";
//echo $template;die;
            $pdf->fetch_pdf_template($template, null, true, false, 0);
            $pdf->Output($nomefile, 'D');

            return 1;
        } catch (Exception $e) {
            // FB::log($e);
            echo $e;
        }
        return 0;
    }

    public function _generate_iscrizione($user, $orientamento,$id_template, $data_attestato) {
        try {
            require_once JPATH_COMPONENT . '/libraries/pdf/certificatePDF.class.php';
            $orientation=$orientamento;
            $pdf = new certificatePDF($orientation);


            $info['data_superamento']=$data_attestato;
            $info['path_id'] = $id_template;
            $info['path'] = $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/';
            $info['content_path'] = $info['path'] . $info['path_id'];

            $template = "file:" . $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/'. $id_template . "/" . $id_template . ".tpl";

            $pdf->add_data((array)$user);
            $pdf->add_data($info);

            $nomefile = "attestato_" . $user['p_nome'] . "_" . $user['p_cognome'] . ".pdf";

            $pdf->fetch_pdf_template($template, null, true, false, 0);
            $pdf->Output($nomefile, 'D');

            return 1;
        } catch (Exception $e) {
            // FB::log($e);
            echo $e;
        }
        return 0;
    }

    public function generate_attestato($id, $orientamento='P',$id_template='37') {
        try {
            require_once JPATH_COMPONENT . '/libraries/pdf/certificatePDF.class.php';
            $orientation=$orientamento;
            $pdf = new certificatePDF($orientation);


            $info['path_id'] = $id_template;
            $info['path'] = $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/';
            $info['content_path'] = $info['path'] . $info['path_id'];

            $template = "file:" . $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/'. $id_template . "/" . $id_template . ".tpl";

            $query=$this->_db->getQuery(true);
            $query->select('s.nome as \'p_nome\', s.cognome as \'p_cognome\', s.luogo_nascita as \'p_luogo_nascita\', DATE_FORMAT(s.data_nascita,\'%d/%m/%Y\') as \'p_data_nascita\',
                    c.titolo as \'c_titolo\',c.riferimento_legislativo as \'c_riferimento_legislativo\', cr.durata as \'c_durata\', 
                    (select min(DATE_FORMAT(l.data,\'%d/%m/%Y\')) from first_gg_lezioni as l inner join first_gg_edizioni as e on l.id_edizione=e.id inner join first_gg_corsi as c on e.id_corso=c.id) as \'c_data\',
                    DATE_FORMAT(now(),\'%d/%m/%Y\') as \'c_data_oggi\',
                    a.numero as \'a_numero\',
                    c.programma as \'c_programma\',
                    (
                    select f.figura from first_gg_partecipanti as p 
                    inner join first_gg_figure as f on f.id=p.id_figura 
                    inner join first_gg_edizioni as e on p.id_edizione=e.id
                    inner join first_gg_corsi as c on c.id=e.id_corso
                    where p.id_studente=s.id
                    ) as \'p_figura\',CONCAT(cr.ruolo,\' \',cr.rischio) as \'c_credito\', a.settore as \'c_settore\',a.rischio_attestato as \'c_rischio_attestato\',
                    a.id as \'a_id\'');
            $query->from('first_gg_attestati as a');
            $query->join('inner','first_gg_studenti as s on a.id_studente=s.id');
            $query->join('inner','first_gg_corsi_crediti_map as m on a.id_corsi_crediti_map=m.id');
            $query->join('inner','first_gg_corsi as c on m.id_corso=c.id');
            $query->join('inner','first_gg_crediti as cr on m.id_credito=cr.id');
            $query->where('a.id='.$id);
            $this->_db->setQuery($query);


            $data=$this->_db->loadAssocList();

            $pdf->add_data($data[0]);
            $pdf->add_data($info);

            $nomefile = $data[0]['a_id']."_attestato_" . $data[0]['p_nome'] . "_" . $data[0]['p_cognome'] . ".pdf";
//echo $template;die;
            $pdf->fetch_pdf_template($template, null, true, false, 0);
            $pdf->Output($nomefile, 'D');

            return 1;
        } catch (Exception $e) {
            // FB::log($e);
            echo $e;
        }
        return 0;
    }
}