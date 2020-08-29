<?php 

if (! function_exists('getBreadcrumb')) 
{
    function getBreadcrumb($key) 
    {
        if(is_numeric($key))
        {
            return $key;
            
        }else
        {
            $breadcrumbs = config('app.breadcrumbs');

            return $breadcrumbs[$key];
        }

    }
}