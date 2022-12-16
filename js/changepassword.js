let myInput=document.getElementById("psw");
let letter=document.getElementById("letter");
let capital=document.getElementById("capital");
let number=document.getElementById("number");
let length=document.getElementById("length");
let count=0;
myInput.onfocus=function(){
    document.getElementById("message").style.display="block";
    document.getElementById("result").innerText=" "; 
}
document.getElementById('conpsw').onfocus=function(){
    document.getElementById("message").style.display="none";  
    document.getElementById("result").innerText=" "; 
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
        document.getElementById('message2').style.display="block";
        count=0;        
    }
    if(count==1){
        let x=new XMLHttpRequest();
        x.onreadystatechange=function(){
            if(this.status==200&&this.readyState==4){
                document.getElementById("message").style.display="none"; 
                document.getElementById("message2").style.display="none";     
                document.getElementById('result').innerHTML=this.responseText;

            }
        }
        x.open('POST','changepassword.php',true);
        x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        x.send('psw='+psw);


    }
    
}