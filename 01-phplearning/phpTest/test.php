<?php 

//$index_test = 100; 
//$index = false; 
//$INDEX = 100; 
// $index-test = 100; 
//if($index === 100){  
// $index = true; 
//} else { 
//} 
//0 == false; // -> vero 
//0 === false; // -> falso 
//for ($i = 0; $i<10; $i++){ 
// echo $i; 
//} 


if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

    echo '<pre>' . print_r($_POST, true) . '</pre>'; //stampo una stringa che è un array formattata 

//if(array_key_exists('lastname', $_POST)){ //verifica se la chiave esiste 

// echo $_POST['lastname']; 

//} 

} 

?> 

<html> 
    <head>  

    </head> 

<body> 

    <form method="post"> 

    <div> 

        <label>Cognome</label> 

    <input  type="text" name="lastname">

    value="<?php  

    if(array_key_exists('lastname',$_POST)){ 

    echo $_POST['lastname']; 

    }  

?>" 

/> 

    </div> 

<div> 

    <label>Nome</label> 

<input  type="text"  name="firstname" value=>

<?php  
    if(array_key_exists('firstname',$_POST)){ 

    echo $_POST['firstname']; 

    }  

        ?>" 

    /> 

</div> 

<div> 

    <label>Data di nascita</label> 

    <select name="birth-day"> 

<?php 

//ottimizzato 

for ($i=1; $i<=31; $i++){ 

    $sel = ""; 

if ($i === (int) $_POST['birth-day']){ 

    $sel = "selected=selected"; 

        } 

    echo '<option value="' .$i. '"' .$sel. '>' .$i. '</option>'; 

        } 
    
    ?> 

</select> 


    <select name="birth-month"> 

<?php 

for ($month=1; $month<=12; $month++){ 

    $sel = ""; 

if($month === (int) $_POST['birth-month']){ 

    $sel = "selected=selected"; 

        } 

    echo '<option value="' .$month. '"'.$sel.'>' .date('F', mktime(0,0,0,$month,1,2026)). '</option>'; 

} 

?>  

</select> 

<?php //echo date('d/m/Y') ?> 

<select name="birth-year"> 
    <?php  

$currentYear = (int) date('Y'); 
    for ($i= $currentYear; $i>$currentYear-100; $i--){ 

    $sel = ""; 

        if($i === (int) $_POST['birth-year']){ 

        $sel = "selected=selected"; 

        } 

        echo '<option value="' .$i. '"' .$sel. '>' .$i. '</option>'; 

        } 

    ?> 

    </select> 

</div> 

<div> 

    <label>height</label> 

    <select name="height"> 

<?php  

    for ($height = 150; $height <= 200; $height++) { 

    echo '<option value="' . $height . '">' . number_format($height / 100, 2, '.', '') . ' m</option>'; 

    } 

?> 

</select> 

</div> 
<div> 
    <label>Data di scadenza</label> 

    <select name="expiry-day"> 

<?php 

    for ($i=1; $i<=31; $i++){ 

    echo '<option value="' .$i. '">' .$i. '</option>'; 

} 

?> 

</select> 

 

<select name="expiry-month"> 

<?php 

    for ($month=1; $month<=12; $month++){ 

    echo '<option value="' .$month. '">' .date('F', mktime(0,0,0,$month,1,2026)). '</option>'; 

} 

?>  

</select> 

<?php //echo date('d/m/Y') ?> 

    <select name="expiry-year"> 

<?php  

    $currentYear = (int) date('Y'); 

    for ($i= $currentYear; $i<=$currentYear+10; $i++){ 

    echo '<option value="' .$i. '">' .$i. '</option>'; 

    } 

    ?> 

        </select> 

            </div> 

 

            <input type="submit" value="Invia"/> 

        </form> 
    </body> 
</html> 