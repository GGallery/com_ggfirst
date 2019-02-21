<?php
defined('_JEXEC') or die;
?>


<head>
<style>
    .insertbox{

        background-color: #d9edf7;
        margin-left: 3px;
    }

    .contenitori_filtro{


        width:100%;

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
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA ATTESTATI</h2>
    <table class="table table-striped table-bordered ">
        <thead>
        <tr>
            <th style="width: 15%;"><select id="filtrocredito" class="contenitori_filtro">
                    <option value="">filtra per credito</option>
                    <?php foreach ($this->crediti as $credito){echo "<option value='".$credito['id']."'>".$credito['credito']."</option>";}?>
                </select></th>
            <th style="width: 15%;">  <select id="filtrostudente" class="contenitori_filtro">
                    <option value="">filtra per studente</option>
                    <?php foreach ($this->studenti[0] as $studente){echo "<option value=".$studente['id'].">".$studente['cognome']." ".$studente['nome']."</option>";}?>
                </select></th>
            <th style="width: 15%;"><input  id="filtronumero" class="contenitori_filtro" type="text"></th>
            <th style="width: 15%;"><input id="filtrodata_attestato" class="contenitori_filtro" type="date"></th>
            <th style="width: 15%;"><input  id="filtrocertificatore" class="contenitori_filtro" type="text"></th>
            <th style="width: 15%;"><input id="filtrodata_scadenza_minore" class="contenitori_filtro" type="date"><input id="filtrodata_scadenza_maggiore" class="contenitori_filtro" type="date"></th>

            <th ><button id="dosearch"><span class="oi oi-magnifying-glass"></span></button></th>
        </tr>
        <tr>
            <th style="width: 15%;">CREDITO</th>
            <th style="width: 15%;">STUDENTE</th>
            <th style="width: 15%;">NUMERO</th>
            <th style="width: 10%;">DATA</th>
            <th style="width: 15%;">CERTIFICATORE</th>
            <th style="width: 20%;">SCADENZA</th>
            
            <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->attestati as  $attestato) {

            ?>
                <tr>
                    <td class="aggiornamento"><span class="start_span" id="span_credito_<?php echo $attestato['id']; ?>"><?php echo $attestato['credito']; ?></span>
                        <input id="input_credito_<?php echo $attestato['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $attestato['credito']; ?>"></td>

                    <td class="ruolo"><span class="start_span" id="span_studente_<?php echo $attestato['id']; ?>"><?php echo $attestato['studente']; ?></span>
                        <input id="input_studente_<?php echo $attestato['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $attestato['studente']; ?>"></td>

                    <td class="rischio"><span class="start_span" id="span_numero_<?php echo $attestato['id']; ?>"><?php echo $attestato['numero']; ?></span>
                        <input  id="input_numero_<?php echo $attestato['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $attestato['numero']; ?>"></td>

                    <td class="durata"><span class="start_span" id="span_data_attestato_<?php echo $attestato['id']; ?>"><?php echo $attestato['data_attestato']; ?></span>
                        <input id="input_data_attestato_<?php echo $attestato['id']; ?>" class="start_hidden_input form-control form-control-sm" type="date" value="<?php echo $attestato['data_attestato']; ?>"></td>


                    <td class="informazioni"><span class="start_span" id="span_certificatore_<?php echo $attestato['id']; ?>"><?php echo $attestato['certificatore']; ?></span>
                        <input type="text" id="input_certificatore_<?php echo $attestato['id']; ?>" class="start_hidden_input form-control form-control-sm"  value="<?php echo $attestato['certificatore']; ?>"></td>



                    <td class="periodicita"><span class="start_span" id="span_scadenza_<?php echo $attestato['id']; ?>"><?php echo $attestato['scadenza']; ?></span>
                        <input id="input_scadenza_<?php echo $attestato['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $attestato['scadenza']; ?>"></td>


                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica attestato" aria-hidden="true" id="<?php echo $attestato['id']; ?>"></span></button>
                        <button class="confirm_button" id="confirm_button_<?php echo $attestato['id']; ?>"><span class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" id="confirm_span_<?php echo $attestato['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $attestato['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                        <button onclick="openattestato('<?php echo $attestato['nome']; ?>','<?php echo $attestato['cognome']; ?>','<?php echo $attestato['data_attestato']; ?>')"><span class="oi oi-document green" title="apri attestato" aria-hidden="true"></span></button>

                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>
<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO ATTESTATO</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-3 col-md-3 text-info"><h5>Studente:</h5>

            <select id="studente">
                <option value="">scegli uno studente</option>
                <?php foreach ($this->studenti[0] as $studente){if($studente['id']==$this->preselected_id_studente){$selected='selected';}else{$selected='';};echo "<option ".$selected." value=".$studente['id'].">".$studente['cognome']." ".$studente['nome']." ".$studente['citta']."</option>";}?>
            </select></div>

        <div class="col-xs-3 col-md-3 text-info"><h5>Numero:</h5> <input class="form-control form-control-sm" type="text" id="numero" size="5"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Data:</h5> <input class="form-control form-control-sm" type="date" id="data_attestato"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Certificatore:</h5> <input type=text class="form-control form-control-sm" id="certificatore"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Credito:</h5>
            <select id="credito">
                <option aggiornamento=null value="null">scegli un credito</option>
            <?php foreach ($this->crediti as $credito){echo "<option aggiornamento=".$credito['aggiornamento']." value='".$credito['id']."'>".$credito['credito']."</option>";}?>
        </select>
        </div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Scadenza:</h5> <input class="form-control form-control-sm" type="date" id="scadenza"></div>

    </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcliente" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
        </div><div class="col-xs-0 col-md-4"></div>
    </div>
</div>

<script type="text/javascript">

    var change_operation=null;

    function openattestato(nome,cognome,data_attestato) {

        url="index.php?option=com_ggfirst&task=pdf.generateAttestato"+
            "&nome="+nome+
            "&cognome="+cognome+
            "&id_attestato=4"+
            "&data_attestato="+data_attestato
        window.open(url,'_self');

    }


    jQuery("#dosearch").click(function (event) {


        url="index.php?option=com_ggfirst&view=attestati"+
            "&id_credito_map="+jQuery("#filtrocredito").val()+
            "&id_studente="+jQuery("#filtrostudente").val()+
            "&numero="+jQuery("#filtronumero").val()+
            "&data_attestato="+jQuery("#filtrodata_attestato").val()+
            "&certificatore="+jQuery("#filtrocertificatore").val()+
            "&scadenza_data_minore="+jQuery("#filtrodata_scadenza_minore").val()+
            "&scadenza_data_maggiore="+jQuery("#filtrodata_scadenza_maggiore").val()

        window.open(url,'_self');
    });

    jQuery('#credito').change(function(){


        var aggiornamento=jQuery('#credito option:selected').attr('aggiornamento');
        console.log(aggiornamento);
        if(jQuery('#data_attestato').val()!=null){

            data_=new Date(jQuery('#data_attestato').val());
            console.log(data_);
            data__=new Date(data_.setFullYear(data_.getFullYear()+(aggiornamento/12)));
            anno=data__.getFullYear().toString();
            mese=(data__.getMonth()+1).toString();
            giorno=data__.getDate().toString();
            if(mese.length==1){
                mese="0"+mese;
            }
            if(giorno.length==1){
                giorno='0'+giorno;
            }

            jQuery('#scadenza').val(anno+'-'+mese+'-'+giorno);

        }

    });

    function insertclick(){

        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=attestati.insert&id_studente='+jQuery("#studente").val()+'&numero='+jQuery("#numero").val()+'&data_attestato='+jQuery("#data_attestato").val()+'&certificatore='+jQuery("#certificatore").val()+'&id_credito_map='+jQuery("#credito").val()+'&scadenza='+jQuery("#scadenza").val()

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
        jQuery("#input_studente_"+str).toggle();
        jQuery("#input_numero_"+str).toggle();
        jQuery("#input_data_attestato_"+str).toggle();
        jQuery("#input_certificatore_"+str).toggle();
        jQuery("#input_credito_"+str).toggle();
        jQuery("#input_scadenza_"+str).toggle();

        jQuery("#input_breakline_"+str).toggle();
        jQuery("#confirm_button_"+str).toggle();
        jQuery("#span_studente_"+str).toggle();
        jQuery("#span_numero_"+str).toggle();
        jQuery("#span_data_attestato_"+str).toggle();
        jQuery("#span_certificatore_"+str).toggle();
        jQuery("#span_credito_"+str).toggle();
        jQuery("#span_scadenza_"+str).toggle();

        change_operation='modify_anagrafica';
    });



    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {

        var str = jQuery(event.target).attr('id').toString();
        console.log(str.substr(13, str.length - 13));
        var id = str.substr(13, str.length - 13);



            var id_studente = jQuery('#input_studente_' + id).val().toString();
            var numero = jQuery('#input_numero_' + id).val().toString();
            var data_attestato = jQuery('#input_data_attestato_' + id).val().toString();
            var certificatore= jQuery('#input_certificatore_' + id).val().toString();
            var id_credito_map = jQuery('#input_credito_' + id).val().toString();
            var scadenza = jQuery('#input_scadenza_' + id).val().toString();



            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=attestati.modify&id=' + id + '&id_studente=' + id_studente + '&numero=' + numero + '&data_attestato=' + data_attestato + '&certificatore=' + certificatore+ '&id_credito_map=' + id_credito_map + '&scadenza=' + scadenza

            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });


    });


    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando un attestato')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=attestati.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
