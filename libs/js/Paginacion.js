/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function paginacionAjax(NumPagina)
{
     
    var objetoAjx=new XMLHttpRequest();
    objetoAjx.open("GET","?paginaProd="+NumPagina,true);
    objetoAjx.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    objetoAjx.onreadystatechange=function()
    {
        if(objetoAjx.readyState==4 && objetoAjx.status==200)
        {   
            document.getElementById("imgInicio").innerHTML= objetoAjx.responseText;
        }
    }
    objetoAjx.send(null);
}

function mostrarSelect(code)
{
    var objetoAjx=new XMLHttpRequest();
    objetoAjx.open("GET","?codeCat="+code,true);
    objetoAjx.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    objetoAjx.onreadystatechange=function()
    {
        if(objetoAjx.readyState==4 && objetoAjx.status==200)
        {   
            document.getElementById("imgInicio").innerHTML= objetoAjx.responseText;
        }
    }
    objetoAjx.send(null);
}

function mantenerCheckbox()
{
   
}