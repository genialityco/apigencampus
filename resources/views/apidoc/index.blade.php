<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Info</h1>
<p>Welcome to the generated API reference.
<a href="{{ route("apidoc.json") }}">Get Postman Collection</a></p>
<!-- END_INFO -->
<h1>Activity</h1>
<p>The activities within an event are <strong>sessions, talks, lessons or conferences</strong> in which specific topics are discussed.</p>
<p>Each activity has its <strong>date , time and duration</strong>.</p>
<p>These activities, according to the organizer, can be carried out either in person or virtually.</p>
<!-- START_0c4bcd062bf8533da02e9afdd3e9e075 -->
<h2><em>duplicate</em>: endpoint destined to the duplication of an activity to english language</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/duplicateactivitie/sunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/duplicateactivitie/sunt"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/duplicateactivitie/facilis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/duplicateactivitie/facilis"
=======
    "https://api.evius.co/api/events/1/duplicateactivitie/ducimus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/duplicateactivitie/ducimus"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/1/duplicateactivitie/reprehenderit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/duplicateactivitie/reprehenderit"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/duplicateactivitie/sunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/duplicateactivitie/sunt"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/duplicateactivitie/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>id of the event to which the activities belong.</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id of the activity you want to see.</td>
</tr>
</tbody>
</table>
<!-- END_0c4bcd062bf8533da02e9afdd3e9e075 -->
<!-- START_a4a55c62b61aebf221a7b56f081e0350 -->
<h2><em>createMeeting</em>: assing meeting to activitie.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1/createmeeting/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"activity_datetime_start":"2020-10-14 14:11","activity_name":"possimus","activity_description":"id"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"activity_datetime_start":"2020-10-14 14:11","activity_name":"eos","activity_description":"doloribus"}'
=======
    -d '{"activity_datetime_start":"2020-10-14 14:11","activity_name":"minus","activity_description":"qui"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"activity_datetime_start":"2020-10-14 14:11","activity_name":"odit","activity_description":"temporibus"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"activity_datetime_start":"2020-10-14 14:11","activity_name":"possimus","activity_description":"id"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/createmeeting/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "activity_datetime_start": "2020-10-14 14:11",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "activity_name": "possimus",
    "activity_description": "id"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "activity_name": "eos",
    "activity_description": "doloribus"
=======
    "activity_name": "minus",
    "activity_description": "qui"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "activity_name": "odit",
    "activity_description": "temporibus"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "activity_name": "possimus",
    "activity_description": "id"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/createmeeting/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>activity_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>activity_datetime_start</code></td>
<td>date</td>
<td>required</td>
</tr>
<tr>
<td><code>activity_name</code></td>
<td>string</td>
<td>required</td>
<td>Example : First activity</td>
</tr>
<tr>
<td><code>activity_description</code></td>
<td>string</td>
<td>required</td>
<td>Example : First activity</td>
</tr>
</tbody>
</table>
<!-- END_a4a55c62b61aebf221a7b56f081e0350 -->
<!-- START_62fbfe55bb9fd87ce0fd3fec5bd1b034 -->
<h2><em>hostAvailability</em>: end point que controla las disponibilidad de los host al crear una reunión</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities/nam/hostAvailability" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/activities/soluta/hostAvailability" \
=======
    "https://api.evius.co/api/events/1/activities/atque/hostAvailability" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/1/activities/quis/hostAvailability" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities/nam/hostAvailability" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"host_ids":"[\"KthHMroFQK24I97YoqxBZw\" , \"FIRVnSoZR7WMDajgtzf5Uw\" , \"15DKHS_6TqWIFpwShasM4w\" , \"2m-YaXq_TW2f791cVpP8og\", \"mSkbi8PmSSqQEWsm6FQiAA\"]","host_id":"KthHMroFQK24I97YoqxBZw","date_start_zoom":"2021-02-08T07:30:00","date_end_zoom":"2021-02-08T09:30:00"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities/nam/hostAvailability"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/activities/soluta/hostAvailability"
=======
    "https://api.evius.co/api/events/1/activities/atque/hostAvailability"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/1/activities/quis/hostAvailability"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities/nam/hostAvailability"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "host_ids": "[\"KthHMroFQK24I97YoqxBZw\" , \"FIRVnSoZR7WMDajgtzf5Uw\" , \"15DKHS_6TqWIFpwShasM4w\" , \"2m-YaXq_TW2f791cVpP8og\", \"mSkbi8PmSSqQEWsm6FQiAA\"]",
    "host_id": "KthHMroFQK24I97YoqxBZw",
    "date_start_zoom": "2021-02-08T07:30:00",
    "date_end_zoom": "2021-02-08T09:30:00"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/activities/{id}/hostAvailability</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>activity to which the meeting is to be created</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>host_ids</code></td>
<td>array</td>
<td>optional</td>
<td>optional id array of selectable hosts</td>
</tr>
<tr>
<td><code>host_id</code></td>
<td>string</td>
<td>optional</td>
<td>host selected to create the meeting</td>
</tr>
<tr>
<td><code>date_start_zoom</code></td>
<td>date</td>
<td>optional</td>
</tr>
<tr>
<td><code>date_end_zoom</code></td>
<td>date</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_62fbfe55bb9fd87ce0fd3fec5bd1b034 -->
<!-- START_2b49ae79d301c06028af57bf277dc0fc -->
<h2><em>registerAndCheckInActivity</em>: status indicating that the user entered the activity</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities/nostrum/register_and_checkin_to_activity" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/nostrum/register_and_checkin_to_activity"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/activities/consequatur/register_and_checkin_to_activity" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/activities/consequatur/register_and_checkin_to_activity"
=======
    "https://api.evius.co/api/events/1/activities/quasi/register_and_checkin_to_activity" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/activities/quasi/register_and_checkin_to_activity"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/1/activities/qui/register_and_checkin_to_activity" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/qui/register_and_checkin_to_activity"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities/nostrum/register_and_checkin_to_activity" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/nostrum/register_and_checkin_to_activity"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "user_id": "5e9caaa1d74d5c2f6a02a3c2",
    "activity_id": "60181474e36ef049a92768ba",
    "event_id": "5fa423eee086ea2d1163343e",
    "checkedin_at": "2021-02-01 22:48:19",
    "updated_at": "2021-02-01 22:48:19",
    "created_at": "2021-02-01 22:48:19",
    "_id": "601885335603e6467b65b605"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/activities/{id}/register_and_checkin_to_activity</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>id of activity</td>
</tr>
</tbody>
</table>
<!-- END_2b49ae79d301c06028af57bf277dc0fc -->
<!-- START_9e0ca3bf8a5715074f04da99706d1d75 -->
<h2><em>deleteVirtualSpaceZoom</em>:</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/activities/mettings_zoom/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/mettings_zoom/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/activities/mettings_zoom/{meeting_id}</code></p>
<!-- END_9e0ca3bf8a5715074f04da99706d1d75 -->
<!-- START_55725aeeef530f59dcf513702eb76be1 -->
<h2><em>index:</em> Listing of all activities</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/activities" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/1\/activities?page=1",
        "last": "http:\/\/localhost\/api\/events\/1\/activities?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/1\/activities",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
=======
    "message": "No query results for model [App\\Event] 1"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "message": "No query results for model [App\\Event] 1"
