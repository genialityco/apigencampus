<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

/**
* @group Google Analytics
*
* APIs for Google Analitycs Stats
*
*/
class GoogleAnalyticsController extends Controller
{

  /**
   * Query for Google Analytics Stats
   * 
   * Recieve a body json to give all the stats related about pageviews, users and sessions
   * filtered by a pagePath consulted.
   * 
   * @bodyParam startDate string required Example: 2021-06-30
   * @bodyParam endDate string required Example: 2021-07-6
   * @bodyParam filtersExpression string Example: ga:pagePath=@/landing/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token
   * @bodyParam metrics string Example: ga:pageviews, ga:users, ga:sessions
   * @bodyParam dimensions string Example: ga:pagePath
   * @bodyParam fieldName string Example: ga:pagePath
   * @bodyParam sortOrder string Example: DESCENDING
   * 
   * @response {
   *    
   *  "containsSampledData": false,
   *  "dataLastRefreshed": null,
   *  "id": "https://www.googleapis.com/analytics/v3/data/ga?ids=ga:114494173&dimensions=ga:pagePath&metrics=ga:pageviews,ga:users,ga:sessions&sort=-ga:pagePath&filters=ga:pagePath%3D@/landing/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token&start-date=2021-06-30&end-date=2021-07-30",
   *  "itemsPerPage": 1000,
   *  "kind": "analytics#gaData",
   *  "nextLink": null,
   *  "previousLink": null,
   *  "rows": [
   *      [
   *          "/landing/5ea23acbd74d5c4b360ddde2/partners",
   *          "1",
   *          "1",
   *          "0"
   *      ],
   *      [
   *          "/landing/5ea23acbd74d5c4b360ddde2/evento/activity/602d88f5fc22ba3f453a0dc3",
   *          "2",
   *          "1",
   *          "0"
   *      ]
   *  ],
   *  "sampleSize": null,
   *  "sampleSpace": null,
   *  "selfLink": "https://www.googleapis.com/analytics/v3/data/ga?ids=ga:114494173&dimensions=ga:pagePath&metrics=ga:pageviews,ga:users,ga:sessions&sort=-ga:pagePath&filters=ga:pagePath%3D@/landing/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token&start-date=2021-06-30&end-date=2021-07-30",
   *  "totalResults": 9,
   *  "totalsForAllResults": {
   *      "ga:pageviews": "620",
   *      "ga:users": "23",
   *      "ga:sessions": "38"
   *  },
   *  "query": {
   *      "dimensions": "ga:pagePath",
   *      "endDate": "2021-07-30",
   *      "filters": "ga:pagePath=@/landing/5ea23acbd74d5c4b360ddde2;ga:pagePath!@token",
   *      "ids": "ga:114494173",
   *      "maxResults": 1000,
   *      "metrics": [
   *          "ga:pageviews",
   *          "ga:users",
   *          "ga:sessions"
   *      ],
   *      "samplingLevel": null,
   *      "segment": null,
   *      "sort": [
   *          "-ga:pagePath"
   *      ],
   *      "startDate": "2021-06-30",
   *      "startIndex": 1
   *  },
   *  "profileInfo": {
   *      "accountId": "72179148",
   *      "internalWebPropertyId": "109811365",
   *      "profileId": "114494173",
   *      "profileName": "All Web Site Data",
   *      "tableId": "ga:114494173",
   *      "webPropertyId": "UA-72179148-1"
   *  },
   *  "columnHeaders": [
   *      {
   *          "columnType": "DIMENSION",
   *          "dataType": "STRING",
   *          "name": "ga:pagePath"
   *      },
   *      {
   *          "columnType": "METRIC",
   *          "dataType": "INTEGER",
   *          "name": "ga:pageviews"
   *      },
   *      {
   *          "columnType": "METRIC",
   *          "dataType": "INTEGER",
   *          "name": "ga:users"
   *      },
   *      {
   *          "columnType": "METRIC",
   *          "dataType": "INTEGER",
   *          "name": "ga:sessions"
   *      }
   *   ]
   *  
   * }
  */
    public function __invoke(Request $req){  

        $json = $req->json()->all();      
        
        //retrieve visitors and pageview data for the current day and the last seven days
        // $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        //retrieve visitors and pageviews since the 6 months ago
        // $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::months(6));
        
        $startYear = explode('-', $json['startDate'])[0];                            
        $startMonth = explode('-', $json['startDate'])[1];
        $startDay = explode('-', $json['startDate'])[2];

        $startDate = Carbon::create($startYear, $startMonth, $startDay);
        
        $endYear = explode('-', $json['endDate'])[0];                             
        $endMonth = explode('-', $json['endDate'])[1];  
        $endDay = explode('-', $json['startDate'])[2];                            

        $endDate = Carbon::create($endYear, $endMonth, $endDay);  
                      
        $period = Period::create($startDate, $endDate);

        //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
        $analyticsData = Analytics::performQuery(
            $period,          
            'ga:sessions',                   
            [
              'metrics' => $json['metrics'],              
              'filters' => $json['filtersExpression'],
              'dimensions' => $json['dimensions'],              
              'sort' => $json['sortOrder'] === 'DESCENDING' ? 
              '-'.$json['fieldName'] : $json['fieldName'],
            ]                    
      );
    
      return json_encode($analyticsData);          
    }
  
}