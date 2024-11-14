function calcul(k, l){
    return k*l;
}


function enterDigit(){
    let person = prompt("Entrez un nombre", 10);

    if(isNaN(person)){
        alert("Il faut un chiffre !");
        enterDigit();
    }else{
        
        for(let i = 1; i < 11; i++){
            console.log(`${i} * ${person} = ${calcul(person, i)}`);
        }
    }
    
}

enterDigit();