>>>>>>> rolesEtapa2
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/activities</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>optional</td>
<td>require</td>
</tr>
</tbody>
</table>
<!-- END_55725aeeef530f59dcf513702eb76be1 -->
<!-- START_d5b44a1e8243972f42d95b117397a87f -->
<h2><em>show</em>: View information on a specific activity</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/activities/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Activities] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/activities/{activitie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>id of the event the activity.</td>
</tr>
<tr>
<td><code>activity</code></td>
<td>required</td>
<td>id of the activity you want to see.</td>
</tr>
</tbody>
</table>
<!-- END_d5b44a1e8243972f42d95b117397a87f -->
<!-- START_abb60f527b9773a27ca95b03f895e392 -->
<h2><em>checkInByAdmin</em>: admin can check-in a specific user on a specific activity</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/debitis/activities/aspernatur/checkinbyadmin" \
=======
    "https://devapi.evius.co/api/events/voluptatum/activities/ipsum/checkinbyadmin" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/events/voluptatum/activities/ipsum/checkinbyadmin" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/debitis/activities/aspernatur/checkinbyadmin" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":"sit"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/voluptatum/activities/ipsum/checkinbyadmin"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/events/debitis/activities/aspernatur/checkinbyadmin"
=======
    "https://api.evius.co/api/events/qui/activities/hic/checkinbyadmin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":"ut"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/qui/activities/hic/checkinbyadmin"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/recusandae/activities/culpa/checkinbyadmin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":"omnis"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/recusandae/activities/culpa/checkinbyadmin"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/voluptatum/activities/ipsum/checkinbyadmin"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "user_id": "sit"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "user_id": "dolore"
=======
    "user_id": "ut"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "user_id": "omnis"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "user_id": "sit"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/activities/{activity}/checkinbyadmin</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>activity</code></td>
<td>required</td>
<td>activity id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user_id</code></td>
<td>string</td>
<td>required</td>
<td>user id</td>
</tr>
</tbody>
</table>
<!-- END_abb60f527b9773a27ca95b03f895e392 -->
<!-- START_9a0403e87bbf04f98ccec81595fdc574 -->
<h2><em>store</em>: create a new activity</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/5fa423eee086ea2d1163343e/activities" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"PRIMERA ACTIVIDAD","subtitle":"Subtitulo primera actividad","image":"https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg","description":"Primera actividad del evento","capacity":50,"event_id":"5fa423eee086ea2d1163343e","datetime_end":"2020-10-14 14:11","datetime_start":"2020-10-14 14:50"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5fa423eee086ea2d1163343e/activities"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "PRIMERA ACTIVIDAD",
    "subtitle": "Subtitulo primera actividad",
    "image": "https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
    "description": "Primera actividad del evento",
    "capacity": 50,
    "event_id": "5fa423eee086ea2d1163343e",
    "datetime_end": "2020-10-14 14:11",
    "datetime_start": "2020-10-14 14:50"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "60804c6e6b7150714f20d122",
    "name": "PRIMERA ACTIVIDAD",
    "subtitle": "Subtitulo primera actividad",
    "image": "https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
    "description": "Primera actividad del evento",
    "capacity": 50,
    "event_id": "5fa423eee086ea2d1163343e",
    "datetime_end": "2020-10-14 14:11",
    "datetime_start": "2020-10-14 14:50",
    "date_start_zoom": "2020-10-14T13:50:00",
    "date_end_zoom": "2020-10-14T15:11:00",
    "updated_at": "2021-04-21 16:01:50",
    "created_at": "2021-04-21 16:01:50",
    "access_restriction_types_available": null,
    "activity_categories": [],
    "space": null,
    "hosts": [],
    "type": null,
    "access_restriction_roles": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/activities</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>id of the event in which a new activity is to be created</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name</td>
</tr>
<tr>
<td><code>subtitle</code></td>
<td>string</td>
<td>optional</td>
<td>optional</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>capacity</code></td>
<td>integer</td>
<td>optional</td>
<td>number of people who can enter the activity.</td>
</tr>
<tr>
<td><code>event_id</code></td>
<td>string</td>
<td>required</td>
<td>event with which the activity is associated</td>
</tr>
<tr>
<td><code>datetime_end</code></td>
<td>datetime</td>
<td>required</td>
</tr>
<tr>
<td><code>datetime_start</code></td>
<td>datetime</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_9a0403e87bbf04f98ccec81595fdc574 -->
<!-- START_628bde723158349a4cffd9f00e940c0c -->
<h2><em>update</em>:update an activity specific.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/activities/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"PRIMERA ACTIVIDAD","subtitle":"Subtitulo primera actividad","image":"https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg","description":"Primera actividad del evento","capacity":50,"event_id":"5fa423eee086ea2d1163343e","datetime_end":"2020-10-14 14:11","datetime_start":"2020-10-14 14:50"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "PRIMERA ACTIVIDAD",
    "subtitle": "Subtitulo primera actividad",
    "image": "https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
    "description": "Primera actividad del evento",
    "capacity": 50,
    "event_id": "5fa423eee086ea2d1163343e",
    "datetime_end": "2020-10-14 14:11",
    "datetime_start": "2020-10-14 14:50"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "60804c6e6b7150714f20d122",
    "name": "PRIMERA ACTIVIDAD",
    "subtitle": "Subtitulo primera actividad",
    "image": "https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
    "description": "Primera actividad del evento",
    "capacity": 50,
    "event_id": "5fa423eee086ea2d1163343e",
    "datetime_end": "2020-10-14 14:11",
    "datetime_start": "2020-10-14 14:50",
    "date_start_zoom": "2020-10-14T13:50:00",
    "date_end_zoom": "2020-10-14T15:11:00",
    "updated_at": "2021-04-21 16:01:50",
    "created_at": "2021-04-21 16:01:50",
    "access_restriction_types_available": null,
    "activity_categories": [],
    "space": null,
    "hosts": [],
    "type": null,
    "access_restriction_roles": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/activities/{activitie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>id of the event to which the activities belong.</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id of the activity you want to update.</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
<td>name</td>
</tr>
<tr>
<td><code>subtitle</code></td>
<td>string</td>
<td>optional</td>
<td>optional</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>capacity</code></td>
<td>integer</td>
<td>optional</td>
<td>number of people who can enter the activity.</td>
</tr>
<tr>
<td><code>event_id</code></td>
<td>string</td>
<td>optional</td>
<td>event with which the activity is associated</td>
</tr>
<tr>
<td><code>datetime_end</code></td>
<td>datetime</td>
<td>optional</td>
</tr>
<tr>
<td><code>datetime_start</code></td>
<td>datetime</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_628bde723158349a4cffd9f00e940c0c -->
<!-- START_522081942cb50f0ea0ee8326d75dce66 -->
<h2><em>destroy</em>: Remove the specified activity</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/1/activities/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/activities/{activitie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>id of the event to which the activities belong</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id of the activity you want to destroy</td>
</tr>
</tbody>
</table>
<!-- END_522081942cb50f0ea0ee8326d75dce66 -->
<h1>ActivityAssistant</h1>
<!-- START_e0ccb05959e639de7d4e4dd3c68556d1 -->
<h2><em>index</em>: List of the activity_assitans</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/activities_attendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/1\/activities_attendees?page=1",
        "last": "http:\/\/localhost\/api\/events\/1\/activities_attendees?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/1\/activities_attendees",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/activities_attendees</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_e0ccb05959e639de7d4e4dd3c68556d1 -->
<!-- START_c86adc4487e15d69d7c0252fe860928f -->
<h2><em>store</em>: create new record activity_assitant</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1/activities_attendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":"5e9caaa1d74d5c2f6a02a3c2","activity_id":"5fa44f6ba8bf7449e65dae32"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": "5e9caaa1d74d5c2f6a02a3c2",
    "activity_id": "5fa44f6ba8bf7449e65dae32"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "user_id": "6026b57a11dbd7582d770e5a",
    "activity_id": "60804c6e6b7150714f20d122",
    "event_id": "5fa423eee086ea2d1163343e",
    "updated_at": "2021-04-21 16:48:14",
    "created_at": "2021-04-21 16:48:14",
    "_id": "6080574edccc122ed71f7b24"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/activities_attendees</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user_id</code></td>
<td>required</td>
<td>optional</td>
<td>id of the user who signs up for the activity</td>
</tr>
<tr>
<td><code>activity_id</code></td>
<td>id</td>
<td>optional</td>
<td>of the activity to which the user subscribes</td>
</tr>
</tbody>
</table>
<!-- END_c86adc4487e15d69d7c0252fe860928f -->
<!-- START_b608a1e67ff8f31d596f3cefd3aa9700 -->
<h2><em>show</em>: view the specific information of an activity_assitant record</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/activities_attendees/5ed66ce2a6929562725bd7c2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees/5ed66ce2a6929562725bd7c2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\ActivityAssistant] 5ed66ce2a6929562725bd7c2"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/activities_attendees/{activities_attendee}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>activities_attendee</code></td>
<td>optional</td>
<td>id de activity_assitant</td>
</tr>
</tbody>
</table>
<!-- END_b608a1e67ff8f31d596f3cefd3aa9700 -->
<!-- START_72909086e39c55cc7be2f2c3d6718343 -->
<h2><em>update</em>:Update the specific information of an activity_assitant record</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/activities_attendees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/activities_attendees/{activities_attendee}</code></p>
<p><code>PATCH api/events/{event}/activities_attendees/{activities_attendee}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>id de activity_assitant</td>
</tr>
</tbody>
</table>
<!-- END_72909086e39c55cc7be2f2c3d6718343 -->
<!-- START_dcd50abfb0c53308b4c8f8faf5280a8e -->
<h2><em>destroy</em>:Remove the specific register of an activity_assitant record</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/1/activities_attendees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/activities_attendees/{activities_attendee}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>id of activity_assitant to remove</td>
</tr>
</tbody>
</table>
<!-- END_dcd50abfb0c53308b4c8f8faf5280a8e -->
<!-- START_5d7f38e360b7e302ecc8b12d1b42754b -->
<h2><em>meIndex</em>: list of registered activities of the logged-in user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/events/1/activities_attendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/events/1/activities_attendees"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/events/{event}/activities_attendees</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
</tbody>
</table>
<!-- END_5d7f38e360b7e302ecc8b12d1b42754b -->
<!-- START_502d45645ea8a6d7fa50895c044bd950 -->
<h2><em>checkIn</em>: status indicating that the user entered the activity</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities_attendees/doloremque/check_in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees/doloremque/check_in"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/activities_attendees/in/check_in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/activities_attendees/in/check_in"
=======
    "https://api.evius.co/api/events/1/activities_attendees/iste/check_in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/activities_attendees/iste/check_in"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/1/activities_attendees/exercitationem/check_in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees/exercitationem/check_in"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/activities_attendees/doloremque/check_in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/activities_attendees/doloremque/check_in"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/activities_attendees/{id}/check_in</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>event to which the activity belongs</td>
</tr>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>id of activity_assitant</td>
</tr>
</tbody>
</table>
<!-- END_502d45645ea8a6d7fa50895c044bd950 -->
<h1>Category</h1>
<p>The categories are a facility for classification of events</p>
<!-- START_a3f47d4a0050ce677364d4f73eba41eb -->
<h2><em>indexByOrganization</em> : list categories by organization</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/categories/organizations/5f7e33ba3abc2119442e83e8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/categories/organizations/5f7e33ba3abc2119442e83e8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "5fbee701a75d483665317ee3",
        "name": "Planeta",
        "image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/ucronio-dev%2Fplaneta.jpg?alt=media&amp;token=54c3c6d0-de27-4298-b5a0-fda6a1409759",
        "updated_at": "2020-11-25 23:21:37",
        "created_at": "2020-11-25 23:21:37",
        "organization_ids": [
            "5f7e33ba3abc2119442e83e8"
        ]
    },
    {
        "_id": "5fbee74043fe4a32e151587c",
        "name": "Satélites",
        "image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/ucronio-dev%2Fsatelites.jpg?alt=media&amp;token=7f12fa5d-11a3-40a0-9461-d3debdc04b90",
        "updated_at": "2020-11-25 23:22:40",
        "created_at": "2020-11-25 23:22:40",
        "organization_ids": [
            "5f7e33ba3abc2119442e83e8"
        ]
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/categories/organizations/{organization_ids}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_ids</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_a3f47d4a0050ce677364d4f73eba41eb -->
<!-- START_109013899e0bc43247b0f00b67f889cf -->
<h2><em>index</em>: List of categories</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [
        {
            "_id": "5bb25243b6312771e92c8693",
            "name": "Evento Deportivo",
            "organization_ids": [
                "5bb63842c06586040e58aa35",
                "5bb63861c065863d470263a3"
            ]
        },
        {
            "_id": "5bb25f91b6312771e92c8695",
            "name": "Concierto"
        },
        {
            "_id": "5bb25f9fb6312771e92c8697",
            "name": "Asamblea"
        },
        {
            "_id": "5bbb6f7f3dafc227ce1c1ca2",
            "name": "Seminario",
            "updated_at": "2018-10-08 14:53:51",
            "created_at": "2018-10-08 14:53:51"
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/categories</code></p>
<!-- END_109013899e0bc43247b0f00b67f889cf -->
<!-- START_34925c1e31e7ecc53f8f52c8b1e91d44 -->
<h2><em>show</em>: consult information on a specific category</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/categories/5bb25243b6312771e92c8693" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/categories/5bb25243b6312771e92c8693"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/categories/{category}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>category</code></td>
<td>required</td>
<td>category</td>
</tr>
</tbody>
</table>
<!-- END_34925c1e31e7ecc53f8f52c8b1e91d44 -->
<!-- START_2335abbed7f782ea7d7dd6df9c738d74 -->
<h2><em>store</em>: create new category</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Animales","image":"https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/gato-atigrado-triste-redes.jpg?alt=media&amp;token=2cd2161b-43f7-42a8-87e6-cf571e83e660","organization_ids":"[5f7e33ba3abc2119442e83e8]"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Animales",
    "image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/gato-atigrado-triste-redes.jpg?alt=media&amp;token=2cd2161b-43f7-42a8-87e6-cf571e83e660",
    "organization_ids": "[5f7e33ba3abc2119442e83e8]"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "name": "Animales",
    "image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/gato-atigrado-triste-redes.jpg?alt=media&amp;token=2cd2161b-43f7-42a8-87e6-cf571e83e660",
    "updated_at": "2021-01-26 15:45:32",
    "created_at": "2021-01-26 15:45:32",
    "_id": "6010391c5254c826bf302bc6"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/categories</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name category</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
<td>category image</td>
</tr>
<tr>
<td><code>organization_ids</code></td>
<td>array</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_2335abbed7f782ea7d7dd6df9c738d74 -->
<!-- START_549109b98c9f25ebff47fb4dc23423b6 -->
<h2><em>update</em>: update a specific category</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/categories/5bb25243b6312771e92c8693" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"nihil"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"aperiam"}'
=======
    -d '{"name":"accusamus"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"facere"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"nihil"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/categories/5bb25243b6312771e92c8693"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "nihil"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "aperiam"
=======
    "name": "accusamus"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "facere"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "name": "nihil"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/categories/{category}</code></p>
<p><code>PATCH api/categories/{category}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>category</code></td>
<td>optional</td>
<td>category</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
<td>name category</td>
</tr>
</tbody>
</table>
<!-- END_549109b98c9f25ebff47fb4dc23423b6 -->
<!-- START_7513823f87b59040507bd5ab26f9ceb5 -->
<h2><em>destroy</em>: Remove the specified resource from storage.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/categories/5fb6e8d76dbaeb3738258092" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/categories/5fb6e8d76dbaeb3738258092"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/categories/{category}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>category</code></td>
<td>optional</td>
<td>category</td>
</tr>
</tbody>
</table>
<!-- END_7513823f87b59040507bd5ab26f9ceb5 -->
<h1>Comment</h1>
<!-- START_11437bb938648370779cd0883f18af2b -->
<h2><em>indexByOrganization</em>: list comments</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/comments/organizations/quo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments/organizations/quo"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/comments/organizations/quidem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/comments/organizations/quidem"
=======
    -G "https://api.evius.co/api/comments/organizations/est" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/comments/organizations/est"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/comments/organizations/optio" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments/organizations/optio"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/comments/organizations/quo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments/organizations/quo"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/comments/organizations/{organization}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_11437bb938648370779cd0883f18af2b -->
<!-- START_6c560cb463cae69ddba197afa896608b -->
<h2><em>store</em>: create new coment</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"organization_id":"nisi","comment":"aperiam","image":"temporibus"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"organization_id":"repudiandae","comment":"voluptatem","image":"id"}'
=======
    -d '{"organization_id":"illum","comment":"eum","image":"qui"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"organization_id":"itaque","comment":"quis","image":"explicabo"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"organization_id":"nisi","comment":"aperiam","image":"temporibus"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "organization_id": "nisi",
    "comment": "aperiam",
    "image": "temporibus"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "organization_id": "repudiandae",
    "comment": "voluptatem",
    "image": "id"
=======
    "organization_id": "illum",
    "comment": "eum",
    "image": "qui"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "organization_id": "itaque",
    "comment": "quis",
    "image": "explicabo"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "organization_id": "nisi",
    "comment": "aperiam",
    "image": "temporibus"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/comments</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>comment</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_6c560cb463cae69ddba197afa896608b -->
<!-- START_2ac6a0d031eca72e1eee4fed61fa203c -->
<h2>Update the specified resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/comments/{comment}</code></p>
<!-- END_2ac6a0d031eca72e1eee4fed61fa203c -->
<!-- START_482189ec97ee06a20b1ee2c27cbda274 -->
<h2>Remove the specified resource from storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/comments/{comment}</code></p>
<!-- END_482189ec97ee06a20b1ee2c27cbda274 -->
<!-- START_38702aa9c6f225b36ff53e89358992ea -->
<h2><em>index</em>: list comments</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/comments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/comments</code></p>
<!-- END_38702aa9c6f225b36ff53e89358992ea -->
<h1>DiscountCode</h1>
<!-- START_a5713fe21a364fcdf05d44f3e7a88ade -->
<h2><em>index</em>: list of discount codes by template</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/discountcodetemplate/5fc80b2a31be4a3ca2419dc4/code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/5fc80b2a31be4a3ca2419dc4/code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "5fc81e8631be4a3ca2419dcc",
        "code": "puBdF3zCs",
        "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "updated_at": "2020-12-04 17:17:07",
        "created_at": "2020-12-02 23:08:54",
        "number_uses": 1
    },
    {
        "_id": "5fc825e431be4a3ca2419ddf",
        "code": "9L54R947",
        "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "updated_at": "2020-12-03 21:01:20",
        "created_at": "2020-12-02 23:40:20",
        "number_uses": 1
    },
    {
        "_id": "5fcbf67721bfcb1393450fc3",
        "code": "Nyd0jOpQ",
        "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "updated_at": "2020-12-05 21:07:03",
        "created_at": "2020-12-05 21:07:03"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/discountcodetemplate/{template_id}/code</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>template_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_a5713fe21a364fcdf05d44f3e7a88ade -->
<!-- START_394b534eecfed6413b7c504a6c534400 -->
<h2><em>store</em>: ceate new discount code</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/discountcodetemplate/5fc80b2a31be4a3ca2419dc4/code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"quantity":2}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/5fc80b2a31be4a3ca2419dc4/code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "quantity": 2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "current_page": 1,
    "data": [
        {
            "_id": "5fcbf67721bfcb1393450fc3",
            "code": "Nyd0jOpQ",
            "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
            "event_id": "5ea23acbd74d5c4b360ddde2",
            "updated_at": "2020-12-05 21:07:03",
            "created_at": "2020-12-05 21:07:03",
            "discount_code_template": {
                "_id": "5fc80b2a31be4a3ca2419dc4",
                "name": "Código de regalo",
                "discount": 100,
                "event_id": "5ea23acbd74d5c4b360ddde2",
                "use_limit": 1,
                "updated_at": "2020-12-02 21:46:18",
                "created_at": "2020-12-02 21:46:18",
                "event": {
                    "_id": "5ea23acbd74d5c4b360ddde2",
                    "name": "Evento virtual Idartes",
                    "datetime_from": "2020-10-14 12:00:00",
                    "datetime_to": "2020-10-14 12:00:00",
                    "venue": "Teatro Municipal Jorge Eliécer Gaitán"
                }
            }
        },
        {
            "_id": "5fcbf67721bfcb1393450fc4",
            "code": "Nyd0jOpR",
            "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
            "event_id": "5ea23acbd74d5c4b360ddde2",
            "updated_at": "2020-12-05 21:07:03",
            "created_at": "2020-12-05 21:07:03",
            "discount_code_template": {
                "_id": "5fc80b2a31be4a3ca2419dc4",
                "name": "Código de regalo",
                "discount": 100,
                "event_id": "5ea23acbd74d5c4b360ddde2",
                "use_limit": 1,
                "updated_at": "2020-12-02 21:46:18",
                "created_at": "2020-12-02 21:46:18",
                "event": {
                    "_id": "5ea23acbd74d5c4b360ddde2",
                    "name": "Evento virtual Idartes",
                    "datetime_from": "2020-10-14 12:00:00",
                    "datetime_to": "2020-10-14 12:00:00",
                    "venue": "Teatro Municipal Jorge Eliécer Gaitán"
                }
            }
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/discountcodetemplate/{template_id}/code</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>template_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>quantity</code></td>
<td>number</td>
<td>required</td>
<td>number of codes to be generated</td>
</tr>
</tbody>
</table>
<!-- END_394b534eecfed6413b7c504a6c534400 -->
<!-- START_eb134ba8cfdce8e85314aba306ea51bb -->
<h2><em>show</em>: view information for a specific code</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/discountcodetemplate/5fc80b2a31be4a3ca2419dc4/code/5fcbf67721bfcb1393450fc3" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/5fc80b2a31be4a3ca2419dc4/code/5fcbf67721bfcb1393450fc3"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "5fcbf67721bfcb1393450fc3",
    "code": "Nyd0jOpQ",
    "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
    "event_id": "5ea23acbd74d5c4b360ddde2",
    "updated_at": "2020-12-05 21:07:03",
    "created_at": "2020-12-05 21:07:03",
    "discount_code_template": {
        "_id": "5fc80b2a31be4a3ca2419dc4",
        "name": "Código de regalo",
        "discount": 100,
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "use_limit": 1,
        "updated_at": "2020-12-02 21:46:18",
        "created_at": "2020-12-02 21:46:18",
        "event": {
            "_id": "5ea23acbd74d5c4b360ddde2",
            "name": "Evento virtual Idartes",
            "datetime_from": "2020-10-14 12:00:00",
            "datetime_to": "2020-10-14 12:00:00",
            "venue": "Teatro Municipal Jorge Eliécer Gaitán"
        }
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/discountcodetemplate/{template_id}/code/{code}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>template_id</code></td>
<td>required</td>
<td>discount code template with which the code is associated</td>
</tr>
<tr>
<td><code>code</code></td>
<td>required</td>
<td>code to be consulted</td>
</tr>
</tbody>
</table>
<!-- END_eb134ba8cfdce8e85314aba306ea51bb -->
<!-- START_6f3ac1b580ce7ebafdb3f4ade4b97210 -->
<h2><em>update</em>: update the specified resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/discountcodetemplate/1/code/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/1/code/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/discountcodetemplate/{template_id}/code/{code}</code></p>
<p><code>PATCH api/discountcodetemplate/{template_id}/code/{code}</code></p>
<!-- END_6f3ac1b580ce7ebafdb3f4ade4b97210 -->
<!-- START_4baba7f610cfbce5ab10b0f75e032949 -->
<h2><em>destroy</em>: Remove the specified resource from storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/discountcodetemplate/dignissimos/code/corrupti" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/dignissimos/code/corrupti"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/discountcodetemplate/nemo/code/autem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/discountcodetemplate/nemo/code/autem"
=======
    "https://api.evius.co/api/discountcodetemplate/est/code/at" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/discountcodetemplate/est/code/at"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/discountcodetemplate/omnis/code/distinctio" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/omnis/code/distinctio"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/discountcodetemplate/dignissimos/code/corrupti" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/dignissimos/code/corrupti"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/discountcodetemplate/{template_id}/code/{code}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>template_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>code</code></td>
<td>required</td>
<td>id code delete</td>
</tr>
</tbody>
</table>
<!-- END_4baba7f610cfbce5ab10b0f75e032949 -->
<!-- START_ad024d13f8fadcba8151ef67354c7676 -->
<h2><em>validateCode</em> : valid if the code is redeemed, exists or is valid.</h2>
<p>To verify the code you must send code and event_id or organization_id as the case may be</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/code/validatecode" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"code":"Nyd0jOpQ","event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"quia"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"code":"Nyd0jOpQ","event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"ratione"}'
=======
    -d '{"code":"Nyd0jOpQ","event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"fuga"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"code":"Nyd0jOpQ","event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"corrupti"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"code":"Nyd0jOpQ","event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"quia"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/code/validatecode"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "Nyd0jOpQ",
    "event_id": "5ea23acbd74d5c4b360ddde2",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "organization_id": "quia"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "organization_id": "ratione"
=======
    "organization_id": "fuga"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "organization_id": "corrupti"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "organization_id": "quia"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "El código ya se uso"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "El código no existe"
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "5fcbf67721bfcb1393450fc3",
    "code": "Nyd0jOpQ",
    "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
    "event_id": "5ea23acbd74d5c4b360ddde2",
    "updated_at": "2020-12-05 21:07:03",
    "created_at": "2020-12-05 21:07:03",
    "discount_code_template": {
        "_id": "5fc80b2a31be4a3ca2419dc4",
        "name": "Código de regalo",
        "discount": 100,
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "use_limit": 1,
        "updated_at": "2020-12-02 21:46:18",
        "created_at": "2020-12-02 21:46:18",
        "event": {
            "_id": "5ea23acbd74d5c4b360ddde2",
            "name": "Evento virtual Idartes",
            "datetime_from": "2020-10-14 12:00:00",
            "datetime_to": "2020-10-14 12:00:00",
            "venue": "Teatro Municipal Jorge Eliécer Gaitán"
        }
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/code/validatecode</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>code</code></td>
<td>string</td>
<td>required</td>
<td>code to redeem</td>
</tr>
<tr>
<td><code>event_id</code></td>
<td>string</td>
<td>optional</td>
<td>event for which the code was purchased</td>
</tr>
<tr>
<td><code>organization_id</code></td>
<td>string</td>
<td>optional</td>
<td>organization so that the code applies to any event Example:</td>
</tr>
</tbody>
</table>
<!-- END_ad024d13f8fadcba8151ef67354c7676 -->
<!-- START_690924bea4cfcc7fd61b529afac550ce -->
<h2><em>redeemPointCode</em>: end point that redeems the points code and adds them to the user who redeemed it.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/code/redeem_point_code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"code":"aut"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"code":"iste"}'
=======
    -d '{"code":"nostrum"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"code":"aut"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"code":"aut"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/code/redeem_point_code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "code": "aut"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "code": "iste"
=======
    "code": "nostrum"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "code": "aut"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "code": "aut"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/code/redeem_point_code</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>code</code></td>
<td>string</td>
<td>required</td>
<td>code that the user is redeeming</td>
</tr>
</tbody>
</table>
<!-- END_690924bea4cfcc7fd61b529afac550ce -->
<!-- START_3f8e8d01c9b0e0cc305d38edd56f26a1 -->
<h2><em>codesByUser</em>: list all codes by user</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/code/codesByUser?organization=perferendis&amp;email=voluptatem" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/code/codesByUser?organization=dicta&amp;email=itaque" \
=======
    -G "https://api.evius.co/api/code/codesByUser?organization=non&amp;email=perspiciatis" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/code/codesByUser?organization=occaecati&amp;email=optio" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/code/codesByUser?organization=perferendis&amp;email=voluptatem" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/code/codesByUser"
);

let params = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "organization": "perferendis",
    "email": "voluptatem",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "organization": "dicta",
    "email": "itaque",
=======
    "organization": "non",
    "email": "perspiciatis",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "organization": "occaecati",
    "email": "optio",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "organization": "perferendis",
    "email": "voluptatem",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/code/codesByUser</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization_id</td>
</tr>
<tr>
<td><code>email</code></td>
<td>required</td>
<td>user email</td>
</tr>
</tbody>
</table>
<!-- END_3f8e8d01c9b0e0cc305d38edd56f26a1 -->
<h1>DiscountCodeTemplate</h1>
<p>The discount template is used to generate the discount codes, along with their percentage and the limit of uses for each code.</p>
<!-- START_201aa1c9edd47d2be21f4e3fc581bd0d -->
<h2><em>index</em>: list all Discount Code Templates</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/discountcodetemplate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "5fcee46a27b131731965ba7f",
        "name": "90%",
        "discount": "90",
        "use_limit": "1",
        "event_id": "5fc9bd9a6f78fc22da463509",
        "updated_at": "2021-01-11 23:01:07",
        "created_at": "2020-12-08 02:26:50",
        "discount_type": "percentage",
        "event": {
            "_id": "5fc9bd9a6f78fc22da463509",
            "datetime_from": "2021-02-22 00:00:00",
            "datetime_to": "2021-02-25 00:00:00",
            "description": "La música y la imagen como conceptos que van de la mano.  La escritura de ideas e historia , a través de la música y la imagen. Storytelling, Transmedia y captación de audiencias para proyectos musicales y artísticos.",
            "name": "Expresión Gráfica para proyectos musicales",
            "picture": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/ucronio-dev%2F05_ExpresionGrafica.jpg?alt=media&amp;token=c4bfa160-01b6-442c-8c88-2cfd57ec5942",
            "visibility": "PUBLIC"
        }
    },
    {
        "_id": "5fd4f51720b4fa0f2b4437d5",
        "name": "Curso de regalo",
        "use_limit": 1,
        "discount": 100,
        "event_id": "5ea6df83cf57da4a52065562",
        "discount_type": "price",
        "updated_at": "2020-12-12 16:51:35",
        "created_at": "2020-12-12 16:51:35",
        "event": {
            "_id": "5ea6df83cf57da4a52065562",
            "name": "Test Event",
            "datetime_from": "2020-06-01 08:00:00",
            "datetime_to": "2020-06-06 22:00:00",
            "picture": "https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/ysn7fDSU0avqNqcn2f53uoPtShKiix1tG7XkJDFw.png",
            "venue": "Mocion"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/discountcodetemplate</code></p>
<!-- END_201aa1c9edd47d2be21f4e3fc581bd0d -->
<!-- START_5fa6dfe88397f13379d24b5901980587 -->
<h2><em>store</em>:create new discount code template</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/discountcodetemplate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"Curso de regalo","use_limit":1,"discount":100,"event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"5e9caaa1d74d5c2f6a02a3c3","discount_type":"beatae"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"Curso de regalo","use_limit":1,"discount":100,"event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"5e9caaa1d74d5c2f6a02a3c3","discount_type":"dolore"}'
=======
    -d '{"name":"Curso de regalo","use_limit":1,"discount":100,"event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"5e9caaa1d74d5c2f6a02a3c3","discount_type":"atque"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"Curso de regalo","use_limit":1,"discount":100,"event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"5e9caaa1d74d5c2f6a02a3c3","discount_type":"ipsa"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"Curso de regalo","use_limit":1,"discount":100,"event_id":"5ea23acbd74d5c4b360ddde2","organization_id":"5e9caaa1d74d5c2f6a02a3c3","discount_type":"beatae"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Curso de regalo",
    "use_limit": 1,
    "discount": 100,
    "event_id": "5ea23acbd74d5c4b360ddde2",
    "organization_id": "5e9caaa1d74d5c2f6a02a3c3",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "discount_type": "beatae"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "discount_type": "dolore"
=======
    "discount_type": "atque"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "discount_type": "ipsa"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "discount_type": "beatae"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "5fc80b2a31be4a3ca2419dc4",
        "name": "Código de regalo",
        "discount": 100,
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "use_limit": 1,
        "updated_at": "2020-12-02 21:46:18",
        "created_at": "2020-12-02 21:46:18"
    },
    {
        "_id": "5fc93d5eccba7b16a74bd538",
        "name": "Acceso",
        "discount": 100,
        "event_id": "5ea23acbd74d5c4b360ddde2",
        "use_limit": 1,
        "updated_at": "2020-12-03 19:32:46",
        "created_at": "2020-12-03 19:32:46"
    },
    {
        "_id": "5fc97a186b7e7f2ff822bc92",
        "name": "Acceso1",
        "discount": "20",
        "use_limit": "10",
        "event_id": "5fba0649f2d08642eb750ba0",
        "updated_at": "2020-12-03 23:51:52",
        "created_at": "2020-12-03 23:51:52"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/discountcodetemplate</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>use_limit</code></td>
<td>number</td>
<td>required</td>
<td>the number of uses for each code</td>
</tr>
<tr>
<td><code>discount</code></td>
<td>number</td>
<td>required</td>
<td>price to be discounted or percentage discount</td>
</tr>
<tr>
<td><code>event_id</code></td>
<td>string</td>
<td>optional</td>
<td>event with which the template will be associated</td>
</tr>
<tr>
<td><code>organization_id</code></td>
<td>string</td>
<td>optional</td>
<td>organization_id if you want the discount template to be applicable to any course</td>
</tr>
<tr>
<td><code>discount_type</code></td>
<td>string</td>
<td>required</td>
<td>percentage or price</td>
</tr>
</tbody>
</table>
<!-- END_5fa6dfe88397f13379d24b5901980587 -->
<!-- START_27da3fb1931735a783b6af918eeb8072 -->
<h2><em>show</em> : information from a specific template</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/discountcodetemplate/5fcee46a27b131731965ba7f" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/5fcee46a27b131731965ba7f"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "5fcee46a27b131731965ba7f",
    "name": "90%",
    "discount": "90",
    "use_limit": "1",
    "event_id": "5fc9bd9a6f78fc22da463509",
    "updated_at": "2021-01-11 23:01:07",
    "created_at": "2020-12-08 02:26:50",
    "discount_type": "percentage",
    "event": {
        "_id": "5fc9bd9a6f78fc22da463509",
        "datetime_from": "2021-02-22 00:00:00",
        "datetime_to": "2021-02-25 00:00:00",
        "description": "La música y la imagen como conceptos que van de la mano.  La escritura de ideas e historia , a través de la música y la imagen. Storytelling, Transmedia y captación de audiencias para proyectos musicales y artísticos.",
        "name": "Expresión Gráfica para proyectos musicales",
        "picture": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/ucronio-dev%2F05_ExpresionGrafica.jpg?alt=media&amp;token=c4bfa160-01b6-442c-8c88-2cfd57ec5942",
        "visibility": "PUBLIC"
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/discountcodetemplate/{discountcodetemplate}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>discountcodetemplate</code></td>
<td>optional</td>
<td>id</td>
</tr>
</tbody>
</table>
<!-- END_27da3fb1931735a783b6af918eeb8072 -->
<!-- START_9ec4381af827ff532415a8fe08101924 -->
<h2><em>update</em>: update information from a specific template</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/discountcodetemplate/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Curso de regalo","use_limit":1,"discount":100}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Curso de regalo",
    "use_limit": 1,
    "discount": 100
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/discountcodetemplate/{discountcodetemplate}</code></p>
<p><code>PATCH api/discountcodetemplate/{discountcodetemplate}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>use_limit</code></td>
<td>number</td>
<td>optional</td>
<td>the number of uses for each code</td>
</tr>
<tr>
<td><code>discount</code></td>
<td>number</td>
<td>optional</td>
<td>discount percentage</td>
</tr>
</tbody>
</table>
<!-- END_9ec4381af827ff532415a8fe08101924 -->
<!-- START_ed37ebe6fa3939018ea0dcd848cbb868 -->
<h2><em>destroy</em>: delete the specified docunt code template</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/discountcodetemplate/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (400):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "El grupo no se puede eliminar si está asociado a un código de descuento"
}</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">1</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/discountcodetemplate/{discountcodetemplate}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>discount template id</td>
</tr>
</tbody>
</table>
<!-- END_ed37ebe6fa3939018ea0dcd848cbb868 -->
<!-- START_76981da19869ccb88996013c80fe9c56 -->
<h2><em>importCodes</em> : Imports DiscountCodes in JSON format, in case this codes are generated in external platform</h2>
<p>and needed to be used inside EVIUS</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/discountcodetemplate/1/importCodes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"":{"json":"{\"codes\":[{\"code\":\"160792352\"},{\"code\":\"204692331\"}]}"}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/1/importCodes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "": {
        "json": "{\"codes\":[{\"code\":\"160792352\"},{\"code\":\"204692331\"}]}"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/discountcodetemplate/{id}/importCodes</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>[json</code></td>
<td>object]</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_76981da19869ccb88996013c80fe9c56 -->
<!-- START_b8b03f80174c3b76c3ba70419cbfeb09 -->
<h2><em>findByOrganization</em>: find disount code template by organization</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/discountcodetemplate/findByOrganization/5e9caaa1d74d5c2f6a02a3c3" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/discountcodetemplate/findByOrganization/5e9caaa1d74d5c2f6a02a3c3"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/discountcodetemplate/findByOrganization/{organization}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<!-- END_b8b03f80174c3b76c3ba70419cbfeb09 -->
<h1>Document User</h1>
<p>This model works to manage the documents to assign to the attendees.</p>
<!-- START_2a6eabd54a9b7747080b93d32e551cc6 -->
<h2><em>index</em>: list all documents to user by event.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/nisi/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/nisi/documentusers"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/consequuntur/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/consequuntur/documentusers"
=======
    -G "https://api.evius.co/api/events/aperiam/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/aperiam/documentusers"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/sapiente/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/sapiente/documentusers"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/nisi/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/nisi/documentusers"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/documentusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event_id</td>
</tr>
</tbody>
</table>
<!-- END_2a6eabd54a9b7747080b93d32e551cc6 -->
<!-- START_821db2d0712d975ae3c831c56512e295 -->
<h2><em>show</em>: Get a document user by id</h2>
<p>Display the specified resource.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/voluptatem/documentusers/unde" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptatem/documentusers/unde"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/accusantium/documentusers/quae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/accusantium/documentusers/quae"
=======
    -G "https://api.evius.co/api/events/eos/documentusers/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/eos/documentusers/et"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/iusto/documentusers/officiis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/iusto/documentusers/officiis"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/voluptatem/documentusers/unde" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptatem/documentusers/unde"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "name": "document name",
    "url": "https:\/\/document\/img.png",
    "assign": false,
    "event_id": "602ecc7d52fc536415397962",
    "updated_at": "2021-11-16 18:29:47",
    "created_at": "2021-11-16 18:29:47",
    "_id": "6193f89bb558ed609e6f85c0"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/documentusers/{documentuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
<tr>
<td><code>documentuser</code></td>
<td>required</td>
<td>document user id</td>
</tr>
</tbody>
</table>
<!-- END_821db2d0712d975ae3c831c56512e295 -->
<!-- START_bf08af12b3a51e7d6c89e96b162a953f -->
<h2><em>store</em>: create a new document user in event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/dolor/documentusers" \
=======
    "https://devapi.evius.co/api/events/minima/documentusers" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/events/minima/documentusers" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/dolor/documentusers" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"laudantium","url":"dolore","assign":true}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/minima/documentusers"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/events/dolor/documentusers"
=======
    "https://api.evius.co/api/events/eligendi/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"velit","url":"veniam","assign":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/eligendi/documentusers"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/ea/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ipsam","url":"autem","assign":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ea/documentusers"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/minima/documentusers"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "laudantium",
    "url": "dolore",
    "assign": true
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "dolorem",
    "url": "odio",
=======
    "name": "velit",
    "url": "veniam",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "ipsam",
    "url": "autem",
>>>>>>> rolesEtapa2
    "assign": false
<<<<<<< HEAD
=======
    "name": "laudantium",
    "url": "dolore",
    "assign": true
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
    "name": "document name",
    "url": "https:\/\/document\/img.png",
    "assign": false,
    "event_id": "602ecc7d52fc536415397962",
    "updated_at": "2021-11-16 18:29:47",
    "created_at": "2021-11-16 18:29:47",
    "_id": "6193f89bb558ed609e6f85c0"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/documentusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>Document name.</td>
</tr>
<tr>
<td><code>url</code></td>
<td>string</td>
<td>required</td>
<td>Document url.</td>
</tr>
<tr>
<td><code>assign</code></td>
<td>boolean</td>
<td>required</td>
<td>This indicate if the document is assigned to a user.</td>
</tr>
</tbody>
</table>
<!-- END_bf08af12b3a51e7d6c89e96b162a953f -->
<!-- START_7a95b32bdae437425a365b1842f435aa -->
<h2><em>update</em>: Update a document user by id</h2>
<p>Update the specified resource in storage.</p>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ea/documentusers/culpa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ea/documentusers/culpa"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/et/documentusers/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/et/documentusers/et"
=======
    "https://api.evius.co/api/events/quisquam/documentusers/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/quisquam/documentusers/et"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/cupiditate/documentusers/dolorum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/cupiditate/documentusers/dolorum"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ea/documentusers/culpa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ea/documentusers/culpa"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "name": "updated document name",
    "url": "https:\/\/document\/img.png",
    "assign": false,
    "event_id": "602ecc7d52fc536415397962",
    "updated_at": "2021-11-16 18:29:47",
    "created_at": "2021-11-16 18:29:47",
    "_id": "6193f89bb558ed609e6f85c0"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/documentusers/{documentuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
<tr>
<td><code>documentuser</code></td>
<td>required</td>
<td>document user id</td>
</tr>
</tbody>
</table>
<!-- END_7a95b32bdae437425a365b1842f435aa -->
<!-- START_d4541c3d1709aa360459e62ae6b3ef33 -->
<h2><em>destroy</em>: Delete a document user by id</h2>
<p>Remove the specified resource from storage.</p>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ex/documentusers/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ex/documentusers/aut"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/sunt/documentusers/omnis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/sunt/documentusers/omnis"
=======
    "https://api.evius.co/api/events/ipsum/documentusers/eum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/ipsum/documentusers/eum"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/vero/documentusers/porro" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/vero/documentusers/porro"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ex/documentusers/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ex/documentusers/aut"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (204):</p>
</blockquote>
<pre><code class="language-json">{}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/documentusers/{documentuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
<tr>
<td><code>documentuser</code></td>
<td>required</td>
<td>document user id</td>
</tr>
</tbody>
</table>
<!-- END_d4541c3d1709aa360459e62ae6b3ef33 -->
<!-- START_10e99476f37db4f919ba13cc5d830287 -->
<h2><em>documentsUserByEvent</em>: list the documents of a logged in user.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/voluptas/me/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptas/me/documentusers"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/cum/me/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/cum/me/documentusers"
=======
    -G "https://api.evius.co/api/events/quos/me/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/quos/me/documentusers"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/est/me/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/est/me/documentusers"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/voluptas/me/documentusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptas/me/documentusers"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/me/documentusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<!-- END_10e99476f37db4f919ba13cc5d830287 -->
<h1>Documents</h1>
<p>The documents are file that you can downloads from event.</p>
<!-- START_ac7c4e2e7ba17649bbd99e23de766cee -->
<h2><em>index</em> : list documents by event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/cumque/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/cumque/documents"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/nobis/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/nobis/documents"
=======
    -G "https://api.evius.co/api/events/dolores/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/dolores/documents"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/officiis/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/officiis/documents"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/cumque/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/cumque/documents"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "first": "http:\/\/localhost\/api\/events\/cumque\/documents?page=1",
        "last": "http:\/\/localhost\/api\/events\/cumque\/documents?page=1",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "first": "http:\/\/localhost\/api\/events\/nobis\/documents?page=1",
        "last": "http:\/\/localhost\/api\/events\/nobis\/documents?page=1",
=======
        "first": "http:\/\/localhost\/api\/events\/dolores\/documents?page=1",
        "last": "http:\/\/localhost\/api\/events\/dolores\/documents?page=1",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "first": "http:\/\/localhost\/api\/events\/officiis\/documents?page=1",
        "last": "http:\/\/localhost\/api\/events\/officiis\/documents?page=1",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "first": "http:\/\/localhost\/api\/events\/cumque\/documents?page=1",
        "last": "http:\/\/localhost\/api\/events\/cumque\/documents?page=1",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "path": "http:\/\/localhost\/api\/events\/cumque\/documents",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "path": "http:\/\/localhost\/api\/events\/nobis\/documents",
=======
        "path": "http:\/\/localhost\/api\/events\/dolores\/documents",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "path": "http:\/\/localhost\/api\/events\/officiis\/documents",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "path": "http:\/\/localhost\/api\/events\/cumque\/documents",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/documents</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event_id</td>
</tr>
</tbody>
</table>
<!-- END_ac7c4e2e7ba17649bbd99e23de766cee -->
<!-- START_90eb8a785fe9d0335f98ad8905d3a0ed -->
<h2><em>store</em>: create documents in the event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ad/documents" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/similique/documents" \
=======
    "https://api.evius.co/api/events/aperiam/documents" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/perferendis/documents" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ad/documents" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"gato.jpg","title":"gato.jpg","format":"jpg","type":"file","file":"https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/documents%2F61a65a6c47430f7aae79cca4%2F1639168484513-gato4.jpg?alt=media&amp;token=1455a85f-6381-4a92-a00e-47c916ed236c"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ad/documents"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/similique/documents"
=======
    "https://api.evius.co/api/events/aperiam/documents"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/perferendis/documents"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ad/documents"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "gato.jpg",
    "title": "gato.jpg",
    "format": "jpg",
    "type": "file",
    "file": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/documents%2F61a65a6c47430f7aae79cca4%2F1639168484513-gato4.jpg?alt=media&amp;token=1455a85f-6381-4a92-a00e-47c916ed236c"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/documents</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>required</td>
<td>optional</td>
<td>name</td>
</tr>
<tr>
<td><code>title</code></td>
<td>required</td>
<td>optional</td>
<td>title</td>
</tr>
<tr>
<td><code>format</code></td>
<td>required</td>
<td>optional</td>
<td>name</td>
</tr>
<tr>
<td><code>type</code></td>
<td>required</td>
<td>optional</td>
<td>type</td>
</tr>
<tr>
<td><code>file</code></td>
<td>required</td>
<td>optional</td>
<td>url document</td>
</tr>
</tbody>
</table>
<!-- END_90eb8a785fe9d0335f98ad8905d3a0ed -->
<!-- START_eced5d59e8bfbfcb2d3e52c9f1ffd318 -->
<h2><em>show</em>: information from a specific document</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/rerum/documents/sequi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/rerum/documents/sequi"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/quam/documents/sed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/quam/documents/sed"
=======
    -G "https://api.evius.co/api/events/sequi/documents/a" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/sequi/documents/a"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/voluptatibus/documents/sint" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptatibus/documents/sint"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/rerum/documents/sequi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/rerum/documents/sequi"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "message": "No query results for model [App\\Documents] sequi"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "message": "No query results for model [App\\Documents] sed"
=======
    "message": "No query results for model [App\\Documents] a"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "message": "No query results for model [App\\Documents] sint"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "message": "No query results for model [App\\Documents] sequi"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/documents/{document}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
<tr>
<td><code>document</code></td>
<td>required</td>
<td>evdocdocumentumentent id</td>
</tr>
</tbody>
</table>
<!-- END_eced5d59e8bfbfcb2d3e52c9f1ffd318 -->
<!-- START_79359dc7a323d27f72b9b0c0f55930c5 -->
<h2><em>store</em>: create documents in the event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/sit/documents/1" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/nisi/documents/1" \
=======
    "https://api.evius.co/api/events/optio/documents/1" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/odio/documents/1" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/sit/documents/1" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"gato.jpg","title":"gato.jpg","format":"jpg","type":"file","file":"https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/documents%2F61a65a6c47430f7aae79cca4%2F1639168484513-gato4.jpg?alt=media&amp;token=1455a85f-6381-4a92-a00e-47c916ed236c"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/sit/documents/1"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/nisi/documents/1"
=======
    "https://api.evius.co/api/events/optio/documents/1"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/odio/documents/1"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/sit/documents/1"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "gato.jpg",
    "title": "gato.jpg",
    "format": "jpg",
    "type": "file",
    "file": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/documents%2F61a65a6c47430f7aae79cca4%2F1639168484513-gato4.jpg?alt=media&amp;token=1455a85f-6381-4a92-a00e-47c916ed236c"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/documents/{document}</code></p>
<p><code>PATCH api/events/{event}/documents/{document}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>required</td>
<td>optional</td>
<td>name</td>
</tr>
<tr>
<td><code>title</code></td>
<td>required</td>
<td>optional</td>
<td>title</td>
</tr>
<tr>
<td><code>format</code></td>
<td>required</td>
<td>optional</td>
<td>name</td>
</tr>
<tr>
<td><code>type</code></td>
<td>required</td>
<td>optional</td>
<td>type</td>
</tr>
<tr>
<td><code>file</code></td>
<td>required</td>
<td>optional</td>
<td>url document</td>
</tr>
</tbody>
</table>
<!-- END_79359dc7a323d27f72b9b0c0f55930c5 -->
<!-- START_dd680f9966c666d6385239c68c07f2cb -->
<h2><em>destroy</em>: delete a specific document</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/sapiente/documents/ipsam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/sapiente/documents/ipsam"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/omnis/documents/nostrum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/omnis/documents/nostrum"
=======
    "https://api.evius.co/api/events/rem/documents/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/rem/documents/et"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/ut/documents/ad" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ut/documents/ad"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/sapiente/documents/ipsam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/sapiente/documents/ipsam"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/documents/{document}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
<tr>
<td><code>document</code></td>
<td>required</td>
<td>evdocdocumentumentent id</td>
</tr>
</tbody>
</table>
<!-- END_dd680f9966c666d6385239c68c07f2cb -->
<h1>Event</h1>
<!-- START_3cb2d4356d9cbfc3731f111cf37179eb -->
<h2><em>EventbyOrganizations</em>: search of events by user organizer.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organizations/1/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/organizations\/1\/events?page=1",
        "last": "http:\/\/localhost\/api\/organizations\/1\/events?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/organizations\/1\/events",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/events</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>organizer_id</td>
</tr>
</tbody>
</table>
<!-- END_3cb2d4356d9cbfc3731f111cf37179eb -->
<!-- START_de725938ba779adbbb84d8bf81220ce7 -->
<h2><em>eventsstadistics</em>:</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/accusamus/eventsstadistics" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/accusamus/eventsstadistics"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/organizations/repellendus/eventsstadistics" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/repellendus/eventsstadistics"
=======
    -G "https://api.evius.co/api/organizations/est/eventsstadistics" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/est/eventsstadistics"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/organizations/aut/eventsstadistics" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/aut/eventsstadistics"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/accusamus/eventsstadistics" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/accusamus/eventsstadistics"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": []
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/eventsstadistics</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>optional</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<!-- END_de725938ba779adbbb84d8bf81220ce7 -->
<!-- START_742a1cbd4a274c7269f0db99a704ff41 -->
<h2><em>index:</em> Listing of all events</h2>
<p>This method allows dynamic querying of any property through the URL using FilterQuery services for example : Exmaple: [{&quot;id&quot;:&quot;event_type_id&quot;,&quot;value&quot;:[&quot;5bb21557af7ea71be746e98x&quot;,&quot;5bb21557af7ea71be746e98b&quot;]}]</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events?filtered=%5B%7B%22field%22%3A%22name%22%2C%22value%22%3A%5B%22Demo%22%5D%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events"
);

let params = {
    "filtered": "[{"field":"name","value":["Demo"]}]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "61a687713bbf847b3f59d117",
    "name": "Demo",
    "address": null,
    "type_event": "onlineEvent",
    "datetime_from": "2021-11-30 15:18:00",
    "datetime_to": "2021-11-30 16:18:00",
    "picture": null,
    "venue": null,
    "location": null,
    "visibility": "PUBLIC",
    "description": null,
    "allow_register": true,
    "styles": {
        "buttonColor": "#FFF",
        "banner_color": "#FFF",
        "menu_color": "#FFF",
        "event_image": null,
        "banner_image": null,
        "menu_image": null,
        "banner_image_email": null,
        "footer_image_email": "",
        "brandPrimary": "#FFFFFF",
        "brandSuccess": "#FFFFFF",
        "brandInfo": "#FFFFFF",
        "brandDanger": "#FFFFFF",
        "containerBgColor": "#ffffff",
        "brandWarning": "#FFFFFF",
        "toolbarDefaultBg": "#FFFFFF",
        "brandDark": "#FFFFFF",
        "brandLight": "#FFFFFF",
        "textMenu": "#555352",
        "activeText": "#FFFFFF",
        "bgButtonsEvent": "#FFFFFF",
        "BackgroundImage": null,
        "FooterImage": null,
        "banner_footer": null,
        "mobile_banner": null,
        "banner_footer_email": null,
        "show_banner": "true",
        "show_card_banner": false,
        "show_inscription": false,
        "hideDatesAgenda": true,
        "hideDatesAgendaItem": false,
        "hideHoursAgenda": false,
        "hideBtnDetailAgenda": true,
        "loader_page": "no",
        "data_loader_page": null
    },
    "author_id": "61a685292e66fd61921378f2",
    "organizer_id": "61a687203bbf847b3f59d113",
    "event_type_id": "5bf47203754e2317e4300b68",
    "updated_at": "2021-11-30 20:20:03",
    "created_at": "2021-11-30 20:20:01",
    "user_properties": [
        {
            "name": "email",
            "label": "Correo",
            "unique": false,
            "mandatory": false,
            "type": "email",
            "updated_at": {
                "$date": {
                    "$numberLong": "1638303602342"
                }
            }
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>filtered</code></td>
<td>optional</td>
<td>optional filter parameters</td>
</tr>
</tbody>
</table>
<!-- END_742a1cbd4a274c7269f0db99a704ff41 -->
<!-- START_de3413bf02c9bb71627fa96e1c1c409f -->
<h2><em>store</em>: Create new event of the organizer.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"architecto","picture":"quaerat","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"quia","picture":"saepe","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"dolores","picture":"quae","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"quidem","picture":"rem","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"architecto","picture":"quaerat","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "adress": "Avenida siempre viva",
    "datetime_from": "2020-10-16 18:00:00",
    "datetime_to": "2020-10-16 21:00:00",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "type_event": "architecto",
    "picture": "quaerat",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "type_event": "quia",
    "picture": "saepe",
=======
    "type_event": "dolores",
    "picture": "quae",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "type_event": "quidem",
    "picture": "rem",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "type_event": "architecto",
    "picture": "quaerat",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "venue": "Venue B",
    "location": {
        "Latitude": 4.668184,
        "Longitude": -74.051968,
        "number": "#123",
        "street": "Avenida siempre viva",
        "city": "Bogot\u00e1",
        "state": "Bogot\u00e1 D.C",
        "FormattedAddress": "Av. Siempre viva #123, Bogot\u00e1, Colombia"
    },
    "visibility": "PUBLIC",
    "user_properties": [],
    "description": "Evento para mostrel funcionamiento de la plataforma.",
    "event_type_id": "5bf47226754e2317e4300b6a",
    "organizer_id": "5e9caaa1d74d5c2f6a02a3c3",
    "category_ids": [],
    "styles": {
        "buttonColor": "#FFF",
        "banner_color": "#FFF",
        "menu_color": "#FFF",
        "brandPrimary": "#FFFFFF",
        "brandSuccess": "#FFFFFF",
        "brandInfo": "#FFFFFF",
        "brandDanger": "#FFFFFF",
        "containerBgColor": "#FFFFFF",
        "brandWarning": "#FFFFFF",
        "brandDark": "#FFFFFF",
        "brandLight": "#FFFFFF",
        "textMenu": "#555352",
        "activeText": "#FFFFFF",
        "bgButtonsEvent": "#FFFFFF"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name to event</td>
</tr>
<tr>
<td><code>adress</code></td>
<td>string</td>
<td>optional</td>
<td>adress when is the event.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>datetime</td>
<td>required</td>
<td>date and time of start of the event</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>datetime</td>
<td>optional</td>
<td>date and time of the end of the event</td>
</tr>
<tr>
<td><code>type_event</code></td>
<td>string</td>
<td>required</td>
<td>This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>image of the event</td>
</tr>
<tr>
<td><code>venue</code></td>
<td>string</td>
<td>optional</td>
<td>Event venue.</td>
</tr>
<tr>
<td><code>location</code></td>
<td>object</td>
<td>optional</td>
<td>This parameter specific all information of event location.</td>
</tr>
<tr>
<td><code>location.Latitude</code></td>
<td>float</td>
<td>optional</td>
<td>Latitude coordinates</td>
</tr>
<tr>
<td><code>location.Longitude</code></td>
<td>float</td>
<td>optional</td>
<td>Longitude coordinates</td>
</tr>
<tr>
<td><code>location.number</code></td>
<td>string</td>
<td>optional</td>
<td>Number build</td>
</tr>
<tr>
<td><code>location.street</code></td>
<td>string</td>
<td>optional</td>
<td>Event street</td>
</tr>
<tr>
<td><code>location.city</code></td>
<td>string</td>
<td>optional</td>
<td>Event city</td>
</tr>
<tr>
<td><code>location.state</code></td>
<td>string</td>
<td>optional</td>
<td>Event state</td>
</tr>
<tr>
<td><code>location.FormattedAddress</code></td>
<td>string</td>
<td>optional</td>
<td>Epecific complete adress</td>
</tr>
<tr>
<td><code>visibility</code></td>
<td>string</td>
<td>required</td>
<td>restricts access for registered users or any unregistered user</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>optional</td>
<td>user registration properties.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>Explanation about  event.</td>
</tr>
<tr>
<td><code>event_type_id</code></td>
<td>string</td>
<td>required</td>
<td>App\EventType This a event</td>
</tr>
<tr>
<td><code>organizer_id</code></td>
<td>string</td>
<td>required</td>
<td>Id Event's organization</td>
</tr>
<tr>
<td><code>category_ids</code></td>
<td>array</td>
<td>optional</td>
<td>App\Category</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>object</td>
<td>required</td>
<td>This is the event's appearance</td>
</tr>
<tr>
<td><code>styles.buttonColor</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.banner_color</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.menu_color</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandPrimary</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandSuccess</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandInfo</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandDanger</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.containerBgColor</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandWarning</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandDark</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandLight</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.textMenu</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.activeText</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.bgButtonsEvent</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_de3413bf02c9bb71627fa96e1c1c409f -->
<!-- START_379a3beb17bbb91528d80d8507f69655 -->
<h2><em>show</em>: display information about a specific event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/61a687713bbf847b3f59d117" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61a687713bbf847b3f59d117"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "61a687713bbf847b3f59d117",
    "name": "Demo",
    "address": null,
    "type_event": "onlineEvent",
    "datetime_from": "2021-11-30 15:18:00",
    "datetime_to": "2021-11-30 16:18:00",
    "picture": null,
    "venue": null,
    "location": null,
    "visibility": "PUBLIC",
    "description": null,
    "allow_register": true,
    "styles": {
        "buttonColor": "#FFF",
        "banner_color": "#FFF",
        "menu_color": "#FFF",
        "event_image": null,
        "banner_image": null,
        "menu_image": null,
        "banner_image_email": null,
        "footer_image_email": "",
        "brandPrimary": "#FFFFFF",
        "brandSuccess": "#FFFFFF",
        "brandInfo": "#FFFFFF",
        "brandDanger": "#FFFFFF",
        "containerBgColor": "#ffffff",
        "brandWarning": "#FFFFFF",
        "toolbarDefaultBg": "#FFFFFF",
        "brandDark": "#FFFFFF",
        "brandLight": "#FFFFFF",
        "textMenu": "#555352",
        "activeText": "#FFFFFF",
        "bgButtonsEvent": "#FFFFFF",
        "BackgroundImage": null,
        "FooterImage": null,
        "banner_footer": null,
        "mobile_banner": null,
        "banner_footer_email": null,
        "show_banner": "true",
        "show_card_banner": false,
        "show_inscription": false,
        "hideDatesAgenda": true,
        "hideDatesAgendaItem": false,
        "hideHoursAgenda": false,
        "hideBtnDetailAgenda": true,
        "loader_page": "no",
        "data_loader_page": null
    },
    "author_id": "61a685292e66fd61921378f2",
    "organizer_id": "61a687203bbf847b3f59d113",
    "event_type_id": "5bf47203754e2317e4300b68",
    "updated_at": "2021-11-30 20:20:03",
    "created_at": "2021-11-30 20:20:01",
    "user_properties": [
        {
            "name": "email",
            "label": "Correo",
            "unique": false,
            "mandatory": false,
            "type": "email",
            "updated_at": {
                "$date": {
                    "$numberLong": "1638303602342"
                }
            }
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id of the event you want to consult.</td>
</tr>
</tbody>
</table>
<!-- END_379a3beb17bbb91528d80d8507f69655 -->
<!-- START_d16967fd1d3d935666f7e8112a1a4451 -->
<h2><em>update</em>: update information on a specific event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/est" \
=======
    "https://devapi.evius.co/api/events/qui" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/events/qui" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/est" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"illo","picture":"accusamus","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/qui"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/events/est"
=======
    "https://api.evius.co/api/events/pariatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"aspernatur","picture":"fugiat","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/pariatur"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/doloremque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"minus","picture":"aut","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/doloremque"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/qui"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "adress": "Avenida siempre viva",
    "datetime_from": "2020-10-16 18:00:00",
    "datetime_to": "2020-10-16 21:00:00",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "type_event": "illo",
    "picture": "accusamus",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "type_event": "quod",
    "picture": "rerum",
=======
    "type_event": "aspernatur",
    "picture": "fugiat",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "type_event": "minus",
    "picture": "aut",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "type_event": "illo",
    "picture": "accusamus",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "venue": "Venue B",
    "location": {},
    "visibility": "PUBLIC",
    "user_properties": [],
    "description": "Evento para mostrel funcionamiento de la plataforma.",
    "event_type_id": "5bf47226754e2317e4300b6a",
    "organizer_id": "5e9caaa1d74d5c2f6a02a3c3",
    "category_ids": [],
    "styles": {}
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}</code></p>
<p><code>PATCH api/events/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id of the event to be updated</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name to event</td>
</tr>
<tr>
<td><code>adress</code></td>
<td>string</td>
<td>optional</td>
<td>adress when is the event.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>datetime</td>
<td>required</td>
<td>date and time of start of the event</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>datetime</td>
<td>optional</td>
<td>date and time of the end of the event</td>
</tr>
<tr>
<td><code>type_event</code></td>
<td>string</td>
<td>required</td>
<td>This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>image of the event</td>
</tr>
<tr>
<td><code>venue</code></td>
<td>string</td>
<td>optional</td>
<td>Event venue.</td>
</tr>
<tr>
<td><code>location</code></td>
<td>object</td>
<td>optional</td>
<td>This parameter specific all information of event location.</td>
</tr>
<tr>
<td><code>visibility</code></td>
<td>string</td>
<td>required</td>
<td>restricts access for registered users or any unregistered user</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>optional</td>
<td>user registration properties.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>Explanation about  event.</td>
</tr>
<tr>
<td><code>event_type_id</code></td>
<td>string</td>
<td>required</td>
<td>App\EventType This a event</td>
</tr>
<tr>
<td><code>organizer_id</code></td>
<td>string</td>
<td>required</td>
<td>Id Event's organization</td>
</tr>
<tr>
<td><code>category_ids</code></td>
<td>array</td>
<td>optional</td>
<td>App\Category</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>object</td>
<td>required</td>
<td>This is the event's appearance</td>
</tr>
</tbody>
</table>
<!-- END_d16967fd1d3d935666f7e8112a1a4451 -->
<!-- START_379a30feb2949828b5f95efbfd7649c3 -->
<h2><em>destroy</em>: delete event and related data.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/consequatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/consequatur"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/expedita" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/expedita"
=======
    "https://api.evius.co/api/events/quidem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/quidem"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/hic" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/hic"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/consequatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/consequatur"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id of the event to be eliminated</td>
</tr>
</tbody>
</table>
<!-- END_379a30feb2949828b5f95efbfd7649c3 -->
<!-- START_66dbd029b818c574790a13910308d53a -->
<h2><em>store</em>: Create new event of the organizer.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"debitis","picture":"est","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"id","picture":"voluptas","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"eum","picture":"ut","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"expedita","picture":"sint","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"debitis","picture":"est","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "adress": "Avenida siempre viva",
    "datetime_from": "2020-10-16 18:00:00",
    "datetime_to": "2020-10-16 21:00:00",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "type_event": "debitis",
    "picture": "est",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "type_event": "id",
    "picture": "voluptas",
=======
    "type_event": "eum",
    "picture": "ut",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "type_event": "expedita",
    "picture": "sint",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "type_event": "debitis",
    "picture": "est",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "venue": "Venue B",
    "location": {
        "Latitude": 4.668184,
        "Longitude": -74.051968,
        "number": "#123",
        "street": "Avenida siempre viva",
        "city": "Bogot\u00e1",
        "state": "Bogot\u00e1 D.C",
        "FormattedAddress": "Av. Siempre viva #123, Bogot\u00e1, Colombia"
    },
    "visibility": "PUBLIC",
    "user_properties": [],
    "description": "Evento para mostrel funcionamiento de la plataforma.",
    "event_type_id": "5bf47226754e2317e4300b6a",
    "organizer_id": "5e9caaa1d74d5c2f6a02a3c3",
    "category_ids": [],
    "styles": {
        "buttonColor": "#FFF",
        "banner_color": "#FFF",
        "menu_color": "#FFF",
        "brandPrimary": "#FFFFFF",
        "brandSuccess": "#FFFFFF",
        "brandInfo": "#FFFFFF",
        "brandDanger": "#FFFFFF",
        "containerBgColor": "#FFFFFF",
        "brandWarning": "#FFFFFF",
        "brandDark": "#FFFFFF",
        "brandLight": "#FFFFFF",
        "textMenu": "#555352",
        "activeText": "#FFFFFF",
        "bgButtonsEvent": "#FFFFFF"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name to event</td>
</tr>
<tr>
<td><code>adress</code></td>
<td>string</td>
<td>optional</td>
<td>adress when is the event.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>datetime</td>
<td>required</td>
<td>date and time of start of the event</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>datetime</td>
<td>optional</td>
<td>date and time of the end of the event</td>
</tr>
<tr>
<td><code>type_event</code></td>
<td>string</td>
<td>required</td>
<td>This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>image of the event</td>
</tr>
<tr>
<td><code>venue</code></td>
<td>string</td>
<td>optional</td>
<td>Event venue.</td>
</tr>
<tr>
<td><code>location</code></td>
<td>object</td>
<td>optional</td>
<td>This parameter specific all information of event location.</td>
</tr>
<tr>
<td><code>location.Latitude</code></td>
<td>float</td>
<td>optional</td>
<td>Latitude coordinates</td>
</tr>
<tr>
<td><code>location.Longitude</code></td>
<td>float</td>
<td>optional</td>
<td>Longitude coordinates</td>
</tr>
<tr>
<td><code>location.number</code></td>
<td>string</td>
<td>optional</td>
<td>Number build</td>
</tr>
<tr>
<td><code>location.street</code></td>
<td>string</td>
<td>optional</td>
<td>Event street</td>
</tr>
<tr>
<td><code>location.city</code></td>
<td>string</td>
<td>optional</td>
<td>Event city</td>
</tr>
<tr>
<td><code>location.state</code></td>
<td>string</td>
<td>optional</td>
<td>Event state</td>
</tr>
<tr>
<td><code>location.FormattedAddress</code></td>
<td>string</td>
<td>optional</td>
<td>Epecific complete adress</td>
</tr>
<tr>
<td><code>visibility</code></td>
<td>string</td>
<td>required</td>
<td>restricts access for registered users or any unregistered user</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>optional</td>
<td>user registration properties.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>Explanation about  event.</td>
</tr>
<tr>
<td><code>event_type_id</code></td>
<td>string</td>
<td>required</td>
<td>App\EventType This a event</td>
</tr>
<tr>
<td><code>organizer_id</code></td>
<td>string</td>
<td>required</td>
<td>Id Event's organization</td>
</tr>
<tr>
<td><code>category_ids</code></td>
<td>array</td>
<td>optional</td>
<td>App\Category</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>object</td>
<td>required</td>
<td>This is the event's appearance</td>
</tr>
<tr>
<td><code>styles.buttonColor</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.banner_color</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.menu_color</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandPrimary</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandSuccess</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandInfo</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandDanger</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.containerBgColor</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandWarning</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandDark</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandLight</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.textMenu</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.activeText</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.bgButtonsEvent</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_66dbd029b818c574790a13910308d53a -->
<!-- START_388e610b5754b1df34564c1c6c66a126 -->
<h2><em>update</em>: update information on a specific event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/voluptatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"voluptatem","picture":"consequatur","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptatibus"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://devapi.evius.co/api/events/eum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"impedit","picture":"sint","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"dignissimos","picture":"accusamus","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"et","picture":"earum","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
>>>>>>> rolesEtapa2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/eum"
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/voluptatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"voluptatem","picture":"consequatur","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/voluptatibus"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "adress": "Avenida siempre viva",
    "datetime_from": "2020-10-16 18:00:00",
    "datetime_to": "2020-10-16 21:00:00",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "type_event": "voluptatem",
    "picture": "consequatur",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "type_event": "impedit",
    "picture": "sint",
=======
    "type_event": "dignissimos",
    "picture": "accusamus",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "type_event": "et",
    "picture": "earum",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "type_event": "voluptatem",
    "picture": "consequatur",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "venue": "Venue B",
    "location": {},
    "visibility": "PUBLIC",
    "user_properties": [],
    "description": "Evento para mostrel funcionamiento de la plataforma.",
    "event_type_id": "5bf47226754e2317e4300b6a",
    "organizer_id": "5e9caaa1d74d5c2f6a02a3c3",
    "category_ids": [],
    "styles": {}
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id of the event to be updated</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name to event</td>
</tr>
<tr>
<td><code>adress</code></td>
<td>string</td>
<td>optional</td>
<td>adress when is the event.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>datetime</td>
<td>required</td>
<td>date and time of start of the event</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>datetime</td>
<td>optional</td>
<td>date and time of the end of the event</td>
</tr>
<tr>
<td><code>type_event</code></td>
<td>string</td>
<td>required</td>
<td>This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>image of the event</td>
</tr>
<tr>
<td><code>venue</code></td>
<td>string</td>
<td>optional</td>
<td>Event venue.</td>
</tr>
<tr>
<td><code>location</code></td>
<td>object</td>
<td>optional</td>
<td>This parameter specific all information of event location.</td>
</tr>
<tr>
<td><code>visibility</code></td>
<td>string</td>
<td>required</td>
<td>restricts access for registered users or any unregistered user</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>optional</td>
<td>user registration properties.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>Explanation about  event.</td>
</tr>
<tr>
<td><code>event_type_id</code></td>
<td>string</td>
<td>required</td>
<td>App\EventType This a event</td>
</tr>
<tr>
<td><code>organizer_id</code></td>
<td>string</td>
<td>required</td>
<td>Id Event's organization</td>
</tr>
<tr>
<td><code>category_ids</code></td>
<td>array</td>
<td>optional</td>
<td>App\Category</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>object</td>
<td>required</td>
<td>This is the event's appearance</td>
</tr>
</tbody>
</table>
<!-- END_388e610b5754b1df34564c1c6c66a126 -->
<!-- START_aec83efbad5ec636ec1b29352c041932 -->
<h2><em>currentUserindex</em>: list of events of the organizer who is logged in</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/events</code></p>
<!-- END_aec83efbad5ec636ec1b29352c041932 -->
<!-- START_2478aef777186232e8bca32fdf09efe3 -->
<h2><em>store</em>: Create new event of the organizer.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/user/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"est","picture":"quos","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"repudiandae","picture":"sequi","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"quaerat","picture":"asperiores","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"harum","picture":"omnis","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"est","picture":"quos","venue":"Venue B","location":{"Latitude":4.668184,"Longitude":-74.051968,"number":"#123","street":"Avenida siempre viva","city":"Bogot\u00e1","state":"Bogot\u00e1 D.C","FormattedAddress":"Av. Siempre viva #123, Bogot\u00e1, Colombia"},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{"buttonColor":"#FFF","banner_color":"#FFF","menu_color":"#FFF","brandPrimary":"#FFFFFF","brandSuccess":"#FFFFFF","brandInfo":"#FFFFFF","brandDanger":"#FFFFFF","containerBgColor":"#FFFFFF","brandWarning":"#FFFFFF","brandDark":"#FFFFFF","brandLight":"#FFFFFF","textMenu":"#555352","activeText":"#FFFFFF","bgButtonsEvent":"#FFFFFF"}}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/user/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "adress": "Avenida siempre viva",
    "datetime_from": "2020-10-16 18:00:00",
    "datetime_to": "2020-10-16 21:00:00",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "type_event": "est",
    "picture": "quos",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "type_event": "repudiandae",
    "picture": "sequi",
=======
    "type_event": "quaerat",
    "picture": "asperiores",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "type_event": "harum",
    "picture": "omnis",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "type_event": "est",
    "picture": "quos",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "venue": "Venue B",
    "location": {
        "Latitude": 4.668184,
        "Longitude": -74.051968,
        "number": "#123",
        "street": "Avenida siempre viva",
        "city": "Bogot\u00e1",
        "state": "Bogot\u00e1 D.C",
        "FormattedAddress": "Av. Siempre viva #123, Bogot\u00e1, Colombia"
    },
    "visibility": "PUBLIC",
    "user_properties": [],
    "description": "Evento para mostrel funcionamiento de la plataforma.",
    "event_type_id": "5bf47226754e2317e4300b6a",
    "organizer_id": "5e9caaa1d74d5c2f6a02a3c3",
    "category_ids": [],
    "styles": {
        "buttonColor": "#FFF",
        "banner_color": "#FFF",
        "menu_color": "#FFF",
        "brandPrimary": "#FFFFFF",
        "brandSuccess": "#FFFFFF",
        "brandInfo": "#FFFFFF",
        "brandDanger": "#FFFFFF",
        "containerBgColor": "#FFFFFF",
        "brandWarning": "#FFFFFF",
        "brandDark": "#FFFFFF",
        "brandLight": "#FFFFFF",
        "textMenu": "#555352",
        "activeText": "#FFFFFF",
        "bgButtonsEvent": "#FFFFFF"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/user/events</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name to event</td>
</tr>
<tr>
<td><code>adress</code></td>
<td>string</td>
<td>optional</td>
<td>adress when is the event.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>datetime</td>
<td>required</td>
<td>date and time of start of the event</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>datetime</td>
<td>optional</td>
<td>date and time of the end of the event</td>
</tr>
<tr>
<td><code>type_event</code></td>
<td>string</td>
<td>required</td>
<td>This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>image of the event</td>
</tr>
<tr>
<td><code>venue</code></td>
<td>string</td>
<td>optional</td>
<td>Event venue.</td>
</tr>
<tr>
<td><code>location</code></td>
<td>object</td>
<td>optional</td>
<td>This parameter specific all information of event location.</td>
</tr>
<tr>
<td><code>location.Latitude</code></td>
<td>float</td>
<td>optional</td>
<td>Latitude coordinates</td>
</tr>
<tr>
<td><code>location.Longitude</code></td>
<td>float</td>
<td>optional</td>
<td>Longitude coordinates</td>
</tr>
<tr>
<td><code>location.number</code></td>
<td>string</td>
<td>optional</td>
<td>Number build</td>
</tr>
<tr>
<td><code>location.street</code></td>
<td>string</td>
<td>optional</td>
<td>Event street</td>
</tr>
<tr>
<td><code>location.city</code></td>
<td>string</td>
<td>optional</td>
<td>Event city</td>
</tr>
<tr>
<td><code>location.state</code></td>
<td>string</td>
<td>optional</td>
<td>Event state</td>
</tr>
<tr>
<td><code>location.FormattedAddress</code></td>
<td>string</td>
<td>optional</td>
<td>Epecific complete adress</td>
</tr>
<tr>
<td><code>visibility</code></td>
<td>string</td>
<td>required</td>
<td>restricts access for registered users or any unregistered user</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>optional</td>
<td>user registration properties.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>Explanation about  event.</td>
</tr>
<tr>
<td><code>event_type_id</code></td>
<td>string</td>
<td>required</td>
<td>App\EventType This a event</td>
</tr>
<tr>
<td><code>organizer_id</code></td>
<td>string</td>
<td>required</td>
<td>Id Event's organization</td>
</tr>
<tr>
<td><code>category_ids</code></td>
<td>array</td>
<td>optional</td>
<td>App\Category</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>object</td>
<td>required</td>
<td>This is the event's appearance</td>
</tr>
<tr>
<td><code>styles.buttonColor</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.banner_color</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.menu_color</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandPrimary</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandSuccess</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandInfo</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandDanger</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.containerBgColor</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandWarning</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandDark</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.brandLight</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.textMenu</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.activeText</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>styles.bgButtonsEvent</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_2478aef777186232e8bca32fdf09efe3 -->
<!-- START_26fd0ed6db820ca28bb674ba1d761a2e -->
<h2><em>update</em>: update information on a specific event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/user/events/et" \
=======
    "https://devapi.evius.co/api/user/events/quia" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/user/events/quia" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/user/events/et" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"quisquam","picture":"illum","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/user/events/quia"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/user/events/et"
=======
    "https://api.evius.co/api/user/events/voluptas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"voluptatum","picture":"nostrum","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/user/events/voluptas"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/user/events/quia" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Demo","adress":"Avenida siempre viva","datetime_from":"2020-10-16 18:00:00","datetime_to":"2020-10-16 21:00:00","type_event":"et","picture":"incidunt","venue":"Venue B","location":{},"visibility":"PUBLIC","user_properties":[],"description":"Evento para mostrel funcionamiento de la plataforma.","event_type_id":"5bf47226754e2317e4300b6a","organizer_id":"5e9caaa1d74d5c2f6a02a3c3","category_ids":[],"styles":{}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/user/events/quia"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/user/events/quia"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "adress": "Avenida siempre viva",
    "datetime_from": "2020-10-16 18:00:00",
    "datetime_to": "2020-10-16 21:00:00",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "type_event": "quisquam",
    "picture": "illum",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "type_event": "voluptatem",
    "picture": "voluptas",
=======
    "type_event": "voluptatum",
    "picture": "nostrum",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "type_event": "et",
    "picture": "incidunt",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "type_event": "quisquam",
    "picture": "illum",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "venue": "Venue B",
    "location": {},
    "visibility": "PUBLIC",
    "user_properties": [],
    "description": "Evento para mostrel funcionamiento de la plataforma.",
    "event_type_id": "5bf47226754e2317e4300b6a",
    "organizer_id": "5e9caaa1d74d5c2f6a02a3c3",
    "category_ids": [],
    "styles": {}
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/user/events/{event}</code></p>
<p><code>PATCH api/user/events/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id of the event to be updated</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name to event</td>
</tr>
<tr>
<td><code>adress</code></td>
<td>string</td>
<td>optional</td>
<td>adress when is the event.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>datetime</td>
<td>required</td>
<td>date and time of start of the event</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>datetime</td>
<td>optional</td>
<td>date and time of the end of the event</td>
</tr>
<tr>
<td><code>type_event</code></td>
<td>string</td>
<td>required</td>
<td>This parameter has two options: onlineEvent or PhysicalEvent, when onlineEvent the event emails will have the link to log in to the event page and physialEvent will send a QR code to enter the event at the physical point.</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>image of the event</td>
</tr>
<tr>
<td><code>venue</code></td>
<td>string</td>
<td>optional</td>
<td>Event venue.</td>
</tr>
<tr>
<td><code>location</code></td>
<td>object</td>
<td>optional</td>
<td>This parameter specific all information of event location.</td>
</tr>
<tr>
<td><code>visibility</code></td>
<td>string</td>
<td>required</td>
<td>restricts access for registered users or any unregistered user</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>optional</td>
<td>user registration properties.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>Explanation about  event.</td>
</tr>
<tr>
<td><code>event_type_id</code></td>
<td>string</td>
<td>required</td>
<td>App\EventType This a event</td>
</tr>
<tr>
<td><code>organizer_id</code></td>
<td>string</td>
<td>required</td>
<td>Id Event's organization</td>
</tr>
<tr>
<td><code>category_ids</code></td>
<td>array</td>
<td>optional</td>
<td>App\Category</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>object</td>
<td>required</td>
<td>This is the event's appearance</td>
</tr>
</tbody>
</table>
<!-- END_26fd0ed6db820ca28bb674ba1d761a2e -->
<!-- START_ed1c02a70ed814c85d464077d0854e00 -->
<h2><em>destroy</em>: delete event and related data.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/user/events/fugiat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/user/events/fugiat"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/user/events/odit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/user/events/odit"
=======
    "https://api.evius.co/api/user/events/sed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/user/events/sed"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/user/events/tempora" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/user/events/tempora"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/user/events/fugiat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/user/events/fugiat"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/user/events/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id of the event to be eliminated</td>
</tr>
</tbody>
</table>
<!-- END_ed1c02a70ed814c85d464077d0854e00 -->
<!-- START_f59d4cbbf9176342893379adb70dc1a5 -->
<h2><em>currentUserindex</em>: list of events of the organizer who is logged in</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/user/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/user/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/user/events</code></p>
<!-- END_f59d4cbbf9176342893379adb70dc1a5 -->
<!-- START_95f9995526c97a3d36e393d3083e53c9 -->
<h2><em>changeStatusEvent</em>: approve or reject the events <strong>&#039;draft&#039;</strong>, and send mail of the change of status of the event to the user who created it</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/changeStatusEvent" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"approved"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/changeStatusEvent"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "approved"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "5fb2eef214b93f11165dd1a0",
    "category": "d35319efaf194af191b8dc7c149a01bc",
    "datetime_from": null,
    "datetime_to": null,
    "description": "dddd",
    "name": "curso 1",
    "picture": "https:\/\/picsum.photos\/400\/800",
    "visibility": "PUBLIC",
    "extra_config": {
        "price": "0"
    },
    "author_id": "5fb1f6fb7bf68702e345b5d2",
    "organizer_id": "5f7e33ba3abc2119442e83e8",
    "event_type_id": "5bf47203754e2317e4300b68",
    "status": "approved",
    "updated_at": "2021-01-20 21:07:50",
    "created_at": "2020-11-16 21:28:18"
}</code></pre>
<blockquote>
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "Error": "The user does not have the permissions to execute this action"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/changeStatusEvent</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
<td>id of the event to be rejected or approved Example:</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>status</code></td>
<td>string</td>
<td>required</td>
<td>the status update allows for two possible statuses <strong>approved</strong> or <strong>rejected</strong></td>
</tr>
</tbody>
</table>
<!-- END_95f9995526c97a3d36e393d3083e53c9 -->
<!-- START_7488288e859ba4fe861385339c81371a -->
<h2><em>beforeToday:</em> list finished events</h2>
<p>This method allows dynamic querying of any property through the URL using FilterQuery services for example : Exmaple: [{&quot;id&quot;:&quot;event_type_id&quot;,&quot;value&quot;:[&quot;5bb21557af7ea71be746e98x&quot;,&quot;5bb21557af7ea71be746e98b&quot;]}]</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/eventsbeforetoday?filtered=%5B%7B%22field%22%3A%22name%22%2C%22value%22%3A%5B%22Demo%22%5D%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventsbeforetoday"
);

let params = {
    "filtered": "[{"field":"name","value":["Demo"]}]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [
        {
            "_id": "624373504b0b113f9e660ce8",
            "name": "Demo",
            "address": null,
            "type_event": "onlineEvent",
            "datetime_from": "2022-03-29 15:59:00",
            "datetime_to": "2022-03-29 16:59:00",
            "picture": null,
            "venue": null,
            "location": null,
            "visibility": "PUBLIC",
            "description": null,
            "allow_register": true,
            "styles": {
                "buttonColor": "#FFF",
                "banner_color": "#FFF",
                "menu_color": "#FFF",
                "event_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Flogo.jpg?alt=media&amp;token=861af09c-f6d0-4934-b56e-ddb83c3cb7a1",
                "banner_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Fbanner.jpg?alt=media&amp;token=8642d0ed-61e2-4fed-97fa-1cdd5687aeaf",
                "menu_image": null,
                "banner_image_email": null,
                "footer_image_email": "",
                "brandPrimary": "#FFFFFF",
                "brandSuccess": "#FFFFFF",
                "brandInfo": "#FFFFFF",
                "brandDanger": "#FFFFFF",
                "containerBgColor": "#ffffff",
                "brandWarning": "#FFFFFF",
                "toolbarDefaultBg": "#FFFFFF",
                "brandDark": "#FFFFFF",
                "brandLight": "#FFFFFF",
                "textMenu": "#555352",
                "activeText": "#FFFFFF",
                "bgButtonsEvent": "#FFFFFF",
                "BackgroundImage": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2FBackgroud.jpg?alt=media&amp;token=cae37ed9-9817-4300-87e9-e9cac7106b05",
                "FooterImage": null,
                "banner_footer": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Ffooter.png?alt=media&amp;token=363b3aab-b149-43f1-9173-622d0b8128f9",
                "mobile_banner": null,
                "banner_footer_email": null,
                "show_banner": "true",
                "show_card_banner": false,
                "show_inscription": false,
                "hideDatesAgenda": true,
                "hideDatesAgendaItem": false,
                "hideHoursAgenda": false,
                "hideBtnDetailAgenda": true,
                "loader_page": "no",
                "data_loader_page": null,
                "show_title": true
            },
            "author_id": "624372c533e51d570818c1b8",
            "organizer_id": "624373494b0b113f9e660cc2",
            "updated_at": "2022-03-29 21:00:02",
            "created_at": "2022-03-29 21:00:00",
            "user_properties": [
                {
                    "name": "email",
                    "label": "Correo",
                    "unique": false,
                    "mandatory": false,
                    "type": "email",
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1648587601358"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1648587601358"
                        }
                    },
                    "_id": {
                        "$oid": "624373514b0b113f9e660ceb"
                    }
                },
                {
                    "name": "names",
                    "label": "Nombres Y Apellidos",
                    "unique": false,
                    "mandatory": false,
                    "type": "text",
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1648587601440"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1648587601440"
                        }
                    },
                    "_id": {
                        "$oid": "624373514b0b113f9e660cec"
                    }
                },
                {
                    "label": "password",
                    "name": "password",
                    "type": "text",
                    "visibleByAdmin": true,
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1649089643026"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1649089643026"
                        }
                    },
                    "_id": {
                        "$oid": "624b1c6b25079f65db493f76"
                    }
                }
            ],
            "itemsMenu": {
                "evento": {
                    "name": "evento",
                    "position": 1,
                    "section": "evento",
                    "icon": "CalendarOutlined",
                    "checked": true,
                    "permissions": "public"
                },
                "agenda": {
                    "name": "Mi agenda",
                    "position": null,
                    "section": "agenda",
                    "icon": "ReadOutlined",
                    "checked": true,
                    "permissions": "public"
                }
            },
            "author": {
                "_id": "624372c533e51d570818c1b8",
                "picture": "https:\/\/www.gravatar.com\/avatar\/00000000000000000000000000000000?d=mp&amp;f=y",
                "email": "geraldine.garcia@mocionsoft.com",
                "names": "Juliana",
                "confirmation_code": "JGmmS6IVxAnihg69",
                "uid": "LV3AVsD6TAXSTPJvUXlz6sv9pIF3",
                "updated_at": "2022-03-29 20:57:41",
                "created_at": "2022-03-29 20:57:41"
            },
            "categories": [],
            "event_type": null,
            "organiser": {
                "_id": "624373494b0b113f9e660cc2",
                "name": "Demo",
                "styles": {
                    "buttonColor": "#FFF",
                    "banner_color": "#FFF",
                    "menu_color": "#FFF",
                    "event_image": null,
                    "banner_image": null,
                    "menu_image": null,
                    "banner_image_email": null,
                    "footer_image_email": "",
                    "brandPrimary": "#FFFFFF",
                    "brandSuccess": "#FFFFFF",
                    "brandInfo": "#FFFFFF",
                    "brandDanger": "#FFFFFF",
                    "containerBgColor": "#ffffff",
                    "brandWarning": "#FFFFFF",
                    "toolbarDefaultBg": "#FFFFFF",
                    "brandDark": "#FFFFFF",
                    "brandLight": "#FFFFFF",
                    "textMenu": "#555352",
                    "activeText": "#FFFFFF",
                    "bgButtonsEvent": "#FFFFFF",
                    "BackgroundImage": null,
                    "FooterImage": null,
                    "banner_footer": null,
                    "mobile_banner": null,
                    "banner_footer_email": null,
                    "show_banner": "true",
                    "show_card_banner": false,
                    "show_inscription": false,
                    "hideDatesAgenda": true,
                    "hideDatesAgendaItem": false,
                    "hideHoursAgenda": false,
                    "hideBtnDetailAgenda": true,
                    "loader_page": "no",
                    "data_loader_page": null
                },
                "author": "624372c533e51d570818c1b8",
                "updated_at": "2022-03-29 20:59:53",
                "created_at": "2022-03-29 20:59:53",
                "user_properties": [
                    {
                        "name": "email",
                        "label": "Correo",
                        "unique": false,
                        "mandatory": false,
                        "type": "email",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587593791"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587593791"
                            }
                        },
                        "_id": {
                            "$oid": "624373494b0b113f9e660cc4"
                        }
                    },
                    {
                        "name": "names",
                        "label": "Nombres Y Apellidos",
                        "unique": false,
                        "mandatory": false,
                        "type": "text",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587593804"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587593804"
                            }
                        },
                        "_id": {
                            "$oid": "624373494b0b113f9e660cc5"
                        }
                    }
                ],
                "template_properties": [
                    {
                        "name": "Template properties",
                        "user_properties": [
                            {
                                "name": "email",
                                "label": "Correo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "email",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 0,
                                "order_weight": 1
                            },
                            {
                                "name": "names",
                                "label": "Nombre completo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "text",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 1,
                                "order_weight": 2
                            },
                            {
                                "label": "celular",
                                "name": "celular",
                                "type": "number",
                                "mandatory": true,
                                "order_weight": 3
                            }
                        ],
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1649252829315"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1649252491223"
                            }
                        },
                        "_id": {
                            "$oid": "624d988b7b535937e462e3d2"
                        }
                    },
                    {
                        "name": "Segundo template",
                        "user_properties": [
                            {
                                "name": "email",
                                "label": "Correo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "email",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 0,
                                "order_weight": 1
                            },
                            {
                                "name": "names",
                                "label": "Nombre completo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "text",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 1,
                                "order_weight": 2
                            },
                            {
                                "label": "celular",
                                "name": "celular",
                                "type": "number",
                                "mandatory": true,
                                "visibleByContacts": true,
                                "visibleByAdmin": true
                            }
                        ],
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1649252688713"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1649252517720"
                            }
                        },
                        "_id": {
                            "$oid": "624d98a536d792388c235f24"
                        }
                    }
                ]
            },
            "organizer": {
                "_id": "624373494b0b113f9e660cc2",
                "name": "Demo",
                "styles": {
                    "buttonColor": "#FFF",
                    "banner_color": "#FFF",
                    "menu_color": "#FFF",
                    "event_image": null,
                    "banner_image": null,
                    "menu_image": null,
                    "banner_image_email": null,
                    "footer_image_email": "",
                    "brandPrimary": "#FFFFFF",
                    "brandSuccess": "#FFFFFF",
                    "brandInfo": "#FFFFFF",
                    "brandDanger": "#FFFFFF",
                    "containerBgColor": "#ffffff",
                    "brandWarning": "#FFFFFF",
                    "toolbarDefaultBg": "#FFFFFF",
                    "brandDark": "#FFFFFF",
                    "brandLight": "#FFFFFF",
                    "textMenu": "#555352",
                    "activeText": "#FFFFFF",
                    "bgButtonsEvent": "#FFFFFF",
                    "BackgroundImage": null,
                    "FooterImage": null,
                    "banner_footer": null,
                    "mobile_banner": null,
                    "banner_footer_email": null,
                    "show_banner": "true",
                    "show_card_banner": false,
                    "show_inscription": false,
                    "hideDatesAgenda": true,
                    "hideDatesAgendaItem": false,
                    "hideHoursAgenda": false,
                    "hideBtnDetailAgenda": true,
                    "loader_page": "no",
                    "data_loader_page": null
                },
                "author": "624372c533e51d570818c1b8",
                "updated_at": "2022-03-29 20:59:53",
                "created_at": "2022-03-29 20:59:53",
                "user_properties": [
                    {
                        "name": "email",
                        "label": "Correo",
                        "unique": false,
                        "mandatory": false,
                        "type": "email",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587593791"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587593791"
                            }
                        },
                        "_id": {
                            "$oid": "624373494b0b113f9e660cc4"
                        }
                    },
                    {
                        "name": "names",
                        "label": "Nombres Y Apellidos",
                        "unique": false,
                        "mandatory": false,
                        "type": "text",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587593804"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587593804"
                            }
                        },
                        "_id": {
                            "$oid": "624373494b0b113f9e660cc5"
                        }
                    }
                ],
                "template_properties": [
                    {
                        "name": "Template properties",
                        "user_properties": [
                            {
                                "name": "email",
                                "label": "Correo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "email",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 0,
                                "order_weight": 1
                            },
                            {
                                "name": "names",
                                "label": "Nombre completo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "text",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 1,
                                "order_weight": 2
                            },
                            {
                                "label": "celular",
                                "name": "celular",
                                "type": "number",
                                "mandatory": true,
                                "order_weight": 3
                            }
                        ],
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1649252829315"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1649252491223"
                            }
                        },
                        "_id": {
                            "$oid": "624d988b7b535937e462e3d2"
                        }
                    },
                    {
                        "name": "Segundo template",
                        "user_properties": [
                            {
                                "name": "email",
                                "label": "Correo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "email",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 0,
                                "order_weight": 1
                            },
                            {
                                "name": "names",
                                "label": "Nombre completo",
                                "unique": false,
                                "mandatory": false,
                                "justonebyattendee": false,
                                "type": "text",
                                "description": null,
                                "visibleByAdmin": false,
                                "visibleByContacts": false,
                                "index": 1,
                                "order_weight": 2
                            },
                            {
                                "label": "celular",
                                "name": "celular",
                                "type": "number",
                                "mandatory": true,
                                "visibleByContacts": true,
                                "visibleByAdmin": true
                            }
                        ],
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1649252688713"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1649252517720"
                            }
                        },
                        "_id": {
                            "$oid": "624d98a536d792388c235f24"
                        }
                    }
                ]
            },
            "currency": {
                "_id": "5c23936fe37db02c715b2a02",
                "id": 1,
                "title": "U.S. Dollar",
                "symbol_left": "$",
                "symbol_right": "",
                "code": "USD",
                "decimal_place": 2,
                "value": 1,
                "decimal_point": ".",
                "thousand_point": ",",
                "status": 1,
                "created_at": "2013-11-29 19=&gt;51=&gt;38",
                "updated_at": "2013-11-29 19=&gt;51=&gt;38"
            },
            "tickets": []
        },
        {
            "_id": "624372d533e51d570818c1cf",
            "name": "Demo",
            "address": null,
            "type_event": "onlineEvent",
            "datetime_from": "2022-03-29 15:57:00",
            "datetime_to": "2022-03-29 16:57:00",
            "picture": null,
            "venue": null,
            "location": null,
            "visibility": "PUBLIC",
            "description": null,
            "allow_register": true,
            "styles": {
                "buttonColor": "#FFF",
                "banner_color": "#FFF",
                "menu_color": "#FFF",
                "event_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Flogo.jpg?alt=media&amp;token=861af09c-f6d0-4934-b56e-ddb83c3cb7a1",
                "banner_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Fbanner.jpg?alt=media&amp;token=8642d0ed-61e2-4fed-97fa-1cdd5687aeaf",
                "menu_image": null,
                "banner_image_email": null,
                "footer_image_email": "",
                "brandPrimary": "#FFFFFF",
                "brandSuccess": "#FFFFFF",
                "brandInfo": "#FFFFFF",
                "brandDanger": "#FFFFFF",
                "containerBgColor": "#ffffff",
                "brandWarning": "#FFFFFF",
                "toolbarDefaultBg": "#FFFFFF",
                "brandDark": "#FFFFFF",
                "brandLight": "#FFFFFF",
                "textMenu": "#555352",
                "activeText": "#FFFFFF",
                "bgButtonsEvent": "#FFFFFF",
                "BackgroundImage": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2FBackgroud.jpg?alt=media&amp;token=cae37ed9-9817-4300-87e9-e9cac7106b05",
                "FooterImage": null,
                "banner_footer": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Ffooter.png?alt=media&amp;token=363b3aab-b149-43f1-9173-622d0b8128f9",
                "mobile_banner": null,
                "banner_footer_email": null,
                "show_banner": "true",
                "show_card_banner": false,
                "show_inscription": false,
                "hideDatesAgenda": true,
                "hideDatesAgendaItem": false,
                "hideHoursAgenda": false,
                "hideBtnDetailAgenda": true,
                "loader_page": "no",
                "data_loader_page": null,
                "show_title": true
            },
            "author_id": "624372c533e51d570818c1b8",
            "organizer_id": "624372ce4b0b113f9e660b80",
            "updated_at": "2022-03-29 20:57:58",
            "created_at": "2022-03-29 20:57:57",
            "user_properties": [
                {
                    "name": "email",
                    "label": "Correo",
                    "unique": false,
                    "mandatory": false,
                    "type": "email",
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1648587477623"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1648587477623"
                        }
                    },
                    "_id": {
                        "$oid": "624372d533e51d570818c1d2"
                    }
                },
                {
                    "name": "names",
                    "label": "Nombres Y Apellidos",
                    "unique": false,
                    "mandatory": false,
                    "type": "text",
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1648587477696"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1648587477696"
                        }
                    },
                    "_id": {
                        "$oid": "624372d533e51d570818c1d3"
                    }
                }
            ],
            "itemsMenu": {
                "evento": {
                    "name": "evento",
                    "position": 1,
                    "section": "evento",
                    "icon": "CalendarOutlined",
                    "checked": true,
                    "permissions": "public"
                },
                "agenda": {
                    "name": "Mi agenda",
                    "position": null,
                    "section": "agenda",
                    "icon": "ReadOutlined",
                    "checked": true,
                    "permissions": "public"
                }
            },
            "author": {
                "_id": "624372c533e51d570818c1b8",
                "picture": "https:\/\/www.gravatar.com\/avatar\/00000000000000000000000000000000?d=mp&amp;f=y",
                "email": "geraldine.garcia@mocionsoft.com",
                "names": "Juliana",
                "confirmation_code": "JGmmS6IVxAnihg69",
                "uid": "LV3AVsD6TAXSTPJvUXlz6sv9pIF3",
                "updated_at": "2022-03-29 20:57:41",
                "created_at": "2022-03-29 20:57:41"
            },
            "categories": [],
            "event_type": null,
            "organiser": {
                "_id": "624372ce4b0b113f9e660b80",
                "name": "Juliana",
                "styles": {
                    "buttonColor": "#FFF",
                    "banner_color": "#FFF",
                    "menu_color": "#FFF",
                    "event_image": null,
                    "banner_image": "#FFF",
                    "menu_image": "#FFF",
                    "banner_image_email": "",
                    "footer_image_email": ""
                },
                "author": "624372c533e51d570818c1b8",
                "updated_at": "2022-03-29 20:57:50",
                "created_at": "2022-03-29 20:57:50",
                "user_properties": [
                    {
                        "name": "email",
                        "label": "Correo",
                        "unique": false,
                        "mandatory": false,
                        "type": "email",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587470735"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587470735"
                            }
                        },
                        "_id": {
                            "$oid": "624372ce4b0b113f9e660b82"
                        }
                    },
                    {
                        "name": "names",
                        "label": "Nombres Y Apellidos",
                        "unique": false,
                        "mandatory": false,
                        "type": "text",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587470749"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587470749"
                            }
                        },
                        "_id": {
                            "$oid": "624372ce4b0b113f9e660b83"
                        }
                    }
                ]
            },
            "organizer": {
                "_id": "624372ce4b0b113f9e660b80",
                "name": "Juliana",
                "styles": {
                    "buttonColor": "#FFF",
                    "banner_color": "#FFF",
                    "menu_color": "#FFF",
                    "event_image": null,
                    "banner_image": "#FFF",
                    "menu_image": "#FFF",
                    "banner_image_email": "",
                    "footer_image_email": ""
                },
                "author": "624372c533e51d570818c1b8",
                "updated_at": "2022-03-29 20:57:50",
                "created_at": "2022-03-29 20:57:50",
                "user_properties": [
                    {
                        "name": "email",
                        "label": "Correo",
                        "unique": false,
                        "mandatory": false,
                        "type": "email",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587470735"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587470735"
                            }
                        },
                        "_id": {
                            "$oid": "624372ce4b0b113f9e660b82"
                        }
                    },
                    {
                        "name": "names",
                        "label": "Nombres Y Apellidos",
                        "unique": false,
                        "mandatory": false,
                        "type": "text",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648587470749"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648587470749"
                            }
                        },
                        "_id": {
                            "$oid": "624372ce4b0b113f9e660b83"
                        }
                    }
                ]
            },
            "currency": {
                "_id": "5c23936fe37db02c715b2a02",
                "id": 1,
                "title": "U.S. Dollar",
                "symbol_left": "$",
                "symbol_right": "",
                "code": "USD",
                "decimal_place": 2,
                "value": 1,
                "decimal_point": ".",
                "thousand_point": ",",
                "status": 1,
                "created_at": "2013-11-29 19=&gt;51=&gt;38",
                "updated_at": "2013-11-29 19=&gt;51=&gt;38"
            },
            "tickets": []
        },
        {
            "_id": "6243718861a2df33076dcefd",
            "name": "Demo",
            "address": null,
            "type_event": "onlineEvent",
            "datetime_from": "2022-03-29 15:51:00",
            "datetime_to": "2022-03-29 16:51:00",
            "picture": null,
            "venue": null,
            "location": null,
            "visibility": "PUBLIC",
            "description": null,
            "allow_register": true,
            "styles": {
                "buttonColor": "#FFF",
                "banner_color": "#FFF",
                "menu_color": "#FFF",
                "event_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Flogo.jpg?alt=media&amp;token=861af09c-f6d0-4934-b56e-ddb83c3cb7a1",
                "banner_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Fbanner.jpg?alt=media&amp;token=8642d0ed-61e2-4fed-97fa-1cdd5687aeaf",
                "menu_image": null,
                "banner_image_email": null,
                "footer_image_email": "",
                "brandPrimary": "#FFFFFF",
                "brandSuccess": "#FFFFFF",
                "brandInfo": "#FFFFFF",
                "brandDanger": "#FFFFFF",
                "containerBgColor": "#ffffff",
                "brandWarning": "#FFFFFF",
                "toolbarDefaultBg": "#FFFFFF",
                "brandDark": "#FFFFFF",
                "brandLight": "#FFFFFF",
                "textMenu": "#555352",
                "activeText": "#FFFFFF",
                "bgButtonsEvent": "#FFFFFF",
                "BackgroundImage": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2FBackgroud.jpg?alt=media&amp;token=cae37ed9-9817-4300-87e9-e9cac7106b05",
                "FooterImage": null,
                "banner_footer": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/template%2Ffooter.png?alt=media&amp;token=363b3aab-b149-43f1-9173-622d0b8128f9",
                "mobile_banner": null,
                "banner_footer_email": null,
                "show_banner": "true",
                "show_card_banner": false,
                "show_inscription": false,
                "hideDatesAgenda": true,
                "hideDatesAgendaItem": false,
                "hideHoursAgenda": false,
                "hideBtnDetailAgenda": true,
                "loader_page": "no",
                "data_loader_page": null,
                "show_title": true
            },
            "author_id": "62436cda0ace786515639be2",
            "organizer_id": "6243703cb3cbe346534263bd",
            "updated_at": "2022-03-29 20:52:25",
            "created_at": "2022-03-29 20:52:24",
            "user_properties": [
                {
                    "name": "email",
                    "label": "Correo",
                    "unique": false,
                    "mandatory": false,
                    "type": "email",
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1648587144880"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1648587144880"
                        }
                    },
                    "_id": {
                        "$oid": "6243718861a2df33076dcf00"
                    }
                },
                {
                    "name": "names",
                    "label": "Nombres Y Apellidos",
                    "unique": false,
                    "mandatory": false,
                    "type": "text",
                    "updated_at": {
                        "$date": {
                            "$numberLong": "1648587144956"
                        }
                    },
                    "created_at": {
                        "$date": {
                            "$numberLong": "1648587144956"
                        }
                    },
                    "_id": {
                        "$oid": "6243718861a2df33076dcf01"
                    }
                }
            ],
            "itemsMenu": {
                "evento": {
                    "name": "evento",
                    "position": 1,
                    "section": "evento",
                    "icon": "CalendarOutlined",
                    "checked": true,
                    "permissions": "public"
                },
                "agenda": {
                    "name": "Mi agenda",
                    "position": null,
                    "section": "agenda",
                    "icon": "ReadOutlined",
                    "checked": true,
                    "permissions": "public"
                }
            },
            "author": {
                "_id": "62436cda0ace786515639be2",
                "picture": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauthdev.appspot.com\/o\/images%2F1648586598816.png?alt=media&amp;token=7909f976-e121-406d-af4b-9a158cd4fd3b",
                "email": "geraldine.garcia+1@mocionsoft.com",
                "names": "Juliana",
                "confirmation_code": "FYzGHOXBxYreqfOI",
                "uid": "LZKEay3r3EbvgaSwUAJuN1k1svO2",
                "updated_at": "2022-03-29 20:43:37",
                "created_at": "2022-03-29 20:32:26"
            },
            "categories": [],
            "event_type": null,
            "organiser": {
                "_id": "6243703cb3cbe346534263bd",
                "name": "Demo",
                "styles": {
                    "buttonColor": "#FFF",
                    "banner_color": "#FFF",
                    "menu_color": "#FFF",
                    "event_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauthdev.appspot.com\/o\/images%2F1648586795195.png?alt=media&amp;token=f0e51186-85dc-481a-95f4-602cfe633cbe",
                    "banner_image": null,
                    "menu_image": null,
                    "banner_image_email": null,
                    "footer_image_email": "",
                    "brandPrimary": "#FFFFFF",
                    "brandSuccess": "#FFFFFF",
                    "brandInfo": "#FFFFFF",
                    "brandDanger": "#FFFFFF",
                    "containerBgColor": "#ffffff",
                    "brandWarning": "#FFFFFF",
                    "toolbarDefaultBg": "#FFFFFF",
                    "brandDark": "#FFFFFF",
                    "brandLight": "#FFFFFF",
                    "textMenu": "#555352",
                    "activeText": "#FFFFFF",
                    "bgButtonsEvent": "#FFFFFF",
                    "BackgroundImage": null,
                    "FooterImage": null,
                    "banner_footer": null,
                    "mobile_banner": null,
                    "banner_footer_email": null,
                    "show_banner": "true",
                    "show_card_banner": false,
                    "show_inscription": false,
                    "hideDatesAgenda": true,
                    "hideDatesAgendaItem": false,
                    "hideHoursAgenda": false,
                    "hideBtnDetailAgenda": true,
                    "loader_page": "no",
                    "data_loader_page": null
                },
                "author": "62436cda0ace786515639be2",
                "updated_at": "2022-03-29 20:46:52",
                "created_at": "2022-03-29 20:46:52",
                "user_properties": [
                    {
                        "name": "email",
                        "label": "Correo",
                        "unique": false,
                        "mandatory": false,
                        "type": "email",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648586812967"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648586812967"
                            }
                        },
                        "_id": {
                            "$oid": "6243703cb3cbe346534263bf"
                        }
                    },
                    {
                        "name": "names",
                        "label": "Nombres Y Apellidos",
                        "unique": false,
                        "mandatory": false,
                        "type": "text",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648586812983"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648586812983"
                            }
                        },
                        "_id": {
                            "$oid": "6243703cb3cbe346534263c0"
                        }
                    }
                ]
            },
            "organizer": {
                "_id": "6243703cb3cbe346534263bd",
                "name": "Demo",
                "styles": {
                    "buttonColor": "#FFF",
                    "banner_color": "#FFF",
                    "menu_color": "#FFF",
                    "event_image": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauthdev.appspot.com\/o\/images%2F1648586795195.png?alt=media&amp;token=f0e51186-85dc-481a-95f4-602cfe633cbe",
                    "banner_image": null,
                    "menu_image": null,
                    "banner_image_email": null,
                    "footer_image_email": "",
                    "brandPrimary": "#FFFFFF",
                    "brandSuccess": "#FFFFFF",
                    "brandInfo": "#FFFFFF",
                    "brandDanger": "#FFFFFF",
                    "containerBgColor": "#ffffff",
                    "brandWarning": "#FFFFFF",
                    "toolbarDefaultBg": "#FFFFFF",
                    "brandDark": "#FFFFFF",
                    "brandLight": "#FFFFFF",
                    "textMenu": "#555352",
                    "activeText": "#FFFFFF",
                    "bgButtonsEvent": "#FFFFFF",
                    "BackgroundImage": null,
                    "FooterImage": null,
                    "banner_footer": null,
                    "mobile_banner": null,
                    "banner_footer_email": null,
                    "show_banner": "true",
                    "show_card_banner": false,
                    "show_inscription": false,
                    "hideDatesAgenda": true,
                    "hideDatesAgendaItem": false,
                    "hideHoursAgenda": false,
                    "hideBtnDetailAgenda": true,
                    "loader_page": "no",
                    "data_loader_page": null
                },
                "author": "62436cda0ace786515639be2",
                "updated_at": "2022-03-29 20:46:52",
                "created_at": "2022-03-29 20:46:52",
                "user_properties": [
                    {
                        "name": "email",
                        "label": "Correo",
                        "unique": false,
                        "mandatory": false,
                        "type": "email",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648586812967"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648586812967"
                            }
                        },
                        "_id": {
                            "$oid": "6243703cb3cbe346534263bf"
                        }
                    },
                    {
                        "name": "names",
                        "label": "Nombres Y Apellidos",
                        "unique": false,
                        "mandatory": false,
                        "type": "text",
                        "updated_at": {
                            "$date": {
                                "$numberLong": "1648586812983"
                            }
                        },
                        "created_at": {
                            "$date": {
                                "$numberLong": "1648586812983"
                            }
                        },
                        "_id": {
                            "$oid": "6243703cb3cbe346534263c0"
                        }
                    }
                ]
            },
            "currency": {
                "_id": "5c23936fe37db02c715b2a02",
                "id": 1,
                "title": "U.S. Dollar",
                "symbol_left": "$",
                "symbol_right": "",
                "code": "USD",
                "decimal_place": 2,
                "value": 1,
                "decimal_point": ".",
                "thousand_point": ",",
                "status": 1,
                "created_at": "2013-11-29 19=&gt;51=&gt;38",
                "updated_at": "2013-11-29 19=&gt;51=&gt;38"
            },
            "tickets": []
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/eventsbeforetoday?page=1",
        "last": "http:\/\/localhost\/api\/eventsbeforetoday?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/eventsbeforetoday",
        "per_page": 2500,
        "to": 3,
        "total": 3
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/eventsbeforetoday</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>filtered</code></td>
<td>optional</td>
<td>optional filter parameters</td>
</tr>
</tbody>
</table>
<!-- END_7488288e859ba4fe861385339c81371a -->
<!-- START_a5b53c3efbacc4b924f371335093c0f7 -->
<h2><em>afterToday:</em> list upcoming events</h2>
<p>This method allows dynamic querying of any property through the URL using FilterQuery services for example : Exmaple: [{&quot;id&quot;:&quot;event_type_id&quot;,&quot;value&quot;:[&quot;5bb21557af7ea71be746e98x&quot;,&quot;5bb21557af7ea71be746e98b&quot;]}]</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/eventsaftertoday?filtered=%5B%7B%22field%22%3A%22name%22%2C%22value%22%3A%5B%22Demo%22%5D%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventsaftertoday"
);

