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


<div class="table-responsive">
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA CORSI</h2>
    <div><input type="text" id="tosearch"><button id="dosearch" style="margin-left: 20px;"><span class="oi oi-magnifying-glass"></span></button></div>
    <table class="table table-striped table-bordered data-page-length='8'">
        <thead>
        <tr>
            <th style="width: 15%;">TITOLO</th>
            <th style="width: 15%;">DATA INIZIO</th>
            <th style="width: 15%;">DATA FINE</th>
            <th style="width: 15%;">CREDITI</th>

           <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->corsi[0] as $corso) {

            ?>
                <tr>
                    <td class="titolo"><span class="start_span" id="_nome"><a href="index.php?option=com_ggfirst&view=partecipanti&id_corso=<?php echo $corso['id']; ?>"><?php echo $corso['titolo']; ?></a></span><span><?php if($corso['corso_attivo']==1) echo '&nbsp;&nbsp;&nbsp;<span class="oi oi-bookmark red"></span>'?>
                    <td class="data_inizio"><span class="start_span" id="_cognome"><?php echo $corso['data_inizio']; ?></span>
                    <td class="data_fine"><span class="start_span" id="_citta"><?php echo $corso['data_fine']; ?></span>
                    <td id="contenitore_crediti">

                        <?php foreach ($corso['crediti'] as $credito) {

                            if($credito['ruolo']!=null) {
                                echo ' <div class="row">
                                            <div class="col-md-8">' . $credito['ruolo'] . '</div>
                                            <div class="col-md-4" onclick=deletecreditoclick(' . $credito['credito_id'] . ')><span class="oi oi-puzzle-piece red delete_ruolo" title="cancella credito" aria-hidden="true"></span></div>
                                      </div>';
                            }
                        }?>
                        <div ><select class="start_hidden_input select_nuovo_credito" id="nuovo_credito_<?php echo $corso['id']; ?>">
                                <option value='0'>aggiungi un credito</option>
                                <?php foreach ($this->crediti as $credito){

                                    echo '<option value='.$credito['id'].'>'.$credito['ruolo'].' - ' .$credito['rischio'].'</option>';
                                }

                                ?>


                            </select>
                        </div>
                    </td>
                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica corso" aria-hidden="true" onclick="modifica(<?php echo $corso['id']; ?>,'<?php echo $corso['titolo']; ?>','<?php echo $corso['data_inizio']; ?>','<?php echo $corso['data_fine']; ?>')"></span></button>
                        <button class="confirm_button" id="confirm_button_<?php echo $corso['id']; ?>"><span class="oi oi-thumb-up" title="conferma modifiche" aria-hidden="true" id="confirm_span_<?php echo $corso['id']; ?>"></span></button>
                        <button onclick="deleteclick(<?php echo $corso['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                        <button><span class="add_credito oi oi-puzzle-piece green" title="aggiungi credito" aria-hidden="true" id="add_credito_<?php echo $corso['id']; ?>"></span></button></td>

                    </td>
                </tr>

                <?php
            }
        ?>
        <tr>
            <td><div class="pagination">
            <?php $k=1;
            for($i=0; $i<$this->corsi[1];$i=$i+10){
                echo "<a href=index.php?option=com_ggfirst&view=corsi&offset=".(($k-1)*10)."&limit=10>".$k."</a>";
                $k++;
            }?>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO CORSO</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-3 col-md-3 text-info"><h5>Titolo:</h5> <input class="form-control form-control-sm" type="text" id="titolo"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Data Inizio:</h5> <input class="form-control form-control-sm" type="date" id="data_inizio"></div>
        <div class="col-xs-6 col-md-6 text-info"><h5>Data Fine:</h5> <input class="form-control form-control-sm" type="date" id="data_fine"></div>
        </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcorso" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
        </div><div class="col-xs-0 col-md-4"></div>
    </div>
</div>

<script type="text/javascript">

    var actual_operation='insert';
    var actual_id;

    jQuery("#dosearch").click(function (event) {

        console.log("/index.php?option=com_ggfirst&view=corsi&search="+jQuery("#tosearch").val());
        window.open("index.php?option=com_ggfirst&view=corsi&search="+jQuery("#tosearch").val(),'_self');
    });

    function modifica(id,titolo,data_inizio,data_fine){


        actual_id=id;
        jQuery("#titolo").val(titolo);
        jQuery("#data_inizio").val(data_inizio);
        jQuery("#data_fine").val(data_fine);
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
                + '&data_inizio=' + jQuery("#data_inizio").val() +
                '&data_fine=' + jQuery("#data_fine").val()


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
                + '&data_inizio=' + jQuery("#data_inizio").val() +
                '&data_fine=' + jQuery("#data_fine").val()

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
