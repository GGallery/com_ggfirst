<?php
defined('_JEXEC') or die;
?>


<head>
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<style>

    .insertlezionibox{

        background-color: #689f55;
        margin-left: 3px;
        margin-right: 0px;
    }

    .inserteditionbox{

        background-color: #ff9933;
        margin-left: 3px;
        margin-right: 0px;

    }
    .insertbox{

        background-color: #d9edf7;
        margin-left: 3px;
        margin-right: 0px;
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

    #contenitore_crediti{

        width: 10%;

    }

    .bottoni{

        width: 20%;
    }

    .red{

        color:red;
    }

    .green{

        color:lawngreen;
    }

    .start_hidden_input,.confirm_button{

        display: none;
    }


    .delete_ruolo{
        font-size: smaller;
    }
</style>
</head>


<div class="table-responsive" style="overflow-x: hidden">
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA CORSI</h2>
</div>
<table id="table_corsi" class="table table-striped table-bordered data-page-length='8'" style="display: none">
    <thead>
    <tr>
        <th style="width: 30%">TITOLO</th>

        <th style="width: 30%">RIFERIMENTO LEG.</th>

        <th style="width: 30%">CREDITI</th>

        <th style="width: 20%"></th>
    </tr>
    </thead>

    <tbody>

    <?php
    if(isset($this->corsiAll[0])) {
        foreach ($this->corsiAll[0] as $corso_) {

            ?>
            <tr>
                <td class="titolo"><span class="start_span" id="_titolo"><?php echo $corso_['titolo']; ?></span>
                    <input id="input_titolo_<?php echo $corso_['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $corso_['titolo']; ?>"></td></td>
                <td class="riferimento_legislativo"><span class="start_span" id="_riferimento_legislativo"><?php echo $corso_['riferimento_legislativo']; ?></span>
                    <input id="input_riferimento_legislativo_<?php echo $corso_['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $corso_['riferimento_legislativo']; ?>"></td></td>
                <td id="contenitore_crediti">

                    <?php foreach ($corso_['crediti'] as $credito) {

                        if ($credito['ruolo'] != null) {
                            echo ' <div class="row">
                                            <div class="col-md-8">' . $credito['ruolo'] . ' ' . $credito['rischio'] . '</div>
                                            <div class="col-md-4" onclick=deletecreditoclick(' . $credito['credito_id'] . ')>
                                            <span class="oi oi-puzzle-piece red delete_ruolo" title="cancella credito" aria-hidden="true"></span></div>
                                      </div>';
                        }
                    } ?>
                    <div><select class="start_hidden_input select_nuovo_credito"
                                 id="nuovo_credito_<?php echo $corso_['id']; ?>">
                            <option value='0'>aggiungi un credito</option>
                            <?php foreach ($this->crediti as $credito) {

                                echo '<option value=' . $credito['id'] . '>' . $credito['ruolo'] . ' - ' . $credito['rischio'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>
                </td>
                <td class="bottoni">
                    <button onclick="modifica_corso(<?php echo $corso_['id']; ?>,'<?php echo $corso_['titolo']; ?>','<?php echo $corso_['riferimento_legislativo']; ?>','<?php echo urldecode($corso_['programma']); ?>')"><span
                                class="modify_button oi oi-pencil" title="modifica corso" aria-hidden="true"></span>
                    </button>
                    <button class="confirm_button" id="confirm_button_<?php echo $corso_['id']; ?>">
                        <span class="oi oi-thumb-up" title="conferma aggiunta credito" aria-hidden="true" onclick="conferma_aggiunta_credito(<?php echo $corso_['id']; ?>)"></span>
                    </button>
                    <button onclick="deleteclick(<?php echo $corso_['id']; ?>)"><span class="oi oi-delete red"
                                                                                      title="cancella corso"
                                                                                      aria-hidden="true"></span>
                    </button>
                    <button><span class="add_credito oi oi-puzzle-piece green" title="aggiungi credito"
                                  aria-hidden="true" id="add_credito_<?php echo $corso_['id']; ?>"></span></button>
                </td>


            </tr>

            <?php
        }
    }
    ?>

    </tbody>
</table>

    <div class="form-group form-group-sm">
        <div class="col-xs-2 col-md-2 text-info" style="padding-bottom: 10px;">
            <button  onclick="open_corsi()"><span class="modify_button oi oi-pencil" title="mostra corsi" aria-hidden="true">apri corsi</span></button>

        </div>
        <div  class="row insertbox"><div class="col-xs-10 col-md-10"><b>INSERISCI UN NUOVO CORSO</b>
            </div>

        </div>


            <div  class="row insertbox">
                <div class="col-xs-6 col-md-6 text-info">titolo:
                    <input  class="form-control form-control-sm" type="text" id="titolo">
                </div>
                <div class="col-xs-6 col-md-6 text-info">riferimento legislativo
                    <textarea  class="form-control form-control-sm" cols=10 rows=1 id="riferimento_legislativo"></textarea>
                </div>
                <div class="col-xs-12 col-md-12 text-info">programma
                    <textarea  class="form-control form-control-sm" id="programma"></textarea>
                </div>
                <?php

                //$editor = JFactory::getEditor();
                //echo $editor->display('content', '', '550', '400', '60', '20', false,'programma1');
                ?>
                <div class="col-xs-5 col-md-5 text-info">

                    <button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcorso" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
                </div>

        </div>
    </div>



<!-- AREA EDIZIONI -------------------------------- -->

<div  class="table-responsive inserteditionbox" style="overflow-x: hidden">
    <div style="padding: 8px 16px;">
        <select  id="input_corso_iniziale">
            <option value="">scegli un corso</option>
            <?php foreach ($this->corsiAll[0] as $corso__){echo "<option value=".$corso__['id'].">".$corso__['titolo']."</option>";}?>
        </select>
        <button onclick="open_edizioni()"><span
                    class="modify_button oi oi-pencil" title="mostra edizioni" aria-hidden="true"></span>
        </button>
    </div>
    <table id="table_edizioni" class="table table-striped table-bordered data-page-length='8'" style="display: none">
        <thead>
        <tr>
            <th style="width: 30%">CODICE</th>

            <th style="width: 30%">STATO</th>

            <th style="width: 20%">MINIMO PARTECIPANTI</th>

            <th style="width: 20%"></th>
        </tr>
        </thead>

        <tbody>

        <?php

        if(isset($this->edizioni[0])) {
            foreach ($this->edizioni[0] as $edizione) {

                ?>
                <tr>
                    <td class="titolo">
                        <span class="start_span" id="_titolo_corso"><b><?php echo $edizione['titolo_corso']; ?></b>&nbsp<?php echo $edizione['codice_edizione']; ?></span>&nbsp;
                        <span class="start_span" id="span_codice_edizione_<?php echo $edizione['id_edizione']; ?>"><a href="index.php?option=com_ggfirst&view=partecipanti&id_edizione=<?php echo $edizione['id_edizione']; ?>"<?php echo $edizione['codice_edizione']; ?></a></span><span><?php if($edizione['edizione_attiva']==1) echo '&nbsp;&nbsp;&nbsp;<span class="oi oi-bookmark red"></span>'?>
                            <input id="input_codice_edizione_<?php echo $edizione['id_edizione']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $edizione['codice_edizione']; ?>">
                            <span class="start_span" id="_numero_partecipanti_<?php echo $edizione['id_edizione']; ?>"><b><?php echo $edizione['numero_partecipanti']; ?></b></span>/<span class="start_span" id="_numero_partecipanti"><b><?php echo $edizione['minimo_partecipanti']; ?>

                    </td>
                    <td id="contenitore_stato">


                        <div><select id="nuovo_stato_<?php echo $edizione['id_edizione']; ?>">
                                <option value='1' <?php if($edizione['stato']==1) echo 'selected';?>>aperto</option>
                                <option value='2' <?php if($edizione['stato']==2) echo 'selected';?>>chiuso</option>
                            </select>
                        </div>
                    </td>
                    <td class="titolo"><span class="start_span" id="span_minimo_partecipanti"><?php echo $edizione['minimo_partecipanti']; ?></a></span>
                        <input id="input_minimo_partecipanti_<?php echo $edizione['id_edizione']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $edizione['minimo_partecipanti']; ?>">
                    </td>
                    <td class="bottoni">
                        <button onclick="modifica_edizione(<?php echo $edizione['id_edizione']; ?>)"><span class="modify_button oi oi-pencil" title="modifica corso" aria-hidden="true"></span>
                        </button>
                        <button class="confirm_button" id="confirm_button_<?php echo $edizione['id_edizione']; ?>"><span
                                    class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" onclick="conferma_modifica_edizione(<?php echo $edizione['id_edizione']; ?>)"></span></button>
                        <button onclick="deleteclick(<?php echo $edizione['id_edizione']; ?>)"><span class="oi oi-delete red"
                                                                                            title="cancella edizione"
                                                                                            aria-hidden="true"></span>
                        </button>

                    </td>

                </tr>

                <?php
            }
        }
        ?>

        </tbody>
    </table>
</div>

<div class="form-group form-group-sm">
    <div  class="row inserteditionbox"><div class="col-xs-10 col-md-10"><b>INSERISCI UNA NUOVA EDIZIONE PER <span style="color: red"><?php if(isset($this->corso[0]['titolo'])) echo ($this->corso[0]['titolo']);?></span></b></div></div>
    <div  class="row inserteditionbox" style="padding-bottom: 8px;">
        <div class="col-xs-4 col-md-4 text-info"><h5>Codice:</h5>
            <input class="form-control form-control-sm" type="text" id="codice_edizione">
        </div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Stato:</h5>
            <select class="inserteditionbox" id="stato">
                <option value="">scegli uno stato</option>
                <?php foreach ($this->stati as $stato){echo "<option value=".$stato['id'].">".$stato['descrizione']."</option>";}?>
            </select>
        </div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Minimo partecipanti:</h5>
            <input class="form-control form-control-sm" type="text" id="minimo_partecipanti">
        </div>
        <div class="col-xs-4 col-md-4 text-info">

        </div>
        <div class="col-xs-4 col-md-4 text-info">
            <button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcorso" value="conferma" onclick="insertedizioneclick()" type="button">CONFERMA</button>
        </div>
        <div class="col-xs-4 col-md-4 text-info">

        </div>

    </div>
</div>

<!-- AREA LEZIONI ---------------------------------   -->

<div class="table-responsive insertlezionibox" style="overflow-x: hidden">
    <div style="padding: 8px 16px;">
        <select  id="input_edizione_iniziale">
            <option value="">scegli una edizione</option>
            <?php foreach ($this->edizioni[0] as $edizione){echo "<option value=".$edizione['id_edizione'].">".$edizione['codice_edizione']."</option>";}?>
        </select>

    </div>

</div>

<div class="form-group form-group-sm">
    <div  class="row insertlezionibox"><div class="col-xs-10 col-md-10"><b>INSERISCI UNA NUOVA DATA PER <?php  if(isset($this->edizione[0][0]['codice_edizione'])) echo $this->edizione[0][0]['codice_edizione']; ?></b></div></div>
    <div  class="row insertlezionibox" style="padding-bottom: 8px;">
        <div class="col-xs-3 col-md-3 text-info"><h5>Docente:</h5><select id="docente"><?php foreach ($this->docenti[0] as $docente){echo "<option value=".$docente['id'].">".$docente['cognome']."</option>";}?></select></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Luogo:</h5><select id="luogo"><?php foreach ($this->luoghi[0] as $luogo){echo "<option value=".$luogo['id'].">".$luogo['denominazione']."</option>";}?></select></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Aula:</h5><select id="aula"><?php foreach ($this->aule[0] as $aula){echo "<option value=".$aula['id'].">".$aula['denominazione']."</option>";}?></select></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Data:</h5> <input class="form-control form-control-sm" type="date" id="data"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Ora Inizio:</h5> <input class="form-control form-control-sm" type="time" id="ora_inizio"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Ora Fine:</h5> <input class="form-control form-control-sm" type="time" id="ora_fine"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Titolo:</h5> <input class="form-control form-control-sm" type="text" id="titolo_lezione" size="25"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Note:</h5> <TEXTAREA class="form-control form-control-sm" id="note"></TEXTAREA></div>
        <div class="col-xs-4 col-md-4 text-info" ></div>
        <div class="col-xs-4 col-md-4 text-info" style="padding-top: 50px;">
            <button  class="form-control btn btn-outline-light btn-sm" id="insertnewcorso" value="conferma" onclick="insertlezioneclick()" type="button">CONFERMA</button>
        </div>
        <div class="col-xs-4 col-md-4 text-info" ></div>
    </div>
</div>




<script>
    CKEDITOR.replace( 'programma' );
</script>





<script type="text/javascript">

    var actual_operation='insert';
    var actual_id;
    var id_corso_in_modify;

    function open_corsi(){

        jQuery("#table_corsi").toggle();
    }

    function open_edizioni(){

        jQuery("#table_edizioni").toggle();
    }



    <?php if(isset($this->id_corso)){?>

    jQuery("#input_edizione_iniziale").change(function () {

        url="index.php?option=com_ggfirst&view=corsi&id_corso=<?php echo $this->id_corso; ?>&id_edizione="+jQuery("#input_edizione_iniziale").val();

        window.open(url,'_self');
    });

    function insertedizioneclick(){


        if(actual_operation=="insert") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.insertedizione'
                + '&id_corso=' + <?php echo $this->id_corso; ?>
                + '&codice_edizione=' + jQuery("#codice_edizione").val()
                + '&stato=' + jQuery("#stato").val()
                + '&minimo_partecipanti=' + jQuery("#minimo_partecipanti").val()


            }).done(function () {

                alert("inserimento riuscito");
                location.reload();


            });
        }
        if(actual_operation=="modify") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.modifyedizione&' +
                'id=' + actual_id
                + '&titolo=' + jQuery("#titolo").val()


            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });
        }

    }

    <?php }?>

    jQuery("#input_corso_iniziale").change(function () {

        url="index.php?option=com_ggfirst&view=corsi&id_corso="+jQuery("#input_corso_iniziale").val();

        window.open(url,'_self');
    });

    function modifica_corso(id,titolo,riferimento_legislativo,programma){

        actual_operation="modify"
        id_corso_in_modify=id.toString();
        /*jQuery('.start_hidden_input').hide()
        jQuery('.start_span').show()
        jQuery("#confirm_button_"+str).toggle();

        jQuery("#input_titolo_"+str).toggle();
        jQuery("#input_riferimento_legislativo_"+str).toggle();*/
        jQuery("#titolo").val(titolo);
        jQuery("#riferimento_legislativo").val(riferimento_legislativo);
        CKEDITOR.instances.programma.setData(programma);





    }

    function modifica_edizione(id){


        var str=id.toString();
        jQuery('.start_hidden_input').hide()
        jQuery('.start_span').show()
        jQuery("#confirm_button_"+str).toggle();
        jQuery("#span_codice_edizione_"+str).toggle();
        jQuery("#span_minimo_partecipanti_"+str).toggle();
        jQuery("#input_minimo_partecipanti_"+str).toggle();
        jQuery("#input_codice_edizione_"+str).toggle();



    }

    function conferma_aggiunta_credito(id){

        var id_credito=jQuery("#nuovo_credito_"+id).val();
        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=crediti.insert_map&id_corso=' + id.toString() + '&id=' + id_credito

        }).done(function () {
            alert("modificata  edizione");
            location.reload();
        }).fail(function ($xhr) {
            var data = $xhr.responseJSON;
            console.log(data);
        });


    }


    function conferma_modifica_edizione(id){

        var str=id.toString();
        var nuovo_codice_edizione=jQuery("#input_codice_edizione_"+str).val()
        var nuovo_stato=jQuery("#nuovo_stato_"+str).val()
        var nuovo_minimo_partecipanti=jQuery("#input_minimo_partecipanti_"+str).val()
        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=corsi.modify_edizione&id=' + id.toString() + '&codice_edizione=' + nuovo_codice_edizione+'&stato='+nuovo_stato+'&minimo_partecipanti='+nuovo_minimo_partecipanti

        }).done(function () {
            alert("modificata  edizione");
            location.reload();
        }).fail(function ($xhr) {
            var data = $xhr.responseJSON;
            console.log(data);
        });


    }

    function insertclick(){


        if(actual_operation=="insert") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.insert'
                + '&titolo=' + jQuery("#titolo").val()
                + '&riferimento_legislativo='+jQuery("#riferimento_legislativo").val()
                + '&programma='+encodeURI(CKEDITOR.instances.programma.getData().replace(/\n|\r/g, ""))//jQuery("#programma1").val()//


            }).done(function () {

                alert("inserimento riuscito");
                location.reload();


            });
        }
        if(actual_operation=="modify") {

            var nuovo_titolo=jQuery("#titolo").val()
            var nuovo_riferimento_legislativo=jQuery("#riferimento_legislativo").val()
            var programma=encodeURI(CKEDITOR.instances.programma.getData().replace(/\n|\r/g, ""))


            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.modify&id='
                + id_corso_in_modify + '&titolo=' + nuovo_titolo+'&riferimento_legislativo='+nuovo_riferimento_legislativo+'&programma='+programma

            }).done(function () {
                alert("modificato  corso");
                location.reload();
            }).fail(function ($xhr) {
                var data = $xhr.responseJSON;
                console.log(data);
            });
        }

    }

    <?php if(isset($this->edizione)){?>
    function insertlezioneclick(){


        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=lezioni.insert'
            + '&id_edizione=<?php echo $this->edizione[0][0]['id_edizione']?>'
            + '&id_docente=' + jQuery("#docente").val()
            + '&id_luogo=' + jQuery("#luogo").val()
            + '&id_aula=' + jQuery("#aula").val()
            + '&data=' + jQuery("#data").val()
            + '&ora_inizio=' + jQuery("#ora_inizio").val()
            + '&ora_fine=' + jQuery("#ora_fine").val()
            + '&titolo=' + jQuery("#titolo_lezione").val()
            + '&note=' + jQuery("#note").val()


        }).done(function () {

            alert("inserimento riuscito");
            location.reload();


        });

    }
<?php }?>


    jQuery(".add_credito").click(function (event) {

        jQuery(".select_nuovo_credito").hide();
        var id=jQuery(event.target).attr('id').toString();

        id=id.substr(12,id.length-12);
        console.log(id);
        jQuery("#nuovo_credito_"+id).toggle();
        jQuery("#confirm_button_"+id).toggle();


    });




    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando un corso')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

    function deletecreditoclick(id) {

        if(confirm('attenzione, stai cancellando il credito per un corso')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=crediti.delete_map&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }

    }

</script>
</html>
