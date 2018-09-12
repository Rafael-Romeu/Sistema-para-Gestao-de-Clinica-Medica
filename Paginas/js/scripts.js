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
        acc[i].addEventListener("click", function() {
            var j;
            for (j = 0; j < acc.length; j++) {
                if (acc[j] != this)
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
        });
    }
}


function medicos() {

    function DisplayMedicos(medicos, div) {
        var html = "";

        if (medicos === undefined || medicos.length == 0)
        {
            html += "<p><br>Não foi encontrado um médico com esses parâmetros.</p>";
        }
        else {
            for (const m of medicos) {
                html += "<label> <input type='radio' name='medico' value='" + m[0] + "' class='medico-select-widget__medico-radio'> <div  class='medico-select-widget__medico-card card'> <div>Nome: " + m[1] + "</div><div>Especialidade: " + m[2] + "</div></div></label>";
            }
        }
        div.innerHTML = html;
    }

    function FilterMedicos(medicos, nome, esp) {
        var result = [];
        for (const m of medicos) {
            if (m[1].toUpperCase().includes(nome.toUpperCase()) && m[2].toUpperCase().includes(esp.toUpperCase()))
            {
                result.push(m);
            }
        }
        return result;
    }

    var medicos = [
        ["000", "Bulsing", "Esp1"],
        ["001", "Luis",   "Esp2"],
        ["003", "Rafael Bulsing", "OUTRO"],
    ];
    
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

    function formatDate(date) {
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
            d.value=formatDate(dates[j])+" "+formatTime(j);
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

