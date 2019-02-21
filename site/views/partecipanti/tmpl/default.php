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

    .blue{

        color:blue;
    }

</style>
</head>


<div class="table-responsive">
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA PARTECIPANTI</h2>
    <h1><?php if($this->edizione!=null){
            echo $this->edizione[0][0]['titolo'].'<br>';

        }?></h1>
    <h1><?php if($this->edizione!=null){
        echo $this->edizione[0][0]['codice_edizione'].'<br>';

    }?>
    <?php
        if(count($this->edizione[0][0]['lezioni'])==1){
            echo '<span style="font-size: x-small">' .date_format(date_create($this->edizione[0][0]['lezioni'][0]['data']),'d-m-Y'). '</span>';
        }else {
            foreach ($this->edizione[0][0]['lezioni'] as $lezione) {
                if (isset($lezione['data']))
                    echo '<span style="font-size: x-small">' . date_format(date_create($lezione['data']),'d-m-Y') . '     ' . '</span>';
            }
        }

        ?></h1><h2>partecipanti attuali <b><?php echo count($this->partecipanti[0])?></b>su <b><?php if(isset($this->partecipanti[0][0]['minimo']))echo $this->partecipanti[0][0]['minimo'];?></b></h2>
    <div><input type="text" id="tosearch"><button id="dosearch" style="margin-left: 20px;"><span class="oi oi-magnifying-glass"></span></button></div>
    <table class="table table-striped table-bordered data-page-length='8'">
        <thead>
        <tr>
            <th style="width: 15%;">NOME</th>
            <th style="width: 15%;">COGNOME</th>

           <th style="width: 15%;">DATA DI NASCITA</th>
           <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->partecipanti[0] as $partecipante) {

            ?>
                <tr>
                    <td class="nome"><span class="start_span" id="_nome"><?php echo $partecipante['nome']; ?></span>
                    <td class="cognome"><span class="start_span" id="_cognome"><?php echo $partecipante['cognome']; ?></span>

                    <td class="data_nascita"><span class="start_span" id="_data_nascita"><?php echo $partecipante['data_nascita']; ?></span>


                    <td class="bottoni">

                        <button onclick="deleteclick(<?php echo $partecipante['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                        <button onclick="openattestati(<?php echo $partecipante['id_studente']; ?>)"><span class="oi oi-plus blue" title="lancia attestato" aria-hidden="true"></span></button>
                        <button onclick="openiscrizione('<?php echo $partecipante['nome']; ?>',
                                '<?php echo $partecipante['cognome']; ?>',
                                '<?php echo $this->edizione[0][0]['titolo']; ?>',
                                '<?php echo $partecipante['credito']; ?>',
                                '<?php echo $partecipante['durata']; ?>',
                                '<?php
                        if(count($this->edizione[0][0]['lezioni'])==1){
                            echo date_format(date_create($this->edizione[0][0]['lezioni'][0]['data']),'d-m-Y'). '</span>';
                        }else {
                            foreach ($this->edizione[0][0]['lezioni'] as $lezione) {
                                if (isset($lezione['data']))
                                    echo date_format(date_create($lezione['data']),'d-m-Y') ;
                            }
                        }

                        ?>',
                                '<?php echo date_format(date_create($this->edizione[0][0]['scadenza_iscrizione']),'d-m-Y');?>' ,
                        '<?php
                        if(count($this->edizione[0][0]['lezioni'])==1){
                            echo $this->edizione[0][0]['lezioni'][0]['ora_inizio'].'  '.$this->edizione[0][0]['lezioni'][0]['ora_fine'];
                        }else {


                            }

                        ?>',
                                '<?php echo $partecipante['riferimento_legislativo']; ?>',
                                '<?php echo $partecipante['luogo_nascita'].' '.date_format(date_create($partecipante['data_nascita']),'d-m-Y'); ?>',
                                '<?php echo $partecipante['codice_fiscale']; ?>',
                                '<?php echo $partecipante['titolo_studio']; ?>',
                                '<?php echo $partecipante['email']; ?>',
                                '<?php echo $partecipante['profilo']; ?>',
                                '<?php echo $partecipante['denominazione']; ?>',

                                '<?php echo $partecipante['piva']; ?>',
                                '<?php echo $partecipante['c_codice_fiscale']; ?>',
                                '<?php echo $partecipante['codice_univoco']; ?>',


                                '<?php echo $partecipante['email']; ?>',
                                '<?php echo $partecipante['indirizzo']; ?>',
                                '<?php echo $partecipante['citta']; ?>',
                                '<?php echo $partecipante['telefono']; ?>',
                                '<?php echo $partecipante['riferimento']; ?>',
                                '<?php echo $partecipante['email']; ?>',
                                '<?php echo $partecipante['ateco']; ?>',


                                )"><span class="oi oi-document red" title="apri iscrizione" aria-hidden="true"></span></button>
                    </td>
                </tr>

                <?php
            }
        ?>
        <tr>
            <td><div class="pagination">
            <?php $k=1;
            for($i=0; $i<$this->partecipanti[1];$i=$i+10){
                echo "<a href=index.php?option=com_ggfirst&view=studenti&offset=".(($k-1)*10)."&limit=10>".$k."</a>";
                $k++;
            }?>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="form-group form-group-sm">
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO PARTECIPANTE</b></div></div>

    <div  class="row insertbox">
        <div class="col-xs-4 col-md-4 text-info"><h5>Studente:</h5>

            <select id="studente">
                <option value="">aggiungi studente</option>
                <?php foreach ($this->studenti[0] as $studente){echo "<option value=".$studente['id'].">".$studente['cognome']." ".$studente['nome']."</option>";}?>
            </select></div>
    </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcliente" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
        </div><div class="col-xs-0 col-md-4"></div>
    </div>
