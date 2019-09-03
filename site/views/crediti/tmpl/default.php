<?php
defined('_JEXEC') or die;
?>


<head>
<style>
    .insertbox{

        background-color: #d9edf7;
        margin-left: 3px;
    }

    .nome{

        width: 25%;
    }

    .cognome{

        width: 25%;
    }

    .valore_orario{

        width: 10%;
    }
    .monte_ore{

        width: 10%;
    }
    #contenitore_ruoli{

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


<div class="table-responsive">
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA CREDITI</h2>
    <table class="table table-striped table-bordered ">
        <thead>
        <tr>
            <th style="width: 15%;">RUOLO</th>
            <th style="width: 15%;">RISCHIO SETTORE/ATTTIVITA'</th>
            <th style="width: 15%;">DURATA</th>
            <th style="width: 15%;">INFORMAZIONI UTILI</th>
            <th style="width: 15%;">AGGIORNAMENTO</th>

            <th style="width: 15%;">E-LEARNING</th>
            <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->crediti as  $credito) {

            ?>
                <tr>
                    <td class="ruolo"><span class="start_span" id="span_ruolo_<?php echo $credito['id']; ?>"><?php echo $credito['ruolo']; ?></span>
                        <input id="input_ruolo_<?php echo $credito['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $credito['ruolo']; ?>"></td>

                    <td class="rischio"><span class="start_span" id="span_rischio_<?php echo $credito['id']; ?>"><?php echo $credito['rischio']; ?></span>
                        <input id="input_rischio_<?php echo $credito['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $credito['rischio']; ?>"></td>

                    <td class="durata"><span class="start_span" id="span_durata_<?php echo $credito['id']; ?>"><?php echo $credito['durata']; ?></span>
                        <input id="input_durata_<?php echo $credito['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $credito['durata']; ?>"></td>


                    <td class="informazioni"><span class="start_span" id="span_informazioni_<?php echo $credito['id']; ?>"><?php echo $credito['informazioni']; ?></span>
                        <textarea cols="5" rows="5" id="input_informazioni_<?php echo $credito['id']; ?>" class="start_hidden_input form-control form-control-sm"  value="<?php echo $credito['informazioni']; ?>"><?php echo $credito['informazioni']; ?></textarea></td>

                    <td class="aggiornamento"><span class="start_span" id="span_aggiornamento_<?php echo $credito['id']; ?>"><?php echo $credito['aggiornamento']; ?></span>
                        <input id="input_aggiornamento_<?php echo $credito['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $credito['aggiornamento']; ?>"></td>



                    <td class="elearning"><span class="start_span" id="span_elearning_<?php echo $credito['id']; ?>"><?php echo $credito['elearning']; ?></span>
                        <textarea cols="5" rows="5" id="input_elearning_<?php echo $credito['id']; ?>" class="start_hidden_input form-control form-control-sm"  value="<?php echo $credito['elearning']; ?>"><?php echo $credito['elearning']; ?></textarea></td>


                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica credito" aria-hidden="true" id="<?php echo $credito['id']; ?>"></span></button>
                        <button class="confirm_button" id="confirm_button_<?php echo $credito['id']; ?>"><span class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" id="confirm_span_<?php echo $credito['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $credito['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>
<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO CREDITO</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-4 col-md-4 text-info"><h5>Ruolo:</h5> <input class="form-control form-control-sm" type="text" id="ruolo"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Rischio Settore/Attività:</h5> <input class="form-control form-control-sm" type="text" id="rischio"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>Durata:</h5> <input class="form-control form-control-sm" type="text" id="durata"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>Informazioni Utili:</h5> <textarea rows=5 cols=5 class="form-control form-control-sm" id="informazioni"></textarea></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>Aggiornamento:</h5> <input class="form-control form-control-sm" type="text" id="aggiornamento"></div>

        <div class="col-xs-4 col-md-2 text-info"><h5>E-Learning:</h5> <textarea cols="5" rows="5" class="form-control form-control-sm" type="text" id="elearning"></textarea></div>
    </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcliente" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
        </div><div class="col-xs-0 col-md-4"></div>
    </div>
</div>

<script type="text/javascript">

    var change_operation=null;
    function insertclick(){

        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggcm&task=crediti.insert&ruolo='+jQuery("#ruolo").val()+'&rischio='+jQuery("#rischio").val()+'&durata='+jQuery("#durata").val()+'&informazioni='+jQuery("#informazioni").val()+'&aggiornamento='+jQuery("#aggiornamento").val()+'&elearning='+jQuery("#elearning").val()

        }).done(function() {

            alert("inserimento riuscito");
            location.reload();


        });
    }

    //questa funzione intercetta l'evento click sui pulsanti di modifica, e trasforma i campi testo della riga in campi input. Prima però riporta tutti a testo
    jQuery(".modify_button").click(function (event) {
console.log("modifica");
        jQuery('.start_hidden_input').hide()
        jQuery('.start_span').show()
        var str=jQuery(event.target).attr('id').toString();
        jQuery("#input_ruolo_"+str).toggle();
        jQuery("#input_rischio_"+str).toggle();
        jQuery("#input_durata_"+str).toggle();
        jQuery("#input_informazioni_"+str).toggle();
        jQuery("#input_aggiornamento_"+str).toggle();

        jQuery("#input_elearning_"+str).toggle();
        jQuery("#input_breakline_"+str).toggle();
        jQuery("#confirm_button_"+str).toggle();
        jQuery("#span_ruolo_"+str).toggle();
        jQuery("#span_rischio_"+str).toggle();
        jQuery("#span_durata_"+str).toggle();
        jQuery("#span_informazioni_"+str).toggle();
        jQuery("#span_aggiornamento_"+str).toggle();

        jQuery("#span_elearning_"+str).toggle();
        change_operation='modify_anagrafica';
    });



    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {

        var str = jQuery(event.target).attr('id').toString();
        console.log(str.substr(13, str.length - 13));
        var id = str.substr(13, str.length - 13);



            var ruolo = jQuery('#input_ruolo_' + id).val().toString();
            var rischio = jQuery('#input_rischio_' + id).val().toString();
            var durata = jQuery('#input_durata_' + id).val().toString();
            var informazioni= jQuery('#input_informazioni_' + id).val().toString();
            var aqgiornamento = jQuery('#input_aggiornamento_' + id).val().toString();

            var elearning = jQuery('#input_elearning_' + id).val().toString();


            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggcm&task=crediti.modify&id=' + id + '&ruolo=' + ruolo + '&rischio=' + rischio + '&durata=' + durata+ '&informazioni=' + informazioni+ '&aggiornamento=' + aqgiornamento  + '&elearning=' + elearning

            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });


    });


    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando un credito')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggcm&task=crediti.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
