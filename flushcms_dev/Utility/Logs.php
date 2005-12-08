<?
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005 The FlushPHP Group                                |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: Wbarbaresco - Out/2003                        
   +----------------------------------------------------------------------+
 */

/* $Id: Logs.php,v 1.1 2005/12/08 08:52:35 arzen Exp $ */

/**
 * Controll of log files
 * @package	Utility
 */

class Logs
{
	# Name of file 
	var $file = "";

	# Message error
	var $error = "";

	# If opened
	var $opened = false;

	# If loaded
	var $loaded = false;

	# If wrote
	var $wrote = false;

	# Array of logs
	var $data = array ();

	# Delimiter
	var $delimiter = "<wxy>";

	# Number of registers in the log
	var $length = 10;

	// Load registers
	function load()
	{
		if (!$this->opened)
		{
			return false;
		}
		$conteudo = @ file_get_contents($this->file);

		$this->data = explode($this->delimiter, $conteudo);

		$nreg = count($this->data);
		$keys = array_keys($this->data);
		for ($x = 0; $x < $nreg; $x ++)
		{
			if (trim($this->data[$keys[$x]]) == "")
			{
				unset ($this->data[$keys[$x]]);
				continue;
			}
			$this->data[$keys[$x]] = trim($this->data[$keys[$x]]);
		}
		$this->loaded = true;
		return true;
	}

	// Show data
	function details()
	{
		echo "<pre>";
		$nreg = count($this->data);
		$keys = array_keys($this->data);
		for ($x = 0; $x < $nreg; $x ++)
		{
			echo "$x : ".$this->data[$keys[$x]]."\n";
		}
		echo "</pre>";
	}

	// Write data in the file
	function write()
	{
		if (!$this->loaded)
		{
			return false;
		}
		$str = "";
		$nreg = count($this->data);
		$keys = array_keys($this->data);
		for ($x = 0; $x < $nreg; $x ++)
		{
			if ($this->data[$keys[$x]] != "")
			{
				$str .= $this->data[$keys[$x]]."\n";
			}
		}
		$f = @ fopen($this->file, "w");
		if (!$f)
		{
			$this->error = "Denied permission";
			$this->wrote = false;
			return false;
		}
		$this->wrote = true;
		@ fwrite($f, $str);
		@ fclose($f);
	}

	// Insert new register
	function insert($str = "")
	{
		$this->load();
		if (!$this->loaded)
		{
			return false;
		}
		array_push($this->data, $str);
		$this->write();
	}

	// Delimiter of data
	function delimiter_data()
	{
		if ($this->length > 0)
		{
			$nreg = count($this->data);
			while ($nreg > $this->length)
			{
				array_shift($this->data);
				$nreg --;
			}
		}
	}

	// Constructor
	function Logs($file)
	{
		if (!file_exists($file))
		{
			$fp = @ fopen($file, "w");
			fclose($fp);
			/*			$this->error 	= "File not Found. File: '$file'."; 
						$this->loaded = false;
						$this->opened 	= false;
						return false;
			*/
		}
		$this->file = $file;
		$this->opened = true;
	}
}
?>