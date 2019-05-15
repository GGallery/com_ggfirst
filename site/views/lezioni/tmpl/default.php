<?php
defined('_JEXEC') or die;
?>


<head>
<style>
    .insertbox{

        background-color: #d9edf7;
        margin-left: 3px;
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }
    .bottoni{

        width: 20%;
    }

    .red{

        color:red;
    }

</style>
</head>


<div class="table-responsive">
    <h2>PRIMA - CALENDARIO CORSI</h2>

    <table class="table table-striped table-bordered data-page-length='8'">
        <tr>
            <td><input id="data_iniziale" type="date" class="form-control form-control-sm"> </td>
            <td><input id="data_finale" type="date" class="form-control form-control-sm"> </td>
            <td><button id="cambia_data"><span class="modify_button oi oi-reload" title="aggiorna" aria-hidden="true"></span>
                </button></td>
        </tr>
    </table>
    <table class="table table-striped table-bordered data-page-length='8'">

        <tr>
            <?php if($this->calendario[0]){
                foreach ($this->calendario[0] as $cell){?>
                <td><?php  if($cell){echo $cell->format('d/m/Y');}?></td>
            <?php }
            }?>
        </tr>
        <?php if($this->calendario[2]) {
            foreach ($this->calendario[2] as $row) {
                ?>
                <tr>
                    <?php foreach ($row as $cell) { ?>

                        <td><table><?php if (is_array($cell)) {
                                $c = $cell;
                                foreach ($cell as $c) {
                                    echo '<tr><td>';
                                    if (isset($c['id_lezione'])) {
                                        if (!isset($c['id_aula'])) {
                                            $c['id_aula'] = 0;
                                        }
                                        echo '<br>' . $c['titolo'] .
                                            '<br>' . $c['titolo_lezione'] .
                                            '<br>' . $c['codice_edizione'] .
                                            '<br>' . $c['cognome'] .
                                            '<br>' . $c['ora_inizio'] . '-' . $c['ora_fine'].
                                            '&nbsp<span class="modify_button oi oi-document green" title="apri registro" aria-hidden="true" onclick="openregistro(\''
                                            . $c['data']
                                            .'\')">
                                            &nbsp<span class="modify_button oi oi-pencil" title="modifica lezione" aria-hidden="true" onclick="modifica('
                                            . $c['id_lezione'] . ','
                                            . $c['id_edizione'] . ','
                                            . $c['id_docente'] . ','
                                            . $c['id_aula'] . ','
                                            . $c['id_luogo'] . ',\''
                                            . $c['data'] . '\',\''
                                            . $c['ora_inizio'] . '\',\''
                                            . $c['ora_fine'] . '\',\''
                                            . $c['titolo_lezione'] . '\',\''
                                            . $c['note'] . '\''
                                            . ')">
                                </span>&nbsp<span class="modify_button oi oi-delete red" title="cancella lezione" aria-hidden="true" onclick="deleteclick('. $c['id_lezione'].')">
                                </span><br>---<br>';

                                    } else {
                                        echo $cell;
                                    }
                                    echo '</td></tr>';
                                }
                            } else if ($cell) {

                                echo $cell;

                            } ?></table></td>
                    <?php } ?>
                </tr>
            <?php }
        }?>
    </table>
</div>

<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>MODIFICA LEZIONE</b></div></div>

    <div  class="row insertbox">
         <div class="col-xs-4 col-md-4 text-info"><h5>Edizione:</h5><select id="edizione"><?php foreach ($this->edizioni[0] as $edizione){echo "<option value=".$edizione['id_edizione'].">".$edizione['titolo'].' - '.$edizione['codice_edizione']."</option>";}?></select></div>
         <div class="col-xs-4 col-md-4 text-info"><h5>Docente:</h5><select id="docente"><?php foreach ($this->docenti[0] as $docente){echo "<option value=".$docente['id'].">".$docente['cognome']."</option>";}?></select></div>
         <div class="col-xs-4 col-md-4 text-info"><h5>Aula:</h5><select id="aula"><?php foreach ($this->aule[0] as $aula){echo "<option value=".$aula['id'].">".$aula['denominazione']."</option>";}?></select></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Luogo:</h5><select id="luogo"><?php foreach ($this->luoghi[0] as $luogo){echo "<option value=".$luogo['id'].">".$luogo['denominazione']."</option>";}?></select></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Data:</h5> <input class="form-control form-control-sm" type="date" id="data"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Ora Inizio:</h5> <input class="form-control form-control-sm" type="time" id="ora_inizio"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Ora Fine:</h5> <input class="form-control form-control-sm" type="time" id="ora_fine"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Titolo:</h5> <input class="form-control form-control-sm" type="text" id="titolo" size="25"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Note:</h5> <TEXTAREA class="form-control form-control-sm" id="note"></TEXTAREA></div>

    </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewlezione" value="conferma" onclick="insertclick()" type="button">CONFERMA</button></div>
        <div class="col-xs-0 col-md-4"></div>
    </div>
</div>

</div>

<script type="text/javascript">

    var actual_operation="insert";
    var actual_id;

    jQuery("#cambia_data").click(function(){

        url="index.php?option=com_ggfirst&view=lezioni&data_iniziale="+jQuery("#data_iniziale").val()+"&data_finale="+jQuery("#data_finale").val();

        window.open(url,'_self');
    });
    function modifica(id,id_edizione,id_docente,id_aula,id_luogo,data,ora_inizio,ora_fine,titolo,note){

        actual_id=id;
        jQuery("#edizione").val(id_edizione);
        jQuery("#docente").val(id_docente);
        jQuery("#aula").val(id_aula);
        jQuery("#luogo").val(id_luogo);
        jQuery("#data").val(data);
        jQuery("#ora_inizio").val(ora_inizio);
        jQuery("#ora_fine").val(ora_fine);
        jQuery("#titolo").val(titolo);
        jQuery("#note").val(note);
        jQuery("#insertnewlezione").html('CONFERMA MODIFICHE');
        actual_operation="modify";


    }
    function insertclick(){

     if(actual_operation=="insert") {
         jQuery.ajax({
             method: "POST",
             cache: false,
             url: 'index.php?option=com_ggfirst&task=lezioni.insert'
             + '&id_corso=' + jQuery("#corso").val()
             + '&id_docente=' + jQuery("#docente").val()
             + '&id_aula=' + jQuery("#aula").val()
             + '&data=' + jQuery("#data").val()
             + '&ora_inizio=' + jQuery("#ora_inizio").val()
             + '&ora_fine=' + jQuery("#ora_fine").val()
             + '&titolo=' + jQuery("#titolo").val()
             + '&note=' + jQuery("#note").val()


         }).done(function () {

             alert("inserimento riuscito");
             location.reload();


         });
     }

        if(actual_operation=="modify") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=lezioni.modify&' +
                'id=' + actual_id
                + '&id_edizione=' + jQuery("#edizione").val()
                + '&id_docente=' + jQuery("#docente").val()
                + '&id_aula=' + jQuery("#aula").val()
                + '&id_luogo=' + jQuery("#luogo").val()
                + '&data=' + jQuery("#data").val()
                + '&ora_inizio=' + jQuery("#ora_inizio").val()
                + '&ora_fine=' + jQuery("#ora_fine").val()
                + '&titolo=' + jQuery("#titolo").val()
                + '&note=' + jQuery("#note").val()

            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });
        }

    }



    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando una lezione')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=lezioni.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

    function openregistro(data_lezione) {
        window.open("index.php?option=com_ggfirst&task=pdf.generateregistro&data_lezione="+data_lezione);
    }

</script>
</html>
