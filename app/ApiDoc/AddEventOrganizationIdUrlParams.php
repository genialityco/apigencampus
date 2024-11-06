<?php

namespace App\ApiDoc;
use Illuminate\Routing\Route;
use Mpociot\ApiDoc\Extracting\Strategies\Strategy;

class AddEventOrganizationIdUrlParams extends Strategy
{
   public function __invoke(Route $route, \ReflectionClass $controller, \ReflectionMethod $method, array $routeRules, array $context = [])
   {
       return [
           'event' => [
               'type' => 'string',
               'description' => 'The ID of the event', 
               'required' => true, 
               'value' => config('apidoc.event'),
           ],
           'organization' => [
                'type' => 'string',
                'description' => 'The ID of the organizationss', 
                'required' => true, 
                'value' => config('apidoc.organization'),
            ]
       ];
   }
}
