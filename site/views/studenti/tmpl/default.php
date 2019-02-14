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
    <h2>PRIMA - GESTIONE CORSI - ANAGRAFICA STUDENTI</h2>
    <div><input type="text" id="tosearch"><button id="dosearch" style="margin-left: 20px;"><span class="oi oi-magnifying-glass"></span></button></div>
    <table class="table table-striped table-bordered data-page-length='8'">
        <thead>
        <tr>
            <th style="width: 15%;">NOME</th>
            <th style="width: 15%;">COGNOME</th>
           <th style="width: 15%;">CITTA'</th>
           <th style="width: 15%;">DATA DI NASCITA</th>
           <th style="width: 15%;">ISCRITTO AD EDIZIONI:</th>
           <th ></th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($this->studenti[0] as $studente) {

            ?>
                <tr>
                    <td class="nome"><span class="start_span" id="_nome"><?php echo $studente['nome']; ?></span>
                    <td class="cognome"><span class="start_span" id="_cognome"><?php echo $studente['cognome']; ?></span>
                    <td class="citta"><span class="start_span" id="_citta"><?php echo $studente['citta']; ?></span>
                    <td class="data_nascita"><span class="start_span" id="_data_nascita"><?php echo $studente['data_nascita']; ?></span>
                    <td class="edizioni"><UL id="_edizioni"><?php foreach ($studente["edizioni_iscritto"] as $edizione){echo '<LI>'.$edizione['titolo_corso'].'-'.$edizione['codice_edizione'].'</LI>' ;} ?></UL>

                    <td class="bottoni">
                        <button><span class="modify_button oi oi-pencil" title="modifica cliente" aria-hidden="true" onclick="modifica(<?php echo $studente['id']; ?>,'<?php echo $studente['nome']; ?>',
                                    '<?php echo $studente['cognome']; ?>','<?php echo $studente['indirizzo']; ?>','<?php echo $studente['cap']; ?>','<?php echo $studente['citta']; ?>',
                                    '<?php echo $studente['provincia']; ?>','<?php echo $studente['codice_fiscale']; ?>','<?php echo $studente['data_nascita']; ?>','<?php echo $studente['luogo_nascita']; ?>',
                                    '<?php echo $studente['prov_nascita']; ?>','<?php echo $studente['telefono']; ?>','<?php echo $studente['cellulare']; ?>','<?php echo $studente['email']; ?>',
                                    '<?php echo $studente['idcliente']; ?>')"></span></button>
                        <button onclick="deleteclick(<?php echo $studente['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                    </td>
                </tr>

                <?php
            }
        ?>
        <tr>
            <td><div class="pagination">
            <?php $k=1;
            for($i=0; $i<$this->studenti[1];$i=$i+10){
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
    <div  class="row insertbox"><div class="col-xs-12 col-md-12"><b>INSERISCI UN NUOVO STUDENTE</b></div></div>

    <div  class="row insertbox">

        <div class="col-xs-3 col-md-3 text-info"><h5>Nome:</h5> <input class="form-control form-control-sm" type="text" id="nome"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Cognome:</h5> <input class="form-control form-control-sm" type="text" id="cognome"></div>
        <div class="col-xs-6 col-md-6 text-info"><h5>Indirizzo:</h5> <input class="form-control form-control-sm" type="text" id="indirizzo"></div>
        <div class="col-xs-2 col-md-2 text-info"><h5>CAP:</h5> <input class="form-control form-control-sm" type="text" id="cap"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Città:</h5> <input class="form-control form-control-sm" type="text" id="citta"></div>
        <div class="col-xs-2 col-md-2 text-info"><h5>Prov.</h5> <input class="form-control form-control-sm" type="text" id="provincia"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Cod. Fiscale</h5> <input class="form-control form-control-sm" type="text" id="codice_fiscale"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Data di nascita</h5> <input class="form-control form-control-sm" type="date" id="data_nascita"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Luogo di Nascita</h5> <input class="form-control form-control-sm" type="text" id="luogo_nascita"></div>
        <div class="col-xs-2 col-md-2 text-info"><h5>Prov. Nasc.</h5> <input class="form-control form-control-sm" type="text" id="prov_nascita"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Telefono</h5> <input class="form-control form-control-sm" type="text" id="telefono"></div>
        <div class="col-xs-3 col-md-3 text-info"><h5>Cellulare</h5> <input class="form-control form-control-sm" type="text" id="cellulare"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Email:</h5> <input class="form-control form-control-sm" type="text" id="email"></div>
        <div class="col-xs-4 col-md-4 text-info"><h5>Cliente:</h5><select id="idcliente"><?php foreach ($this->clienti as $cliente){echo "<option value=".$cliente['id'].">".$cliente['denominazione']."</option>";}?></select></div>
    </div>

    <div  class="row insertbox">
        <div class="col-xs-0 col-md-4"></div>
        <div class="col-xs-12 col-md-4 text-center"><button  class="form-control btn btn-outline-secondary btn-sm" id="insertnewcliente" value="conferma" onclick="insertclick()" type="button">CONFERMA</button>
        </div><div class="col-xs-0 col-md-4"></div>
    </div>
</div>

<script type="text/javascript">

    var actual_operation="insert";
    var actual_id;

    jQuery("#dosearch").click(function (event) {

        console.log("/index.php?option=com_ggfirst&view=studenti&search="+jQuery("#tosearch").val());
        window.open("index.php?option=com_ggfirst&view=studenti&search="+jQuery("#tosearch").val(),'_self');
    });

    function modifica(id,nome,cognome,indirizzo,cap,citta,provincia,codice_fiscale,data_nascita,luogo_nascita,prov_nascita,telefono,cellulare,email,idcliente){

        console.log(id+" "+nome);
        actual_id=id;
        jQuery("#nome").val(nome);
        jQuery("#cognome").val(cognome);
        jQuery("#provincia").val(provincia);
        jQuery("#indirizzo").val(indirizzo);
        jQuery("#cap").val(cap);
        jQuery("#citta").val(citta);
        jQuery("#codice_fiscale").val(codice_fiscale);
        jQuery("#data_nascita").val(data_nascita);
        jQuery("#luogo_nascita").val(luogo_nascita);
        jQuery("#prov_nascita").val(prov_nascita);
        jQuery("#telefono").val(telefono);
        jQuery("#cellulare").val(cellulare);
        jQuery("#email").val(email);
        jQuery("#idcliente").val(idcliente);
        jQuery("#insertnewcliente").html('CONFERMA MODIFICHE');
        actual_operation="modify";


    }
    function insertclick(){

     if(actual_operation=="insert") {
         jQuery.ajax({
             method: "POST",
             cache: false,
             url: 'index.php?option=com_ggfirst&task=studenti.insert'
             + '&nome=' + jQuery("#nome").val()
             + '&cognome=' + jQuery("#cognome").val() +
             '&provincia=' + jQuery("#provincia").val()
             + '&indirizzo=' + jQuery("#indirizzo").val()
             + '&cap=' + jQuery("#cap").val()
             + '&citta=' + jQuery("#citta").val()
             + '&codice_fiscale=' + jQuery("#codice_fiscale").val()
             + '&data_nascita=' + jQuery("#data_nascita").val()
             + '&luogo_nascita=' + jQuery("#luogo_nascita").val()
             + '&prov_nascita=' + jQuery("#prov_nascita").val()
             + '&telefono=' + jQuery("#telefono").val()
             + '&cellulare=' + jQuery("#cellulare").val()
             + '&email=' + jQuery("#email").val()
             + '&idcliente=' + jQuery("#idcliente").val()


         }).done(function () {

             alert("inserimento riuscito");
             location.reload();


         });
     }

        if(actual_operation=="modify") {
            jQuery.ajax({
                method: "POST",
                cache: false,
                url: 'index.php?option=com_ggfirst&task=studenti.modify&' +
                'id=' + actual_id
                +'&nome='+jQuery("#nome").val()
                +'&cognome='+jQuery("#cognome").val()+
                '&provincia='+jQuery("#provincia").val()
                +'&indirizzo='+jQuery("#indirizzo").val()
                +'&cap='+jQuery("#cap").val()
                +'&citta='+jQuery("#citta").val()
                +'&codice_fiscale='+jQuery("#codice_fiscale").val()
                +'&data_nascita='+jQuery("#data_nascita").val()
                +'&luogo_nascita='+jQuery("#luogo_nascita").val()
                +'&prov_nascita='+jQuery("#prov_nascita").val()
                +'&telefono='+jQuery("#telefono").val()
                +'&cellulare='+jQuery("#cellulare").val()
                +'&idcliente='+jQuery("#idcliente").val()



            }).done(function () {

                alert("modifiche riuscite");
                location.reload();


            });
        }

    }




    //QUESTA E' LA PROCEDURA DI INVIO DEI DATI MODIFICATI
    jQuery(".oi-thumb-up").click(function (event) {

        jQuery.ajax({
            method: "POST",
            cache: false,
            url: 'index.php?option=com_ggfirst&task=studenti.modify&' +
            'id=' + id
            +'&nome='+jQuery("#nome").val()
            +'&cognome='+jQuery("#cognome").val()+
            '&provincia='+jQuery("#provincia").val()
            +'&indirizzo='+jQuery("#indirizzo").val()
            +'&cap='+jQuery("#cap").val()
            +'&citta='+jQuery("#citta").val()
            +'&codice_fiscale='+jQuery("#codice_fiscale").val()
            +'&data_nascita='+jQuery("#data_nascita").val()
            +'&luogo_nascita='+jQuery("#luogo_nascita").val()
            +'&prov_nascita='+jQuery("#prov_nascita").val()
            +'&telefono='+jQuery("#telefono").val()
            +'&cellulare='+jQuery("#cellulare").val()



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
                url: 'index.php?option=com_ggfirst&task=studenti.delete&id=' + id.toString()

            }).done(function () {

                alert("cancellazione riuscita");
                location.reload();


            });
        }
    }

</script>
</html>
