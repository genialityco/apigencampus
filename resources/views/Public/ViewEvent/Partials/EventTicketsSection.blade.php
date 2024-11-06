<script>
        document.domain = "evius.co"
</script>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  background-color: white;
     margin-left: 0.8%;
}

.body-style{
    overflow: hidden;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: #EEEEEF;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  /* transition: 0.3s; */
  font-size: 1.2em;
  color: black;
  font-weight: bold;
  margin-top: 10px;
  border-bottom: solid 3px #00f0be;
  border-left: solid 1px black;
}

/* Change background color of buttons on hover */
a:hover {
  background-color: #bfbfbf;
  color: #00f0be;
  cursor: pointer;
}

p.active{
  background-color: #428bca;
  font-family: Montserrat,sans-serif;
  padding: 4%;
  color: white;
  font-size: 16px;
  text-align: center;
}
p.calender{
 font-family: Montserrat,sans-serif;
  padding: 6%;
  font-size: 16px;
}

/* Create an active/current tablink class */

button.active p small {
  color: black;
}


/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 0px;
  /* border: 1px solid #ccc; */
  border-top: none;
}
.sub-titulo{
    color: #a2a2a2;
}

td{
    border-color:transparent !important;
}
.td{
    border-top: none !important;
}
.ticket{
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px 10px 10px 10px;
    text-align: center;
    border-bottom: solid 3px #00f0be;
    width:100%
}
.espacio{
    height: 0px;
    padding: 5px !important;
    background-color: transparent !important;
}
.content{
    padding: 0 !important;
}
.precio{
    width:200px;
    text-align: right;
}
.cantidad{
    width: 85px;
}
.button-purchase {
  position: fixed;
  z-index: 998;
  bottom: 0px;
  left:1%;
  width: 98%;
  height: 40px;
  line-height: 20px;
  text-align: center;
  background-color: #00f0be;
  border-color: transparent;
  color: white !important;
  font-size: 2.5rem;
  border-radius: 15px;
  font-weight: bold;
  border-radius: 10px 10px 10px 10px;
  text-transform: uppercase;
}
.button-purchase:hover{
    transition: 0.7s;
    background-color: #13cea8 !important;
}

.dropdown-tickets {
    background: white;
    text-align:center;
    width:95%;
    padding:10px;
    margin: 10px 8px;
    border-radius: 2px;
    box-shadow: 0px 2px 5px rgba(0, 5, 9, 0.1);
    border-color: #EAECEE;
}

.title {
    text-align:center;
    width:100%;
}
.etapa ul {
    text-align:center;
    width:100%;
}

.help-text{
    text-align: center;
    color:grey;
}

@media screen and (min-width: 900px) {
    .dropdown-tickets{
            width: 98%;
            margin: 8px;
        }
}




@media screen and (min-width: 600px) {
       table {
           width:100%;
       }
       thead {
           display: none;
       }
       tr td:first-child {
           background-color: white;
       }
       tbody td {
           display: block;
           text-align:center;
       }
        .precio{
            width:100%;
            text-align:center;
        }
        .cantidad{
            width: 100%;
        }
        .tab button {
            width: 94%;
            margin-left: 3%;
            cursor: pointer;
            padding: 14px 16px;
            margin-top: 5px;
            border-left: none;
            border-radius: 5px 5px 5px 5px;
        }
        .tab button.active {
            border-radius: 5px 5px 5px 5px;
        }
        .tab {
            margin-left: 0;
        }
        .dropdown-tickets{
            width: 98%;
            margin: 5px;
        }
}

</style>


@if(is_null($event->stage_continue)) <!-- Si el evento tiene limite de compra entre etapas -->
    @include('Public.ViewEvent.Partials.EventTicketsSectionList')
@else
    @include('Public.ViewEvent.Partials.EventTicketsSectionDropDown')
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
/*Que es esto pregunta juan para documentarlo */
function openCity(evt, key) {
 evt.currentTarget.className += " active";

  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("p");
  for (i = 0; i < tablinks.length; i++) {
    // tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(key).style.display = "block";
  $('p.active').removeClass("active")
  $('p.tab-'+key).addClass("active")
}



$(document).ready(function(){

    function ticket_selection_change(){
        //hide all tabs first
        $('.ticket_dropdown').hide();
        //show the first tab content
        //$('#1').show();

        $('#ticket-selection').on("change",".ticket-type",function () {
        var select_id =  $( this ).val()
        //first hide all tabs again when a new option is selected
        $('.ticket_dropdown').val("0").hide();
        //then show the tab content of whatever option value was selected

        $('#' + "ticket_" + select_id).show();
        $('#' + "ticket_" + select_id).val("1");

        });
    }
    ticket_selection_change ();

    function tickets_tab_selection(){
        //hide all tabs first
        $('.tabcontent').hide();
        //show the first tab content
        $('#1').show();

        $('#select-box').change(function () {
        dropdown = $('#select-box').val();
        //first hide all tabs again when a new option is selected
        $('.tabcontent').hide();
        //then show the tab content of whatever option value was selected
        $('#' + "" + dropdown).show();
        });
    }
    tickets_tab_selection();

    $("select.tickets").change(function(){
        var total = 0;
        var total_select = 0;
        $("select.tickets").each(function(){
            var total_select = parseInt($(this).val());
            total += total_select
        });
        if(total == 1){
            $("div#codes_discount").append(`


            <div class="card" style="border-color: #72f0bf; border-style: dotted;">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <input type="text" name="code_discount" class="form-control" placeholder="Si tiene un código promocional, puede ingresarlo en este campo" style="border-color: #72f0bf;">
                    <center><footer class="blockquote-footer">Código promocional</footer></center>
                    </blockquote>
                </div>
            </div>


            `)
        }else{
            $("div#codes_discount").empty()
        }
    });
});
</script>
