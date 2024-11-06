<template>
  <div>
      <div id="chart"></div>
  </div>
</template>

<script>
    // import chart from './ticket-section/chart.vue';
    export default {
        props: ['event','stage_act', 'tickets'],
        data() {
            return {
                selectTicket: 0,
                selectQuantity: 1,
                chart: []
                // quantityUser: tickets[this.selectTicket]['max_per_person']
            }
        },
        mounted() {
                this.chart = new seatsio.SeatingChart({
                    divId: 'chart',
                    publicKey :             this.event['seats_configuration']["keys"]["public"],
                    language :              this.event['seats_configuration']["language"],
                    maxSelectedObjects:     1,
                    event :                 this.event['event_stages'][this.stage_act]['seating_chart'],  
                    // availableCategories   :   [this.tickets[this.selectTicket]['title']],
                    showMinimap:            this.event['seats_configuration']["minimap"],
                    onObjectSelected: function(object){
                        var url = '/checkout/seats';
                        var data = { data: object, order_reference: '{!! $temporal_id !!}' };
                        fetch(  url, {
                                method: 'POST', // or 'PUT'
                                body: JSON.stringify(data), // data can be `string` or {object}!
                                headers:{
                                    'Content-Type': 'application/json'
                                }
                        }).then(res => res.json())
                        .catch(error => console.error('Error:', error))
                        .then(response => console.log('Success:', response));
                    },
                    onObjectDeselected: function(object){
                        var url = '/checkout/seats';
                        var data = { data: object, order_reference: '{!! $temporal_id !!}' };
                        fetch(  url, {
                                method: 'POST', // or 'PUT'
                                body: JSON.stringify(data), // data can be `string` or {object}!
                                headers:{
                                    'Content-Type': 'application/json'
                                }
                        }).then(res => res.json())
                        .catch(error => console.error('Error:', error))
                        .then(response => console.log('Success:', response));
                    }
                }).render();
        },
        methods: {
            chartConfiguration(){
                this.chart.config.maxSelectedObjects = 3
                console.log(this.chart)
                vm.$forceUpdate();
            }

        }
    }
</script>
