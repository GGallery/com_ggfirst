
<style>

    #container #attestato div {
    }



    #attestato {
        position: absolute;
        top:15%;
        text-align:left;
        width: 80%;
    }
    h1 {
        color: navy;
        font-family: times;
        font-size: 24pt;

    }
    p {
        color: #000;
        font-family: times;
        font-size: 9pt;
        padding: 5pt;
    }

    td{
        padding-top: 40px;
        white-space:nowrap;
    }

    body {
        border: 5px solid red;
    }

</style>

<head>

    <title>ISCRIZIONE TEMPLATE</title>

</head>
<body>
<table>
    <tr><td style="width: 25%"></td><td style="width: 25%"></td><td style="width: 25%"></td><td style="width: 25%"><img src="{$data.content_path}/aifos.png"></td></tr>
    <tr><td style="width: 30%"></td><td style="width: 30%"><img src="{$data.content_path}/prima.png"></td><td style="width: 30%"></td></tr>


</table>
<table>
    <tr><td style="width: 100%; text-align: center; font-size: medium"><b>ENTE DI FORMAZIONE</b></td></tr>

    <tr><td style="width: 100%;text-align: center;font-size: medium;"><b>ACCREDITATO DALLA REGIONE LIGURIA</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>ATTESTATO DI PARTECIPAZIONE</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: x-large;"><i>Si attesta che</i></td></tr>
    <tr><td style="width: 100%;text-align: center;"><h1>{$data.p_nome} {$data.p_cognome}</h1></td></tr>
    <tr><td style="width: 100%;text-align: center;"><i>Nato a {$data.p_luogo_nascita} il {$data.p_data_nascita}</i></td></tr>
    <tr><td style="width: 100%;text-align: center;"><i><!--{$data.p_profilo_professionale}--></i></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: x-large;"><i>ha frequentato e superato il test finale di apprendimento</i></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: x-large;"><i>del corso di</i></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><h1>{$data.c_titolo}</h1></td></tr>
    <tr><td style="width: 100%;text-align: center;"><h3>Settore {$data.c_settore} - classe di rischio {$data.c_rischio_attestato}</h3></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;"><i><h5>{$data.c_riferimento_legislativo}</h5></i></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;"><B><i>della durata di ore {$data.c_durata} realizzato il giorno {$data.c_data}</i></B></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;"><B><i>c/o PRIMA Training & Consulting srl</i></B></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;"><B><i>Il corso è organizzato e certificato da</i></B></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;padding-top: 15px;"><B>PRIMA Training & Consulting srl</B></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;padding-top: 0px;"><B>ENTE DI FORMAZIONE ACCREDITATO</B></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;padding-top: 0px;"><B>DALLA REGIONE LIGURIA (D.M. 166/01)</B></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium;">Via I. Frugoni 15/5 • 16121 Genova • Tel. 010/ 09.80.790 fax 010/ 09.80.791</td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: x-small; color: #0E2883;">www.webprima.it – www.primaelearning.it</td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: xx-large;"><b>&nbsp;</b></td></tr>
    
</table>
<table>
    <tr>
        <td style="width:60%;text-align: left;font-size: x-large; ">Genova, {$data.c_data_oggi} <br>N. Protocollo {$data.a_numero}</td>

        <td style="width:40%;font-size: x-large; padding-left: 100px;">PRIMA Training & Consulting srl<br><b>Dott.ssa Priscilla Dusi</b><br><img src="{$data.content_path}/drusi.png"></td>
    </tr>
</table>
<footer></footer>
<br pagebreak="true"/>
<TABLE><TR><TD style="width:100%;font-size: xx-large;padding-left: 50%;;"><B>PROGRAMMA DEL CORSO</B></TD></TR></TABLE>
{$data.c_programma}
<!-- ABILITARE LA SEGUENTE RIGA PER VISUALIZZARE LE VARIABILI -->
<!--{$data|@var_dump}-->

