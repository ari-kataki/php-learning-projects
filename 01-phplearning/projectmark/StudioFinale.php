<!--      COMMENTI IN HTML                   -->
<!--      /* COMMENTI IN CSS */              -->
<!--      //COMMENTI IN PHP e JAVASCRIPT     -->


 <html>
    <head>
        <title>Studio Finale</title>

        <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="./Studio.css">
    </head>

    <body>
        <form>
            <!-- FRAME ESTERNO -->
            <div class="frame">

                <!-- PRIMA RIGA -->
                <div class="row">

                    <!-- BLOCCO TESTO -->
                    <div class="top">

                        <input 
                        type="text" 
                        id="firstname"
                        placeholder="Inserisci un Nome" 
                        class="name firstname"
                        >
                    </div><!--
                    --><div class="top">

                            <input 
                            type="text" 
                            id="lastname"
                            placeholder="Inserisci un Cognome" 
                            class="name lastname"
                            >
                        </div>

                </div>

                <!-- SECONDA RIGA -->
                <div class="row">
                    <div class="main sex">
                        
                        <button id="male" class="but" type="button"> M </button>

                        <button id="female" class="but" type="button"> F </button>
                       
                    </div><!--

                    --><div id="display" class="main display">
                        <div class="displaysector" id="nomeCompleto"></div>
                        <div class="displaysector" id="sesso"></div>
                        <div class="displaysector" id="age"></div>
                    </div><!--
                    
                    
                    --><div class="main age">
                            <select id="age" class="select" onclick="inserisciEta()">
                                <option value=""></option>
                                <option>29</option>
                            </select>
                    </div>
                </div>

                <!-- TERZA RIGA -->
                <div class="row bottom">
            
                    <button id="submit" class="submit" type="submit" 
                    onclick="insertData()">INVIA</button>

                </div>

            </div>
        </form>

        <script>
            function insertData(){
                const nome = document.getElemntbyid('firstname').value;

                const cognome = document.getElemntbyid('lastname').value;

            document.getElemntbyid('nomeCompleto').innerText =  nome + " " + cognome;

            document.getElemntbyid('nomeCompleto').innerText =  nome + " " + cognome;
            
            }

            fuinction inserisciEta(){
                 const eta = document.getElemntbyid('age').innerText = eta;

                 document.getElementbyId('eta').innerText = eta;
                

            }
            fuinction inserisciSesso(SexID){
                if(sexID == 'male') {
                    const eta = document.getElemntbyid('male').value;

                    document.getElementbyId('sesso').innerText = 'male';
                }
                else{
                    const eta = document.getElemntbyid('female').value;

                    document.getElementbyId('sesso').innerText = 'female' ;

                }


            }
        
        </script>
    </body>
 </html>
