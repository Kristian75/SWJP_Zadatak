var x;
var y;

function uhvatiPozicijuMisa(e) {
    x = e.clientX;
    y = e.clientY;
}

function dohvatiDojmove(str) {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (xmlhttp.readyState == 4) {
         document.getElementById('divRezultat').innerHTML = xmlhttp.responseText;
     }
   };
   xmlhttp.open("GET", "dohvatiDojmove.php?str=" + str, true);
   xmlhttp.send(null);
}

var timer;
function selektirajDojam(d, id) {
    window.clearTimeout(timer);
    d.style.backgroundColor = 'orange';
    timer = setTimeout(() => prikaziDetalje(id), 2000);
}

function deselektirajDojam(d) {
    ukloniDetalje();
    d.style.backgroundColor = '';
    window.clearTimeout(timer);
}

function prikaziDetalje(id) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
     if (xmlhttp.readyState == 4) {
        var divDetalji = document.getElementById('divDetalji');
        divDetalji.innerHTML = xmlhttp.responseText;
        divDetalji.style.left = x + 1 + 'px';
        divDetalji.style.top = y + 'px';
        divDetalji.style.visibility = 'visible';
     }
    };
    xmlhttp.open("GET", "dohvatiDojam.php?id=" + id, true);
    xmlhttp.send(null);
}

function ukloniDetalje() {
    document.getElementById('divDetalji').style.visibility = "hidden";
}

function kapitaliziraj(input) {
    if (input && input.value) {
        input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1).toLowerCase();
    }
}


function dodajDojam() {
   var txtImePrezime = document.getElementById('txtImePrezime');
   var txtEmail = document.getElementById('txtEmail');
   var txtTekst = document.getElementById('txtTekst');

   if(txtImePrezime.value == '') {
        alert('Niste unijeli Vaše ime i prezime!');
        txtImePrezime.focus();
        return false;
   }

   if(txtEmail.value == '') {
    alert('Niste unijeli Vaš email!');
    txtEmail.focus();
    return false;
}

   var atpos = txtEmail.value.indexOf("@");
   var dotpos = txtEmail.value.lastIndexOf(".");
   if (txtEmail.value && (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= txtEmail.value.length)) {
        alert("Niste unijeli ispravnu e-mail adresu!");
        txtEmail.focus();
        return false;
   }

   if(txtTekst.value.length > 1000) {
        alert('Unijeli ste predugi tekst! Maksimalno 1000 znakova.');
        txtTekst.focus();
        return false;
   }

   xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (xmlhttp.readyState == 4) {
         alert(xmlhttp.responseText);
         txtImePrezime.value = '';
         txtEmail.value = '';
         txtTekst.value = '';
         dohvatiDojmove(document.getElementById('txtPretraga').value);
     }
   };
   xmlhttp.open("GET", "/knjiga_dojmova/dodajDojam.php?imePrezime=" + txtImePrezime.value + "&eMail=" + txtEmail.value + "&tekst=" + txtTekst.value, true);
   xmlhttp.send(null);
}