let params = {
    "filtered": "[{"field":"name","value":["Demo"]}]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/eventsaftertoday?page=1",
        "last": "http:\/\/localhost\/api\/eventsaftertoday?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/eventsaftertoday",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/eventsaftertoday</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>filtered</code></td>
<td>optional</td>
<td>optional filter parameters</td>
</tr>
</tbody>
</table>
<!-- END_a5b53c3efbacc4b924f371335093c0f7 -->
<!-- START_1f26b5805c3db4083ddb592b9023cc0f -->
<h2><em>EventbyUsers</em>: search of events by user organizer.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/users/quis/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/quis/events"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/users/molestiae/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/users/molestiae/events"
=======
    -G "https://api.evius.co/api/users/quo/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/users/quo/events"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/users/inventore/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/inventore/events"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/users/quis/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/quis/events"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "first": "http:\/\/localhost\/api\/users\/quis\/events?page=1",
        "last": "http:\/\/localhost\/api\/users\/quis\/events?page=1",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "first": "http:\/\/localhost\/api\/users\/molestiae\/events?page=1",
        "last": "http:\/\/localhost\/api\/users\/molestiae\/events?page=1",
=======
        "first": "http:\/\/localhost\/api\/users\/quo\/events?page=1",
        "last": "http:\/\/localhost\/api\/users\/quo\/events?page=1",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "first": "http:\/\/localhost\/api\/users\/inventore\/events?page=1",
        "last": "http:\/\/localhost\/api\/users\/inventore\/events?page=1",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "first": "http:\/\/localhost\/api\/users\/quis\/events?page=1",
        "last": "http:\/\/localhost\/api\/users\/quis\/events?page=1",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "path": "http:\/\/localhost\/api\/users\/quis\/events",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "path": "http:\/\/localhost\/api\/users\/molestiae\/events",
=======
        "path": "http:\/\/localhost\/api\/users\/quo\/events",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "path": "http:\/\/localhost\/api\/users\/inventore\/events",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "path": "http:\/\/localhost\/api\/users\/quis\/events",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users/{user}/events</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>organiser_id</td>
</tr>
</tbody>
</table>
<!-- END_1f26b5805c3db4083ddb592b9023cc0f -->
<!-- START_48ec4d386efb8ba88bf13409d75a9572 -->
<h2>api/events/{event}/surveys/{id}/coursefinished</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1/surveys/1/coursefinished" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/surveys/1/coursefinished"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/surveys/{id}/coursefinished</code></p>
<!-- END_48ec4d386efb8ba88bf13409d75a9572 -->
<!-- START_fee8ef1fe728ff1db6ba4c577c3fd10c -->
<h2><em>addDocumentUserToEvent</em>: adds the default settings to events that have user documents.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/porro/adddocumentuser" \
=======
    "https://devapi.evius.co/api/events/dolores/adddocumentuser" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/events/dolores/adddocumentuser" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/porro/adddocumentuser" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"quantity":9395.72780995,"auto_assign":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/dolores/adddocumentuser"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/events/porro/adddocumentuser"
=======
    "https://api.evius.co/api/events/illo/adddocumentuser" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"quantity":884.8548,"auto_assign":true}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/illo/adddocumentuser"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/rem/adddocumentuser" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"quantity":3829.063132,"auto_assign":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/rem/adddocumentuser"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/dolores/adddocumentuser"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "quantity": 9395.72780995,
    "auto_assign": false
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "quantity": 1.44234727,
=======
    "quantity": 884.8548,
