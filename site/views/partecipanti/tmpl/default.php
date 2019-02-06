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
    <h1><?php if($this->corso!=null){
        echo $this->corso[0][0]['titolo'].'<br>';
        foreach ($this->corso[0][0]['crediti'] as $credito) {
            echo '<p><span><h6>'.$credito['ruolo'] . ' - ' . $credito['rischio'] . '</h6></span></p>';
        }
    }?></h1><h2>partecipanti attuali <b><?php echo count($this->partecipanti[0])?></b>su <b><?php echo $this->partecipanti[0][0]['minimo']?></b></h2>
    <div><input type="text" id="tosearch"><button id="dosearch" style="margin-left: 20px;"><span class="oi oi-magnifying-glass"></span></button></div>
    <table class="table table-striped table-bordered data-page-length='8'">
        <thead>
        <tr>
            <th style="width: 15%;">NOME</th>
            <th style="width: 15%;">COGNOME</th>
           <th style="width: 15%;">CITTA'</th>
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
                    <td class="citta"><span class="start_span" id="_citta"><?php echo $partecipante['citta']; ?></span>
                    <td class="data_nascita"><span class="start_span" id="_data_nascita"><?php echo $partecipante['data_nascita']; ?></span>


                    <td class="bottoni">

                        <button onclick="deleteclick(<?php echo $partecipante['id']; ?>)"><span class="oi oi-delete red" title="cancella utente" aria-hidden="true"></span></button>
                        <button onclick="openattestati(<?php echo $partecipante['id_studente']; ?>)"><span class="oi oi-plus blue" title="lancia attestato" aria-hidden="true"></span></button>
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
                <?php foreach ($this->studenti[0] as $studente){echo "<option value=".$studente['id'].">".$studente['cognome']." ".$studente['nome']." ".$studente['citta']."</option>";}?>
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


        window.open("index.php?option=com_ggfirst&view=partecipanti&id_corso=<?php echo $this->id_corso?>&search="+jQuery("#tosearch").val(),'_self');
    });


    function insertclick(){


         jQuery.ajax({
             method: "POST",
             cache: false,
             url: 'index.php?option=com_ggfirst&task=partecipanti.insert'
             + '&id_corso=' + <?php echo $this->id_corso?>
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
