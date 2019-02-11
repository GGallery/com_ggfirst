<?php
defined('_JEXEC') or die;
?>


<head>
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

    <div class="form-group form-group-sm">
        <div  class="row insertbox"><div class="col-xs-10 col-md-10"><b>INSERISCI UN NUOVO CORSO</b></div></div>
            <div  class="row insertbox">
                <div class="col-xs-4 col-md-4 text-info"><h5></h5>
                    <input class="form-control form-control-sm" type="text" id="titolo">

                </div>

                <div class="col-xs-4 col-md-4 text-info"><h5></h5>

                    <button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcorso" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
                </div>

        </div>
    </div>



<!-- AREA EDIZIONI -------------------------------- -->

<div  class="table-responsive inserteditionbox" style="overflow-x: hidden">
    <div style="padding: 8px 16px;">
        <select  id="input_corso_iniziale">
            <option value="">scegli un corso</option>
            <?php foreach ($this->corsiAll[0] as $corso){echo "<option value=".$corso['id'].' '.$selected.">".$corso['titolo']."</option>";}?>
        </select>
        <button onclick="open_edizioni()"><span
                    class="modify_button oi oi-pencil" title="mostra edizioni" aria-hidden="true"></span>
        </button>
    </div>
    <table id="table_edizioni" class="table table-striped table-bordered data-page-length='8'" style="display: none">
        <thead>
        <tr>
            <th style="width: 30%">TITOLO</th>

            <th style="width: 30%">CREDITI</th>

           <th style="width: 20%"></th>
        </tr>
        </thead>

        <tbody>

        <?php
        if(isset($this->corso[0])) {
            foreach ($this->corso[0] as $corso) {

                ?>
                <tr>
                    <td class="titolo"><span class="start_span" id="_nome"><?php echo $corso['titolo']; ?></a></span>
                    <td id="contenitore_crediti">

                        <?php foreach ($corso['crediti'] as $credito) {

                            if ($credito['ruolo'] != null) {
                                echo ' <div class="row">
                                            <div class="col-md-8">' . $credito['ruolo'] . ' ' . $credito['rischio'] . '</div>
                                            <div class="col-md-4" onclick=deletecreditoclick(' . $credito['credito_id'] . ')><span class="oi oi-puzzle-piece red delete_ruolo" title="cancella credito" aria-hidden="true"></span></div>
                                      </div>';
                            }
                        } ?>
                        <div><select class="start_hidden_input select_nuovo_credito"
                                     id="nuovo_credito_<?php echo $corso['id']; ?>">
                                <option value='0'>aggiungi un credito</option>
                                <?php foreach ($this->crediti as $credito) {

                                    echo '<option value=' . $credito['id'] . '>' . $credito['ruolo'] . ' - ' . $credito['rischio'] . '</option>';
                                }

                                ?>


                            </select>
                        </div>
                    </td>
                    <td class="bottoni">
                        <button onclick="modifica(<?php echo $corso['id']; ?>,'<?php echo $corso['titolo']; ?>')"><span
                                    class="modify_button oi oi-pencil" title="modifica corso" aria-hidden="true"></span>
                        </button>
                        <button class="confirm_button" id="confirm_button_<?php echo $corso['id']; ?>"><span
                                    class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true"
                                    id="confirm_span_<?php echo $corso['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $corso['id']; ?>)"><span class="oi oi-delete red"
                                                                                         title="cancella utente"
                                                                                         aria-hidden="true"></span>
                        </button>
                        <button><span class="add_credito oi oi-puzzle-piece green" title="aggiungi credito"
                                      aria-hidden="true" id="add_credito_<?php echo $corso['id']; ?>"></span></button>
                    </td>

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
    <div  class="row inserteditionbox"><div class="col-xs-10 col-md-10"><b>INSERISCI UNA NUOVA EDIZIONE PER <span style="color: red"><?php echo $corso['titolo']?></span></b></div></div>
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
            <?php foreach ($this->edizioni[0] as $edizione){echo "<option value=".$edizione['id'].' '.$selected.">".$edizione['codice_edizione']."</option>";}?>
        </select>
        <button onclick="open_lezioni()"><span
                    class="modify_button oi oi-pencil" title="mostra lezioni" aria-hidden="true"></span>
        </button>
    </div>
    <table id="table_lezioni" class="table table-striped table-bordered data-page-length='8'" style="display: none">
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
                    <td class="titolo"><span class="start_span" id="_codice_edizione"><?php echo $edizione['codice_edizione']; ?></a></span>
                    <td id="contenitore_stato">


                        <div><select id="nuovo_stato_<?php echo $edizione['id']; ?>">
                                <option value='1' <?php if($edizione['stato']==1) echo 'selected';?>>aperto</option>
                                <option value='2' <?php if($edizione['stato']==2) echo 'selected';?>>chiuso</option>
                              </select>
                        </div>
                    </td>
                    <td class="titolo"><span class="start_span" id="_minimo_partecipanti"><?php echo $edizione['minimo_partecipanti']; ?></a></span>

                    <td class="bottoni">
                        <button onclick="modifica_edizione(<?php echo $edizione['id']; ?>,'<?php echo $edizione['codice_edizione']; ?>','<?php echo $edizione['stato']; ?>','<?php echo $edizione['minimo_partecipanti']; ?>')"><span
                                    class="modify_button oi oi-pencil" title="modifica corso" aria-hidden="true"></span>
                        </button>
                        <button class="confirm_button" id="confirm_button_<?php echo $edizione['id']; ?>"><span
                                    class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true"
                                    id="confirm_span_<?php echo $edizione['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $edizione['id']; ?>)"><span class="oi oi-delete red"
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
    <div  class="row insertlezionibox"><div class="col-xs-10 col-md-10"><b>INSERISCI UNA NUOVA DATA PER <?php  if(isset($this->edizione[0][0]['codice_edizione'])) echo $this->edizione[0][0]['codice_edizione']; ?></b></div></div>
    <div  class="row insertlezionibox" style="padding-bottom: 8px;">
        <div class="col-xs-4 col-md-4 text-info"><h5>Docente:</h5><select id="docente"><?php foreach ($this->docenti[0] as $docente){echo "<option value=".$docente['id'].">".$docente['cognome']."</option>";}?></select></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Aula:</h5><select id="aula"><?php foreach ($this->aule[0] as $aula){echo "<option value=".$aula['id'].">".$aula['denominazione']."</option>";}?></select></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Data:</h5> <input class="form-control form-control-sm" type="date" id="data"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Ora Inizio:</h5> <input class="form-control form-control-sm" type="time" id="ora_inizio"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Ora Fine:</h5> <input class="form-control form-control-sm" type="time" id="ora_fine"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Titolo:</h5> <input class="form-control form-control-sm" type="text" id="titolo" size="25"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Note:</h5> <TEXTAREA class="form-control form-control-sm" id="note"></TEXTAREA></div>
        <div class="col-xs-4 col-md-4 text-info">

        </div>
        <div class="col-xs-4 col-md-4 text-info" style="padding-top: 10px;">
            <button  class="form-control btn btn-outline-light btn-sm" id="insertnewcorso" value="conferma" onclick="insertlezioneclick()" type="button">CONFERMA</button>
        </div>
        <div class="col-xs-4 col-md-4 text-info">

        </div>
    </div>
</div>










<script type="text/javascript">

    var actual_operation='insert';
    var actual_id;

    function open_edizioni(){

        jQuery("#table_edizioni").toggle();
    }

    function open_lezioni(){

        jQuery("#table_lezioni").toggle();
    }

    jQuery("#input_edizione_iniziale").change(function () {

        url="index.php?option=com_ggfirst&view=corsi&id_corso=<?php echo $corso['id']; ?>&id_edizione="+jQuery("#input_edizione_iniziale").val();

        window.open(url,'_self');
    });


    jQuery("#input_corso_iniziale").change(function () {

        url="index.php?option=com_ggfirst&view=corsi&id_corso="+jQuery("#input_corso_iniziale").val();

        window.open(url,'_self');
    });

    function modifica(id,titolo,data_inizio,data_fine){


        actual_id=id;
        jQuery("#titolo").val(titolo);

        jQuery("#insertnewcorso").html('CONFERMA MODIFICHE');
        actual_operation="modify";



    }
    function insertclick(){


        if(actual_operation=="insert") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.insert'
                + '&titolo=' + jQuery("#titolo").val()



            }).done(function () {

                alert("inserimento riuscito");
                location.reload();


            });
        }
        if(actual_operation=="modify") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.modify&' +
                'id=' + actual_id
                + '&titolo=' + jQuery("#titolo").val()


            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });
        }

    }

    <?php if(isset($this->edizione)){?>
    function insertlezioneclick(){


        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=lezioni.insert'
            + '&id_edizione=<?php echo $this->edizione[0][0]['id']?>'
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
<?php }?>
    function insertedizioneclick(){


        if(actual_operation=="insert") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=corsi.insertedizione'
                + '&id_corso=' + <?php echo $corso['id']; ?>
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
                url: 'index.php?option=com_ggfirst&task=corsi.modify&' +
                'id=' + actual_id
                + '&titolo=' + jQuery("#titolo").val()


            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });
        }

    }

    jQuery(".add_credito").click(function (event) {

        jQuery(".select_nuovo_credito").hide();
        var id=jQuery(event.target).attr('id').toString();

        id=id.substr(12,id.length-12);
        console.log(id);
        jQuery("#nuovo_credito_"+id).toggle();
        jQuery("#confirm_button_"+id).toggle();


    });


    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {
        var str = jQuery(event.target).attr('id').toString();
        console.log(str.substr(13, str.length - 13));
        var id = str.substr(13, str.length - 13);


            var credito_id = jQuery("#nuovo_credito_" + id).val().toString();// PRENDE IL VALUE DELLA OPTION, QUINDI ID DEL RUOLO
            console.log(credito_id);

            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=crediti.insert_map&id_corso=' + id.toString() + '&id=' + credito_id.toString()

            }).done(function () {
                alert("aggiunto credito");
                location.reload();
            }).fail(function ($xhr) {
                var data = $xhr.responseJSON;
                console.log(data);
            });



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
