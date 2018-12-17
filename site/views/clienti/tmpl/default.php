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
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA CLIENTI</h2>
    <table class="table table-striped table-bordered ">
        <thead>
        <tr>
            <th style="width: 15%;">DENOMINAZIONE</th>
            <th style="width: 15%;">RIFERIMENTO</th>
            <th style="width: 15%;">EMAIL</th>
            <th style="width: 15%;">INDIRIZZO</th>
            <th style="width: 15%;">CAP</th>
            <th style="width: 15%;">CITTA'</th>
            <th style="width: 15%;">P.IVA</th>
            <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->clienti as $cliente) {

            ?>
                <tr>
                    <td class="denominazione"><span class="start_span" id="span_denominazione_<?php echo $cliente['id']; ?>"><?php echo $cliente['denominazione']; ?></span>
                        <input id="input_denominazione_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['denominazione']; ?>"></td>

                    <td class="riferimento"><span class="start_span" id="span_riferimento_<?php echo $cliente['id']; ?>"><?php echo $cliente['riferimento']; ?></span>
                        <input id="input_riferimento_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['riferimento']; ?>"></td>

                    <td class="email"><span class="start_span" id="span_email_<?php echo $cliente['id']; ?>"><?php echo $cliente['email']; ?></span>
                        <input id="input_email_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['email']; ?>"></td>


                    <td class="indirizzo"><span class="start_span" id="span_indirizzo_<?php echo $cliente['id']; ?>"><?php echo $cliente['indirizzo']; ?></span>
                        <input id="input_indirizzo_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['indirizzo']; ?>"></td>

                    <td class="cap"><span class="start_span" id="span_cap_<?php echo $cliente['id']; ?>"><?php echo $cliente['cap']; ?></span>
                        <input id="input_cap_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['cap']; ?>"></td>

                    <td class="citta"><span class="start_span" id="span_citta_<?php echo $cliente['id']; ?>"><?php echo $cliente['citta']; ?></span>
                        <input id="input_citta_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['citta']; ?>"></td>

                    <td class="piva"><span class="start_span" id="span_piva_<?php echo $cliente['id']; ?>"><?php echo $cliente['piva']; ?></span>
                        <input id="input_piva_<?php echo $cliente['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $cliente['piva']; ?>"></td>


                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica cliente" aria-hidden="true" id="<?php echo $cliente['id']; ?>"></span></button>
                        <button class="confirm_button" id="confirm_button_<?php echo $cliente['id']; ?>"><span class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" id="confirm_span_<?php echo $cliente['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $cliente['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>
<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO CLIENTE</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-4 col-md-4 text-info"><h5>Denominazione:</h5> <input class="form-control form-control-sm" type="text" id="denominazione"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Riferimento:</h5> <input class="form-control form-control-sm" type="text" id="riferimento"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>Email:</h5> <input class="form-control form-control-sm" type="text" id="email"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>indirizzo:</h5> <input class="form-control form-control-sm" type="text" id="indirizzo"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>cap:</h5> <input class="form-control form-control-sm" type="text" id="cap"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>citta:</h5> <input class="form-control form-control-sm" type="text" id="citta"></div>
        <div class="col-xs-4 col-md-2 text-info"><h5>P. IVA:</h5> <input class="form-control form-control-sm" type="text" id="piva"></div>
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
            url: 'index.php?option=com_ggfirst&task=clienti.insert&denominazione='+jQuery("#denominazione").val()+'&riferimento='+jQuery("#riferimento").val()+'&email='+jQuery("#email").val()+'&indirizzo='+jQuery("#indirizzo").val()+'&cap='+jQuery("#cap").val()+'&citta='+jQuery("#citta").val()+'&piva='+jQuery("#piva").val()

        }).done(function() {

            alert("inserimento riuscito");
            location.reload();


        });
    }

    //questa funzione intercetta l'evento click sui pulsanti di modifica, e trasforma i campi testo della riga in campi input. Prima però riporta tutti a testo
    jQuery(".modify_button").click(function (event) {

        jQuery('.start_hidden_input').hide()
        jQuery('.start_span').show()
        var str=jQuery(event.target).attr('id').toString();
        jQuery("#input_denominazione_"+str).toggle();
        jQuery("#input_riferimento_"+str).toggle();
        jQuery("#input_email_"+str).toggle();
        jQuery("#input_indirizzo_"+str).toggle();
        jQuery("#input_cap_"+str).toggle();
        jQuery("#input_citta_"+str).toggle();
        jQuery("#input_piva_"+str).toggle();
        jQuery("#input_breakline_"+str).toggle();
        jQuery("#confirm_button_"+str).toggle();
        jQuery("#span_denominazione_"+str).toggle();
        jQuery("#span_riferimento_"+str).toggle();
        jQuery("#span_email_"+str).toggle();
        jQuery("#span_indirizzo_"+str).toggle();
        jQuery("#span_cap_"+str).toggle();
        jQuery("#span_citta_"+str).toggle();
        jQuery("#span_piva_"+str).toggle();
        change_operation='modify_anagrafica';
    });



    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {

        var str = jQuery(event.target).attr('id').toString();
        console.log(str.substr(13, str.length - 13));
        var id = str.substr(13, str.length - 13);



            var denominazione = jQuery('#input_denominazione_' + id).val().toString();
            var riferimento = jQuery('#input_riferimento_' + id).val().toString();
            var email = jQuery('#input_email_' + id).val().toString();
            var indirizzo = jQuery('#input_indirizzo_' + id).val().toString();
            var cap = jQuery('#input_cap_' + id).val().toString();
            var citta = jQuery('#input_citta_' + id).val().toString();
            var piva = jQuery('#input_piva_' + id).val().toString();


            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=clienti.modify&id=' + id + '&denominazione=' + denominazione + '&riferimento=' + riferimento + '&email=' + email+ '&indirizzo=' + indirizzo+ '&cap=' + cap+ '&citta=' + citta+ '&piva=' + piva

            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });


    });


    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando un cliente')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=clienti.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
