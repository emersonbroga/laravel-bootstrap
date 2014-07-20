<?php

if ( ! function_exists('slug')) {
    function slug($title, $separator = '-')
    {
        return Illuminate\Support\Str::slug($title, $separator);
    }
}


if(! function_exists('static_url'))
{
    function static_url( $path = null, $parameters = array(), $secure = null )
    {   
        $path = ($path) ? '/pages/' . $path : $path;
        return url($path, $parameters, $secure);
    }
}


if(! function_exists('btn_delete_confirm'))
{
    function btn_delete_confirm( $route, $id )
    {   
        $html = HTML::link( URL::route($route, $id).'?confirm=delete',  trans('project.btn.delete'), ['class'=>'btn btn-danger btn-xs']);
        return $html;
    }
}

if(! function_exists('btn_delete'))
{
    function btn_delete( $route, $id )
    {   
        $html = Form::open(array('route' => array($route, $id), 'method' => 'delete'));
        $html.= Form::button(trans('project.btn.delete'), ['class'=>'btn btn-danger', 'type'=> 'submit'] );
        $html.= Form::close();
        return $html;
    }
}

if(! function_exists('btn_show'))
{
    function btn_show( $route, $id )
    {   
        $html = HTML::link( URL::route($route, $id),  trans('project.btn.show'), ['class'=>'btn btn-success btn-xs']);
        return $html;
    }
}

if(! function_exists('btn_edit'))
{
    function btn_edit( $route, $id )
    {   
        $html = HTML::link( URL::route($route, $id), trans('project.btn.edit'), ['class'=>'btn btn-info btn-xs']);
        return $html;
    }
}


if(! function_exists('btn_add'))
{
    function btn_add( $route )
    {    
        echo trans('project.btn.add');
        $html = HTML::link( URL::route($route), trans('project.btn.add'), ['class'=>'btn btn-primary btn-xs']);
        return $html;
    }
}


if(! function_exists('btn_back'))
{
    function btn_back( $route = null ) 
    {   
        $current = URL::to(Route::getCurrentRoute()->getPath());
        $route = ($route) ? $route : URL::previous();

        $html = '';
        if($current == $route){
            
            $controllerName = Route::currentRouteAction();
            $controllerName = substr($controllerName, 0, strpos($controllerName, '@'));
            $route = Url::action($controllerName.'@index');
            
            $html = HTML::link( $route, '&lsaquo; List', ['class'=>'btn btn-default btn-xs']);

        }else{
            $html = HTML::link( $route, '&lsaquo; Back', ['class'=>'btn btn-default btn-xs']);
        }

        
        return $html;
    }
}

if(! function_exists('btn_list'))
{
    function btn_list( $route )
    {   
        $html = HTML::link( URL::route($route),  trans('project.btn.list'), ['class'=>'btn btn-primary btn-xs']);
        return $html;
    }
}


if(! function_exists('btn_save'))
{
    function btn_save()
    {   
        $html = Form::button('Save', ['class'=>'btn btn-success btn-xs', 'type'=> 'submit'] );
        return $html;
    }
}