<?php
// Here you can write any function which you want to load during bootstrap mean at start

if ( ! function_exists('config_item'))
{
	/**
	 * Returns the specified config item
	 *
	 * @param	string
	 * @return	mixed
	 */
	function config_item($item)
	{
		static $_config;

		if (empty($_config))
		{
			// references cannot be directly assigned to static variables, so we use an array
			$_config[0] =config("App.base_url");
		}

		return isset($_config[0][$item]) ? $_config[0][$item] : NULL;
	}
}


	
?>