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

    public function __construct($config = array()) {
        parent::__construct($config);

        $this->id_elemento= JRequest::getInt('content', 0);

        $user = JFactory::getUser();
        $this->_user_id = $user->get('id');
    }

    public function __destruct() {
    }


    public function _generate_attestato($user, $orientamento,$id_attestato, $data_attestato) {
        try {
            require_once JPATH_COMPONENT . '/libraries/pdf/certificatePDF.class.php';
            $orientation=$orientamento;
            $pdf = new certificatePDF($orientation);


            $info['data_superamento']=$data_attestato;
            $info['path_id'] = $id_attestato;
            $info['path'] = $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/';
            $info['content_path'] = $info['path'] . $info['path_id'];

            $template = "file:" . $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/'. $id_attestato . "/" . $id_attestato . ".tpl";

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

    public function _generate_iscrizione($user, $orientamento,$id_attestato, $data_attestato) {
        try {
            require_once JPATH_COMPONENT . '/libraries/pdf/certificatePDF.class.php';
            $orientation=$orientamento;
            $pdf = new certificatePDF($orientation);


            $info['data_superamento']=$data_attestato;
            $info['path_id'] = $id_attestato;
            $info['path'] = $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/';
            $info['content_path'] = $info['path'] . $info['path_id'];

            $template = "file:" . $_SERVER['DOCUMENT_ROOT'].'/mediagg/contenuti/'. $id_attestato . "/" . $id_attestato . ".tpl";

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


}