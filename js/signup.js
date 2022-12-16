let myInput=document.getElementById("psw");
let letter=document.getElementById("letter");
let capital=document.getElementById("capital");
let number=document.getElementById("number");
let length=document.getElementById("length");
let count=0;
myInput.onfocus=function(){
    document.getElementById("message").style.display="block";
}
document.getElementById('conpsw').onfocus=function(){
    document.getElementById("message").style.display="none";   
}
myInput.onkeyup=function(){
    let lowerCaseLetter=/[a-z]/g;
    let upperCaseLetter=/[A-Z]/g;
    let numbers=/[0-9]/g;
matchInput(letter,lowerCaseLetter);
matchInput(capital,upperCaseLetter);
matchInput(number,numbers);
if(myInput.value.length>=8){
    length.classList.remove("invalid");
    length.classList.add("valid");
    count=1;
}
else{
    length.classList.remove("valid");
    length.classList.add("invalid");
    count=0;
}    
}
function matchInput(entity,comp){
    if(myInput.value.match(comp)){
        entity.classList.remove("invalid");
        entity.classList.add("valid");
        count=1;
    }
    else{
        entity.classList.remove("valid");
        entity.classList.add("invalid");
        count=0;
    }
}
function validate(){
    let psw=document.getElementById('psw').value;
    let conpsw=document.getElementById('conpsw').value;
    if(psw!=conpsw){
        document.getElementById('message').innerHTML="<div class='invalid'><p>Mismatch !!Type down same password</p></div>";
        document.getElementById("message").style.display="block";
        return false;
    }
    if(count==0){
        return false;
    }
    else{
        return true;
    }
}