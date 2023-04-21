function cargar(){
    var xhtpp=new XMLHttpRequest();
    xhtpp.onreadystatechange=function(){
        if(this.readyState==4 & this.status==200){
         document.getElementById("datos").innerHTML= this.responseText;

        }
    };
    xhtpp.open("GET","datos.txt",true);//mientras que sea FALSE sera sincrona y TRUE sera asicronico
    xhtpp.send()
}
 
function mensaje(){
   alert("Mientras carga el mensaje");     
}


 let btnCarga =document.getElementById("cargar");
 btnCarga.addEventListener("click",cargar);
 btnCarga.addEventListener("click",mensaje);