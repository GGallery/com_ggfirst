<!DOCTYPE html>
<html>

<head>

    <title>ISCRIZIONE TEMPLATE</title>

</head>
<body>
<table>
    <tr><td style="width: 100%;" align="center"><img src="{$data.content_path}/prima.png"></td><td><img src="{$data.content_path}/aifos.png"></td></tr>
</table>
<table>
    <tr><td style="width: 100%; text-align: center; font-size: x-small">SEDE REGIONALE   AIFOS Ente di Formazione Accreditato dalla Regione Liguria</td><td></td></tr>

    <tr><td style="width: 100%;text-align: center;font-size: x-small">Via I. Frugoni 15/5 • 16121 Genova • Tel. 010/ 09.80.790 fax 010/ 09.80.791</td><td></td></tr>

    <tr><td style="width: 100%;text-align: center;font-size: x-small; color: #0E2883;">www.webprima.it – www.primaelearning.it</td><td></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: medium; color:black; padding-top: 10px;">SCHEDA DI ISCRIZIONE</td><td></td></tr>
</table>
<table >
    <tr><td style="width: 5%;"></td>
        <td border="1" style="width: 90%;text-align: center;font-size: medium; color:black; padding-top: 10px;padding-bottom: 10px;color: #0E2883;">
            {$data.c_titolo}<BR>Valevole come aggiornamento: {$data.c_credito} {$data.c_ore}<br>({$data.c_riferimento_legislativo})
        </td><td></td>
        <td style="width: 5%;"></td>
    </tr>
</table>
<table>
    <tr><td style="width: 100%; text-align: center; font-size: medium;color:black;"><i>Il corso si terrà a Genova in via I. Frugoni 15/5</i></td><td></td></tr>

    <tr><td style="width: 100%;text-align: center;font-size: medium"><i>il {$data.c_data} {$data.c_orario}</i></td><td></td></tr>

    <tr><td style="width: 100%;text-align: center;font-size:medium ;"><i>COMPILARE IN STAMPATELLO</i> ED INVIARE ENTRO IL <i>{$data.c_data_scadenza}</i></td><td></td></tr>
    <tr><td style="width: 100%;text-align: center;font-size: x-small; color:black; padding-top: 10px;">via fax al n. 010 / 09.80.791 o via e-mail a: <SPAN style="color: #0E2883;">info@webprima.it</SPAN></td><td></td></tr>
</table>
<table style="margin-left: 5%; width: 90%;">
    <tr style="">
        <td style="width: 50%;">
            <table  style="width: 100%;" border="1">

                <tr><td colspan="2" style="width: 100%; text-align: center; ">DATI PARTECIPANTE</td></tr>
                <tr><td style="width: 35%;">*Nome</td><td style="width: 65%;">{$data.p_nome}</td></tr>
                <tr><td style="width: 35%;">*Cognome</td><td style="width: 65%;">{$data.p_cognome} </td></tr>
                <tr><td style="width: 35%;">*Luogo e Data di nascita</td><td style="width: 65%;">{$data.p_luogo_data_nascita}</td></tr>
                <tr><td style="width: 35%;">*CF</td><td style="width: 65%;">{$data.p_cf} </td></tr>
                <tr><td style="width: 35%;">*Titolo di studio</td><td style="width: 65%;">{$data.p_titolo}</td></tr>
                <tr><td style="width: 35%;">*Email</td><td style="width: 65%;">{$data.p_email} </td></tr>
                <tr><td style="width: 35%;">*Profilo Professionale</td><td style="width: 65%;">{$data.p_profilo}</td></tr>
                <tr><td style="width: 35%;">*Indicare la figura rappresentata</td>
                    <td style="width: 65%;">
                        <table  style="font-size: xx-small;padding-bottom: 2px;">
                            <tr><td>datore di lavoro <br><input type="checkbox" name="datore di lavoro " value="datore di lavoro " {if $data.p_figura=='datore di lavoro'}checked="checked"{/if}></td>
                                <td>ASP/RSPP<br><input type="checkbox" name="5" value="5" {if $data.p_figura=='ASP/RSPP'}checked="checked"{/if}></td>
                                <td>Dirigente<br><input type="checkbox" name="1" value="1" {if $data.p_figura=='Dirigente'}checked="checked"{/if}></td></tr>
                            <tr><td>RLS<br><input type="checkbox" name="2" value="2" {if $data.p_figura=='RLS'}checked="checked"{/if}></td>
                                <td>Preposto<br><input type="checkbox" name="3" value="4" {if $data.p_figura=='Preposto'}checked="checked"{/if}></td>
                                <td>Lavoratore<br><input type="checkbox" name="4" value="4" {if $data.p_figura=='Lavoratore'}checked="checked"{/if}></td></tr>
                        </table>
                    </td>
                </tr>



            </table>
        </td>
        <td style="width: 50%;">
            <table style="margin-left: 5%;width: 110%;" border="1">

                <tr><td colspan="2" style="width: 100%; text-align: center; ">DATI FATTURAZIONE</td></tr>
                <tr><td style="width: 35%; font-size: x-small;">*Ragione sociale/Libero Prof.</td><td style="width: 65%;">{$data.f_ragione_sociale}</td></tr>
                <tr><td style="width: 35%; font-size: x-small;">*P.IVA</td><td style="width: 65%;">{$data.f_piva} </td></tr>
                <tr><td style="width: 35%; font-size: x-small;">*CF(se diverso da P.IVA)</td><td style="width: 65%;">{$data.f_cf}</td></tr>
                <tr><td style="width: 35%; font-size: x-small;">*CODICE UNIVOCO</td><td style="width: 65%;">{$data.f_codice_univoco} </td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*PEC</td><td style="width: 65%;">{$data.f_pec}</td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*Indirizzo Sede Legale</td><td style="width: 65%;">{$data.f_indirizzo} </td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*Comune e Provincia</td><td style="width: 65%;">{$data.f_comune_provincia}</td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*Telefono fisso/FAX</td><td style="width: 65%;">{$data.f_tel_fax}</td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*Referente aziendale</td><td style="width: 65%;">{$data.f_referente}</td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*Email referente</td><td style="width: 65%;">{$data.f_email_referente}</td></tr>
                <tr><td style="width: 35%;font-size: x-small;">*Codice ATECO</td><td style="width: 65%;">{$data.f_ateco}</td></tr>
            </table>
        </td>
    </tr>
