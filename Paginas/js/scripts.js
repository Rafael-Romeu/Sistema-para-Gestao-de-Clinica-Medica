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


function CarregaMedicos2(medicos) {

    function DisplayMedicos(medicos, div) {
        var html = "";

        if (medicos === undefined || medicos.length == 0)
        {
            html += "<p><br>Não foi encontrado um médico com esses parâmetros.</p>";
        }
        else {
            for (const m of medicos) {
                html += "<label> <input type='radio' name='medico' value='" + m.cpf + "' class='medico-select-widget__medico-radio' onclick='MostraSelecionados()'> <div  class='medico-select-widget__medico-card card'> <div><b>Nome:</b> " + m.nome + "</div><div><b>Especialidade: </b>" + m.esp + "</div></div></label>";
            }
        }
        div.innerHTML = html;
    }

    function FilterMedicos(medicos, nome, esp) {
        var result = [];
        for (const m of medicos) {
            if (m.nome.toUpperCase().includes(nome.toUpperCase()) && m.esp.toUpperCase().includes(esp.toUpperCase()))
            {
                result.push(m);
            }
        }
        return result;
    }

    
    var div = document.getElementById("medico-select-widget__medicos");
    
    var nomeInput = document.getElementById("filter-nome");
    var espInput =  document.getElementById("filter-esp");

    nomeInput.addEventListener("input", function(e) {
        var filtered = FilterMedicos(medicos, this.value, espInput.value);
        DisplayMedicos(filtered, div);
    });

    espInput.addEventListener("input", function(e) {
        var filtered = FilterMedicos(medicos, nomeInput.value, this.value);
        DisplayMedicos(filtered, div);
    });

    var filtered = FilterMedicos(medicos, "", "");
    DisplayMedicos(filtered, div);
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


function horarios(date) {

    function getPreviousMonday(dateOrigin)
    {
        var date = new Date(dateOrigin);
        var day = date.getDay();
        var prevMonday;
        if(date.getDay() == 0){
            prevMonday = new Date().setDate(date.getDate() - 7);
        }
        else{
            prevMonday = new Date().setDate(date.getDate() - day);
        }

        return addDays(prevMonday,1);
    }

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    } 

    function getPreviousWorkWeek(dateOrigin) {
        var dates = [];
        var monday = getPreviousMonday(dateOrigin);
        
        for (var i=0; i<5; ++i){
            dates.push(addDays(monday, i));
        }
        return dates;
    }

    function showDays(days) {
        document.getElementById("cal-seg").innerHTML = days[0].getDate();
        document.getElementById("cal-ter").innerHTML = days[1].getDate();
        document.getElementById("cal-qua").innerHTML = days[2].getDate();
        document.getElementById("cal-qui").innerHTML = days[3].getDate();
        document.getElementById("cal-sex").innerHTML = days[4].getDate();
    }

    

    function formatTime(time) {
        var horarioTable = ["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30"];
        return horarioTable[time];
    }

    if (date === undefined) {
        date = new Date();
    }
    else {
        date = new Date(date);
    }

    var dates = getPreviousWorkWeek(date);

    showDays(dates);

    var horarios = [
        "0000000000000000000000",
        "0101010101010101010101",
        "1010101010101010101010", 
        "0001110001110001110001",
        "0110101010101010101010"
    ];

    


    var rows = document.getElementById("horario-select-widget__agenda").children[0].children;

    for (var i=0; i<horarios[0].length; ++i) {

        for (var j=0; j<5; ++j) {
            var d = rows[i+1].children[j+1].children[0].children[0];
            
            if (horarios[j][i] === "0") {
                d.disabled=true;
            }
            d.checked=false;
            d.value=FormatDate(dates[j]) + " " + formatTime(i);
        }

    }




}

$( function DatePicker() {
    var dp = $( "#datepicker" ).datepicker({
        inline: true,
        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        nextText: '>',
        prevText: '<',
        onSelect: function(date) {
            horarios(date);
        }
    });
} );


function MostraSelecionados(){
    var medInput = $("input[type='radio'][name='medico']:checked");
    var horaInput = $("input[type='radio'][name='horario']:checked");

    var medVal, espVal, horaVal;

    var incompleto = false;

    if (medInput.length === 0)
    {
        medVal = "Nenhum selecionado.";
        espVal = "Nenhum selecionado.";
        incompleto = true;
    }
    else
    {
        medVal = medInput.parent().children()[1].children[0].innerHTML.substr(6);
        espVal = medInput.parent().children()[1].children[1].innerHTML.substr(15);
    }

    if (horaInput.length === 0)
    {
        horaVal =  "Nenhum selecionado.";
        incompleto = true;
    }
    else 
    {
        horaVal = horaInput.val().substr(0,10) + ", às " + horaInput.val().substr(11);
    }


    document.getElementById("marcar-btn").disabled = incompleto;


    var medDiv  = document.getElementById("med-selecionado");
    var espDiv  = document.getElementById("esp-selecionado");
    var horaDiv  = document.getElementById("hora-selecionado");
    
    medDiv.innerHTML = medVal;
    espDiv.innerHTML = espVal;
    horaDiv.innerHTML = horaVal;

}


function MarcaConsulta() {
    var medInput = $("input[type='radio'][name='medico']:checked");
    var horaInput = $("input[type='radio'][name='horario']:checked");

    var medVal  = medInput.parent().children()[1].children[0].innerHTML.substr(6);
    var espVal  = medInput.parent().children()[1].children[1].innerHTML.substr(15);
    var diaVal  = horaInput.val().substr(0,10);
    var horaVal = horaInput.val().substr(11);
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
