<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-md-12 no-pad">
        <div class="jumbotron" v-if="showChart">
          <div class="row">
            <div class="col-md-7">
              <div id="chart" v-bind:class="{ 'opacity-chart': opacityChart }"></div>
            </div>
            <div class="col-md-5">
              <div class="panel">
                <ul class="nav">
                  <li class="nav-item" v-for="(stage, idx) in event['event_stages']" :key="idx">
                    <a
                      class="p-3 mb-2 bg-primary text-white active"
                      href="#"
                      v-if="event['event_stages'][stage_act]['title'] == stage['title']"
                    >
                      <p>
                        {{stage['title']}}
                        <small
                          style="float: right;"
                        >Hasta: {{stage['end_sale_date']}}</small>
                      </p>
                    </a>
                    <a class="nav-link" href="#" v-else>
                      <small>
                        <p>
                          {{stage['title']}}
                          <small
                            style="float: right; font-size: 1rem;"
                          >Desde: {{stage['start_sale_date']}}</small>
                          <br>
                          <small
                            style="float: right; font-size: 1rem;"
                          >Hasta: {{stage['end_sale_date']}}</small>
                        </p>
                      </small>
                    </a>
                  </li>
                </ul>
                <div class="panel-heading" v-if="!opacityChart">
                  <h3 class="panel-title">
                    <i class="ico-cursor mr5"></i>
                    Selecciona tu ubicación en el mapa.
                  </h3>
                </div>
                <div class="panel-body pt0">
                  <label for="title-ticket">Tiquete</label>
                  <select
                    id="title-ticket"
                    class="form-control form-control-lg"
                    v-model="selectTicket"
                    @change="chartConfiguration"
                  >
                    <option
                      v-for="(ticket, idx) in currentTickets"
                      :key="idx"
                      v-bind:value="ticket['position']"
                    >{{ ticket['title']}}</option>
                  </select>
                  <div>
                    <small>{{descriptionTicket}}</small>
                  </div>
                  <div v-if="this.quantityTickets != 1">
                    <label for="quantity-ticket">Cantidad</label>
                    <select
                      id="quantity-ticket"
                      class="form-control form-control-lg"
                      v-model="selectQuantity"
                      @change="chartConfiguration"
                    >
                      <option v-for="idx in quantityTickets" :key="idx">{{idx}}</option>
                    </select>
                  </div>
                </div>

                <div class="panel-heading">
                  <h3 class="panel-title">
                    <i class="ico-cart mr5"></i>
                    Resumen del pedido - {{ tickets[selectTicket]['title']}}
                  </h3>
                </div>

                <div class="panel-body pt0">
                  <table class="table mb0 table-condensed">
                    <tbody>
                      <tr>
                        <td class="pl0">
                          <div v-if="event.comission_on_base_price && event.fees">
                            
                            <p class="prices">
                              Precio Base
                            </p>
                            <p class="prices">
                              Comision
                            </p>
                            <p class="prices">
                              IVA
                            </p>

                          </div>
                          <div v-else>
                            <b
                              v-if="tickets[selectTicket]['price'] * selectQuantity > 0"
                            >{{ selectQuantity }} X {{tickets[selectTicket]['currency'] }} $ {{tickets[selectTicket]['price']}}</b>
                            <b v-else>X {{ selectQuantity }}</b>
                          </div>

                        </td>
                        <td style="text-align: right;">


                          <div v-if="event.comission_on_base_price && event.fees">
                            
                            <p class="pl0 prices">
                               {{ tickets[selectTicket]['price'] * selectQuantity | currency('$', 0, { thousandsSeparator: '.' }) }} 
                            </p>
                              <p class="pl0 prices">
                               {{ tickets[selectTicket]['price'] * event.fees * selectQuantity | currency('$', 0, { thousandsSeparator: '.' }) }}
                            </p>
                            <p class="pl0 prices">
                               {{ tickets[selectTicket]['price'] * event.fees * event.tax * selectQuantity| currency('$', 0, { thousandsSeparator: '.' }) }}
                            </p>

                          </div>
                          <div v-else>
                            <b
                              v-if="tickets[selectTicket]['price'] * selectQuantity > 0"
                            >{{selectQuantity}} X {{tickets[selectTicket]['currency'] }} $ {{tickets[selectTicket]['price']}}</b>
                            <b v-else>X {{ selectQuantity }}</b>
                          </div>                          






                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                  <h5>
                  <!--De aca para abajo viene el total-->
                    Total:
                    <span style="float: right;">
                      <b
                        v-if="tickets[selectTicket]['price'] * selectQuantity > 0"
                      >
                      
                      {{tickets[selectTicket]['currency'] }} {{ tickets[selectTicket]['price'] * selectQuantity +  tickets[selectTicket]['price'] * event.fees * selectQuantity + tickets[selectTicket]['price'] * event.fees * event.tax * selectQuantity | currency('$', 0, { thousandsSeparator: '.' }) }}
                      </b>
                      <b v-else>Gratis</b>
                    </span>
                  </h5>
                  <hr>
                  <div v-if="auth">
                    <div v-if="!next">
                      <a
                        class="btn btn-lg btn-success card-submit"
                        href="#"
                        role="button"
                        v-on:click="submit()"
                      >Comprar</a>
                    </div>
                    <div class="progress" v-else>
                      <div
                        class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                        role="progressbar"
                        aria-valuenow="100"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 100%"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
        <div class="jumbotron jumbotron-fluid container-back no-pad">
          <div class="">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <i class="ico-cursor mr5"></i>
                    Selecciona el tiquete.
                </h3>
              </div>
          </div>
            <div class="panel-body pt0">
              <label for="title-ticket">Tiquete</label>
              <select
                id="title-ticket"
                class="form-control form-control-lg"
                v-model="selectTicketinitial"
                @change="chartConfiguration"
              >
              <option value="-1">Selecciona una categoría</option>
                <option
                  v-for="(ticket, idx) in currentTickets"
                  :key="idx"
                  v-bind:value="ticket['position']"
                >{{ ticket['title']}}</option>
              </select>
              <div>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Vue2Filters from 'vue2-filters'
