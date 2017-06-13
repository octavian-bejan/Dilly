<?php
    class Controller
    {
    	public function model($model)
    	{
            try
            {
    		  require_once('../app/models/' . $model . '.php');
    		  return new $model();
            }catch(Exception $e)
            {
                throw $e;
            }
    	}

    	public function view($view, $data = array())
    	{
    		require_once '../app/views/' . $view . '.php';
    	}
    }
?>