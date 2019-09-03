<?php
defined('_JEXEC') or die;
?>


<head>
<style>
.question
{
    font-style: italic;
    font-size: medium;

}
.paragrafo{

    margin-top: 20px;
    margin-left: 20px;
    margin-right: 30px;
}

.questionrow{



    border-bottom: 1px dashed black;
}
</style>
</head>
<div  class="row"><div class="col-xs-4 col-md-4"><img src="<?php echo JURI::base();?>/components/com_ggcm/libraries/images/logo_prima.png"></div><div class="col-xs-8 col-md-8">
        <div><b><h2>Corso:<?php echo  $this->titolo_corso;?></h2></b></div>
        <div>Data:<?php echo  date('d/m/Y');?></div>
    </div>
</div>
<div class="row paragrafo">
    <div class="col-xs-12 col-md-12">
    <span style="font-size: medium;">
    Per verificare la qualità del corso di formazione e, nello specifico, alla lezione cui ha partecipato ed allo scopo di verificarne la sua efficacia,
    anche rispetto alle sue aspettative ed esigenze personali, la invitiamo a compilare in tutte le sue sezioni il seguente questionario. Le chiediamo di
    dare un voto da 1 a 5 ai vari punti sotto elencati tenendo presente che 1 è insufficiente e 5 è ottimo.<br>
        Il Questionario viene redatto in forma anonima. Grazie.
    </span>
    </div>
</div>
<div class="row paragrafo">
    <div class="col-xs-6 col-md-6"></div>
    <div class="col-xs-2 col-md-2"><span class="question">Insufficiente</span></div>
    <div class="col-xs-4 col-md-4"><span class="question" style="padding-left: 40px;">Ottimo</span></div>
</div>
<div class="form-group form-group-sm ">
    <?php $i=0;?>
    <?php foreach($this->domande as $domanda){?>
    <div class="row paragrafo questionrow">
        <div class="col-xs-6 col-md-6"><span class="question"><?php if($i==14) echo "<B>"; echo $domanda; if($i==14) echo "</B>";?></span></div>
        <div class="col-xs-6 col-md-6">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline<?php echo $i ?>1" name="customRadioInline<?php echo $i ?>" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline<?php echo $i ?>1">1</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline<?php echo $i ?>2" name="customRadioInline<?php echo $i ?>" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline<?php echo $i ?>2">2</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline<?php echo $i ?>3" name="customRadioInline<?php echo $i ?>" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline<?php echo $i ?>3">3</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline<?php echo $i ?>4" name="customRadioInline<?php echo $i ?>" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline<?php echo $i ?>4">4</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline<?php echo $i ?>5" name="customRadioInline<?php echo $i ?>" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline<?php echo $i ?>5">5</label>
            </div>


        </div>
    </div>
    <?php $i++;}?>
</div>

<div class="row paragrafo">
    <div class="col-xs-3 col-md-3"></div>
    <div class="col-xs-3 col-md-3"><button id="invia">INVIA</button></div>
    <div class="col-xs-3 col-md-3"></div>
</div>

<script type="text/javascript">

    var error=0;
    jQuery("#invia").click(function () {


        <?php $i=0;?>
        <?php foreach($this->domande as $domanda){?>
        if(jQuery('input[type=radio][name=customRadioInline<?php echo $i ?>]:checked').attr('id')) {
            var valore<?php echo $i ?>= jQuery('input[type=radio][name=customRadioInline<?php echo $i ?>]:checked').attr('id').toString().slice(-1);
            console.log(valore<?php echo $i ?>);
        }else{
            alert("non hai risposto alla domanda n.<?php echo $i+1; ?>");
            error=1;
        }
        <?php $i++;}?>

            if(error==0){
                jQuery.ajax({
                    method: "POST",
                    cache: false,
                    url: 'index.php?option=com_ggcm&task=questionario.insert&id_corso=<?php echo $this->id_corso ?>'+'&data=<?php echo  date('Y-m-d');?>'
                    <?php $i=1;?>
                    <?php foreach($this->domande as $domanda){?>
                        +"&risposta<?php echo $i ?>="+valore<?php echo $i-1 ?>
                    <?php $i++;}?>

            }).done(function () {

                    alert("inserimento riuscito");
                    location.reload();


               });
        }

    });



</script>
</html>
