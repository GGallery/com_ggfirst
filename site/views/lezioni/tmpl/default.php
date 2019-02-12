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
            <?php foreach ($this->calendario[0] as $cell){?>
                <td><?php  if($cell){echo $cell->format('d/m/Y');}?></td>
            <?php }?>
        </tr>
        <?php foreach ($this->calendario[2] as $row){?>
            <tr>
                <?php foreach ($row as $cell){?>

                    <td><?php if(is_array($cell)){
                        $c=$cell;
                        foreach ($cell as $c) {
                            //var_dump($c);die;
                            if (isset($c['id_lezione'])) {
                                echo '<A onclick="modifica('
                                    . $c['id_lezione'] . ','
                                    . $c['id_corso'] . ','
                                    . $c['id_edizione'] . ','
                                    . $c['id_docente'] . ','
                                    . $c['id_aula'] . ',\''
                                    . $c['data'] . '\',\''
                                    . $c['ora_inizio'] . '\',\''
                                    . $c['ora_fine'] . '\',\''
                                    . $c['titolo_lezione'] . '\',\''
                                    . $c['note'] . '\''
                                    . ')">
                                ' . $c['titolo'] . '</A><br>' . $c['titolo_lezione'] . '<br>'. $c['codice_edizione'] . '<br>' . $c['cognome'] . '<br>' . $c['ora_inizio'] . '-' . $c['ora_fine'].'<br>';

                            } else {
                                echo $cell;
                            }
                        }
                        }else if($cell){

                            echo $cell;

                        }?></td>
                <?php }?>
            </tr>
        <?php }?>
    </table>
</div>
<!--
<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UNA NUOVA LEZIONE</b></div></div>

    <div  class="row insertbox">
         <div class="col-xs-4 col-md-4 text-info"><h5>Corso:</h5><select id="corso"><?php// foreach ($this->corsi[0] as $corso){echo "<option value=".$corso['id'].">".$corso['titolo']."</option>";}?></select></div>
         <div class="col-xs-4 col-md-4 text-info"><h5>Docente:</h5><select id="docente"><?php// foreach ($this->docenti[0] as $docente){echo "<option value=".$docente['id'].">".$docente['cognome']."</option>";}?></select></div>
         <div class="col-xs-4 col-md-4 text-info"><h5>Aula:</h5><select id="aula"><?php //foreach ($this->aule[0] as $aula){echo "<option value=".$aula['id'].">".$aula['denominazione']."</option>";}?></select></div>
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
-->
</div>

<script type="text/javascript">

    var actual_operation="insert";
    var actual_id;


    function modifica(id,id_corso,id_docente,id_aula,data,ora_inizio,ora_fine,titolo,note){

        actual_id=id;
        jQuery("#corso").val(id_corso);
        jQuery("#docente").val(id_docente);
        jQuery("#aula").val(id_aula);
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
                + '&id_corso=' + jQuery("#corso").val()
                + '&id_docente=' + jQuery("#docente").val()
                + '&id_aula=' + jQuery("#aula").val()
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

        if(confirm('attenzione, stai cancellando uno studente')==true) {
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

</script>
</html>
