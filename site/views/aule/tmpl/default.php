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
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA AULE</h2>
    <table class="table table-striped table-bordered ">
        <thead>
        <tr>
            <th style="width: 15%;">DENOMINAZIONE</th>
            <th style="width: 15%;">INDIRIZZO</th>
            <th style="width: 15%;">CITTA</th>
            <th style="width: 15%;">NOTE</th>
           
            <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php


            foreach ($this->aule[0] as $aula) {

                ?>
                <tr>
                    <td class="denominazione"><span class="start_span" id="span_denominazione_<?php echo $aula['id']; ?>"><?php echo $aula['denominazione']; ?></span>
                        <input id="input_denominazione_<?php echo $aula['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $aula['denominazione']; ?>"></td>

                    <td class="indirizzo"><span class="start_span" id="span_indirizzo_<?php echo $aula['id']; ?>"><?php echo $aula['indirizzo']; ?></span>
                        <input id="input_indirizzo_<?php echo $aula['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $aula['indirizzo']; ?>"></td>

                    <td class="citta"><span class="start_span" id="span_citta_<?php echo $aula['id']; ?>"><?php echo $aula['citta']; ?></span>
                        <input id="input_citta_<?php echo $aula['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $aula['citta']; ?>"></td>

                    <td class="note"><span class="start_span" id="span_note_<?php echo $aula['id']; ?>"><?php echo $aula['note']; ?></span>
                        <TEXTAREA id="input_note_<?php echo $aula['id']; ?>" class="start_hidden_input form-control form-control-sm"><?php echo $aula['note']; ?></TEXTAREA></td>


                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica aula" aria-hidden="true" id="<?php echo $aula['id']; ?>"></span></button>
                        <button class="confirm_button" id="confirm_button_<?php echo $aula['id']; ?>"><span class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" id="confirm_span_<?php echo $aula['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $aula['id']; ?>)"><span class="oi oi-delete red" title="cancella aula" aria-hidden="true"></span> </button>
                    </td>
                </tr>
                <?php

        }
        ?>
        </tbody>
    </table>
</div>
<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UNA NUOVA AULA</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-4 col-md-4 text-info"><h5>Denominazione:</h5> <input class="form-control form-control-sm" type="text" id="denominazione"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Indirizzo</h5> <input class="form-control form-control-sm" type="text" id="indirizzo"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>Citta:</h5> <input class="form-control form-control-sm" type="text" id="citta"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>Note:</h5> <textarea rows=5 cols=5 class="form-control form-control-sm" id="note"></textarea></div>

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
            url: 'index.php?option=com_ggfirst&task=aule.insert&denominazione='+jQuery("#denominazione").val()+'&indirizzo='+jQuery("#indirizzo").val()+'&citta='+jQuery("#citta").val()+'&note='+jQuery("#note").val()

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
        jQuery("#input_denominazione_"+str).toggle();
        jQuery("#input_indirizzo_"+str).toggle();
        jQuery("#input_citta_"+str).toggle();
        jQuery("#input_note_"+str).toggle();
        jQuery("#confirm_button_"+str).toggle();

        change_operation='modify_anagrafica';
    });



    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {

        var str = jQuery(event.target).attr('id').toString();
        console.log(str.substr(13, str.length - 13));
        var id = str.substr(13, str.length - 13);
          var denominazione = jQuery('#input_denominazione_' + id).val().toString();
            var indirizzo = jQuery('#input_indirizzo_' + id).val().toString();
            var citta = jQuery('#input_citta_' + id).val().toString();
            var note= jQuery('#input_note_' + id).val().toString();

            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=aule.modify&id=' + id + '&denominazione=' + denominazione + '&indirizzo=' + indirizzo + '&citta=' + citta+ '&note=' + note

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
                url: 'index.php?option=com_ggfirst&task=aule.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