>>>>>>> rolesEtapa2:public/docs/index.html
    "auto_assign": true
=======
    "quantity": 3829.063132,
    "auto_assign": false
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "quantity": 9395.72780995,
    "auto_assign": false
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/adddocumentuser</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>quantity</code></td>
<td>number</td>
<td>required</td>
<td>Indicates how many documents will assigned to a user.</td>
</tr>
<tr>
<td><code>auto_assign</code></td>
<td>boolean</td>
<td>required</td>
<td>This parameter indicates if the document are assigned to the user automatically or if the user selects them when registering.</td>
</tr>
</tbody>
</table>
<!-- END_fee8ef1fe728ff1db6ba4c577c3fd10c -->
<h1>EventTypes</h1>
<p>The type of event provides information about the scope of the event, for example, events can be of type, <strong>educational, sports, international, etc..</strong></p>
<!-- START_d075018d0f5c4b4c28eebc2ea6c990a2 -->
<h2><em>index</em> : list of event types</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/eventTypes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventTypes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/eventTypes?page=1",
        "last": "http:\/\/localhost\/api\/eventTypes?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/eventTypes",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/eventTypes</code></p>
<!-- END_d075018d0f5c4b4c28eebc2ea6c990a2 -->
<!-- START_82b919fce1599acdcfd3004c203870e2 -->
<h2>Store a newly created resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/eventTypes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"voluptatem"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"quibusdam"}'
=======
    -d '{"name":"ea"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"iure"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"voluptatem"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventTypes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "voluptatem"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "quibusdam"