// const { SeatsioClient } = require('seatsio')

export default {
  props: ["event", "stage_act", "tickets", "auth"],
  components:['Vue2Filters'],
  mixins: [Vue2Filters.mixin],
  data() {
    return {
      selectTicket: 0,
      selectTicketinitial: -1,
      selectTicketName: "",
      selectQuantity: 1,
      chart: [],
      selectedObject: [],
      activators: [],
      next: false,
      currentTickets: [],
      state_active: '',
      descriptionTicket: '',
      showChart: false,
      quantityTickets: 1,
      opacityChart: true

    };
  },
  mounted() {
    // realizar ticket seleccionados por estado en la parte de aca
    this.state_active = this.event["event_stages"][this.stage_act]["stage_id"];
    var flag = true;
    this.tickets.forEach((ticket, key) => {
      if (ticket["stage_id"] == this.state_active) {
        ticket["position"] = key;
        this.currentTickets.push(ticket);
        if (flag) {
            this.selectTicket = key;
            this.selectTicketName = this.tickets[this.selectTicket]["title"];
            this.descriptionTicket = this.tickets[this.selectTicket]["description"];
            flag = false;
        }
      }
    });

  },
  methods: {
   chartConfiguration() {
      if(!this.showChart){
        this.selectTicket = this.selectTicketinitial

                //paint char
        this.chart = new seatsio.SeatingChart({
          divId: "chart",
          publicKey: this.event["seats_configuration"]["keys"]["public"],
          language: this.event["seats_configuration"]["language"],
          maxSelectedObjects: this.selectQuantity,
          event: this.event["seats_configuration"]["keys"]["event"],
          availableCategories: [this.tickets[this.selectTicket]["title"]],
          showMinimap: this.event["seats_configuration"]["minimap"],
          onObjectSelected: function(object) {},
          onObjectDeselected: function(object) {}
        }).render();
      }

this.opacityChart = (this.tickets[this.selectTicket]["title"] == "General") ? true :false;

    // console.log(this.tickets[this.selectTicket]["title"]);
// console.log(await client.events.retrieve(this.event["seats_configuration"]["keys"]["event"]));

      this.showChart = true;
      this.selectTicketName = this.tickets[this.selectTicket]["title"];
      this.quantityTickets = parseInt(this.tickets[this.selectTicket]["max_per_person"])

      //Cambio de chart
      this.chart.setAvailableCategories([
        [this.tickets[this.selectTicket]["title"]]
      ]);

        console.log(this.event["seats_configuration"]["keys"]["event"]);

      this.chart.changeConfig({
        maxSelectedObjects: this.selectQuantity
      });
      this.chart.clearSelection();

      //show description 
      this.tickets.forEach(element => {
        if(element.title == this.selectTicketName && element.stage_id == this.state_active){
          this.descriptionTicket = element.description 
        }
      });
    },
    /**
     *
     *
     */

    async submit() {
      // this.next = true;
      this.chart.listSelectedObjects(selectedObject => {
        if (this.selectQuantity == selectedObject.length) {
          this.petition(selectedObject);
        } else {
          this.chart.listCategories(categories => {
            const result = categories.filter(
              category => category.label == this.selectTicketName
            );
            if (!result.length) {
              this.petition(null);
            } else {
              humane.log(
                "Te quedan " +
                  (this.selectQuantity - selectedObject.length) +
                  " puestos por seleccionar",
                {
                  timeoutAfterMove: 3000,
                  waitForMove: true
                }
              );
              this.next = false;
            }
          });
        }
      });
    },
    /**
     * Petition
     * 
     * Send petition to create  ticket
     */
    petition(selectedObject) {
        var ticketTitle = "ticket_" + this.tickets[this.selectTicket]["_id"];
        var data = {};
        data[ticketTitle] = this.selectQuantity;
        data["tickets"] = [this.tickets[this.selectTicket]["_id"]];
        if (!selectedObject) {
          var seat = {
            labels: 
              {
                displayedLabel: this.selectTicketName,
                own: this.selectTicketName,
                parent: this.selectTicketName,
                section: this.selectTicketName
              },
              id: this.selectTicketName,
              chart:{
                  config: {
                      event: this.event["seats_configuration"]["keys"]["event"]
                  }
              },
              label: this.selectTicketName,
              category: {
                  label: this.selectTicketName,
              }

          };
         selectedObject = [];
         for (var i = 0; i < this.selectQuantity; i++) {
             selectedObject.push(seat);
          }
        }
        data["seats"] = selectedObject;
        // console.log(data);
        var url = '/es/e/'+this.event['_id']+'/checkout';
            fetch(  url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data),
                    headers:{
                        'Content-Type': 'application/json'
                    }
            }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => {
                console.log(response.redirectUrl);
                window.top.location.href = response.redirectUrl
            }
            ); 
    }
  }
};
</script>

<style>
a.btn-success {
    background-color: #87e5c1;
    width: 100%;
    font-size: 100%;
    border-color: #87e5c1;
    font-family: Montserrat,sans-serif;
}

li > a.active {
        margin-left: -10px;
        margin-right: -10px;
}
.jumbotron {
  background-color: white !important;
}

.selection-tick{
  margin-left: -59px !important;
}

p.prices {
    font-size:14px !important;
    font-weight:bold !important;
}

.opacity-chart{
  opacity: 0.3
}
.no-pad{
  padding: 10px 0 !important;
}
</style> 