</div>

<script type="text/javascript">




    jQuery("#dosearch").click(function (event) {


        window.open("index.php?option=com_ggfirst&view=partecipanti&id_edizione=<?php echo $this->id_edizione?>&search="+jQuery("#tosearch").val(),'_self');
    });


    function insertclick(){


         jQuery.ajax({
             method: "POST",
             cache: false,
             url: 'index.php?option=com_ggfirst&task=partecipanti.insert'
             + '&id_edizione=' + <?php echo $this->id_edizione?>
             + '&id_studente=' + jQuery("#studente").val()



         }).done(function () {

             alert("inserimento riuscito");
             location.reload();


         }).fail(function() {
             alert( "error" );
         });



    }

    function openattestati(id){

        window.open("index.php?option=com_ggfirst&view=attestati&preselected_id_studente="+id,'_self');

    }

    function openiscrizione(nome,cognome,titolo_corso,credito,durata,data,data_scadenza,orario,riferimento_legislativo,
                            luogo_data,codice_fiscale,titolo_studio,email,profilo,denominazione,piva,c_codice_fiscale,codice_univoco,
                            pec,indirizzo,citta,telefono,riferimento,email_riferimento,ateco) {

        url="index.php?option=com_ggfirst&task=pdf.generateIscrizione"+
            "&nome="+nome+
            "&cognome="+cognome+
            "&id_attestato=5"+
            "&titolo_corso="+titolo_corso+
            "&credito="+credito+
            "&durata="+durata+
            "&data="+data+
            "&data_scadenza="+data_scadenza+
            "&orario="+orario+
            "&riferimento_legislativo="+riferimento_legislativo+
            "&luogo_data="+luogo_data+
            "&codice_fiscale="+codice_fiscale+
            "&titolo_studio="+titolo_studio+
            "&email="+email+
            "&profilo="+profilo+
            "&denominazione="+denominazione+
            "&piva="+piva+
            "&c_codice_fiscale="+c_codice_fiscale+
            "&codice_univoco="+codice_univoco+
            "&pec="+pec+
            "&indirizzo="+indirizzo+
            "&comune_provincia="+citta+
            "&tel_fax="+telefono+
            "&riferimento="+riferimento+
            "&email_riferimento="+email_riferimento+
            "&ateco="+ateco
        window.open(url,'_self');

    }

    function deleteclick(id) {

        if(confirm('attenzione, stai cancellando un partecipante')==true) {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=partecipanti.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
