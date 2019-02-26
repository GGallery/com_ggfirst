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
    .start_hidden_input,.confirm_button{

        display: none;
    }
</style>
</head>


<div class="table-responsive">
    <h2>PRIMA - GESTIONE CORSI - PREVENTIVI</h2>

    <table class="table table-striped table-bordered data-page-length='8'">

        <tr>
            <td style="width: 50%">
            filtra per nome del corso: <input type="text" id="tosearch"><button id="dosearch" style="margin-left: 20px;"><span class="oi oi-magnifying-glass"></span></button><br>
            filtra per nome del cliente: <input type="text" id="tosearch_cliente"><button id="dosearch_cliente" style="margin-left: 20px;"><span class="oi oi-magnifying-glass"></span></button>
            </td>

            <td style="width: 50%">
            <select style="width: 50%" class="form-control form-control-sm" id="filter_stato"><option value="">scegli</option><option value="">tutti</option><?php foreach ($this->stati as $stato){echo "<option value=".$stato['id'].">".$stato['stato_preventivo']."</option>";}?></select>

            </td>

        </tr>

    </table>
       <table class="table table-striped table-bordered data-page-length='8'">
        <thead>

        <tr>
            <th style="width: 15%;">CORSO</th>
            <th style="width: 15%;">CLIENTE</th>
            <th style="width: 15%;">STATO ISCRIZIONI</th>
           <th style="width: 15%;">BUDGET</th>
            <th style="width: 15%;">STATO</th>
            <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->preventivi[0] as $preventivo) {

            ?>
                <tr>
                    <td class="corso"><span class="start_span" id="span_corso_<?php echo $preventivo['id']; ?>"><?php echo $preventivo['corso']; ?></span>
                        <select class="start_hidden_input form-control form-control-sm" id="input_corso_<?php echo $preventivo['id']; ?>"><?php foreach ($this->corsi[0] as $corso){$selected=($preventivo['id_corso']==$corso['id']?'selected':'null');echo "<option value=".$corso['id'].' '.$selected.">".$corso['titolo']."</option>";}?></select></td>
                    <td class="cliente"><span class="start_span" id="span_cliente_<?php echo $preventivo['id']; ?>"><?php echo $preventivo['cliente']; ?></span>
                        <select class="start_hidden_input form-control form-control-sm" id="input_cliente_<?php echo $preventivo['id']; ?>"><?php foreach ($this->clienti as $cliente){$selected=($preventivo['id_cliente']==$cliente['id']?'selected':'null');echo "<option value=".$cliente['id'].' '.$selected.">".$cliente['denominazione']."</option>";}?></select></td>
                    <td class="numero_partecipanti"><span class="start_span"><?php echo $preventivo['numero_partecipanti']; ?>/<?php echo $preventivo['minimo_partecipanti']; ?></span><span><?php if($preventivo['edizione_attiva']==1) echo '&nbsp;&nbsp;&nbsp;<span class="oi oi-bookmark red"></span>'?>
                   <td class="budget"><span class="start_span" id="span_budget_<?php echo $preventivo['id']; ?>"><?php echo $preventivo['budget']; ?></span>
                        <input class="start_hidden_input form-control form-control-sm" id="input_budget_<?php echo $preventivo['id']; ?>" class="start_hidden_input form-control form-control-sm" type="text" value="<?php echo $preventivo['budget']; ?>"></td>
                    <td class="stato"><span class="start_span" id="span_stato_<?php echo $preventivo['id']; ?>"><?php echo $preventivo['stato']; ?></span>
                        <select class="start_hidden_input form-control form-control-sm" id="input_stato_<?php echo $preventivo['id']; ?>"><?php foreach ($this->stati as $stato){$selected=($preventivo['id_stato_preventivo']==$stato['id']?'selected':'null');echo "<option value=".$stato['id'].' '.$selected.">".$stato['stato_preventivo']."</option>";}?></select></td>
                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica preventivo" aria-hidden="true" id="<?php echo $preventivo['id']; ?>"></span></button>
                        <button class="confirm_button" id="confirm_button_<?php echo $preventivo['id']; ?>"><span class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" id="confirm_span_<?php echo $preventivo['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $preventivo['id']; ?>)"><span class="oi oi-delete red" title="cancella preventivo" aria-hidden="true"></span></button>
                    </td>
                </tr>

                <?php
            }
        ?>
        <tr>
            <td><div class="pagination">
            <?php $k=1;
            for($i=0; $i<$this->preventivi[1];$i=$i+10){
                echo "<a href=index.php?option=com_ggfirst&view=preventivi&offset=".(($k-1)*10)."&limit=10>".$k."</a>";
                $k++;
            }?>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO PREVENTIVO</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-4 col-md-4 text-info"><h5>Corso:</h5><select id="corso"><option value="">scegli</option><?php foreach ($this->corsi[0] as $corso){echo "<option value=".$corso['id'].">".$corso['titolo']."</option>";}?></select></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Cliente:</h5><select id="cliente"><option value="">scegli</option><?php foreach ($this->clienti as $cliente){echo "<option value=".$cliente['id'].">".$cliente['denominazione']."</option>";}?></select></div>

        <div class="col-xs-4 col-md-4 text-info"><h5>Budget:</h5> <input class="form-control form-control-sm" type="text" id="budget"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Stato:</h5><select id="stato"><option value="">scegli</option><?php foreach ($this->stati as $stato){echo "<option value=".$stato['id'].">".$stato['stato_preventivo']."</option>";}?></select></div>
    </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcliente" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
        </div><div class="col-xs-0 col-md-4"></div>
    </div>
</div>

<script type="text/javascript">


    var actual_id;

    jQuery("#dosearch_cliente").click(function (event) {

        console.log("/index.php?option=com_ggfirst&view=preventivi&search="+jQuery("#tosearch").val());
        window.open("index.php?option=com_ggfirst&view=preventivi&search_cliente="+jQuery("#tosearch_cliente").val(),'_self');
    });

    jQuery("#dosearch").click(function (event) {

        console.log("/index.php?option=com_ggfirst&view=preventivi&search="+jQuery("#tosearch").val());
        window.open("index.php?option=com_ggfirst&view=preventivi&search="+jQuery("#tosearch").val(),'_self');
    });
    //questa funzione intercetta l'evento click sui pulsanti di modifica, e trasforma i campi testo della riga in campi input. Prima però riporta tutti a testo
    jQuery(".modify_button").click(function (event) {
        console.log("modifica");
        jQuery('.start_hidden_input').hide()
        jQuery('.start_span').show()
        var str=jQuery(event.target).attr('id').toString();
        jQuery("#input_corso_"+str).toggle();
        jQuery("#input_cliente_"+str).toggle();
        jQuery("#input_budget_"+str).toggle();

        jQuery("#input_stato_"+str).toggle();
        jQuery("#span_corso_"+str).toggle();
        jQuery("#span_cliente_"+str).toggle();
        jQuery("#span_budget_"+str).toggle();
        jQuery("#span_numero_"+str).toggle();
        jQuery("#span_stato_"+str).toggle();
        jQuery("#confirm_button_"+str).toggle();

    });

    function insertclick(){


         jQuery.ajax({
             method: "POST",
             cache: false,
             url: 'index.php?option=com_ggfirst&task=preventivi.insert'
             + '&id_corso=' + jQuery("#corso").val()
             + '&id_cliente=' + jQuery("#cliente").val()

             + '&budget=' + jQuery("#budget").val()
             + '&id_stato_preventivo=' + jQuery("#stato").val()



         }).done(function () {

             alert("inserimento riuscito");
             location.reload();


         });

   }

    jQuery("#filter_stato").change(function(){

        window.open("index.php?option=com_ggfirst&view=preventivi&search_stato="+jQuery("#filter_stato").val(),'_self');

    });


    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {

        var str = jQuery(event.target).attr('id').toString();

        var id = str.substr(13, str.length - 13);
        console.log(id);
        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=preventivi.modify&' +
            'id=' + id
            +'&id_corso='+jQuery("#input_corso_"+id).val()
            +'&id_cliente='+jQuery("#input_cliente_"+id).val()

            +'&budget='+jQuery("#input_budget_"+id).val()
            +'&id_stato_preventivo='+jQuery("#input_stato_"+id).val()




        }).done(function () {

            alert("modifiche riuscite");
            location.reload();


        });



    });


    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando uno studente')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=preventivi.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
