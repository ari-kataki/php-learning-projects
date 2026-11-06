<!-- SINTASSI E BLOCCHI IMPORTANTI -->
<html>
    <body>
        <!-- SINTASSI GENERALI -->
        <?php
            //If-Else
            if($x == $y){
                
            }
            elseif($x != $y){
                
            }
            else{
                
            }

            //Ciclo For
            for($contatore = 0; $contatore <= 9; $contatore++){
            
            }

            //Definizione e Richiamo di una Funzione
            function nuovaFunzione($parametro){

            }
            nuovaFunzione($parametro);
        ?>


        <!-- BLOCCHI UTILI PER L'ESAME -->
        <?php
            //Controllare la presenza di una chiave e stamparla
            if (array_key_exists('lastname', $_POST)) {
                    echo $_POST['lastname'];
                
            }
                
            //Stampare un array con gli elementi del form
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo '<pre>'.print_r($_POST, true).'</pre>';
                //<pre> sta per "preformatted" e serve per stampare un array formattato come lista di elementi
            }
            
            //Stampare la data attuale
            echo date('d/m/Y');

            //Lista di anni che vanno dall'anno attuale al 1926
            for ($i = date('Y'); $i > 1926; $i--) {
                echo '<option value="'.$i.'">'.$i.'</option>';
            }     
            
            //Stampare una lista che va da Gennaio a Dicembre utilizzando la funzione mktime
            for ($month =  1; $month <= 12; $month++) {
                echo '<option value="'.$month.'">'.date('F', mktime(0,0,0,$month,1,2026)).'</option>';
            } 
        ?>
    </body>
</html>

<!-- Menu a tendina con Giorni, Mesi e Anni -->
<html>
    <body>
        <select name="birth-day" id="birth-day">
            <?php
                for ($i = 1; $i <= 31; $i++) {
                                
                    $selected = '';
                    if ($i == $_POST['birth-day']){
                        $selected = "selected=selected";
                    }
                    echo '<option value="'. $i .'"'. $selected .'>'. $i .'</option>';
                }       
            ?> 
        </select>

        <select name="birth-month" id="birth-month">
            <?php
                for ($month =  1; $month <= 12; $month++) {
                                
                    $selected = '';
                    if ($month == (int)$_POST['birth-month']){
                        $selected = "selected=selected";
                    }
                    echo '<option value="'. $month .'"'. $selected .'>'. date('F', mktime(0,0,0,$month,1,2026)) .'</option>';
                }       
            ?> 
        </select>

        <select name="birth-year" id="birth-year">
            <?php
                $currentYear = (int)date('Y');
                for ($i = $currentYear; $i > $currentYear - 100; $i--) {

                    $selected = '';
                    if ($i == $_POST['birth-year']){
                        $selected = "selected=selected";
                    }
                    echo '<option value="'. $i .'"'. $selected .'>'. $i .'</option>';
                }       
            ?> 
        </select>

        <div style="display:inline-block" id = "date-error"></div>

            <?php
                if (array_key_exists('birth-day', $_POST)) {
                    
                    $month = (int) $_POST['birth-month'];
                    $day = (int) $_POST['birth-day'];
                    $year = (int) $_POST['birth-year'];
                    if (checkdate($month, $day, $year) == false) {
                        echo '<span style="color: red"> Data non valida! </span>';
                    }
                }
            ?>
                
        </div>
    </body>
</html>


 <!-- CASELLA DI TESTO CON CONTROLLI SUL CONTENUTO -->
<html>
    <body>
       <form method="POST">
            <!-- Nello style c'è un php che definisce i bordi mentre nel value c'è un php che definisce il contenuto di default della casella -->
            <input 
                style="<?php 
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                        if(strlen(string: $_POST['lastname']) === 0){
                            echo 'border: 1px solid red';
                        }
                    }
                ?>"
            
                type="text" 
                name="lastname" 
                id="lastname"

                value="<?php 
                    if (array_key_exists('lastname', $_POST)) {
                        echo $_POST['lastname'];
                    } 
                ?>"
            />

            <?php
                if (array_key_exists('lastname', $_POST)) {
                    if ($_POST['lastname'] === "" || strlen($_POST['lastname']) < 3) {
                        echo '<span style="color: red"> Cognome non valido! </span>';
                    }
                }
            ?>
        </form>        
    </body>