=======
    "name": "ea"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "iure"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "name": "voluptatem"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/eventTypes</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>required</td>
<td>optional</td>
<td>name event types</td>
</tr>
</tbody>
</table>
<!-- END_82b919fce1599acdcfd3004c203870e2 -->
<h1>EventUser</h1>
<p>Handles the relation bewteeen user and event.  It handles user booking into an event
Account relation to an event is one of the fundamental aspects of this platform
Most of the user functionality is executed under &quot;Attendee&quot; model and not directly under Account, because is an events platform.</p>
<p style="border: 1px solid #DDD">
Attendee has one user though account_id
<br> and one event though event_id
<br> This relation has states that represent the booking status of the user into the event
</p>
<!-- START_6d734e2380b448480b231a52bc627249 -->
<h2><em>store:</em> Store a newly Attendee  in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/at/eventusers" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/reprehenderit/eventusers" \
=======
    "https://api.evius.co/api/events/qui/eventusers" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/dicta/eventusers" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/at/eventusers" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"properties":{"email":{},"names":{},"others_properties":{}}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/at/eventusers"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/reprehenderit/eventusers"
=======
    "https://api.evius.co/api/events/qui/eventusers"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/dicta/eventusers"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/at/eventusers"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "properties": {
        "email": {},
        "names": {},
        "others_properties": {}
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/eventusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>properties.email</code></td>
<td>object</td>
<td>optional</td>
<td>other params  will be saved in user and eventUser each event can require aditional properties for registration.</td>
</tr>
<tr>
<td><code>properties.names</code></td>
<td>object</td>
<td>optional</td>
<td>other params  will be saved in user and eventUser each event can require aditional properties for registration.</td>
</tr>
<tr>
<td><code>properties.others_properties</code></td>
<td>object</td>
<td>optional</td>
<td>other params  will be saved in user and eventUser each event can require aditional properties for registration.</td>
</tr>
</tbody>
</table>
<!-- END_6d734e2380b448480b231a52bc627249 -->
<!-- START_91cdeb75b076b7622e0d97e5b95538b4 -->
<h2>api/events/{event}/eventusers/{eventuser}/unsubscribe</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/eventusers/1/unsubscribe" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/eventusers/1/unsubscribe"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/eventusers/{eventuser}/unsubscribe</code></p>
<!-- END_91cdeb75b076b7622e0d97e5b95538b4 -->
<!-- START_d8c597db91ecae06a8314266fe9173f6 -->
<h2><em>SubscribeUserToEventAndSendEmail</em>: register user to an event and send confirmation email</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/adduserwithemailvalidation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"properties":{"email":"evius@evius.co","name":"Evius","password":"*******"}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/adduserwithemailvalidation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "properties": {
        "email": "evius@evius.co",
        "name": "Evius",
        "password": "*******"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/adduserwithemailvalidation</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>properties.email</code></td>
<td>email</td>
<td>required</td>
<td>email event user</td>
</tr>
<tr>
<td><code>properties.name</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>properties.password</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_d8c597db91ecae06a8314266fe9173f6 -->
<!-- START_ae3699df3bb574732c28c9b539afa6cf -->
<h2><em>transferEventuserAndEnrollToActivity</em> : transfer Eventuser And Enroll To Activity</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/eventusers/1/tranfereventuser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventusers/1/tranfereventuser/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/eventusers/{event}/tranfereventuser/{event_user}</code></p>
<!-- END_ae3699df3bb574732c28c9b539afa6cf -->
<!-- START_62f0c5655d8d2562857a8516c1822886 -->
<h2><em>updateWithStatus</em>: update With Status</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/eventUsers/1/withStatus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventUsers/1/withStatus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/eventUsers/{id}/withStatus</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>optional</td>
<td>string required</td>
</tr>
</tbody>
</table>
<!-- END_62f0c5655d8d2562857a8516c1822886 -->
<!-- START_4689c377b6415c181d64a5ee269eebce -->
<h2><em>checkIn</em>: checks In an existent Attendee to the related event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/eventUsers/dolorum/checkin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventUsers/dolorum/checkin"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/eventUsers/aut/checkin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/eventUsers/aut/checkin"
=======
    "https://api.evius.co/api/eventUsers/tempore/checkin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/eventUsers/tempore/checkin"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/eventUsers/et/checkin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventUsers/et/checkin"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/eventUsers/dolorum/checkin" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventUsers/dolorum/checkin"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/eventUsers/{eventuser}/checkin</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>eventuser</code></td>
<td>optional</td>
<td>string required id Attendee to checkin into the event</td>
</tr>
</tbody>
</table>
<!-- END_4689c377b6415c181d64a5ee269eebce -->
<!-- START_f25c21b9dd2179852d16eac76d3bca80 -->
<h2><em>createUserAndAddtoEvent</em>: import  user and add it to an event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
When you import a user to an event, if the user does not exist, the user will be created and the record will be created in the event and
if the user exists, the user will not be updated, it will only create the record in the event.</p>
<p><img src="https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2Fdocumentation%2FcreateUserAndAddtoEvent.png?alt=media&amp;token=ee03b215-85e6-49cc-9340-43ae3a00dd60" alt="Screenshot" /></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/eventUsers/createUserAndAddtoEvent/61ccd3551c821b765a312864" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"email":"example@evius.co","name":"Evius","password":"*******","other_params":{"city":"temporibus"}}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"email":"example@evius.co","name":"Evius","password":"*******","other_params":{"city":"dolorum"}}'
=======
    -d '{"email":"example@evius.co","name":"Evius","password":"*******","other_params":{"city":"et"}}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"email":"example@evius.co","name":"Evius","password":"*******","other_params":{"city":"aliquid"}}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"email":"example@evius.co","name":"Evius","password":"*******","other_params":{"city":"temporibus"}}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventUsers/createUserAndAddtoEvent/61ccd3551c821b765a312864"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "example@evius.co",
    "name": "Evius",
    "password": "*******",
    "other_params": {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "city": "temporibus"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "city": "dolorum"
=======
        "city": "et"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "city": "aliquid"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "city": "temporibus"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/eventUsers/createUserAndAddtoEvent/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
<td>email event user</td>
</tr>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>optional</td>
<td>if the password is not added, the password will be the user's email.</td>
</tr>
<tr>
<td><code>other_params.city</code></td>
<td>any</td>
<td>optional</td>
<td>other params  will be saved in eventUser</td>
</tr>
</tbody>
</table>
<!-- END_f25c21b9dd2179852d16eac76d3bca80 -->
<!-- START_8584edbef5108e01985db1d291b64c2e -->
<h2><em>bookEventUsers</em>: when an event is pay the attendees can do book without having to pay.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/eventUsers/bookEventUsers/61ccd3551c821b765a312864" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"eventUsersIds":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventUsers/bookEventUsers/61ccd3551c821b765a312864"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "eventUsersIds": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/eventUsers/bookEventUsers/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>eventUsersIds</code></td>
<td>array</td>
<td>required</td>
<td>Attendees list who book in an event</td>
</tr>
</tbody>
</table>
<!-- END_8584edbef5108e01985db1d291b64c2e -->
<!-- START_c8437aa309bc9307e85279e92b05876e -->
<h2><em>index</em> display all the EventUsers of an event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/61ccd3551c821b765a312864\/eventusers?page=1",
        "last": "http:\/\/localhost\/api\/events\/61ccd3551c821b765a312864\/eventusers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/61ccd3551c821b765a312864\/eventusers",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/eventusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required event id</td>
</tr>
</tbody>
</table>
<!-- END_c8437aa309bc9307e85279e92b05876e -->
<!-- START_05a678eb2a1e19035815cb6dcaa3d3e4 -->
<h2><em>index</em> display all the EventUsers of an event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventUsers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventUsers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/61ccd3551c821b765a312864\/eventUsers?page=1",
        "last": "http:\/\/localhost\/api\/events\/61ccd3551c821b765a312864\/eventUsers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/61ccd3551c821b765a312864\/eventUsers",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/eventUsers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required event id</td>
</tr>
</tbody>
</table>
<!-- END_05a678eb2a1e19035815cb6dcaa3d3e4 -->
<!-- START_141b31e9c5a7037e89acadf43efa649d -->
<h2><em>show:</em> consult an EventUser by assistant id</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers/61ccd3551c821b765a312866" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers/61ccd3551c821b765a312866"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/eventusers/{eventuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required</td>
</tr>
<tr>
<td><code>eventuser</code></td>
<td>optional</td>
<td>string required id Attendee</td>
</tr>
</tbody>
</table>
<!-- END_141b31e9c5a7037e89acadf43efa649d -->
<!-- START_1a93d52037043b43040c8f63d1d0c6b7 -->
<h2><em>update</em>:update a specific assistant</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers/61ccd3551c821b765a312866" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"rol_id":"et","properties":{"other_properties":"dolor"}}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"rol_id":"et","properties":{"other_properties":"autem"}}'
=======
    -d '{"rol_id":"reprehenderit","properties":{"other_properties":"velit"}}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"rol_id":"eos","properties":{"other_properties":"quis"}}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"rol_id":"et","properties":{"other_properties":"dolor"}}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers/61ccd3551c821b765a312866"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "rol_id": "et",
    "properties": {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "other_properties": "dolor"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "other_properties": "autem"
=======
    "rol_id": "reprehenderit",
    "properties": {
        "other_properties": "velit"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "rol_id": "eos",
    "properties": {
        "other_properties": "quis"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "other_properties": "dolor"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    }
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/eventusers/{eventuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required</td>
</tr>
<tr>
<td><code>eventuser</code></td>
<td>optional</td>
<td>string required id Attendee</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>rol_id</code></td>
<td>string</td>
<td>optional</td>
<td>rol id this is the role user into event</td>
</tr>
<tr>
<td><code>properties.other_properties</code></td>
<td>any</td>
<td>optional</td>
<td>other params  will be saved in user and eventUser</td>
</tr>
</tbody>
</table>
<!-- END_1a93d52037043b43040c8f63d1d0c6b7 -->
<!-- START_f70f7831fab4378970f6e432c9e25736 -->
<h2><strong>delete:</strong> remove a specific attendee from an event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers/61ccd3333821b765a312866" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/61ccd3551c821b765a312864/eventusers/61ccd3333821b765a312866"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/eventusers/{eventuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required</td>
</tr>
<tr>
<td><code>eventuser</code></td>
<td>optional</td>
<td>string required id Attendee</td>
</tr>
</tbody>
</table>
<!-- END_f70f7831fab4378970f6e432c9e25736 -->
<!-- START_84d74839b57eed0df8c1697071eeeaa6 -->
<h2><em>indexByUserInEvent</em>: list of users by events</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/eventusers/event/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/eventusers/event/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/eventusers/event/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>optional</td>
<td>string required</td>
</tr>
</tbody>
</table>
<!-- END_84d74839b57eed0df8c1697071eeeaa6 -->
<!-- START_4bd3b40485e104bf4de0c264138d1029 -->
<h2><em>ByUserInEvent</em> : list of users by events</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/eventusers/event/1/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventusers/event/1/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/eventusers/event/{event}/user/{user_id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>optional</td>
<td>string required</td>
</tr>
</tbody>
</table>
<!-- END_4bd3b40485e104bf4de0c264138d1029 -->
<!-- START_60d316aa60b8b526ece5acd538b7d419 -->
<h2><em>meInEvent</em>: user information logged into the event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/events/61ccd3551c821b765a312864/eventusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/events/61ccd3551c821b765a312864/eventusers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/events/{event}/eventusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>string required event id</td>
</tr>
</tbody>
</table>
<!-- END_60d316aa60b8b526ece5acd538b7d419 -->
<!-- START_b11ff93318cdb6da2eb89990c0f8793c -->
<h2><em>metricsEventByDate</em>: number of registered users and checked in for day according to event start and end dates  * or according specific dates.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/fuga/metricsbydate/eventusers?metrics_type=created_at&amp;datetime_from=minima&amp;datetime_to=ducimus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/fuga/metricsbydate/eventusers"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/perferendis/metricsbydate/eventusers?metrics_type=created_at&amp;datetime_from=est&amp;datetime_to=quia" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/perferendis/metricsbydate/eventusers"
=======
    -G "https://api.evius.co/api/events/consectetur/metricsbydate/eventusers?metrics_type=created_at&amp;datetime_from=hic&amp;datetime_to=dolorum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/consectetur/metricsbydate/eventusers"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/aut/metricsbydate/eventusers?metrics_type=created_at&amp;datetime_from=earum&amp;datetime_to=sit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/aut/metricsbydate/eventusers"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/fuga/metricsbydate/eventusers?metrics_type=created_at&amp;datetime_from=minima&amp;datetime_to=ducimus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/fuga/metricsbydate/eventusers"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let params = {
    "metrics_type": "created_at",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "datetime_from": "minima",
    "datetime_to": "ducimus",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "datetime_from": "est",
    "datetime_to": "quia",
=======
    "datetime_from": "hic",
    "datetime_to": "dolorum",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "datetime_from": "earum",
    "datetime_to": "sit",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "datetime_from": "minima",
    "datetime_to": "ducimus",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/metricsbydate/eventusers</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event_id</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>metrics_type</code></td>
<td>required</td>
<td>string With this parameter you can defined the type of metrics that you want to see, you can select created_at for see the registered users  or checkedin_at for see checked users.</td>
</tr>
<tr>
<td><code>datetime_from</code></td>
<td>optional</td>
<td>date format dd-mm-yyyy</td>
</tr>
<tr>
<td><code>datetime_to</code></td>
<td>optional</td>
<td>date format dd-mm-yyyy</td>
</tr>
</tbody>
</table>
<!-- END_b11ff93318cdb6da2eb89990c0f8793c -->
<!-- START_268cde1684b4e9055d6507c299b96ea7 -->
<h2><em>updateRolAndSendEmail</em>: change the rol of an user in a event especific.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
This end point sends an email to the user to inform them of the change.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/vitae/eventusers/hic/updaterol" \
=======
    "https://devapi.evius.co/api/events/earum/eventusers/pariatur/updaterol" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/events/earum/eventusers/pariatur/updaterol" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/vitae/eventusers/hic/updaterol" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"rol_id":"in"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/earum/eventusers/pariatur/updaterol"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/events/vitae/eventusers/hic/updaterol"
=======
    "https://api.evius.co/api/events/et/eventusers/placeat/updaterol" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"rol_id":"distinctio"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/et/eventusers/placeat/updaterol"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/corrupti/eventusers/sint/updaterol" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"rol_id":"illo"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/corrupti/eventusers/sint/updaterol"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/earum/eventusers/pariatur/updaterol"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "rol_id": "in"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "rol_id": "dolores"
=======
    "rol_id": "distinctio"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "rol_id": "illo"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "rol_id": "in"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/eventusers/{eventuser}/updaterol</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
</tr>
<tr>
<td><code>eventuser</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>rol_id</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_268cde1684b4e9055d6507c299b96ea7 -->
<!-- START_b517d383c710e2dea5f2e97ab7bb8b43 -->
<h2><em>meEvents:</em> list of registered events of the logged in user.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/eventUsers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/eventUsers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/eventUsers</code></p>
<!-- END_b517d383c710e2dea5f2e97ab7bb8b43 -->
<h1>Files</h1>
<p>Files handing mostly used to upload new files</p>
<!-- START_2a29088746aee0c7fa1f3a03ed44765b -->
<h2>Uploads files send though HTTP multipart/form-data</h2>
<p>Uploads provided file though HTTPFile  multipart/form-data; and returns full file URL.</p>
<p>In the request the file data came in field called file.</p>
<p>But in case this field name should be changed, It could be done though</p>
<p>field_name parameter</p>
<p>HTTPFile could be just one file on multiple files,</p>
<p>for one file this function returns  a string with the url
for multiple files It returns an array of URLS.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/files/upload/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"file":"velit"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"file":"error"}'
=======
    -d '{"file":"iste"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"file":"sapiente"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"file":"velit"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/files/upload/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "file": "velit"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "file": "error"
=======
    "file": "iste"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "file": "sapiente"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "file": "velit"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/files/upload/{field_name?}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>file</code></td>
<td>file</td>
<td>required</td>
<td>file sent using multipart/form-data;</td>
</tr>
</tbody>
</table>
<!-- END_2a29088746aee0c7fa1f3a03ed44765b -->
<!-- START_18c1b3fc6f79ce014b60fa16df3d8417 -->
<h2><em>storeBaseImg</em>: Uploads images send though HTTP multipart/form-data  with resizing option</h2>
<p>Uploads files send though HTTP multipart/form-data</p>
<p>Uploads provided file though HTTPFile  multipart/form-data; and returns full file URL.</p>
<p>In the request the file data came in field called file.</p>
<p>But in case this field name should be changed, It could be done though</p>
<p>field_name parameter</p>
<p>HTTPFile could be just one file on multiple files,</p>
<p>for one file this function returns  a string with the url
for multiple files It returns an array of URLS.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/files/uploadbase/esse" \
=======
    "https://devapi.evius.co/api/files/uploadbase/officia" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/files/uploadbase/officia" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/files/uploadbase/esse" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"file":"veritatis","type":"cum"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/files/uploadbase/officia"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/files/uploadbase/esse"
=======
    "https://api.evius.co/api/files/uploadbase/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"file":"ut","type":"dolorem"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/files/uploadbase/aut"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/files/uploadbase/quasi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"file":"autem","type":"voluptatem"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/files/uploadbase/quasi"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/files/uploadbase/officia"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "file": "veritatis",
    "type": "cum"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "file": "mollitia",
    "type": "exercitationem"
=======
    "file": "ut",
    "type": "dolorem"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "file": "autem",
    "type": "voluptatem"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "file": "veritatis",
    "type": "cum"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/files/uploadbase/{name}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>optional</td>
<td>file field by default file</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>file</code></td>
<td>file</td>
<td>required</td>
<td>file sent using multipart/form-data;</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>optional</td>
<td>[&quot;icon&quot; =&gt; 240, &quot;wall&quot; =&gt; 500, &quot;default&quot; =&gt; 600, &quot;email&quot; =&gt; 600]; by default 600</td>
</tr>
</tbody>
</table>
<!-- END_18c1b3fc6f79ce014b60fa16df3d8417 -->
<h1>Google Analytics</h1>
<p>APIs for Google Analitycs Stats</p>
<!-- START_259c759273915c655b1f237b29029215 -->
<h2>Query for Google Analytics Stats</h2>
<p>Recieve a body json to give all the stats related about pageviews, users and sessions
filtered by a pagePath consulted.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/googleanalytics" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"startDate":"2021-06-30","endDate":"2021-07-6","filtersExpression":"ga:pagePath=@\/landing\/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token","metrics":"ga:pageviews, ga:users, ga:sessions","dimensions":"ga:pagePath","fieldName":"ga:pagePath","sortOrder":"DESCENDING"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/googleanalytics"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "startDate": "2021-06-30",
    "endDate": "2021-07-6",
    "filtersExpression": "ga:pagePath=@\/landing\/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token",
    "metrics": "ga:pageviews, ga:users, ga:sessions",
    "dimensions": "ga:pagePath",
    "fieldName": "ga:pagePath",
    "sortOrder": "DESCENDING"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "containsSampledData": false,
    "dataLastRefreshed": null,
    "id": "https:\/\/www.googleapis.com\/analytics\/v3\/data\/ga?ids=ga:114494173&amp;dimensions=ga:pagePath&amp;metrics=ga:pageviews,ga:users,ga:sessions&amp;sort=-ga:pagePath&amp;filters=ga:pagePath%3D@\/landing\/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token&amp;start-date=2021-06-30&amp;end-date=2021-07-30",
    "itemsPerPage": 1000,
    "kind": "analytics#gaData",
    "nextLink": null,
    "previousLink": null,
    "rows": [
        [
            "\/landing\/5ea23acbd74d5c4b360ddde2\/partners",
            "1",
            "1",
            "0"
        ],
        [
            "\/landing\/5ea23acbd74d5c4b360ddde2\/evento\/activity\/602d88f5fc22ba3f453a0dc3",
            "2",
            "1",
            "0"
        ]
    ],
    "sampleSize": null,
    "sampleSpace": null,
    "selfLink": "https:\/\/www.googleapis.com\/analytics\/v3\/data\/ga?ids=ga:114494173&amp;dimensions=ga:pagePath&amp;metrics=ga:pageviews,ga:users,ga:sessions&amp;sort=-ga:pagePath&amp;filters=ga:pagePath%3D@\/landing\/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token&amp;start-date=2021-06-30&amp;end-date=2021-07-30",
    "totalResults": 9,
    "totalsForAllResults": {
        "ga:pageviews": "620",
        "ga:users": "23",
        "ga:sessions": "38"
    },
    "query": {
        "dimensions": "ga:pagePath",
        "endDate": "2021-07-30",
        "filters": "ga:pagePath=@\/landing\/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token",
        "ids": "ga:114494173",
        "maxResults": 1000,
        "metrics": [
            "ga:pageviews",
            "ga:users",
            "ga:sessions"
        ],
        "samplingLevel": null,
        "segment": null,
        "sort": [
            "-ga:pagePath"
        ],
        "startDate": "2021-06-30",
        "startIndex": 1
    },
    "profileInfo": {
        "accountId": "72179148",
        "internalWebPropertyId": "109811365",
        "profileId": "114494173",
        "profileName": "All Web Site Data",
        "tableId": "ga:114494173",
        "webPropertyId": "UA-72179148-1"
    },
    "columnHeaders": [
        {
            "columnType": "DIMENSION",
            "dataType": "STRING",
            "name": "ga:pagePath"
        },
        {
            "columnType": "METRIC",
            "dataType": "INTEGER",
            "name": "ga:pageviews"
        },
        {
            "columnType": "METRIC",
            "dataType": "INTEGER",
            "name": "ga:users"
        },
        {
            "columnType": "METRIC",
            "dataType": "INTEGER",
            "name": "ga:sessions"
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/googleanalytics</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>startDate</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>endDate</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>filtersExpression</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>metrics</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>dimensions</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>fieldName</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>sortOrder</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_259c759273915c655b1f237b29029215 -->
<h1>Host(Speakers)</h1>
<p>The host or conferences are in charge of carrying out the activities</p>
<!-- START_918a74c64a832dc34e51b48a1e52471e -->
<h2><em>index</em>: list all host</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/host" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/host"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "created_at": "2020-11-05 20:23:33",
    "description": "&lt;p&gt;Es todo un profesional&lt;\/p&gt;",
    "description_activity": "true",
    "event_id": "5fa423eee086ea2d1163343e",
    "image": null,
    "name": "Primer conferencista",
    "order": 1,
    "profession": "Ingeniero",
    "updated_at": "2020-11-05 20:23:33",
    "_id": "5fa45f453766a90b471a0f22"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/host</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_918a74c64a832dc34e51b48a1e52471e -->
<!-- START_fa42a1d1fa3809228cee6ca7b1135be8 -->
<h2><em>show</em>: view information for a specific host</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/host/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/host/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Host] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/host/{host}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>host id to be removed</td>
</tr>
</tbody>
</table>
<!-- END_fa42a1d1fa3809228cee6ca7b1135be8 -->
<!-- START_4086c0e3b680a2dd566cb3574341f389 -->
<h2><em>store</em>: create new host</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1/host" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"consequatur","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"molestiae","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"et","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"voluptates","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"consequatur","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/host"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "description": "&lt;p&gt;Es todo un profesional&lt;\/p&gt;",
    "description_activity": "true",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "image": "consequatur",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "image": "molestiae",
=======
    "image": "et",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "image": "voluptates",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "image": "consequatur",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "name": "Primer conferencista",
    "order": 1,
    "profession": "Ingeniero"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/host</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>description_activity</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>order</code></td>
<td>number</td>
<td>optional</td>
</tr>
<tr>
<td><code>profession</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_4086c0e3b680a2dd566cb3574341f389 -->
<!-- START_ce1c2797d70ec4af9be56d0ee7084b2d -->
<h2><em>update</em>: update the specified host.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/host/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"voluptas","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"ut","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"deleniti","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"vitae","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"description":"&lt;p&gt;Es todo un profesional&lt;\/p&gt;","description_activity":"true","image":"voluptas","name":"Primer conferencista","order":1,"profession":"Ingeniero"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/host/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "description": "&lt;p&gt;Es todo un profesional&lt;\/p&gt;",
    "description_activity": "true",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "image": "voluptas",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "image": "ut",
=======
    "image": "deleniti",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "image": "vitae",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "image": "voluptas",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "name": "Primer conferencista",
    "order": 1,
    "profession": "Ingeniero"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/host/{host}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>description_activity</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>order</code></td>
<td>number</td>
<td>optional</td>
</tr>
<tr>
<td><code>profession</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_ce1c2797d70ec4af9be56d0ee7084b2d -->
<!-- START_fc812c3ac5933927f6f5dd638d5e3990 -->
<h2><em>destroy</em> : Remove the specified speaker.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/1/host/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/host/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/host/{host}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>host id to be removed</td>
</tr>
</tbody>
</table>
<!-- END_fc812c3ac5933927f6f5dd638d5e3990 -->
<h1>News Feed</h1>
<!-- START_2b5183f2566ebb92311d3d276dbfa1f2 -->
<h2><em>store</em>: create news in an event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"Los mejores eventos est\u00e1n en Evius","description_complete":"Los eventos en evius son interactivos porque tiene multiples opciones...","description_short":"Los eventos en Evius son los m\u00e1s interactivos y los mejores.","linkYoutube":"https:\/\/www.youtube.com\/watch?v=m1YUmZRfgqU&amp;ab_channel=MG1010","image":"https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/IdKxqboMxU0pvgY3AbRkig4ZptQcUNE4CUvysJIn.png","time":"2021-08-02"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "Los mejores eventos est\u00e1n en Evius",
    "description_complete": "Los eventos en evius son interactivos porque tiene multiples opciones...",
    "description_short": "Los eventos en Evius son los m\u00e1s interactivos y los mejores.",
    "linkYoutube": "https:\/\/www.youtube.com\/watch?v=m1YUmZRfgqU&amp;ab_channel=MG1010",
    "image": "https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/IdKxqboMxU0pvgY3AbRkig4ZptQcUNE4CUvysJIn.png",
    "time": "2021-08-02"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/newsfeed</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id event.</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>title</code></td>
<td>string</td>
<td>required</td>
<td>news title.</td>
</tr>
<tr>
<td><code>description_complete</code></td>
<td>news</td>
<td>optional</td>
<td>complete   string.</td>
</tr>
<tr>
<td><code>description_short</code></td>
<td>string</td>
<td>optional</td>
<td>news description short</td>
</tr>
<tr>
<td><code>linkYoutube</code></td>
<td>string</td>
<td>optional</td>
<td>news video</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
<td>news image.</td>
</tr>
<tr>
<td><code>time</code></td>
<td>string</td>
<td>optional</td>
<td>news date.</td>
</tr>
</tbody>
</table>
<!-- END_2b5183f2566ebb92311d3d276dbfa1f2 -->
<!-- START_ebee4149bc53997cd5f982e1177082da -->
<h2><em>update</em>: create news in an event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"Los mejores eventos est\u00e1n en Evius","description_complete":"Los eventos en evius son interactivos porque tiene multiples opciones...","description_short":"Los eventos en Evius son los m\u00e1s interactivos y los mejores.","linkYoutube":"https:\/\/www.youtube.com\/watch?v=m1YUmZRfgqU&amp;ab_channel=MG1010","image":"https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/IdKxqboMxU0pvgY3AbRkig4ZptQcUNE4CUvysJIn.png","time":"2021-08-02"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "Los mejores eventos est\u00e1n en Evius",
    "description_complete": "Los eventos en evius son interactivos porque tiene multiples opciones...",
    "description_short": "Los eventos en Evius son los m\u00e1s interactivos y los mejores.",
    "linkYoutube": "https:\/\/www.youtube.com\/watch?v=m1YUmZRfgqU&amp;ab_channel=MG1010",
    "image": "https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/IdKxqboMxU0pvgY3AbRkig4ZptQcUNE4CUvysJIn.png",
    "time": "2021-08-02"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/newsfeed/{newsfeed}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id event.</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>title</code></td>
<td>string</td>
<td>optional</td>
<td>news title.</td>
</tr>
<tr>
<td><code>description_complete</code></td>
<td>news</td>
<td>optional</td>
<td>complete   string.</td>
</tr>
<tr>
<td><code>description_short</code></td>
<td>string</td>
<td>optional</td>
<td>news description short</td>
</tr>
<tr>
<td><code>linkYoutube</code></td>
<td>string</td>
<td>optional</td>
<td>news video</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
<td>news image.</td>
</tr>
<tr>
<td><code>time</code></td>
<td>string</td>
<td>optional</td>
<td>news date.</td>
</tr>
</tbody>
</table>
<!-- END_ebee4149bc53997cd5f982e1177082da -->
<!-- START_322b2e85d6ca0584c316bb1b662b654a -->
<h2><em>destroy</em>:  delete a specific news</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed/6107fe65ff324f482d1c7569" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed/6107fe65ff324f482d1c7569"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/newsfeed/{newsfeed}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id event.</td>
</tr>
<tr>
<td><code>newsfeed</code></td>
<td>required</td>
<td>id news.</td>
</tr>
</tbody>
</table>
<!-- END_322b2e85d6ca0584c316bb1b662b654a -->
<!-- START_70a22f864b8b2e72e32ac85821bf707e -->
<h2><em>index</em>: list of news of the event.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/605241e68b276356801236e4\/newsfeed?page=1",
        "last": "http:\/\/localhost\/api\/events\/605241e68b276356801236e4\/newsfeed?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/605241e68b276356801236e4\/newsfeed",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/newsfeed</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id event</td>
</tr>
</tbody>
</table>
<!-- END_70a22f864b8b2e72e32ac85821bf707e -->
<!-- START_1acb96ce1b68eb8a3c8a1a08a36a1020 -->
<h2><em>show</em>:  view information for a specific news</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed/6107fe65ff324f482d1c7569" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/605241e68b276356801236e4/newsfeed/6107fe65ff324f482d1c7569"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Newsfeed] 6107fe65ff324f482d1c7569"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/newsfeed/{newsfeed}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>id event.</td>
</tr>
<tr>
<td><code>newsfeed</code></td>
<td>required</td>
<td>id news.</td>
</tr>
</tbody>
</table>
<!-- END_1acb96ce1b68eb8a3c8a1a08a36a1020 -->
<h1>Orders</h1>
<p>The purpose of this end point is to store all the information of a user's payment orders</p>
<!-- START_f9301c03a9281c0847565f96e6f723de -->
<h2><em>index</em>: list of all orders</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [
        {
            "_id": "5c5209c9f33bd41d17312774",
            "_token": "Iac0K5a4SOBSZGSZfQUFH3kAJhZGMpC8eeT7mAok",
            "payment_gateway_id": "3",
            "first_name": "Larissa",
            "last_name": "Wiley",
            "email": "felipe.martinez+100@mocionsoft.com",
            "order_status_id": "5c4a291e5c93dc0eb1992149",
            "amount": 100000,
            "booking_fee": 0,
            "organiser_booking_fee": 0,
            "discount": 0,
            "account_id": "5c51df3f342254001128a122",
            "event_id": "5c51e165342254001a3b1982",
            "is_payment_received": 1,
            "session_id": 171953,
            "order_reference": "ticket_order_1548880329",
            "taxamt": "0.00",
            "url": "https:\/\/test.placetopay.com\/redirection\/session\/171953\/918bed652065302921a260c87320b2b3",
            "updated_at": "2019-02-21 00:33:59",
            "created_at": "2019-01-30 20:32:09",
            "tickets": [],
            "order_status": {
                "_id": "5c4a291e5c93dc0eb1992149",
                "id": "6",
                "name": "Rechazado"
            }
        },
        {
            "_id": "5c52104df33bd41d187dc7a3",
            "_token": "Iac0K5a4SOBSZGSZfQUFH3kAJhZGMpC8eeT7mAok",
            "payment_gateway_id": "3",
            "first_name": "Larissa",
            "last_name": "Wiley",
            "email": "felipe.martinez+100@mocionsoft.com",
            "order_status_id": "5c4a291e5c93dc0eb1992149",
            "amount": 100000,
            "booking_fee": 0,
            "organiser_booking_fee": 0,
            "discount": 0,
            "account_id": "5c51df3f342254001128a122",
            "event_id": "5c51e165342254001a3b1982",
            "is_payment_received": 1,
            "session_id": 171957,
            "order_reference": "ticket_order_1548881997",
            "taxamt": "0.00",
            "url": "https:\/\/test.placetopay.com\/redirection\/session\/171957\/8081ccf8aa0bb8d0eadb223854bdae8e",
            "updated_at": "2019-02-21 00:34:02",
            "created_at": "2019-01-30 20:59:57",
            "tickets": [],
            "order_status": {
                "_id": "5c4a291e5c93dc0eb1992149",
                "id": "6",
                "name": "Rechazado"
            }
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/orders</code></p>
<!-- END_f9301c03a9281c0847565f96e6f723de -->
<!-- START_285c87403b6cfdebe26bc357f22e870f -->
<h2><em>store</em>: create new order</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"items":"[\"5ea23acbd74d5c4b360ddde2\"]","account_id":"5f450fb3d4267837bb128102","amount":10000,"item_type":"discountCode","discount_codes":[],"properties":"{\"person_type\" : \"Natural\",\"document_type\" : \"CC\", \"email\" : \"correo@correo.com\" , document_number\" : \"1014305626\",\"telephone\" : \"30058744512\",\"date_birth\" : \"2021-01-13\",\"adress\" : \"Calle falsa 123\", \"user_first_name\" : \"Pepe\" ,\"user_last_name\" : \"Lepu\"}"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "items": "[\"5ea23acbd74d5c4b360ddde2\"]",
    "account_id": "5f450fb3d4267837bb128102",
    "amount": 10000,
    "item_type": "discountCode",
    "discount_codes": [],
    "properties": "{\"person_type\" : \"Natural\",\"document_type\" : \"CC\", \"email\" : \"correo@correo.com\" , document_number\" : \"1014305626\",\"telephone\" : \"30058744512\",\"date_birth\" : \"2021-01-13\",\"adress\" : \"Calle falsa 123\", \"user_first_name\" : \"Pepe\" ,\"user_last_name\" : \"Lepu\"}"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>items</code></td>
<td>array</td>
<td>required</td>
<td>the items are the id of the event in case of buying a course or the id of the discount code template in case of buying a code</td>
</tr>
<tr>
<td><code>account_id</code></td>
<td>string</td>
<td>required</td>
<td>id of the user making the purchase</td>
</tr>
<tr>
<td><code>amount</code></td>
<td>integer</td>
<td>required</td>
<td>total order value</td>
</tr>
<tr>
<td><code>item_type</code></td>
<td>string</td>
<td>required</td>
<td>item type discountCode or event</td>
</tr>
<tr>
<td><code>discount_codes</code></td>
<td>array</td>
<td>optional</td>
<td>disount code</td>
</tr>
<tr>
<td><code>properties</code></td>
<td>object</td>
<td>optional</td>
<td>the properties are the additional data required for billing such as: <strong>person_type, document_type, email, document_number, telephone, date_birth, adress</strong></td>
</tr>
</tbody>
</table>
<!-- END_285c87403b6cfdebe26bc357f22e870f -->
<!-- START_7e6be1b9dd04564a7b1298dd260f3183 -->
<h2><em>show</em>: view order-specific information</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/orders/5fbd84e345611e292f04ab92" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/5fbd84e345611e292f04ab92"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Order] 5fbd84e345611e292f04ab92"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/orders/{order}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>order</code></td>
<td>required</td>
<td>order id</td>
</tr>
</tbody>
</table>
<!-- END_7e6be1b9dd04564a7b1298dd260f3183 -->
<!-- START_37f7b8cec13991c44b134bb2186e9d1e -->
<h2><em>update</em>: update the specified resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"items":"[\"5ea23acbd74d5c4b360ddde2\"]","account_id":"5f450fb3d4267837bb128102","amount":10000}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "items": "[\"5ea23acbd74d5c4b360ddde2\"]",
    "account_id": "5f450fb3d4267837bb128102",
    "amount": 10000
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/orders/{order}</code></p>
<p><code>PATCH api/orders/{order}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>items</code></td>
<td>array</td>
<td>optional</td>
<td>id of the event from which the purchase is made</td>
</tr>
<tr>
<td><code>account_id</code></td>
<td>string</td>
<td>optional</td>
<td>id of the user making the purchase</td>
</tr>
<tr>
<td><code>amount</code></td>
<td>integer</td>
<td>optional</td>
<td>total order value</td>
</tr>
</tbody>
</table>
<!-- END_37f7b8cec13991c44b134bb2186e9d1e -->
<!-- START_c280b55cf267ef09fc12c6b09ac78ede -->
<h2><em>destroy</em>: remove the specified resource from storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/orders/{order}</code></p>
<!-- END_c280b55cf267ef09fc12c6b09ac78ede -->
<!-- START_6cc158194854b1566a980ee31d9d889e -->
<h2><em>indexByEvent</em>: display all the orders of an event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/orders/ordersevent?filtered=%5B%7B%22field%22%3A%22items%22%2C%22value%22%3A%226116b372396b8f5e864f033a%22%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/orders/ordersevent"
);

let params = {
    "filtered": "[{"field":"items","value":"6116b372396b8f5e864f033a"}]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/5ea23acbd74d5c4b360ddde2\/orders\/ordersevent?page=1",
        "last": "http:\/\/localhost\/api\/events\/5ea23acbd74d5c4b360ddde2\/orders\/ordersevent?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/5ea23acbd74d5c4b360ddde2\/orders\/ordersevent",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/orders/ordersevent</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>event_id required</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>filtered</code></td>
<td>optional</td>
<td>optional filter parameters</td>
</tr>
</tbody>
</table>
<!-- END_6cc158194854b1566a980ee31d9d889e -->
<!-- START_9b8c5a2dde67602a8bbc27b096c1a18c -->
<h2><em>index</em>: display all the Orders of an user</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/users/5f450fb3d4267837bb128102/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/5f450fb3d4267837bb128102/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users/{user_id}/orders</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_9b8c5a2dde67602a8bbc27b096c1a18c -->
<!-- START_ce55e3d34b596a57ed26ef1545458299 -->
<h2><em>index:</em> display all the Orders of an user logueado</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/orders</code></p>
<!-- END_ce55e3d34b596a57ed26ef1545458299 -->
<!-- START_bf072e9c55bd3ec9ea0f7fe31d44b304 -->
<h2><em>indexByOrganization</em>: display all the Orders of an organization</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/orders/adipisci/orderOrganization" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/adipisci/orderOrganization"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/orders/aut/orderOrganization" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/orders/aut/orderOrganization"
=======
    -G "https://api.evius.co/api/orders/ut/orderOrganization" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/orders/ut/orderOrganization"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/orders/ullam/orderOrganization" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/ullam/orderOrganization"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/orders/adipisci/orderOrganization" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/adipisci/orderOrganization"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/orders/{organization_id}/orderOrganization</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_bf072e9c55bd3ec9ea0f7fe31d44b304 -->
<h1>Organization</h1>
<!-- START_434c81a9abb0283f205ef7cb7378688e -->
<h2><em>index</em>:Display a listing of the organizations.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organizations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "_id": "5bb53ffac06586065d58cf7c",
    "name": "empresa",
    "nit": "123213213",
    "phone": "123123213",
    "author": "5ba434b0c065861ef00d1d0d",
    "updated_at": "2018-10-03 22:17:30",
    "created_at": "2018-10-03 22:17:30"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations</code></p>
<!-- END_434c81a9abb0283f205ef7cb7378688e -->
<!-- START_7d1f86cd2d17ff6e8f7bce97aeabc7f3 -->
<h2><em>show</em>: Display the specified organization.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organizations/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Organization] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}</code></p>
<!-- END_7d1f86cd2d17ff6e8f7bce97aeabc7f3 -->
<!-- START_a3d4660c575d6fd59c9718ff69a12cc7 -->
<h2><em>store</em>:Store a newly created resource in organizations.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/organizations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"name":"laudantium","styles":[],"user_properties":[]}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"name":"ex","styles":[],"user_properties":[]}'
=======
    -d '{"name":"autem","styles":[],"user_properties":[]}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"name":"dolor","styles":[],"user_properties":[]}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"name":"laudantium","styles":[],"user_properties":[]}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "laudantium",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "ex",
=======
    "name": "autem",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "dolor",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "name": "laudantium",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "styles": [],
    "user_properties": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/organizations</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>required</td>
<td>optional</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>array</td>
<td>required</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_a3d4660c575d6fd59c9718ff69a12cc7 -->
<!-- START_830597a84ecd460e286f39b9ea7ef5ac -->
<h2><em>update</em>: Update the specified resource in organization.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/et" \
=======
    "https://devapi.evius.co/api/organizations/non" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/organizations/non" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/et" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"eveniet","styles":[],"user_properties":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/non"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/organizations/et"
=======
    "https://api.evius.co/api/organizations/dolor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"vel","styles":[],"user_properties":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/dolor"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/accusantium" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ab","styles":[],"user_properties":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/accusantium"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/non"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "eveniet",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "est",
=======
    "name": "vel",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "ab",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "name": "eveniet",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "styles": [],
    "user_properties": []
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/organizations/{organization}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>required</td>
<td>optional</td>
</tr>
<tr>
<td><code>styles</code></td>
<td>array</td>
<td>required</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_830597a84ecd460e286f39b9ea7ef5ac -->
<!-- START_b9047b90f047db47c77810fd8de29af9 -->
<h2><em>destroy</em>: Remove the specified organization from storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/organizations/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/organizations/{organization}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_b9047b90f047db47c77810fd8de29af9 -->
<!-- START_fb6e9dbe7a1124499a62eb259b0fbc18 -->
<h2><em>ordersUsersPoints</em>: list all information about all orders pending with the information complete about codes and total products</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organization/voluptas/ordersUsersPoints?status=pendiente&amp;date_from=repudiandae&amp;date_to=eveniet&amp;type_report=csv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organization/voluptas/ordersUsersPoints"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/organization/laudantium/ordersUsersPoints?status=pendiente&amp;date_from=qui&amp;date_to=maxime&amp;type_report=csv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organization/laudantium/ordersUsersPoints"
=======
    -G "https://api.evius.co/api/organization/accusamus/ordersUsersPoints?status=pendiente&amp;date_from=cum&amp;date_to=non&amp;type_report=csv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organization/accusamus/ordersUsersPoints"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/organization/cum/ordersUsersPoints?status=pendiente&amp;date_from=dolorem&amp;date_to=cum&amp;type_report=csv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organization/cum/ordersUsersPoints"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organization/voluptas/ordersUsersPoints?status=pendiente&amp;date_from=repudiandae&amp;date_to=eveniet&amp;type_report=csv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organization/voluptas/ordersUsersPoints"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let params = {
    "status": "pendiente",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "date_from": "repudiandae",
    "date_to": "eveniet",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "date_from": "qui",
    "date_to": "maxime",
=======
    "date_from": "cum",
    "date_to": "non",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "date_from": "dolorem",
    "date_to": "cum",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "date_from": "repudiandae",
    "date_to": "eveniet",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "type_report": "csv",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organization/{organization}/ordersUsersPoints</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization_id</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>status</code></td>
<td>optional</td>
<td>this paramether has two options: pendiente or despachado. The default value is pendiente.</td>
</tr>
<tr>
<td><code>date_from</code></td>
<td>optional</td>
<td>Format: DD-MM-YYYY If you want to filtered for date this is the initial date.</td>
</tr>
<tr>
<td><code>date_to</code></td>
<td>optional</td>
<td>Format: DD-MM-YYYY If you want to filtered for date this is the finish date.</td>
</tr>
<tr>
<td><code>type_report</code></td>
<td>optional</td>
<td>This parameter allows return format json or csv,</td>
</tr>
</tbody>
</table>
<!-- END_fb6e9dbe7a1124499a62eb259b0fbc18 -->
<h1>Organization User</h1>
<p>This model is the</p>
<!-- START_df43e77b8e54b4ebc43bfa2c1b1be609 -->
<h2><em>index</em>: List all user of a organization</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organizations/1/organizationusers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/organizationusers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/organizationusers</code></p>
<!-- END_df43e77b8e54b4ebc43bfa2c1b1be609 -->
<!-- START_27849da1b2004e898106c0e7154c6c49 -->
<h2><em>show</em>: view a specific organization user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/occaecati/organizationusers/voluptate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/occaecati/organizationusers/voluptate"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/organizations/at/organizationusers/excepturi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/at/organizationusers/excepturi"
=======
    -G "https://api.evius.co/api/organizations/delectus/organizationusers/accusamus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/delectus/organizationusers/accusamus"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/organizations/neque/organizationusers/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/neque/organizationusers/et"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/occaecati/organizationusers/voluptate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/occaecati/organizationusers/voluptate"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/organizationusers/{organizationuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>optional</td>
<td>The id of the organization</td>
</tr>
<tr>
<td><code>organizationuser</code></td>
<td>optional</td>
<td>The id of the organization</td>
</tr>
</tbody>
</table>
<!-- END_27849da1b2004e898106c0e7154c6c49 -->
<!-- START_a93750b0b379e68b8ec6868184a38740 -->
<h2><em>update</em>: update a register user in organization.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/et/organizationusers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/et/organizationusers/1"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/deserunt/organizationusers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/deserunt/organizationusers/1"
=======
    "https://api.evius.co/api/organizations/autem/organizationusers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/autem/organizationusers/1"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/placeat/organizationusers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/placeat/organizationusers/1"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/et/organizationusers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/et/organizationusers/1"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/organizations/{organization}/organizationusers/{organizationuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<!-- END_a93750b0b379e68b8ec6868184a38740 -->
<!-- START_1120b508785531237669def22c99aa6e -->
<h2><em>destroy</em>: delete a sapcific user in the organization</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/architecto/organizationusers/minima" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/architecto/organizationusers/minima"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/est/organizationusers/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/est/organizationusers/et"
=======
    "https://api.evius.co/api/organizations/corrupti/organizationusers/saepe" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/corrupti/organizationusers/saepe"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/consequatur/organizationusers/nesciunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/consequatur/organizationusers/nesciunt"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/architecto/organizationusers/minima" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/architecto/organizationusers/minima"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/organizations/{organization}/organizationusers/{organizationuser}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
<tr>
<td><code>organizationuser</code></td>
<td>required</td>
<td>organization user id</td>
</tr>
</tbody>
</table>
<!-- END_1120b508785531237669def22c99aa6e -->
<!-- START_4c6145b46f1c2242e8bb6de5f5447d52 -->
<h2><em>meOrganizations</em>: list user&#039;s organizations.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
These organizations</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/organizations" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/organizations"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/organizations</code></p>
<!-- END_4c6145b46f1c2242e8bb6de5f5447d52 -->
<!-- START_58b0ca87cd1aefd4ad8a9943ca352bc4 -->
<h2><em>meInOrganization</em>: view the information an user specific into an organization</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/me/organizations/blanditiis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/organizations/blanditiis"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/me/organizations/ratione" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/me/organizations/ratione"
=======
    -G "https://api.evius.co/api/me/organizations/fugiat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/me/organizations/fugiat"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/me/organizations/sed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/organizations/sed"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/me/organizations/blanditiis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/organizations/blanditiis"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/organizations/{organization}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>optional</td>
<td>The id of the organization</td>
</tr>
</tbody>
</table>
<!-- END_58b0ca87cd1aefd4ad8a9943ca352bc4 -->
<!-- START_b503be95f61a64248d1c224d6ca8afc5 -->
<h2><em>store</em>: create a new user in a organization</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/qui/addorganizationuser" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/ratione/addorganizationuser" \
=======
    "https://api.evius.co/api/organizations/voluptas/addorganizationuser" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/animi/addorganizationuser" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/qui/addorganizationuser" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"test+11@mocionsoft.com","names":"test"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/qui/addorganizationuser"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/ratione/addorganizationuser"
=======
    "https://api.evius.co/api/organizations/voluptas/addorganizationuser"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/animi/addorganizationuser"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/qui/addorganizationuser"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "test+11@mocionsoft.com",
    "names": "test"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/organizations/{organization}/addorganizationuser</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization_id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
<td>user email</td>
</tr>
<tr>
<td><code>names</code></td>
<td>string</td>
<td>required</td>
<td>user names</td>
</tr>
</tbody>
</table>
<!-- END_b503be95f61a64248d1c224d6ca8afc5 -->
<h1>Organization User Properties</h1>
<!-- START_fde293a40d72b8e03e61bb63ad3a64f6 -->
<h2><em>index</em>: list of user properties of a specific event.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organizations/1/userproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/userproperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>optional</td>
<td>required.</td>
</tr>
</tbody>
</table>
<!-- END_fde293a40d72b8e03e61bb63ad3a64f6 -->
<!-- START_8e4161194c0ae11e8741dddf0bd358a8 -->
<h2><em>show</em>: view the specific user propertie.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/1/userproperties/vero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties/vero"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/organizations/1/userproperties/asperiores" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/1/userproperties/asperiores"
=======
    -G "https://api.evius.co/api/organizations/1/userproperties/error" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/1/userproperties/error"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/organizations/1/userproperties/inventore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties/inventore"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/1/userproperties/vero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties/vero"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/userproperties/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id UserProperties</td>
</tr>
</tbody>
</table>
<!-- END_8e4161194c0ae11e8741dddf0bd358a8 -->
<!-- START_167f478ffea3087e2d42f6b4df749db6 -->
<h2><em>store</em>: a newly created resource in UserProperties.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/organizations/1/userproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"celular","mandatory":true,"visibleByContacts":true,"visibleByAdmin":true,"label":"Celular","description":"N\u00famero de contacto","type":"number","justonebyattendee":true,"order_weight":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "celular",
    "mandatory": true,
    "visibleByContacts": true,
    "visibleByAdmin": true,
    "label": "Celular",
    "description": "N\u00famero de contacto",
    "type": "number",
    "justonebyattendee": true,
    "order_weight": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/organizations/{organization}/userproperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>optional</td>
<td>required.</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>strign</td>
<td>required</td>
<td>name of user's property.</td>
</tr>
<tr>
<td><code>mandatory</code></td>
<td>boolean</td>
<td>required</td>
<td>This field indicates that the field in the form cannot be null if it is set to true or false if it can be null.</td>
</tr>
<tr>
<td><code>visibleByContacts</code></td>
<td>boolean</td>
<td>required</td>
<td>visible by contacts if its value is true.</td>
</tr>
<tr>
<td><code>visibleByAdmin</code></td>
<td>boolean</td>
<td>required</td>
<td>visible by admin if its value is true.</td>
</tr>
<tr>
<td><code>label</code></td>
<td>string</td>
<td>required</td>
<td>label that will be visible in the registration form.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>required</td>
<td>description.</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>required</td>
<td>type of character the field accepts in the form,</td>
</tr>
<tr>
<td><code>justonebyattendee</code></td>
<td>boolean</td>
<td>required</td>
</tr>
<tr>
<td><code>order_weight</code></td>
<td>number</td>
<td>required</td>
<td>order of fields in the form.</td>
</tr>
</tbody>
</table>
<!-- END_167f478ffea3087e2d42f6b4df749db6 -->
<!-- START_6358afd13bef612f324ae42b40a6078a -->
<h2><em>update</em>: update the specified resource in UserProperties.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/possimus" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/1/userproperties/in" \
=======
    "https://api.evius.co/api/organizations/1/userproperties/placeat" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/molestias" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/possimus" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"celular","mandatory":true,"visibleByContacts":true,"visibleByAdmin":true,"label":"Celular","description":"N\u00famero de contacto","type":"number","justonebyattendee":true,"order_weight":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/possimus"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/1/userproperties/in"
=======
    "https://api.evius.co/api/organizations/1/userproperties/placeat"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/molestias"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/possimus"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "celular",
    "mandatory": true,
    "visibleByContacts": true,
    "visibleByAdmin": true,
    "label": "Celular",
    "description": "N\u00famero de contacto",
    "type": "number",
    "justonebyattendee": true,
    "order_weight": 1
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/organizations/{organization}/userproperties/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id UserProperties</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>strign</td>
<td>optional</td>
<td>name of user's property.</td>
</tr>
<tr>
<td><code>mandatory</code></td>
<td>boolean</td>
<td>optional</td>
<td>This field indicates that the field in the form cannot be null if it is set to true or false if it can be null.</td>
</tr>
<tr>
<td><code>visibleByContacts</code></td>
<td>boolean</td>
<td>optional</td>
<td>visible by contacts if its value is true.</td>
</tr>
<tr>
<td><code>visibleByAdmin</code></td>
<td>boolean</td>
<td>optional</td>
<td>visible by admin if its value is true.</td>
</tr>
<tr>
<td><code>label</code></td>
<td>string</td>
<td>optional</td>
<td>label that will be visible in the registration form.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>description.</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>optional</td>
<td>type of character the field accepts in the form,</td>
</tr>
<tr>
<td><code>justonebyattendee</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>order_weight</code></td>
<td>number</td>
<td>optional</td>
<td>order of fields in the form.</td>
</tr>
</tbody>
</table>
<!-- END_6358afd13bef612f324ae42b40a6078a -->
<!-- START_396b41c70d12c1109e1377fd56016011 -->
<h2><em>destroy</em>: remove the specified resource from UserProperties.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/optio" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties/optio"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/1/userproperties/voluptatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/1/userproperties/voluptatibus"
=======
    "https://api.evius.co/api/organizations/1/userproperties/temporibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/1/userproperties/temporibus"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/cumque" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties/cumque"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/1/userproperties/optio" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/userproperties/optio"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/organizations/{organization}/userproperties/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id UserProperties</td>
</tr>
</tbody>
</table>
<!-- END_396b41c70d12c1109e1377fd56016011 -->
<h1>Product</h1>
<p>Endpoint that manages event products.</p>
<!-- START_0358a380fb4889756d2a2c7b2af024c6 -->
<h2><em>store</em>: create new register for product.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ea/products" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/sapiente/products" \
=======
    "https://api.evius.co/api/events/consequatur/products" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/temporibus/products" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ea/products" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Arbol","description":"Esta pintura es de un arbol.","image":"https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/87Pxr9PYNfBEDMbX19CeTU8wwTFHpb2XB3n2bnak.jpg","price":10000,"by":"Evius","short_description":"Pintura de arbol 1x2m","position":11111}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ea/products"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/sapiente/products"
=======
    "https://api.evius.co/api/events/consequatur/products"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/temporibus/products"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/ea/products"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Arbol",
    "description": "Esta pintura es de un arbol.",
    "image": "https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/87Pxr9PYNfBEDMbX19CeTU8wwTFHpb2XB3n2bnak.jpg",
    "price": 10000,
    "by": "Evius",
    "short_description": "Pintura de arbol 1x2m",
    "position": 11111
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/products</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name of image.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>description of image.</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>required</td>
<td>route of image.</td>
</tr>
<tr>
<td><code>price</code></td>
<td>number</td>
<td>optional</td>
</tr>
<tr>
<td><code>by</code></td>
<td>string</td>
<td>optional</td>
<td>author or brands of the product.</td>
</tr>
<tr>
<td><code>short_description</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>position</code></td>
<td>number</td>
<td>optional</td>
<td>position of the product to order them.</td>
</tr>
</tbody>
</table>
<!-- END_0358a380fb4889756d2a2c7b2af024c6 -->
<!-- START_1f13f3f69bf70a5e166cb499d630ef85 -->
<h2><em>update</em>: update image of product specific.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/amet/products/1" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/nam/products/1" \
=======
    "https://api.evius.co/api/events/nobis/products/1" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/repudiandae/products/1" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/amet/products/1" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Arbol","description":"Esta pintura es de un arbol.","image":"https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/87Pxr9PYNfBEDMbX19CeTU8wwTFHpb2XB3n2bnak.jpg","price":10000,"by":"Evius","short_description":"Pintura de arbol 1x2m"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/amet/products/1"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/nam/products/1"
=======
    "https://api.evius.co/api/events/nobis/products/1"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/repudiandae/products/1"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/amet/products/1"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Arbol",
    "description": "Esta pintura es de un arbol.",
    "image": "https:\/\/storage.googleapis.com\/eviusauth.appspot.com\/evius\/events\/87Pxr9PYNfBEDMbX19CeTU8wwTFHpb2XB3n2bnak.jpg",
    "price": 10000,
    "by": "Evius",
    "short_description": "Pintura de arbol 1x2m"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/products/{product}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
<td>name of image.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>description of image.</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
<td>route of image.</td>
</tr>
<tr>
<td><code>price</code></td>
<td>number</td>
<td>optional</td>
</tr>
<tr>
<td><code>by</code></td>
<td>string</td>
<td>optional</td>
<td>author or brands of the product.</td>
</tr>
<tr>
<td><code>short_description</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_1f13f3f69bf70a5e166cb499d630ef85 -->
<!-- START_c94f6ea83daf742543be8a079783e5c3 -->
<h2><em>destroy</em>: delete image in the product.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/et"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/aut"
=======
    "https://api.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/dolores" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/dolores"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/laudantium" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/laudantium"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/et"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/products/{product}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
</tr>
<tr>
<td><code>product</code></td>
<td>required</td>
<td>id of the event to be eliminated</td>
</tr>
</tbody>
</table>
<!-- END_c94f6ea83daf742543be8a079783e5c3 -->
<!-- START_512598b30e73f747a1366ca186b265b8 -->
<h2><em>createSilentAuction</em>: create a silent bid</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/60e8cd558c421b004f2ff082/silentauctionmail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"valueOffered":"100000"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5ea23acbd74d5c4b360ddde2/products/60e8cd558c421b004f2ff082/silentauctionmail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "valueOffered": "100000"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/products/{product}/silentauctionmail</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
<tr>
<td><code>product</code></td>
<td>required</td>
<td>product id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>valueOffered</code></td>
<td>requires</td>
<td>optional</td>
<td>number value offered for an item</td>
</tr>
</tbody>
</table>
<!-- END_512598b30e73f747a1366ca186b265b8 -->
<!-- START_bcbfb75febf28221590e61636f620566 -->
<h2><em>index</em>: list product by event.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/modi/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/modi/products"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/delectus/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/delectus/products"
=======
    -G "https://api.evius.co/api/events/dolore/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/dolore/products"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/iusto/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/iusto/products"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/modi/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/modi/products"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "first": "http:\/\/localhost\/api\/events\/modi\/products?page=1",
        "last": "http:\/\/localhost\/api\/events\/modi\/products?page=1",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "first": "http:\/\/localhost\/api\/events\/delectus\/products?page=1",
        "last": "http:\/\/localhost\/api\/events\/delectus\/products?page=1",
=======
        "first": "http:\/\/localhost\/api\/events\/dolore\/products?page=1",
        "last": "http:\/\/localhost\/api\/events\/dolore\/products?page=1",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "first": "http:\/\/localhost\/api\/events\/iusto\/products?page=1",
        "last": "http:\/\/localhost\/api\/events\/iusto\/products?page=1",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "first": "http:\/\/localhost\/api\/events\/modi\/products?page=1",
        "last": "http:\/\/localhost\/api\/events\/modi\/products?page=1",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
<<<<<<< HEAD
<<<<<<< HEAD
=======
        "path": "http:\/\/localhost\/api\/events\/modi\/products",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
        "path": "http:\/\/localhost\/api\/events\/delectus\/products",
=======
        "path": "http:\/\/localhost\/api\/events\/dolore\/products",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
        "path": "http:\/\/localhost\/api\/events\/iusto\/products",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
        "path": "http:\/\/localhost\/api\/events\/modi\/products",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/products</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_bcbfb75febf28221590e61636f620566 -->
<!-- START_4bef507777cd70c6558f89fe041edc82 -->
<h2><em>show</em>: consult information on a specific product</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/5bb25243b6312771e92c8693/products/labore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5bb25243b6312771e92c8693/products/labore"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/5bb25243b6312771e92c8693/products/beatae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/5bb25243b6312771e92c8693/products/beatae"
=======
    -G "https://api.evius.co/api/events/5bb25243b6312771e92c8693/products/dolorem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/5bb25243b6312771e92c8693/products/dolorem"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/5bb25243b6312771e92c8693/products/cum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5bb25243b6312771e92c8693/products/cum"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/5bb25243b6312771e92c8693/products/labore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/5bb25243b6312771e92c8693/products/labore"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/products/{product}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event</td>
</tr>
<tr>
<td><code>product</code></td>
<td>required</td>
<td>product</td>
</tr>
</tbody>
</table>
<!-- END_4bef507777cd70c6558f89fe041edc82 -->
<h1>RSVP</h1>
<p>Handle RSVP(invitations for events)</p>
<!-- START_6b8165cc7da505120fbe6aa7aba5356e -->
<h2><em>createAndSendRSVP</em>: send RSVP to users in an event, taking eventUsersIds[] in request to filter which users the RSVP is going to be send to</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/rsvp/sendeventrsvp/explicabo" \
=======
    "https://devapi.evius.co/api/rsvp/sendeventrsvp/exercitationem" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rsvp/sendeventrsvp/exercitationem" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/rsvp/sendeventrsvp/explicabo" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"perferendis","image_header":"amet","content_header":"Has sido invitado a el evento","message":"non","image":"non","image_footer":"odit","eventUsersIds":{"":"\"eventUsersIds\": [\"5f8734c81730821f216b6202\"]"},"include_ical_calendar":false,"include_login_button":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/rsvp/sendeventrsvp/exercitationem"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/rsvp/sendeventrsvp/explicabo"
=======
    "https://api.evius.co/api/rsvp/sendeventrsvp/vero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"odio","image_header":"vero","content_header":"Has sido invitado a el evento","message":"earum","image":"ratione","image_footer":"officia","eventUsersIds":{"":"\"eventUsersIds\": [\"5f8734c81730821f216b6202\"]"},"include_ical_calendar":false,"include_login_button":true}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/rsvp/sendeventrsvp/vero"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/rsvp/sendeventrsvp/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"subject":"veniam","image_header":"quisquam","content_header":"Has sido invitado a el evento","message":"voluptatem","image":"vero","image_footer":"ut","eventUsersIds":{"":"\"eventUsersIds\": [\"5f8734c81730821f216b6202\"]"},"include_ical_calendar":false,"include_login_button":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rsvp/sendeventrsvp/aut"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/rsvp/sendeventrsvp/exercitationem"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "subject": "perferendis",
    "image_header": "amet",
    "content_header": "Has sido invitado a el evento",
    "message": "non",
    "image": "non",
    "image_footer": "odit",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "subject": "similique",
    "image_header": "aspernatur",
    "content_header": "Has sido invitado a el evento",
    "message": "quia",
    "image": "laboriosam",
    "image_footer": "omnis",
=======
    "subject": "odio",
    "image_header": "vero",
    "content_header": "Has sido invitado a el evento",
    "message": "earum",
    "image": "ratione",
    "image_footer": "officia",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "subject": "veniam",
    "image_header": "quisquam",
    "content_header": "Has sido invitado a el evento",
    "message": "voluptatem",
    "image": "vero",
    "image_footer": "ut",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "subject": "perferendis",
    "image_header": "amet",
    "content_header": "Has sido invitado a el evento",
    "message": "non",
    "image": "non",
    "image_footer": "odit",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "eventUsersIds": {
        "": "\"eventUsersIds\": [\"5f8734c81730821f216b6202\"]"
    },
    "include_ical_calendar": false,
    "include_login_button": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/rsvp/sendeventrsvp/{event}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>subject</code></td>
<td>string</td>
<td>required</td>
<td>mail subject Evento virtual Ucronio</td>
</tr>
<tr>
<td><code>image_header</code></td>
<td>string</td>
<td>optional</td>
<td>imagen header</td>
</tr>
<tr>
<td><code>content_header</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>message</code></td>
<td>string</td>
<td>optional</td>
<td>message that will go in the body of the mail</td>
</tr>
<tr>
<td><code>image</code></td>
<td>string</td>
<td>optional</td>
<td>image that will go in the body of the mail</td>
</tr>
<tr>
<td><code>image_footer</code></td>
<td>string</td>
<td>optional</td>
<td>image footer</td>
</tr>
<tr>
<td><code>eventUsersIds[]</code></td>
<td>array</td>
<td>required</td>
<td>id of users to whom the mail will be sent</td>
</tr>
<tr>
<td><code>include_ical_calendar</code></td>
<td>boolean</td>
<td>optional</td>
<td>field used to show(true) or not(false) the top calendar in the mailing</td>
</tr>
<tr>
<td><code>include_login_button</code></td>
<td>boolean</td>
<td>optional</td>
<td>field used to show (true) or not (false) the event entry button Example : false</td>
</tr>
</tbody>
</table>
<!-- END_6b8165cc7da505120fbe6aa7aba5356e -->
<!-- START_2b2c42e811c82fe1668961513937f683 -->
<h2>updateStatusMessageUser_: update the stadistics about the emails send</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
    "https://devapi.evius.co/api/events/explicabo/updateStatusMessageUser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/explicabo/updateStatusMessageUser/1"
=======
    "https://devapi.evius.co/api/events/consectetur/updateStatusMessageUser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/consectetur/updateStatusMessageUser/1"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/events/consectetur/updateStatusMessageUser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/consectetur/updateStatusMessageUser/1"
=======
    "https://devapi.evius.co/api/events/explicabo/updateStatusMessageUser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/explicabo/updateStatusMessageUser/1"
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/updateStatusMessageUser/{message_id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>optional</td>
<td>The ID of the event</td>
</tr>
<tr>
<td><code>message</code></td>
<td>optional</td>
<td>The ID of the message</td>
</tr>
</tbody>
</table>
<!-- END_2b2c42e811c82fe1668961513937f683 -->
<h1>RolEvent</h1>
<!-- START_75cf5c3a8f2699c0187f655ac1a80839 -->
<h2><em>index</em>: list all roles by event and the system default roles that can use in every events.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organizations/1/roles" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/roles"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "60e8a7e74f9fb74ccd00dc22",
        "name": "Attendee",
        "guard_name": "web",
        "updated_at": "2021-08-06 19:04:06",
        "created_at": "2021-07-09 19:47:51",
        "type": "attendee",
        "module": "system"
    },
    {
        "_id": "5c1a59b2f33bd40bb67f2322",
        "name": "Administrator",
        "guard_name": "web",
        "updated_at": "2021-07-02 20:58:53",
        "created_at": "2018-12-19 14:46:10",
        "type": "admin",
        "module": "system"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/roles</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organizaton</code></td>
<td>required</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<!-- END_75cf5c3a8f2699c0187f655ac1a80839 -->
<!-- START_5fde156c85cd0549ec53e979b40db35a -->
<h2><em>store</em>: create a new rol</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/quos/roles" \
=======
    "https://devapi.evius.co/api/organizations/dolor/roles" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/organizations/dolor/roles" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/quos/roles" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"exercitationem","type":"et","module":"dignissimos"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/dolor/roles"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/organizations/quos/roles"
=======
    "https://api.evius.co/api/organizations/dolores/roles" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"libero","type":"quia","module":"tenetur"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/dolores/roles"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/eveniet/roles" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"recusandae","type":"a","module":"sint"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/eveniet/roles"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/dolor/roles"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "exercitationem",
    "type": "et",
    "module": "dignissimos"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "maiores",
    "type": "itaque",
    "module": "et"
=======
    "name": "libero",
    "type": "quia",
    "module": "tenetur"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "recusandae",
    "type": "a",
    "module": "sint"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "name": "exercitationem",
    "type": "et",
    "module": "dignissimos"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/organizations/{organization}/roles</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>name of the role</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>module</code></td>
<td>required</td>
<td>optional</td>
<td>string This indicate management in to organization  organization defaul value.</td>
</tr>
</tbody>
</table>
<!-- END_5fde156c85cd0549ec53e979b40db35a -->
<!-- START_96609e7c119b00852e46e170c74929d9 -->
<h2><em>show</em>: information from a specific role in an event</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/omnis/roles/eos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/omnis/roles/eos"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/organizations/quis/roles/id" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/quis/roles/id"
=======
    -G "https://api.evius.co/api/organizations/nobis/roles/facilis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/nobis/roles/facilis"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/organizations/earum/roles/qui" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/earum/roles/qui"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/omnis/roles/eos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/omnis/roles/eos"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/roles/{rol}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
<tr>
<td><code>rol</code></td>
<td>required</td>
<td>organization rol</td>
</tr>
</tbody>
</table>
<!-- END_96609e7c119b00852e46e170c74929d9 -->
<!-- START_0e404f1982b18a1657efeb53eb13234d -->
<h2><em>update</em>: update the specified resource in storage.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/est/roles/perspiciatis" \
=======
    "https://devapi.evius.co/api/organizations/id/roles/perferendis" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/organizations/id/roles/perferendis" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/est/roles/perspiciatis" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"odio","model":"nemo"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/id/roles/perferendis"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/organizations/est/roles/perspiciatis"
=======
    "https://api.evius.co/api/organizations/corrupti/roles/nam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"in","model":"sapiente"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/corrupti/roles/nam"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/rerum/roles/aut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"vero","model":"id"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/rerum/roles/aut"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/id/roles/perferendis"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "name": "odio",
    "model": "nemo"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "name": "ut",
    "model": "asperiores"
=======
    "name": "in",
    "model": "sapiente"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "name": "vero",
    "model": "id"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "name": "odio",
    "model": "nemo"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/organizations/{organization}/roles/{rol}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
<tr>
<td><code>rol</code></td>
<td>required</td>
<td>organization rol</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>model</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_0e404f1982b18a1657efeb53eb13234d -->
<!-- START_ea81c8d9d17ea50df012601c683bba01 -->
<h2><em>destroy</em>:Remove the specified resource from storage.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/velit/roles/quis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/velit/roles/quis"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/molestiae/roles/accusamus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/molestiae/roles/accusamus"
=======
    "https://api.evius.co/api/organizations/vel/roles/rerum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/vel/roles/rerum"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/reprehenderit/roles/id" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/reprehenderit/roles/id"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/velit/roles/quis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/velit/roles/quis"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/organizations/{organization}/roles/{rol}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization id</td>
</tr>
<tr>
<td><code>rol</code></td>
<td>required</td>
<td>organization rol</td>
</tr>
</tbody>
</table>
<!-- END_ea81c8d9d17ea50df012601c683bba01 -->
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
=======
>>>>>>> rolesEtapa2
<!-- START_7fc3643705ffb59eed1a17830c3ca58a -->
<h2><em>index</em>: list roles by event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/rols" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rols"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/rols</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event id</td>
</tr>
</tbody>
</table>
<!-- END_7fc3643705ffb59eed1a17830c3ca58a -->
<!-- START_ae94266f0fd03360b19b3b34978ae151 -->
<h2><em>show</em>: information from a specific role</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/rols/1/rolseventspublic" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rols/1/rolseventspublic"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Rol] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/rols/{id}/rolseventspublic</code></p>
<!-- END_ae94266f0fd03360b19b3b34978ae151 -->
<<<<<<< HEAD
<h1>RoleAttendee</h1>
=======
=======
>>>>>>> rolesEtapa2
<h1>Rol Events</h1>
<p>These enpoints help you to manage the roles of attendes
and aministrators in a event.</p>
<p>You can create all roles that yo want. </p>
<p>For view and manage this endpoints you have to be administrator in the event.</p>
<<<<<<< HEAD
>>>>>>> rolesEtapa2:public/docs/index.html
=======
>>>>>>> rolesEtapa2
<!-- START_daebd65ec706c058340d05a863cd1d6a -->
<h2><em>index</em>: list roles by event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
In this list you can see the two roles default of the system: Attendee and Administrator.
Also you can see all roles created for you in you event.
When you create an event, you are assigned the Administrator role.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/1/rolesattendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/rolesattendees"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/1/rolesattendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/rolesattendees"
=======
    -G "https://api.evius.co/api/events/quis/rolesattendees?filtered=%5B%7B%22field%22%3A%22type%22%2C%22value%22%3A%22attendee%22%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/quis/rolesattendees"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/events/quia/rolesattendees?filtered=%5B%7B%22field%22%3A%22type%22%2C%22value%22%3A%22attendee%22%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/quia/rolesattendees"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/1/rolesattendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/rolesattendees"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let params = {
    "filtered": "[{"field":"type","value":"attendee"}]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "60e8a7e74f9fb74ccd00dc22",
        "name": "Attendee",
        "guard_name": "web",
        "updated_at": "2021-08-06 19:04:06",
        "created_at": "2021-07-09 19:47:51",
        "type": "attendee",
        "module": "system"
    },
    {
        "_id": "5c1a59b2f33bd40bb67f2322",
        "name": "Administrator",
        "guard_name": "web",
        "updated_at": "2021-07-02 20:58:53",
        "created_at": "2018-12-19 14:46:10",
        "type": "admin",
        "module": "system"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/rolesattendees</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
<td><code>event_id</code></td>
<td>required</td>
<td>event id</td>
=======
=======
>>>>>>> rolesEtapa2
<td><code>event</code></td>
<td>required</td>
<td>The ID of the event</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>filtered</code></td>
<td>optional</td>
<td>optional filter parameters</td>
<<<<<<< HEAD
>>>>>>> rolesEtapa2:public/docs/index.html
=======
>>>>>>> rolesEtapa2
</tr>
</tbody>
</table>
<!-- END_daebd65ec706c058340d05a863cd1d6a -->
<!-- START_11bc1f15101545b12589241813acaff2 -->
<h2><em>store</em>: create a new rol</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/rolesattendees" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/rolesattendees" \
=======
    "https://api.evius.co/api/events/expedita/rolesattendees" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/dolor/rolesattendees" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/rolesattendees" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"RolName","type":"attendee"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/rolesattendees"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/1/rolesattendees"
=======
    "https://api.evius.co/api/events/expedita/rolesattendees"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/dolor/rolesattendees"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/1/rolesattendees"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "RolName",
    "type": "attendee"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/rolesattendees</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
<td><code>event_id</code></td>
<td>required</td>
=======
<td><code>event</code></td>
<td>required</td>
<td>The ID of the event</td>
>>>>>>> rolesEtapa2:public/docs/index.html
=======
<td><code>event</code></td>
<td>required</td>
<td>The ID of the event</td>
>>>>>>> rolesEtapa2
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>unique Rol name, the name of the role have to be unique, you can't create two or more roles with the same name.</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>required</td>
<td>The type can be attendee or admin. The user with role type attendee can have access to event’s landing and can consult only the functions get, thist ype of rol doesn’t  access to CMS.</td>
</tr>
</tbody>
</table>
<!-- END_11bc1f15101545b12589241813acaff2 -->
<!-- START_5055a96905ed88d1904fd00ac2112535 -->
<h2><em>show</em>: information from a specific role</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/1/rolesattendees/5faefba6b68d6316213f7cc2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/rolesattendees/5faefba6b68d6316213f7cc2"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/events/1/rolesattendees/5faefba6b68d6316213f7cc2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/rolesattendees/5faefba6b68d6316213f7cc2"
=======
    -G "https://api.evius.co/api/events/sit/rolesattendees/ut" \
=======
    -G "https://devapi.evius.co/api/events/odit/rolesattendees/accusamus" \
>>>>>>> rolesEtapa2
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/odit/rolesattendees/accusamus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/rolesattendees/{rolevent}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>The ID of the event</td>
</tr>
<tr>
<td><code>rolevent</code></td>
<td>required</td>
<td>rol id</td>
</tr>
</tbody>
</table>
<!-- END_5055a96905ed88d1904fd00ac2112535 -->
<!-- START_2bbb24201a513674052246142b773598 -->
<h2><em>update</em>: update the specified rol in the event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/ea/rolesattendees/sed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"laudantium","type":"ut"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/ea/rolesattendees/sed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "laudantium",
    "type": "ut"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/rolesattendees/{rolevent}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>The ID of the event</td>
</tr>
<tr>
<td><code>rolevent</code></td>
<td>required</td>
<td>rol id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>optional</td>
<td>Rol name</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>optional</td>
<td>The type can be attendee or admin</td>
</tr>
</tbody>
</table>
<!-- END_2bbb24201a513674052246142b773598 -->
<!-- START_c4944fda5c5ef68fc14b4664b719a484 -->
<h2><em>destroy</em>: if the roll is not used for none user you can remove them.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/omnis/rolesattendees/dignissimos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/omnis/rolesattendees/dignissimos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/rolesattendees/{rolevent}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>The ID of the event</td>
</tr>
<tr>
<td><code>rolevent</code></td>
<td>required</td>
<td>rol id</td>
</tr>
</tbody>
</table>
<!-- END_c4944fda5c5ef68fc14b4664b719a484 -->
<<<<<<< HEAD
<h1>Roles Permissions</h1>
<p>These endpoint allow you manage the relationship between roles and permissions.
Here you can see the which permissions have the roles and also you can add permissions
to the roles.</p>
<!-- START_8d3e90084c3b726d3fbd482738591c60 -->
<h2><em>index</em>: list all roles and their permissions</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://api.evius.co/api/events/rem/rolespermissions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/rem/rolespermissions"
>>>>>>> rolesEtapa2:public/docs/index.html
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/events/1/rolesattendees/5faefba6b68d6316213f7cc2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/rolesattendees/5faefba6b68d6316213f7cc2"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "_id": "62265556a2634aabe418619e",
        "rol_id": "60e8a7e74f9fb74ccd00dc22",
        "permission_id": "6220f361b472fe2eb78b6d7b",
        "updated_at": "2021-08-06 19:48:01",
        "created_at": "2021-08-06 19:48:01",
        "rol": {
            "_id": "60e8a7e74f9fb74ccd00dc22",
            "name": "Attendee",
            "guard_name": "web",
            "updated_at": "2021-08-06 19:04:06",
            "created_at": "2021-07-09 19:47:51",
            "type": "attendee",
            "module": "system"
        },
        "permission": {
            "_id": "6220f361b472fe2eb78b6d7b",
            "name": "list_activities"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/rolespermissions</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>rolesattendee</code></td>
<td>required</td>
<td>RoleAttendee id</td>
</tr>
</tbody>
</table>
<!-- END_ca4093f14da2bc7f1804f083e9cb1a75 -->
<!-- START_c9f4b57d1c2ec7748a7b442f7568ec6d -->
<h2><em>update</em>: update role event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/rolesattendees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/rolesattendees/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/rolesattendees/{rolesattendee}</code></p>
<p><code>PATCH api/events/{event}/rolesattendees/{rolesattendee}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id de RoleAttendee</td>
</tr>
</tbody>
</table>
<!-- END_c9f4b57d1c2ec7748a7b442f7568ec6d -->
<!-- START_abbfbdc7df426c143ee85ea151b2877c -->
<h2><em>destroy</em>: delete rol.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/1/rolesattendees/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/rolesattendees/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/rolesattendees/{rolesattendee}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id de RoleAttendee</td>
</tr>
</tbody>
</table>
<!-- END_abbfbdc7df426c143ee85ea151b2877c -->
<!-- START_5ae624c6977784b7a830ad9eab832b35 -->
<h2><em>index</em>: list of the roles of the attendees of an event</h2>
=======
<td><code>event</code></td>
<td>optional</td>
<td>requires event id.</td>
</tr>
</tbody>
</table>
<!-- END_8d3e90084c3b726d3fbd482738591c60 -->
<!-- START_29386b8ed115f4cf9a8c48cca1767ffd -->
<h2><em>indexByRoles</em>: list all permisos by rol</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
>>>>>>> rolesEtapa2:public/docs/index.html
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
    -G "https://api.evius.co/api/events/autem/rolespermissionsbyrol" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/autem/rolespermissionsbyrol"
=======
    -G "https://devapi.evius.co/api/rolesattendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rolesattendees"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    -G "https://devapi.evius.co/api/rolesattendees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rolesattendees"
=======
    -G "https://api.evius.co/api/events/autem/rolespermissionsbyrol" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/autem/rolespermissionsbyrol"
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/rolespermissionsbyrol</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
<td><code>event_id</code></td>
<td>required</td>
<td>event id</td>
=======
<td><code>event</code></td>
<td>optional</td>
<td>requires event id.</td>
</tr>
<tr>
<td><code>rol</code></td>
<td>optional</td>
<td>requires event rol id.</td>
>>>>>>> rolesEtapa2:public/docs/index.html
</tr>
</tbody>
</table>
<!-- END_29386b8ed115f4cf9a8c48cca1767ffd -->
<!-- START_434e2e708f44439618f042917956910f -->
<h2><em>show</em>: information from a specific relationship between role and permiision</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
    -G "https://api.evius.co/api/events/1/rolespermissions/sit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/rolespermissions/sit"
=======
    -G "https://devapi.evius.co/api/rolesattendees/5faefba6b68d6316213f7cc2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rolesattendees/5faefba6b68d6316213f7cc2"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    -G "https://devapi.evius.co/api/rolesattendees/5faefba6b68d6316213f7cc2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rolesattendees/5faefba6b68d6316213f7cc2"
=======
    -G "https://api.evius.co/api/events/1/rolespermissions/sit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/1/rolespermissions/sit"
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/rolespermissions/{rolpermission}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>rolpermission</code></td>
<td>required</td>
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
</tr>
<tr>
<td><code>rolesattendee</code></td>
<td>required</td>
<td>RoleAttendee id</td>
=======
<td>rolpermission_id</td>
>>>>>>> rolesEtapa2:public/docs/index.html
</tr>
</tbody>
</table>
<!-- END_434e2e708f44439618f042917956910f -->
<!-- START_5da5502bb097af8a8781a32754c4e353 -->
<h2><em>store</em>: create new rolespermissions</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
    "https://api.evius.co/api/events/1/rolespermissions" \
=======
    "https://devapi.evius.co/api/rolesattendees" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rolesattendees" \
=======
    "https://api.evius.co/api/events/1/rolespermissions" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"rol_id":"hic","permission_id":"laborum"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
    "https://api.evius.co/api/events/1/rolespermissions"
=======
    "https://devapi.evius.co/api/rolesattendees"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rolesattendees"
=======
    "https://api.evius.co/api/events/1/rolespermissions"
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rol_id": "hic",
    "permission_id": "laborum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
<p><code>POST api/rolesattendees</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
=======
<p><code>POST api/events/{event}/rolespermissions</code></p>
>>>>>>> rolesEtapa2:public/docs/index.html
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>rol_id</code></td>
<td>string</td>
<td>required</td>
</tr>
<tr>
<td><code>permission_id</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_5da5502bb097af8a8781a32754c4e353 -->
<!-- START_0908f0b7db5612c90ca0e8b822176a6c -->
<h2><em>update</em>: update a specific rolepermission</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
    "https://api.evius.co/api/events/1/rolespermissions/1" \
=======
    "https://devapi.evius.co/api/rolesattendees/1" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rolesattendees/1" \
=======
    "https://api.evius.co/api/events/1/rolespermissions/1" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"rol_id":"maxime","permission_id":"laborum"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
    "https://api.evius.co/api/events/1/rolespermissions/1"
=======
    "https://devapi.evius.co/api/rolesattendees/1"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rolesattendees/1"
=======
    "https://api.evius.co/api/events/1/rolespermissions/1"
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rol_id": "maxime",
    "permission_id": "laborum"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/rolespermissions/{rolpermission}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>rol_id</code></td>
<td>string</td>
<td>required</td>
</tr>
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
=======
<tr>
<td><code>permission_id</code></td>
<td>string</td>
<td>required</td>
</tr>
>>>>>>> rolesEtapa2:public/docs/index.html
</tbody>
</table>
<!-- END_0908f0b7db5612c90ca0e8b822176a6c -->
<!-- START_ccb7b798dcf1cc2f91466db6b637e3c5 -->
<h2><em>update</em>: update a specific rolepermission</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
<<<<<<< HEAD
<<<<<<< HEAD
    "https://api.evius.co/api/events/1/rolespermissions/1" \
=======
    "https://devapi.evius.co/api/rolesattendees/1" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rolesattendees/1" \
=======
    "https://api.evius.co/api/events/1/rolespermissions/1" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"rol_id":"quis","permission_id":"eos"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
    "https://api.evius.co/api/events/1/rolespermissions/1"
=======
    "https://devapi.evius.co/api/rolesattendees/1"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/rolesattendees/1"
=======
    "https://api.evius.co/api/events/1/rolespermissions/1"
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rol_id": "quis",
    "permission_id": "eos"
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/rolespermissions/{rolpermission}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>rol_id</code></td>
<td>string</td>
<td>required</td>
</tr>
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
</tbody>
</table>
<!-- END_20bcc935d9c85f19ae2a05947d0add4b -->
<!-- START_67f0cc9990d72d5faeb7e08ced97043b -->
<h2><em>destroy</em>: delete rol.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/rolesattendees/omnis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/rolesattendees/omnis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/rolesattendees/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id de RoleAttendee</td>
</tr>
</tbody>
</table>
<!-- END_67f0cc9990d72d5faeb7e08ced97043b -->
=======
<tr>
<td><code>permission_id</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_ccb7b798dcf1cc2f91466db6b637e3c5 -->
>>>>>>> rolesEtapa2:public/docs/index.html
=======
>>>>>>> rolesEtapa2
<h1>Surveys</h1>
<!-- START_7525b8a38df41d7ddc341cd4c293b84c -->
<h2><em>show</em> : view the information of a specific survey</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/surveys/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/surveys/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Survey] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/surveys/{surveys}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>string      required event id</td>
</tr>
<tr>
<td><code>survey</code></td>
<td>optional</td>
<td>string  required survey id</td>
</tr>
</tbody>
</table>
<!-- END_7525b8a38df41d7ddc341cd4c293b84c -->
<!-- START_6060d494641740ac2660bc7cd4cbe1d2 -->
<h2><em>index</em>: list of surveys of an event</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/surveys" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/surveys"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "links": {
        "first": "http:\/\/localhost\/api\/events\/1\/surveys?page=1",
        "last": "http:\/\/localhost\/api\/events\/1\/surveys?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/events\/1\/surveys",
        "per_page": 2500,
        "to": null,
        "total": 0
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/surveys</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>string  required event id</td>
</tr>
</tbody>
</table>
<!-- END_6060d494641740ac2660bc7cd4cbe1d2 -->
<!-- START_1f9326dacbb23c27cb5ebe3274269cb9 -->
<h2><em>store</em>: create a new survey</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1/surveys" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"survey":"Nombre de encuesta","show_horizontal_bar":false,"allow_vote_value_per_user":false,"activity_id":"quaerat","points":1,"initialMessage":"unde","time_limit":0,"allow_anonymous_answers":false,"allow_gradable_survey":false,"hasMinimumScore":false,"isGlobal":false,"freezeGame":false,"open":false,"publish":false,"minimumScore":37786.66257359}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"survey":"Nombre de encuesta","show_horizontal_bar":false,"allow_vote_value_per_user":false,"activity_id":"dolores","points":1,"initialMessage":"quis","time_limit":0,"allow_anonymous_answers":false,"allow_gradable_survey":false,"hasMinimumScore":false,"isGlobal":false,"freezeGame":false,"open":false,"publish":false,"minimumScore":20.963}'
=======
    -d '{"survey":"Nombre de encuesta","show_horizontal_bar":false,"allow_vote_value_per_user":false,"activity_id":"earum","points":1,"initialMessage":"tempora","time_limit":0,"allow_anonymous_answers":false,"allow_gradable_survey":false,"hasMinimumScore":false,"isGlobal":false,"freezeGame":false,"open":false,"publish":false,"minimumScore":520158035.4189}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"survey":"Nombre de encuesta","show_horizontal_bar":false,"allow_vote_value_per_user":false,"activity_id":"veritatis","points":1,"initialMessage":"qui","time_limit":0,"allow_anonymous_answers":false,"allow_gradable_survey":false,"hasMinimumScore":false,"isGlobal":false,"freezeGame":false,"open":false,"publish":false,"minimumScore":27242351.4}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"survey":"Nombre de encuesta","show_horizontal_bar":false,"allow_vote_value_per_user":false,"activity_id":"quaerat","points":1,"initialMessage":"unde","time_limit":0,"allow_anonymous_answers":false,"allow_gradable_survey":false,"hasMinimumScore":false,"isGlobal":false,"freezeGame":false,"open":false,"publish":false,"minimumScore":37786.66257359}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/surveys"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "survey": "Nombre de encuesta",
    "show_horizontal_bar": false,
    "allow_vote_value_per_user": false,
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "activity_id": "quaerat",
    "points": 1,
    "initialMessage": "unde",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "activity_id": "dolores",
    "points": 1,
    "initialMessage": "quis",
=======
    "activity_id": "earum",
    "points": 1,
    "initialMessage": "tempora",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "activity_id": "veritatis",
    "points": 1,
    "initialMessage": "qui",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "activity_id": "quaerat",
    "points": 1,
    "initialMessage": "unde",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "time_limit": 0,
    "allow_anonymous_answers": false,
    "allow_gradable_survey": false,
    "hasMinimumScore": false,
    "isGlobal": false,
    "freezeGame": false,
    "open": false,
    "publish": false,
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "minimumScore": 37786.66257359
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "minimumScore": 20.963
=======
    "minimumScore": 520158035.4189
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "minimumScore": 27242351.4
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "minimumScore": 37786.66257359
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "survey": "Encuesta 1",
    "show_horizontal_bar": false,
    "allow_vote_value_per_user": "false",
    "event_id": "605241e68b276356801236e4",
    "activity_id": "",
    "points": 1,
    "initialMessage": null,
    "time_limit": 0,
    "win_Message": null,
    "neutral_Message": null,
    "lose_Message": null,
    "allow_anonymous_answers": "false",
    "allow_gradable_survey": "false",
    "hasMinimumScore": false,
    "isGlobal": false,
    "freezeGame": false,
    "open": "false",
    "publish": "false",
    "minimumScore": 0
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/surveys</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>string  required event id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>survey</code></td>
<td>string</td>
<td>required</td>
<td>name of survey</td>
</tr>
<tr>
<td><code>show_horizontal_bar</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>allow_vote_value_per_user</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>activity_id</code></td>
<td></td>
<td>optional</td>
<td>string</td>
</tr>
<tr>
<td><code>points</code></td>
<td>number</td>
<td>optional</td>
</tr>
<tr>
<td><code>initialMessage</code></td>
<td></td>
<td>optional</td>
<td>string</td>
</tr>
<tr>
<td><code>time_limit</code></td>
<td>number</td>
<td>optional</td>
</tr>
<tr>
<td><code>allow_anonymous_answers</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>allow_gradable_survey</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>hasMinimumScore</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>isGlobal</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>freezeGame</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>open</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>publish</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>minimumScore</code></td>
<td>number</td>
<td>optional</td>
<td>Exmaple: 0</td>
</tr>
</tbody>
</table>
<!-- END_1f9326dacbb23c27cb5ebe3274269cb9 -->
<!-- START_288a60e8a896009f5dbf97d933605b4a -->
<h2><em>update</em>: update a specific survey</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/surveys/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"survey":"non","show_horizontal_bar":"iste","allow_vote_value_per_user":"aspernatur","activity_id":"ipsam","points":"ratione","initialMessage":"aut","time_limit":"qui","allow_anonymous_answers":"natus","allow_gradable_survey":"nam","hasMinimumScore":"saepe","isGlobal":"eos","freezeGame":"nulla","open":"et","publish":"nihil","minimumScore":"fuga"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"survey":"est","show_horizontal_bar":"nisi","allow_vote_value_per_user":"nemo","activity_id":"quia","points":"eum","initialMessage":"recusandae","time_limit":"voluptatem","allow_anonymous_answers":"voluptas","allow_gradable_survey":"similique","hasMinimumScore":"quos","isGlobal":"ab","freezeGame":"iusto","open":"modi","publish":"corrupti","minimumScore":"sed"}'
=======
    -d '{"survey":"ducimus","show_horizontal_bar":"non","allow_vote_value_per_user":"dolorem","activity_id":"perferendis","points":"veniam","initialMessage":"omnis","time_limit":"et","allow_anonymous_answers":"sed","allow_gradable_survey":"velit","hasMinimumScore":"minus","isGlobal":"sint","freezeGame":"qui","open":"nihil","publish":"est","minimumScore":"vero"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"survey":"consectetur","show_horizontal_bar":"vitae","allow_vote_value_per_user":"praesentium","activity_id":"in","points":"vitae","initialMessage":"suscipit","time_limit":"adipisci","allow_anonymous_answers":"pariatur","allow_gradable_survey":"dignissimos","hasMinimumScore":"consequatur","isGlobal":"fugiat","freezeGame":"eveniet","open":"ad","publish":"facere","minimumScore":"exercitationem"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"survey":"non","show_horizontal_bar":"iste","allow_vote_value_per_user":"aspernatur","activity_id":"ipsam","points":"ratione","initialMessage":"aut","time_limit":"qui","allow_anonymous_answers":"natus","allow_gradable_survey":"nam","hasMinimumScore":"saepe","isGlobal":"eos","freezeGame":"nulla","open":"et","publish":"nihil","minimumScore":"fuga"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/surveys/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "survey": "non",
    "show_horizontal_bar": "iste",
    "allow_vote_value_per_user": "aspernatur",
    "activity_id": "ipsam",
    "points": "ratione",
    "initialMessage": "aut",
    "time_limit": "qui",
    "allow_anonymous_answers": "natus",
    "allow_gradable_survey": "nam",
    "hasMinimumScore": "saepe",
    "isGlobal": "eos",
    "freezeGame": "nulla",
    "open": "et",
    "publish": "nihil",
    "minimumScore": "fuga"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "survey": "est",
    "show_horizontal_bar": "nisi",
    "allow_vote_value_per_user": "nemo",
    "activity_id": "quia",
    "points": "eum",
    "initialMessage": "recusandae",
    "time_limit": "voluptatem",
    "allow_anonymous_answers": "voluptas",
    "allow_gradable_survey": "similique",
    "hasMinimumScore": "quos",
    "isGlobal": "ab",
    "freezeGame": "iusto",
    "open": "modi",
    "publish": "corrupti",
    "minimumScore": "sed"
=======
    "survey": "ducimus",
    "show_horizontal_bar": "non",
    "allow_vote_value_per_user": "dolorem",
    "activity_id": "perferendis",
    "points": "veniam",
    "initialMessage": "omnis",
    "time_limit": "et",
    "allow_anonymous_answers": "sed",
    "allow_gradable_survey": "velit",
    "hasMinimumScore": "minus",
    "isGlobal": "sint",
    "freezeGame": "qui",
    "open": "nihil",
    "publish": "est",
    "minimumScore": "vero"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "survey": "consectetur",
    "show_horizontal_bar": "vitae",
    "allow_vote_value_per_user": "praesentium",
    "activity_id": "in",
    "points": "vitae",
    "initialMessage": "suscipit",
    "time_limit": "adipisci",
    "allow_anonymous_answers": "pariatur",
    "allow_gradable_survey": "dignissimos",
    "hasMinimumScore": "consequatur",
    "isGlobal": "fugiat",
    "freezeGame": "eveniet",
    "open": "ad",
    "publish": "facere",
    "minimumScore": "exercitationem"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "survey": "non",
    "show_horizontal_bar": "iste",
    "allow_vote_value_per_user": "aspernatur",
    "activity_id": "ipsam",
    "points": "ratione",
    "initialMessage": "aut",
    "time_limit": "qui",
    "allow_anonymous_answers": "natus",
    "allow_gradable_survey": "nam",
    "hasMinimumScore": "saepe",
    "isGlobal": "eos",
    "freezeGame": "nulla",
    "open": "et",
    "publish": "nihil",
    "minimumScore": "fuga"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/surveys/{surveys}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>string      required event id</td>
</tr>
<tr>
<td><code>survey</code></td>
<td>optional</td>
<td>string  required survey id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>survey</code></td>
<td>string</td>
<td>optional</td>
<td>name of survey</td>
</tr>
<tr>
<td><code>show_horizontal_bar</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>allow_vote_value_per_user</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>activity_id</code></td>
<td></td>
<td>optional</td>
<td>string</td>
</tr>
<tr>
<td><code>points</code></td>
<td></td>
<td>optional</td>
<td>number</td>
</tr>
<tr>
<td><code>initialMessage</code></td>
<td></td>
<td>optional</td>
<td>string</td>
</tr>
<tr>
<td><code>time_limit</code></td>
<td></td>
<td>optional</td>
<td>number</td>
</tr>
<tr>
<td><code>allow_anonymous_answers</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>allow_gradable_survey</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>hasMinimumScore</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>isGlobal</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>freezeGame</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>open</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>publish</code></td>
<td></td>
<td>optional</td>
<td>boolean</td>
</tr>
<tr>
<td><code>minimumScore</code></td>
<td></td>
<td>optional</td>
<td>number</td>
</tr>
</tbody>
</table>
<!-- END_288a60e8a896009f5dbf97d933605b4a -->
<!-- START_610f5bf40dcb396bf4887fd59387ae95 -->
<h2><em>destroy</em>: delete a specific survey</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/1/surveys/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/surveys/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/surveys/{surveys}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>optional</td>
<td>string      required event id</td>
</tr>
<tr>
<td><code>survey</code></td>
<td>optional</td>
<td>string  required survey id</td>
</tr>
</tbody>
</table>
<!-- END_610f5bf40dcb396bf4887fd59387ae95 -->
<h1>Template Properties Organization</h1>
<!-- START_86088a56e9074ccaabe74dbdf9a1f3f4 -->
<h2><em>index</em>:list all templates by organization</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/et/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/et/templateproperties"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -G "https://api.evius.co/api/organizations/voluptas/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/voluptas/templateproperties"
=======
    -G "https://api.evius.co/api/organizations/eaque/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/eaque/templateproperties"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -G "https://devapi.evius.co/api/organizations/inventore/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/inventore/templateproperties"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -G "https://devapi.evius.co/api/organizations/et/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/et/templateproperties"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organizations/{organization}/templateproperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization_id</td>
</tr>
</tbody>
</table>
<!-- END_86088a56e9074ccaabe74dbdf9a1f3f4 -->
<!-- START_2c8677d519f9cef5320ab334c917c67f -->
<h2><em>store</em>: create a new template for organization</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/hic/templateproperties" \
=======
    "https://devapi.evius.co/api/organizations/voluptatum/templateproperties" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
    "https://devapi.evius.co/api/organizations/voluptatum/templateproperties" \
=======
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/hic/templateproperties" \
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Template 1","user_properties":"necessitatibus"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/voluptatum/templateproperties"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "https://api.evius.co/api/organizations/hic/templateproperties"
=======
    "https://api.evius.co/api/organizations/et/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Template 1","user_properties":"architecto"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/et/templateproperties"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/ut/templateproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Template 1","user_properties":"facilis"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/ut/templateproperties"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/voluptatum/templateproperties"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Template 1",
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "user_properties": "necessitatibus"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "user_properties": "laboriosam"
=======
    "user_properties": "architecto"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "user_properties": "facilis"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "user_properties": "necessitatibus"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/organizations/{organization}/templateproperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization_id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>strign</td>
<td>required</td>
<td>name temlate.</td>
</tr>
<tr>
<td><code>user_properties</code></td>
<td>array,</td>
<td>optional</td>
<td>if you want to make this structure, see User Properties and User Properties Organization</td>
</tr>
</tbody>
</table>
<!-- END_2c8677d519f9cef5320ab334c917c67f -->
<!-- START_ade25c3455463e7a3f1adb4db6090581 -->
<h2><em>update</em>: update the specified template propertie.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/sunt/templateproperties/in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/sunt/templateproperties/in"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/organizations/nihil/templateproperties/nihil" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/nihil/templateproperties/nihil"
=======
    "https://api.evius.co/api/organizations/iusto/templateproperties/dolores" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/organizations/iusto/templateproperties/dolores"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/organizations/consequatur/templateproperties/eligendi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/consequatur/templateproperties/eligendi"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/organizations/sunt/templateproperties/in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/sunt/templateproperties/in"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/organizations/{organization}/templateproperties/{templatepropertie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization_id</td>
</tr>
<tr>
<td><code>templatepropertie</code></td>
<td>required</td>
<td>template id</td>
</tr>
</tbody>
</table>
<!-- END_ade25c3455463e7a3f1adb4db6090581 -->
<!-- START_053b1e05dd045fddad02fe8adb0f1ed6 -->
<h2><em>destry</em>: delete a template specific</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/organizations/1/templateproperties/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organizations/1/templateproperties/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/organizations/{organization}/templateproperties/{templatepropertie}</code></p>
<!-- END_053b1e05dd045fddad02fe8adb0f1ed6 -->
<!-- START_239f959da521a75bb133a94e90fce443 -->
<h2><em>addtemplateevent</em>: this metho allow add template to an event.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/quod/templateproperties/1/addtemplateporperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/quod/templateproperties/1/addtemplateporperties"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/events/optio/templateproperties/1/addtemplateporperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/optio/templateproperties/1/addtemplateporperties"
=======
    "https://api.evius.co/api/events/iste/templateproperties/1/addtemplateporperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/events/iste/templateproperties/1/addtemplateporperties"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/events/non/templateproperties/1/addtemplateporperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/non/templateproperties/1/addtemplateporperties"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/events/quod/templateproperties/1/addtemplateporperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/quod/templateproperties/1/addtemplateporperties"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/templateproperties/{templatepropertie}/addtemplateporperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event</code></td>
<td>required</td>
<td>event_id</td>
</tr>
</tbody>
</table>
<!-- END_239f959da521a75bb133a94e90fce443 -->
<h1>User</h1>
<p>Manage users, the users info are stored in the backend and the user auth info (password, email).
There are two data base for the users: <strong>firebase</strong> and <strong>mongodb</strong>, the users are related by the field <strong>uid</strong> this id is genereated from  firebase.</p>
<p>Firebase manage the sessions user using tokens JTW.</p>
<p>The tokens are send in the url this way <strong>?token=xxxxxxxxxxxxxxxxx</strong>  for validate the athuentication of user.</p>
<p>If you want to work in development environment or production enviroment is necesary connect to proyect correspondent.</p>
<table>
<thead>
<tr>
<th></th>
<th>Prodcution</th>
<th>Dev</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>ID project</strong></td>
<td>eviusauth</td>
<td>eviusauthdev</td>
</tr>
<tr>
<td><strong>Name project</strong></td>
<td>eviusAuth</td>
<td>eviusAuthDev</td>
</tr>
</tbody>
</table>
<!-- START_fc1e4f6a697e3c48257de845299b71d5 -->
<h2><em>index</em>: It&#039;s not posible to query all users in the platform.</h2>
<p>Doesn't make sense to query all users. Users main function is to assits to an event
thus make sense to query users going to an event.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users</code></p>
<!-- END_fc1e4f6a697e3c48257de845299b71d5 -->
<!-- START_12e37982cc5398c7100e59625ebb5514 -->
<h2><em>store</em>: create new user and send confirmation email</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"example@evius.co","names":"Evius","picture":"http:\/\/www.gravatar.com\/avatar","password":"*******"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "example@evius.co",
    "names": "Evius",
    "picture": "http:\/\/www.gravatar.com\/avatar",
    "password": "*******"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/users</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
</tr>
<tr>
<td><code>names</code></td>
<td>string</td>
<td>required</td>
<td>person name</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_12e37982cc5398c7100e59625ebb5514 -->
<!-- START_8653614346cb0e3d444d164579a0a0a2 -->
<h2><em>show</em>: view a specific registered user</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/users/603d6af041e6f468091c95d5" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/603d6af041e6f468091c95d5"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users/{user}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>id of user.</td>
</tr>
</tbody>
</table>
<!-- END_8653614346cb0e3d444d164579a0a0a2 -->
<!-- START_a8785604ee9d7e645382ed66ee45ff12 -->
<h2>loginorcreatefromtoken: create a user from auth data.</h2>
<p>If a userauth is created  in frontend using firebaseatuh javascript JDK
this method can be called to create respective user in the backend
data is extracted from the token.</p>
<p>authuser in firebaseauth and user are related by the field uid created by firebase</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/users/loginorcreatefromtoken" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/loginorcreatefromtoken"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users/loginorcreatefromtoken</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>token</code></td>
<td>required</td>
<td>auth token used to extract the user info</td>
</tr>
<tr>
<td><code>destination</code></td>
<td>optional</td>
<td>optional url to redirect after user is created</td>
</tr>
</tbody>
</table>
<!-- END_a8785604ee9d7e645382ed66ee45ff12 -->
<!-- START_48a3115be98493a3c866eb0e23347262 -->
<h2><em>update</em>: update registered user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/users/603d6af041e6f468091c95d5" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"names":"Evius Demo","password":"******","picture":"http:\/\/www.gravatar.com\/avatar"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/603d6af041e6f468091c95d5"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "names": "Evius Demo",
    "password": "******",
    "picture": "http:\/\/www.gravatar.com\/avatar"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/users/{user}</code></p>
<p><code>PATCH api/users/{user}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>id user.</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>names</code></td>
<td>string</td>
<td>optional</td>
<td>optional.</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string.</td>
<td>optional</td>
</tr>
<tr>
<td><code>picture</code></td>
<td>string</td>
<td>optional</td>
<td>optional.</td>
</tr>
</tbody>
</table>
<!-- END_48a3115be98493a3c866eb0e23347262 -->
<!-- START_d2db7a9fe3abd141d5adbc367a88e969 -->
<h2><em>delete</em>: delete a registered user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/users/603d6af041e6f555591c95d5" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/603d6af041e6f555591c95d5"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/users/{user}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>id user</td>
</tr>
</tbody>
</table>
<!-- END_d2db7a9fe3abd141d5adbc367a88e969 -->
<!-- START_897105c2d6a4eba5dea882c31f100668 -->
<h2>getCurrentUser: returns current user information using valid token send with the request.</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
returns current user information using valid token send with the request.
Token is processed  by middleware</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/users/currentUser" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/currentUser"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users/currentUser</code></p>
<!-- END_897105c2d6a4eba5dea882c31f100668 -->
<!-- START_16f3abe301f4f23d3903a26415684533 -->
<h2><em>findByEmail</em>: search for specific user by mail</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/users/findByEmail/correo@evius.co" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/findByEmail/correo@evius.co"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/users/findByEmail/{email}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>required</td>
<td>email del usuario buscado.</td>
</tr>
</tbody>
</table>
<!-- END_16f3abe301f4f23d3903a26415684533 -->
<!-- START_a34c0500a6de41f9c818a3e32dad6141 -->
<h2><em>userOrganization</em>: user lists all the users that belong to an organization, besides this you can filter all the users by <strong>any of the properties</strong> that have</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/organization/61ccd2cc81e73549a63dd5ce/users?filtered=%5B%7B%22field%22%3Anames%22%2C%22Evius%22%7D%5D&amp;orderBy=%5B%7B%22field%22%3A%22_id%22%2C%22order%22%3A%22desc%22%7D%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/organization/61ccd2cc81e73549a63dd5ce/users"
);

let params = {
    "filtered": "[{"field":names","Evius"}]",
    "orderBy": "[{"field":"_id","order":"desc"}]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/organization/{organization}/users</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>organization</code></td>
<td>required</td>
<td>organization to which the users belong.</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>filtered</code></td>
<td>optional</td>
<td>optional filter parameters</td>
</tr>
<tr>
<td><code>orderBy</code></td>
<td>optional</td>
<td>filter parameters</td>
</tr>
</tbody>
</table>
<!-- END_a34c0500a6de41f9c818a3e32dad6141 -->
<!-- START_5382494c391bf1f288b8a7f745638217 -->
<h2><em>changeStatusUser</em>: approve or reject the rol the users teacher ,and send mail of the change of status of the user to the user who created it</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/users/enim/changeStatusUser" \
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/users/ratione/changeStatusUser" \
=======
    "https://api.evius.co/api/users/sint/changeStatusUser" \
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/users/autem/changeStatusUser" \
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/users/enim/changeStatusUser" \
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"approved"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/users/enim/changeStatusUser"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/users/ratione/changeStatusUser"
=======
    "https://api.evius.co/api/users/sint/changeStatusUser"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/users/autem/changeStatusUser"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/users/enim/changeStatusUser"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "approved"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/users/{user_id}/changeStatusUser</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user_id</code></td>
<td>required</td>
<td>id of the user to be rejected or approved</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>status</code></td>
<td>string</td>
<td>required</td>
<td>the status update allows for two possible statuses <strong>approved</strong> or <strong>rejected</strong></td>
</tr>
</tbody>
</table>
<!-- END_5382494c391bf1f288b8a7f745638217 -->
<!-- START_eb2ff3ef2cdbbd1f25eccfdb8637e9e5 -->
<h2><em>signInWithEmailAndPassword</em>: login a user, you can see this <a href="https://app.diagrams.net/#G1qSNi58JI6usiyqU7n7SsmyTrJW5oITAZ">diagram</a></h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/users/signInWithEmailAndPassword" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"correo@evius.co","password":"*********"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/users/signInWithEmailAndPassword"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "correo@evius.co",
    "password": "*********"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/users/signInWithEmailAndPassword</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_eb2ff3ef2cdbbd1f25eccfdb8637e9e5 -->
<!-- START_e57bdb918239f0f65c7591c94c0ef2fc -->
<h2><em>getAccessLink</em>: get and sent link acces to email to user.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/getloginlink" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    -d '{"refreshlink":"sequi","event":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    -d '{"refreshlink":"saepe","event":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
=======
    -d '{"refreshlink":"voluptates","event":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    -d '{"refreshlink":"impedit","event":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    -d '{"refreshlink":"sequi","event":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/getloginlink"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "refreshlink": "sequi",
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "refreshlink": "saepe",
=======
    "refreshlink": "voluptates",
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "refreshlink": "impedit",
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "refreshlink": "sequi",
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
    "event": "61ccd3551c821b765a312864",
    "email": "correo@evius.co"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/getloginlink</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>refreshlink</code></td>
<td>This</td>
<td>optional</td>
<td>parameter return the login link but not send email.</td>
</tr>
<tr>
<td><code>event</code></td>
<td>string</td>
<td>optional</td>
<td>event id to redirect user, if this parameter not send, the link redirect to principal page.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
<td>user email</td>
</tr>
</tbody>
</table>
<!-- END_e57bdb918239f0f65c7591c94c0ef2fc -->
<!-- START_dae265a702afa4764e8b5bc8f0be7fbc -->
<h2><em>signInWithEmailLink</em>: this end point start the login when the user does click in the link</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/singinwithemaillink" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"event_id":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/singinwithemaillink"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "event_id": "61ccd3551c821b765a312864",
    "email": "correo@evius.co"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/singinwithemaillink</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>string</td>
<td>optional</td>
<td>event id to redirect user, if this parameter not send, the link redirect to principal page.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
<td>user email</td>
</tr>
</tbody>
</table>
<!-- END_dae265a702afa4764e8b5bc8f0be7fbc -->
<!-- START_a658293e8e100b2384bed5b8ebc735f6 -->
<h2><em>changeUserPassword</em>: send to email to user whit  link to change user password.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/changeuserpassword" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"event_id":"61ccd3551c821b765a312864","email":"correo@evius.co"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/changeuserpassword"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "event_id": "61ccd3551c821b765a312864",
    "email": "correo@evius.co"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/changeuserpassword</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>string</td>
<td>optional</td>
<td>event id to redirect user, if this parameter not send, the link redirect to principal page.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>email</td>
<td>required</td>
<td>user email</td>
</tr>
</tbody>
</table>
<!-- END_a658293e8e100b2384bed5b8ebc735f6 -->
<h1>User Properties</h1>
<!-- START_68d285999cbfafa88d4198cbf41d0b56 -->
<h2><em>store</em>: a newly created resource in UserProperties.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/events/1/userproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"celular","mandatory":true,"visibleByContacts":true,"visibleByAdmin":true,"label":"Celular","description":"N\u00famero de contacto","type":"number","justonebyattendee":true,"order_weight":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/userproperties"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "celular",
    "mandatory": true,
    "visibleByContacts": true,
    "visibleByAdmin": true,
    "label": "Celular",
    "description": "N\u00famero de contacto",
    "type": "number",
    "justonebyattendee": true,
    "order_weight": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/events/{event}/userproperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>optional</td>
<td>required.</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>strign</td>
<td>required</td>
<td>name of user's property.</td>
</tr>
<tr>
<td><code>mandatory</code></td>
<td>boolean</td>
<td>required</td>
<td>This field indicates that the field in the form cannot be null if it is set to true or false if it can be null.</td>
</tr>
<tr>
<td><code>visibleByContacts</code></td>
<td>boolean</td>
<td>required</td>
<td>visible by contacts if its value is true.</td>
</tr>
<tr>
<td><code>visibleByAdmin</code></td>
<td>boolean</td>
<td>required</td>
<td>visible by admin if its value is true.</td>
</tr>
<tr>
<td><code>label</code></td>
<td>string</td>
<td>required</td>
<td>label that will be visible in the registration form.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>required</td>
<td>description.</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>required</td>
<td>type of character the field accepts in the form,</td>
</tr>
<tr>
<td><code>justonebyattendee</code></td>
<td>boolean</td>
<td>required</td>
</tr>
<tr>
<td><code>order_weight</code></td>
<td>number</td>
<td>required</td>
<td>order of fields in the form.</td>
</tr>
</tbody>
</table>
<!-- END_68d285999cbfafa88d4198cbf41d0b56 -->
<!-- START_d47dfbb08915a820fc67249882766595 -->
<h2><em>destroy</em>: remove the specified resource from UserProperties.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://devapi.evius.co/api/events/1/userproperties/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/userproperties/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/events/{event}/userproperties/{userpropertie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id UserProperties</td>
</tr>
</tbody>
</table>
<!-- END_d47dfbb08915a820fc67249882766595 -->
<!-- START_2463d7da5944ffc58dc186ede13e61d9 -->
<h2><em>update</em>: update the specified resource in UserProperties.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/userproperties/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"celular","mandatory":true,"visibleByContacts":true,"visibleByAdmin":true,"label":"Celular","description":"N\u00famero de contacto","type":"number","justonebyattendee":true,"order_weight":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/userproperties/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "celular",
    "mandatory": true,
    "visibleByContacts": true,
    "visibleByAdmin": true,
    "label": "Celular",
    "description": "N\u00famero de contacto",
    "type": "number",
    "justonebyattendee": true,
    "order_weight": 1
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/userproperties/{userpropertie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id UserProperties</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>strign</td>
<td>optional</td>
<td>name of user's property.</td>
</tr>
<tr>
<td><code>mandatory</code></td>
<td>boolean</td>
<td>optional</td>
<td>This field indicates that the field in the form cannot be null if it is set to true or false if it can be null.</td>
</tr>
<tr>
<td><code>visibleByContacts</code></td>
<td>boolean</td>
<td>optional</td>
<td>visible by contacts if its value is true.</td>
</tr>
<tr>
<td><code>visibleByAdmin</code></td>
<td>boolean</td>
<td>optional</td>
<td>visible by admin if its value is true.</td>
</tr>
<tr>
<td><code>label</code></td>
<td>string</td>
<td>optional</td>
<td>label that will be visible in the registration form.</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>optional</td>
<td>description.</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>optional</td>
<td>type of character the field accepts in the form,</td>
</tr>
<tr>
<td><code>justonebyattendee</code></td>
<td>boolean</td>
<td>optional</td>
</tr>
<tr>
<td><code>order_weight</code></td>
<td>number</td>
<td>optional</td>
<td>order of fields in the form.</td>
</tr>
</tbody>
</table>
<!-- END_2463d7da5944ffc58dc186ede13e61d9 -->
<!-- START_d7bee26085b2859ff52e30a635f692d6 -->
<h2><em>index</em>: list of user properties of a specific event.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/userproperties" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/userproperties"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/userproperties</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>optional</td>
<td>required.</td>
</tr>
</tbody>
</table>
<!-- END_d7bee26085b2859ff52e30a635f692d6 -->
<!-- START_8f812971c8ea60dcbbf597e9ce9066dc -->
<h2><em>show</em>: view the specific user propertie.</h2>
<table>
<thead>
<tr>
<th>Url Params</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/userproperties/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/userproperties/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/userproperties/{userpropertie}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>event_id</code></td>
<td>required</td>
</tr>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>id UserProperties</td>
</tr>
</tbody>
</table>
<!-- END_8f812971c8ea60dcbbf597e9ce9066dc -->
<!-- START_4a8c578c70536fb0ccabd2246574206d -->
<h2><em>RegisterListFieldOptionTaken</em>: bloquea un elemento que un asistente ya escogio de un campo tipo lista de elementos con inventario cuando se registra a un evento.</h2>
<p>Toca hacerlo asi porque con la concurrencia se nos estaban cruzando dos peticiones simultaneas y solo quedaba con los valores de la última</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://devapi.evius.co/api/events/1/userproperties/1/RegisterListFieldOptionTaken" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/userproperties/1/RegisterListFieldOptionTaken"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/events/{event}/userproperties/{userpropertie}/RegisterListFieldOptionTaken</code></p>
<!-- END_4a8c578c70536fb0ccabd2246574206d -->
<h1>general</h1>
<!-- START_d9b62494c6aeb80a34684d6c82c603e4 -->
<h2>api/eventusers/{event}/makeTicketIdaProperty/{ticket_id}</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/eventusers/1/makeTicketIdaProperty/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/eventusers/1/makeTicketIdaProperty/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">0</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/eventusers/{event}/makeTicketIdaProperty/{ticket_id}</code></p>
<!-- END_d9b62494c6aeb80a34684d6c82c603e4 -->
<!-- START_710a166934ebcbb3ee90ea0211f87e7b -->
<h2>api/events/{event}/users/{user_id}/asignticketstouser</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/events/1/users/1/asignticketstouser" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/events/1/users/1/asignticketstouser"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/events/{event}/users/{user_id}/asignticketstouser</code></p>
<!-- END_710a166934ebcbb3ee90ea0211f87e7b -->
<!-- START_739442a2495f200cd4de63da705ac98e -->
<h2>Create model_has_role</h2>
<p>role_id
model_id (user_id)
event_id</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/me/contributors/events" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/me/contributors/events"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/me/contributors/events</code></p>
<!-- END_739442a2495f200cd4de63da705ac98e -->
<!-- START_50361dad34e65e623afe3a82b2191784 -->
<h2>Display a listing of the contributors of an event resource.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/contributors/events/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/contributors/events/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/contributors/events/{event}</code></p>
<!-- END_50361dad34e65e623afe3a82b2191784 -->
<!-- START_e2472f0dc8400d5818ee0a4fb92cf7ce -->
<h2><em>validateFreeorder</em>: validates the order in case the purchase value is 0</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/orders/eligendi/validateFreeorder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/eligendi/validateFreeorder"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/orders/occaecati/validateFreeorder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/orders/occaecati/validateFreeorder"
=======
    "https://api.evius.co/api/orders/ex/validateFreeorder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/orders/ex/validateFreeorder"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/orders/natus/validateFreeorder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/natus/validateFreeorder"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/orders/eligendi/validateFreeorder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/eligendi/validateFreeorder"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders/{order_id}/validateFreeorder</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>order_id</code></td>
<td>required</td>
</tr>
</tbody>
</table>
<!-- END_e2472f0dc8400d5818ee0a4fb92cf7ce -->
<!-- START_17a9af1431c78e54a7d156397fba2c28 -->
<h2><em>validatePointOrder</em> :validate orders of type points</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
<<<<<<< HEAD
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/orders/doloribus/validatePointOrder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/doloribus/validatePointOrder"
=======
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
<<<<<<< HEAD
<<<<<<< HEAD:resources/views/apidoc/index.blade.php
    "https://api.evius.co/api/orders/voluptatem/validatePointOrder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/orders/voluptatem/validatePointOrder"
=======
    "https://api.evius.co/api/orders/id/validatePointOrder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://api.evius.co/api/orders/id/validatePointOrder"
>>>>>>> rolesEtapa2:public/docs/index.html
=======
    "https://devapi.evius.co/api/orders/accusantium/validatePointOrder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/accusantium/validatePointOrder"
>>>>>>> rolesEtapa2
<<<<<<< HEAD
=======
    "https://devapi.evius.co/api/orders/doloribus/validatePointOrder" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/doloribus/validatePointOrder"
>>>>>>> d1e32bdae7e1fe14929a2589acd3233719f1be7a
=======
>>>>>>> 575678c2c1f0c166f629bc0b7da86cde45ab8712
>>>>>>> 8b4c17be41eb02be5c7d353a9d04b9fd8477ced2
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders/{order_id}/validatePointOrder</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>order_id</code></td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_17a9af1431c78e54a7d156397fba2c28 -->
<!-- START_3e560035745c03dfe7c6d4b9bf634a60 -->
<h2>api/orders/{order_id}/validatePointOrderTest</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://devapi.evius.co/api/orders/1/validatePointOrderTest" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/orders/1/validatePointOrderTest"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/orders/{order_id}/validatePointOrderTest</code></p>
<!-- END_3e560035745c03dfe7c6d4b9bf634a60 -->
<!-- START_689c210ebe174946aebc5f5e948631fe -->
<h2>Show the form for creating a new resource.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/api/test/auth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/api/test/auth"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/test/auth</code></p>
<!-- END_689c210ebe174946aebc5f5e948631fe -->
<!-- START_66df3678904adde969490f2278b8f47f -->
<h2>Authenticate the request for channel access.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://devapi.evius.co/broadcasting/auth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://devapi.evius.co/broadcasting/auth"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>GET broadcasting/auth</code></p>
<p><code>POST broadcasting/auth</code></p>
<!-- END_66df3678904adde969490f2278b8f47f -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                              </div>
                </div>
    </div>
  </body>
</html>