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



function EditarConsulta() {
    var btn = document.getElementsByClassName("consultas-widget__edit-btn");
    var i;

    for (i = 0; i < btn.length; i++) {
        btn[i].addEventListener("click", function() {
            

            if (this.classList.contains("active")) {
                this.parentElement.parentElement.parentElement.classList.toggle("editing");
                this.parentElement.parentElement.parentElement.addEventListener("click", ToggleAccordion);
                this.parentElement.click();
                this.lastElementChild.innerHTML = "Editar";

                

                var campos = this.parentElement.children;
                
                var receita = textToHtml(campos[0].lastElementChild.lastElementChild.value);
                var recomen = textToHtml(campos[1].lastElementChild.lastElementChild.value);
    
                campos[0].lastElementChild.innerHTML = receita;

                campos[1].lastElementChild.innerHTML = recomen;
            }
            else {
                this.parentElement.parentElement.parentElement.classList.toggle("editing");
                this.parentElement.parentElement.parentElement.removeEventListener("click", ToggleAccordion);
                this.parentElement.parentElement.style.maxHeight = "500px";

                this.lastElementChild.innerHTML = "Salvar";
                var campos = this.parentElement.children;
    
                var receita = htmlToText(campos[0].lastElementChild.innerHTML.trim());
                var recomen = htmlToText(campos[1].lastElementChild.innerHTML.trim());
    
                campos[0].lastElementChild.innerHTML = "<textarea rows='10' cols='40'>" + receita + "</textarea>";

                campos[1].lastElementChild.innerHTML = "<textarea rows='10' cols='40'>" + recomen + "</textarea>";
            }

            this.classList.toggle("active");
            
        });
    }
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