</html>


<!-- ARRAY -->
<html>
    <body>
        <?php
            //Scrittura di un Array
            $array = [ 
                "Marco", 
                "Cognome" => " Mechelli ", 
                "Eta" => $somma
            ];
            echo $array[0];
            echo $array["Cognome"];
            echo $array["Eta"];

            //Stampo l'array utilizzando un ciclo
            for($i=0; $i < count($array); $i++){
                echo $array[$i];
            }

            //Varie Funzioni per gli Array
            print_r ($numeri);
            sort($numeri);
            rsort($numeri);
            array_push($numeri, 100);
            array_pop($numeri);
    
        
            //Varie Funzioni per Echo
            $stringa = 'Frase lunga per contare la sua lunghezza';
            echo strlen($stringa);

            $stringa = 'maiuscolo';
            echo strtoupper($stringa);

            $stringa = 'minuscolo';
            echo strtolower($stringa);

            $stringa = ' Rimuovere spazi bianchi prima e dopo ';
            echo trim($stringa);

            $stringa = 'Contare le parole della stringa';
            echo str_word_count($stringa);
        
            $stringa = 'Stringa al contrario';

            echo strrev($stringa);
            echo min(20, 32, 5, 100);
            echo max(20, 32, 5, 100);
            echo abs(-3);
            echo sqrt(49);
        ?>
    </body>
</html>

<!-- FORM ESEMPIO -->
<html>
    <form method = "POST" action = "Form.php">
        <label for = "nome"> Nome: </label>
        <input type = "text" id = "nome" name= "nome" placeholder = "Inserisci nome">

        <label for = "cognome"> Cognome: </label>
        <input type = "text" id = "cognome" name= "cognome" placeholder = "Inserisci cognome">
            
        <input type = "submit" value = "Invia">
    </form>
<!-- In questo esempio il form è collegato ad un file Form.php che contiene echo 'Ciao ' .$_POST['nome'].' '.$_POST['cognome']; -->
</html>

<!-- TUTTO CIO' CHE RIGUARDA DATA E ORA -->
<html>
    <body>
        <?php 
            /*  FUNZIONE DATE() e PARAMETRI
            Con la funzione date() possono lavorare su due parametri:
            - il timestamp che restituisce l'ora attuale basandosi sul tempo trascorso a partire dalla mezzanotte del 1 Gennaio del 1970;
            
            - il format permette di scegliere in che modo verrà mostrata la data posizionando giorno, mese e anno;

            Parametri di date():
            d = numero del giorno
            D = nome del giorno abbreviato
            l = nome del giorno completo
            m = numero del mese
            M = nome del mese
            y = anno con 2 cifre finali, 96
            Y = anno con 4 cifre, 1996

            h = ore in formato da 12
            H = ore in formato da 24
            i = minuti
            s = secondi
            a = am e pm in minuscolo
            A = AM e PM  in maiuscolo
        */


            $data = date('d-m-Y  H:i:s', time());
            echo 'Data attuale: '.$data;
            //Stampa la data attuale nel formato Giorno-Mese-Anno e l'ora attuale in Ore:Minuti:Secondi
            //time() serve proprio per andare a prendere l'orario esatto

            $data = mktime(12, 49, 00, 01, 31, 2026);
            echo 'Timestamp del 31 Gennaio 2026: '.$data;
            //mktime() serve per ottenere il timestamp di una data specifica

            $data = strtotime('31-10-1996');
            echo 'Timestamp del 31 Ottobre 1996: '.$data;
            //strtotime funziona come mktime ma ti permette di scrivere la data nel formato desiderato

            $data = date('d / m / Y', 846720000);
            echo $data;
            //Stampa una data specifica grazie al timestamp generato online

            $data = date('d-m-Y' , strtotime("now" . "+7 days"));
            echo 'Tra 7 giorni sarà il ' .$data
            //Somma delle date
        ?>
    </body>
</html>


<?php
require 'Includi.php';
include 'Includi.html'
?>