</table>
<table>
    <tr><td style="width: 100%;text-align: left;font-size:medium ;"><b><i>*CAMPI OBBLIGATORI</i></b> <span style="font-size: xx-small;">per rilascio attestati (come da normativa), fatturazione e comunicazioni</span></td><td></td></tr>
    <tr><td style="width: 100%;text-align: left;font-size:medium ;">IL PARTECIPANTE AL CORSO dichiara di aver preso visione delle informazioni generali, del programma e delle date del corso e delle modalità organizzative e:</td><td></td></tr>
    <tr><td style="width: 100%;text-align: left;font-size:medium ;">•	CHIEDE di essere iscritto al corso di formazione “{$data.c_titolo}” (N. {$data.c_ore})</td><td></td></tr>
    <tr><td style="width: 100%;text-align: left;font-size:medium ;">_____________________________________________________________________________________________</td><td></td></tr>
    <tr><td style="width: 50%;text-align: left;font-size:xx-small ;">luogo e data</td><td style="width: 50%;text-align: left;font-size:xx-small ;">firma partecipante</td></tr>
    <tr><td style="width: 100%;text-align: left;font-size:x-small;"><b>•	AUTORIZZA PRIMA Training & Consulting srl ad inserire i presenti dati personali nella propria banca dati onde consentire il regolare svolgimento del rapporto contrattuale, per assolvere ad obblighi di natura contabile, civilistica e fiscale, per effettuare operazioni connesse alla formazione e all’organizzazione interna (registrazione partecipanti, accoglienza e assistenza, orientamento didattico, rilascio attestato e libretto curriculum), per favorire tempestive segnalazioni inerenti ai servizi e alle iniziative di formazione
                (consenso al trattamento dei dati personali ai sensi del Regolamento Europeo 679 del 2016).</b></td><td></td></tr>
    <tr><td style="width: 100%;text-align: left;font-size:medium ;">_____________________________________________________________________________________________</td><td></td></tr>
    <tr><td style="width: 50%;text-align: left;font-size:xx-small ;">luogo e data</td><td style="width: 50%;text-align: left;font-size:xx-small ;">firma partecipante</td></tr>
</table>

<table border="1">
    <tr><td style="text-align: center;"><b>MODALITA' DI PAGAMENTO:</b> <span style="font-size: x-small;"><i>entro 5 giorni l'inizio del corso</i> tramite<i> assegno</i> N.T. intestato a:</span>
    <br>PRIMA Training & Consulting srl o bonifico da accreditarsi a: PRIMA Training & Consulting srl
    <br>IBAN: IT 57 P 05034 01428 0000 0000 0368</td></tr>


</table>

</body>

</html>