function SvgInliner() {
    document.querySelectorAll('img.svg').forEach(function(img){
        var imgID = img.id;
        var imgClass = img.className;
        var imgURL = img.src;

        fetch(imgURL).then(function(response) {
            return response.text();
        }).then(function(text){

            var parser = new DOMParser();
            var xmlDoc = parser.parseFromString(text, "text/xml");

            // Get the SVG tag, ignore the rest
            var svg = xmlDoc.getElementsByTagName('svg')[0];

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                svg.setAttribute('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
            svg.setAttribute('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            svg.removeAttribute('xmlns:a');

            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
            if(!svg.getAttribute('viewBox') && svg.getAttribute('height') && svg.getAttribute('width')) {
                svg.setAttribute('viewBox', '0 0 ' + svg.getAttribute('height') + ' ' + svg.getAttribute('width'))
            }

            // Replace image with new SVG
            img.parentNode.replaceChild(svg, img);

        });

    });
}

function ConsultasFilter() {
    $( "#filter-toggle" ).click(function() {
        this.classList.toggle("consultas-widget__filter-icon--active");
        $( "#filter-box" ).toggle( 500 , "swing" );
    });
}

function Accordion() {
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", ToggleAccordion);
    }
}

function ToggleAccordion() {
    var acc = document.getElementsByClassName("accordion");
    var j;
    for (j = 0; j < acc.length; j++) {
        if (acc[j] != this && !acc[j].classList.contains("editing"))
        {
        acc[j].classList.remove("accordion--active");
        acc[j].lastElementChild.style.maxHeight = null;
        }
    }
    this.classList.toggle("accordion--active");
    var panel = this.lastElementChild;
    if (panel.style.maxHeight){
        panel.style.maxHeight = null;
    } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
    } 
}





function FormatDate(date) {
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0!
    var yyyy = date.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    var formated = yyyy + '-' + mm + '-' + dd;
    return formated;
}





function htmlToText(html){
    //remove code brakes and tabs
    html = html.replace(/\n/g, "");
    html = html.replace(/\t/g, "");

    //keep html brakes and tabs
    html = html.replace(/<br>( )*/g, "\n"); 
    html = html.replace(/<br( )*\/>/g, "\n");

    html = html.replace(/ +/g, " ")

    return html;
}

function textToHtml(text){
    text = text.replace(/\n/g, "<br>");

    return text;
}

function Logout() {
    window.location.replace("/ServerScripts/refactored/Logout.php");
  }

function carregaClinicas(){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var clinicas = JSON.parse(this.responseText);
            
            
            var html = "";
            for (var i=0; i<clinicas.length; ++i) {
                html = html + "<option value='" + clinicas[i].cod + "'>" + clinicas[i].nome + "</option>";
            }
            document.getElementById("selectClinica").innerHTML = html;
            
        }
    };
    
    
    xmlhttp.open("GET", "/ServerScripts/refactored/CarregaClinicasLogin.php?", true);
    xmlhttp.send();
}

function mudaDeClinica(){
    var dd = document.getElementById("selectClinica");

    var codClinica = dd.options[dd.selectedIndex].value;

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload(); 
        }
    };
    
    var envio = "codClinica=" + codClinica;
    
    xmlhttp.open("GET", "/ServerScripts/refactored/MudaDeClinica.php?"+envio, true);
    xmlhttp.send();
}