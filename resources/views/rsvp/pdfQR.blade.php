<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style media="all">
    body,
    html {
      background-color: #ddd;
      margin: 0;
      padding: 0;
      font-family: "Inknut Antiqua", serif;
      font-family: "Ravi Prakash", cursive;
      font-family: "Lora", serif;
      font-family: "Indie Flower", cursive;
      font-family: "Cabin", sans-serif;
    }

    div.container {
      height: 550px;
      width: 100%;
      background-color: #ddd;
      margin: 15px auto;
    }

    .container .item {
      width: 96%;
      background-color: #aadd55;
      height: 550px;
      float: left;
      /* padding: 0 20px; */
      padding-top: 0px;
      background: #fff;
      overflow: hidden;
      margin: 10px auto;
      display: table;
    }

    .container .item-right,
    .container .item-left {
      /* float: left; */
      padding: 20px;
      display: table-cell;
      vertical-align: middle;
    }

    .container .item-right {
      /* padding: 79px 50px; */
      /* margin-right: 20px; */
      width: 30%;
      position: relative;
      height: 550px;
      background-color: #fff;
      padding: 0;
      margin: 0;
      display: table-cell;
      vertical-align: middle;
    }

    .items-justify {
	text-align: center;
    }

    .container .item-right .up-border,
    .container .item-right .down-border {
      padding: 28px 30px;
      background-color: #ddd;
      border-radius: 50%;
      position: absolute;
    }

    .container .item-right .up-border {
      top: -18px;
      right: -34px;
    }

    .container .item-right .down-border {
      top: 520px;
      right: -34px;
    }

    .container .item-right .num {
      font-size: 60px;
      text-align: center;
      color: #111;
    }

    .container .item-right .day,
    .container .item-left .event {
      color: #555;
      font-size: 30px;
      margin: 10px 0px;
    }

    .container .item-right .day {
      text-align: center;
      font-size: 25px;
    }

    .container .item-left {
      width: 66%;
      padding: 34px 0px 19px 46px;
      border-left: 5px dotted #999;
    }

    .container .item-left .title {
      color: #111;
      font-size: 60px;
      margin-top: 12px;
      margin-bottom: 12px;
    }

    .container .item-left .sce {
      margin-top: 5px;
      display: block;
    }

    .container .item-left .sce .icon,
    .container .item-left .sce p {
      word-spacing: 5px;
      font-size: 24px;
      letter-spacing: 1px;
      color: #888;
      margin-bottom: 5px;
    }

    .container .item-left .sce .icon,
    .container .item-left .loc .icon {
      font-size: 25px;
      color: #666;
    }

    .container .item-left .loc {
      display: block;
    }

    .fix {
      clear: both;
    }

    .container .item .tickets {
      padding: 6px 14px;
      margin-left: 580px;
      font-size: 23px;
      border: none;
      color: #fff;
      height: 7%;
      border-radius: 15px;
      background-color: #87d7c6;
      width: 15%;
      text-align: center;
    }

    .linethrough {
      text-decoration: line-through;
    }

    @media only screen and (max-width: 1150px) {
      .container .item {
        width: 100%;
        margin-right: 20px;
      }

      div.container {
        margin: 0 20px auto;
      }
    }

    .qr {
      width: 80%;
    }
    .code{
      font-size: 24px;
      font-weight: bold;
      letter-spacing: 0.14rem;
    }
  </style>
</head>
<body>
    
<link href="https://fonts.googleapis.com/css?family=Cabin|Indie+Flower|Inknut+Antiqua|Lora|Ravi+Prakash" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"  />


<div class="container">
  <div class="item">
    <div class="item-right">
	<div class="items-justify">
          <img class="qr"
            src="data:image/png;base64,{{ $qr }}" />
          <span class="code">{{ $burnedTicket->code }}</span>
        </div>


      <span class="up-border"></span>
      <span class="down-border"></span>
    </div>

    <div class="item-left">
      <p class="event">{{ $burnedTicket['event']['name'] }}</p>
      <h2 class="title">{{ $burnedTicket['ticket_category']['name'][$lang] }}</h2>

      <div class="sce">
        <div class="icon">
	  <i class="fa fa-duotone fa-calendar"></i>
	    @if($lang === 'es')
	    <p>Início: {{ $burnedTicket['event']['datetime_from'] }} <br/>Fín: {{ $burnedTicket['event']['datetime_to'] }}</p>
	    @elseif($lang === 'en')
	    <p>Start: {{ $burnedTicket['event']['datetime_from'] }} <br/>End: {{ $burnedTicket['event']['datetime_to'] }}</p>
	    @endif
        </div>
      </div>
  </div>
</div>


</body>
</html>
