var deleteid;
var deletetype;
var ajaxconnection;
var loading = 0;
var ajaxconnection2;
var loading2 = 0;
var ajaxconnection3;
var loading3 = 0;
var postto;
var ajaxconnection4;
var loading4 = 0;
var ajaxconnection5;
var loading5 = 0;

function toggle(id)
{
	var x = document.getElementById(id);
	if(x.style.display == 'block')
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "block";
	}
}

function hide(id)
{
	document.getElementById(id).style.display = "none";
}

function showmodal(id, type)
{
	document.getElementById("modal").style.display = "block";
	deleteid = id;
	deletetype = type;
}

function showedit(id, type)
{
	document.getElementById("modaledit").style.display = "block";
	deleteid = id;
	deletetype = type;
}

function enter(e, id)
{
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 13)
	{
 		switch(id)
 		{
 			case 1:
 				search('searchmyproducts', 'list', 1);
 				break;

 			case 2:
 				search('searchmyoffers', 'list', 2);
 				break;

 			case 3:
 				search('searchproduct', 'list', 3);
 				break;

 			case 4:
 				search('searchoffers', 'list', 4);
 				break;

 			case 5:
 				search('searchproviders', 'list', 5);
 				break;

 			default:
 				break;
 		}
	}
}


function modify()
{
	var edittime = document.getElementById("edittime").value;
	var editprice = document.getElementById("editprice").value;
	if(editprice < 0 || editprice.length == 0 || isNaN(editprice))
	{
		document.getElementById("editprice").style.border = "1px solid #ff7675";
		return;
	}
	else
	{
		document.getElementById("editprice").style.border = "1px solid green";
	}
	if(edittime < 0 || edittime.length == 0 || isNaN(edittime))
	{
		document.getElementById("edittime").style.border = "1px solid #ff7675";
		return;
	}
	else
	{
		document.getElementById("edittime").style.border = "1px solid green";
	}
	if (loading5 == 0)
	{
		if (window.XMLHttpRequest)
		{
			ajaxconnection5 = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{
			ajaxconnection5 = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Problema con la conexión");
			return false;
		}

		var url = "actions/editoffer.php?data1=" + deleteid + "&data2=" + editprice + "&data3=" + edittime;

		ajaxconnection5.onreadystatechange = getdata5;
		ajaxconnection5.open("GET", url, true);
        ajaxconnection5.send();
    }
    else
    {
       	alert("Espere a terminar la carga");
    }
}

function getdata5()
{
	if (ajaxconnection5.readyState == 4)
	{
		if (ajaxconnection5.status == 200)
		{
			hide("modal");
			location.reload(); 
		}
		else
		{
			alert("Problema al traer datos");
		}
		loading5 = 0;
	}
	else
	{
		loading5 = 1;
	}
}

function drop()
{
	if (loading == 0)
	{
		if (window.XMLHttpRequest)
		{
			ajaxconnection = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{
			ajaxconnection = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Problema con la conexión");
			return false;
		}

		var url = "actions/delete.php?data1=" + deleteid + "&data2=" + deletetype;

		ajaxconnection.onreadystatechange = getdata;
		ajaxconnection.open("GET", url, true);
        ajaxconnection.send();
    }
    else
    {
       	alert("Espere a terminar la carga");
    }
}

function getdata()
{
	if (ajaxconnection.readyState == 4)
	{
		if (ajaxconnection.status == 200)
		{
			hide("modal");
			location.reload(); 
		}
		else
		{
			alert("Problema al traer datos");
		}
		loading = 0;
	}
	else
	{
		loading = 1;
	}

}

function switchforms(id)
{
	if(id == 'product')
	{
		document.getElementById(id).style.display = "block";
		document.getElementById("offer").style.display = "none";
	}
	else if(id == 'offer')
	{
		document.getElementById(id).style.display = "block";
		document.getElementById("product").style.display = "none";
	}
}

function updateprofile()
{
	var uname = encodeURIComponent(document.getElementById("uname").value);
	var udescription = encodeURIComponent(document.getElementById("udescription").value);
	var ulocation = encodeURIComponent(document.getElementById("ulocation").value);
	var utelephone1 = encodeURIComponent(document.getElementById("utelephone1").value);
	var utelephone2 = encodeURIComponent(document.getElementById("utelephone2").value);
	var ucellphone1 = encodeURIComponent(document.getElementById("ucellphone1").value);
	var ucellphone2 = encodeURIComponent(document.getElementById("ucellphone2").value);
	var ucontactemail = encodeURIComponent(document.getElementById("ucontactemail").value);
	var uwebsite = encodeURIComponent(document.getElementById("uwebsite").value);
	if (loading2 == 0)
	{
		if (window.XMLHttpRequest)
		{
			ajaxconnection2 = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{
			ajaxconnection2 = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Problema con la conexión");
			return false;
		}

		var url = "actions/updateprofile.php?data1=" + uname + "&data2=" + udescription + "&data3=" + ulocation + "&data4=" + utelephone1 + "&data5=" + utelephone2 + "&data6=" + ucellphone1 + "&data7=" + ucellphone2 + "&data8=" + ucontactemail + "&data9=" + uwebsite;

		ajaxconnection2.onreadystatechange = getdata2;
		ajaxconnection2.open("GET", url, true);
        ajaxconnection2.send();
    }
    else
    {
       	alert("Espere a terminar la carga");
    }
}

function getdata2()
{
	if (ajaxconnection2.readyState == 4)
	{
		if (ajaxconnection2.status == 200)
		{
			location.reload(); 
		}
		else
		{
			alert("Problema al traer datos");
		}
		loading2 = 0;
	}
	else
	{
		loading2 = 1;
	}

}

function submitform(id)
{
	var input1 = document.getElementById(id).elements[0];
	var input2 = document.getElementById(id).elements[1];
	var input3 = document.getElementById(id).elements[2];
	var value1 = input3.value.replace(" ", "");
	
	if(id == 'form3')
	{
		var input4 = 1234;
	}
	else
	{
		var input4 = document.getElementById(id).elements[4];
		var value2 = input4.value.replace(" ", "");
	}

	if(id == 'form2')
	{
		var input5 = document.getElementById(id).elements[5];
		var input6 = document.getElementById(id).elements[6];
		var value3 = input5.value.replace(" ", "");
		var value4 = input6.value.replace(" ", "");
	}

	var error1, error2, error3, error4, error5, error6;

	if(input1.value.length == 0)
	{
		input1.style.border = "1px solid #ff7675";
		error1 = true;
	}
	else
	{
		input1.style.border = "1px solid green";
		error1 = false;
	}

	if(input2.value.length == 0)
	{
		input2.style.border = "1px solid #ff7675";
		error2 = true;
	}
	else
	{
		input2.style.border = "1px solid green";
		error2 = false;
	}

	if(input3.value.length == 0 || isNaN(value1))
	{
		input3.style.border = "1px solid #ff7675";
		input3.value = value1;
		error3 = true;
	}
	else
	{
		input3.style.border = "1px solid green";
		input3.value = value1;
		error3 = false;
	}

	
	if(id == 'form3')
	{
		error4 = false;
	}
	else
	{
		if(input4.value.length == 0 || isNaN(value2))
		{
			input4.style.border = "1px solid #ff7675";
			input4.value = value2;
			error4 = true;
		}
		else
		{
			input4.style.border = "1px solid green";
			input4.value = value2;
			error4 = false;
		}
	}

	if(id == 'form2')
	{
		if(input5.value.length == 0 || isNaN(value3))
		{
			input5.style.border = "1px solid #ff7675";
			input5.value = value3;
			error5 = true;
		}
		else
		{
			input5.style.border = "1px solid green";
			input5.value = value3;
			error5 = false;
		}
		
		if(input6.value.length == 0 || isNaN(value4))
		{
			input6.style.border = "1px solid #ff7675";
			input6.value = value4;
			error6 = true;
		}
		else
		{
			input6.style.border = "1px solid green";
			input6.value = value4;
			error6 = false;
		}
	}

	if(id == 'form2')
	{
		if(error1 == false && error2 == false && error3 == false && error4 == false && error5 == false && error6 == false)
		{
			document.getElementById("submit2").disabled = true;
			document.getElementById(id).submit();
		}
	}
	else if(id == 'form1')
	{
		if(error1 == false && error2 == false && error3 == false && error4 == false)
		{
			document.getElementById("submit1").disabled = true;
			document.getElementById(id).submit();
		}
	}
	else
	{
		if(error1 == false && error2 == false && error3 == false)
		{
			document.getElementById("submit1").disabled = true;
			document.getElementById(id).submit();
		}
	}
}

// TIPOS:
// 1) Mis Productos
// 2) Mis Ofertas
// 3) Productos (clientes)
// 4) Ofertas (clientes)
// 5) Proveedores (clientes)

function search(from, to, type)
{
	var datafrom = document.getElementById(from).value;
	postto = to;
	if (loading3 == 0)
	{
		if (window.XMLHttpRequest)
		{
			ajaxconnection3 = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{
			ajaxconnection3 = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Problema con la conexión");
			return false;
		}

		var url = "actions/search.php?data1=" + datafrom + "&type=" + type;
		console.log(from);
		console.log(to);
		console.log(type);
		console.log(url);
		console.log(datafrom);
		
		ajaxconnection3.onreadystatechange = getdata3;
		ajaxconnection3.open("GET", url, true);
        ajaxconnection3.send();
    }
    else
    {
       	alert("Espere a terminar la carga");
    }
}

function getdata3()
{
	if (ajaxconnection3.readyState == 4)
	{
		if (ajaxconnection3.status == 200)
		{
			document.getElementById(postto).innerHTML = ajaxconnection3.responseText;
		}
		else
		{
			alert("Problema al traer datos");
		}
		loading3 = 0;
	}
	else
	{
		loading3 = 1;
	}

}

// ARREGLAR
function reset(id)
{
	if (loading4 == 0)
	{
		if (window.XMLHttpRequest)
		{
			ajaxconnection4 = new XMLHttpRequest();
		}
		else if (window.ActiveXObject)
		{
			ajaxconnection4 = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Problema con la conexión");
			return false;
		}

		var url = "../actions/reset.php?data1=" + id;
		ajaxconnection4.onreadystatechange = getdata4;
		ajaxconnection4.open("GET", url, true);
        ajaxconnection4.send();
    }
    else
    {
       	alert("Espere a terminar la carga");
    }
}

function getdata4()
{
	if (ajaxconnection4.readyState == 4)
	{
		if (ajaxconnection4.status == 200)
		{
			location.reload();
		}
		else
		{
			alert("Problema al traer datos");
		}
		loading4 = 0;
	}
	else
	{
		loading4 = 1;
	}

}

function modificar(id){
		
		var id = id;
		var valor = '#price'+id;
		var price = $(valor).val();
		console.log(price);
		$.ajax({
			data:  {"id": id , "price" : price },
			url:   '../actions/editarticle.php',
			type:  'post',
			success:  function (response) {
				location.reload();
			}
		});
	}