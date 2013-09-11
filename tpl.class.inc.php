<?php
########################################################################
# File Name : tpl.class.inc.php                                        #
# Author(s) :                                                          #
#   Phil Allen - phil@hilands.com                                      #
# Last Edited By :                                                     #
#   2009120500 added reset phil@hilands.com                            #
# Version : 2011062800                                                 #
#                                                                      #
# Copyright :                                                          #
#   Database Include                                                   #
#   Copyright (C) 2005 Philip J Allen                                  #
#                                                                      #
#   This file is free software; you can redistribute it and/or modify  #
#   it under the terms of the GNU General Public License as published  #
#   by the Free Software Foundation; either version 2 of the License,  #
#   or (at your option) any later version.                             #
#                                                                      #
#   This File is distributed in the hope that it will be useful,       #
#   but WITHOUT ANY WARRANTY; without even the implied warranty of     #
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the      #
#   GNU General Public License for more details.                       #
#                                                                      #
#   You should have received a copy of the GNU General Public License  #
#   along with This File; if not, write to the Free Software           #
#   Foundation, Inc., 51 Franklin St, Fifth Floor,                     #
#   Boston, MA  02110-1301  USA                                        #
#                                                                      #
# External Files:                                                      #
#   List of External Files all require/includes                        #
#                                                                      #
# General Information (algorithm) :                                    #
#   Tested to work with PHP 5                                          #
#                                                                      #
# Functions :                                                          #
#   see classes                                                        #
#                                                                      #
# Classes :                                                            #
#   tpl                                                                #
#                                                                      #
# CSS :                                                                #
#   db_error - used in span for custom database errors                 #
#   db_sql_error_message - used in span for SQL default error          #
#       messages and error numbers                                     #
#                                                                      #
# JavaScript :                                                         #
#                                                                      #
# Variable Lexicon :                                                   #
#   String             - $strStringName                                #
#   Array              - $arrArrayName                                 #
#   Resource           - $resResourceName                              #
#   Reference Variable - $refReferenceVariableName  (aka object)       #
#   Integer            - $intIntegerName                               #
#   Boolean            - $boolBooleanName                              #
#   Function           - function_name (all lowercase _ as space)      #
#   Class              - class_name (all lowercase _ as space)         #
#                                                                      #
# Commenting Style :                                                   #
#   # (in boxes) denotes commenting for large blocks of code, function #
#       and classes                                                    #
#   # (single at beginning of line) denotes debugging infromation      #
#       like printing out array data to see if data has properly been  #
#       entered                                                        #
#   # (single indented) denotes commented code that may later serve    #
#       some type of purpose                                           #
#   // used for simple notes inside of code for easy follow capability #
#   /* */ is only used to comment out mass lines of code, if we follow #
#       the above way of code we will be able to comment out entire    #
#       files for major debugging                                      #
#                                                                      #
########################################################################
########################################################################
# Class tpl                                                            #
########################################################################
class tpl
{
	// template and parsed templates!
	var $strFile;
	var $strTemplate;
	var $strFileContent;
	// booleans for interaction stuff
	var $boolVerbose;
	var $boolDie;
	var $boolFile;
	// error
	var $strError = "";
	// storage arrays
	var $arrILoops = array();
	var $arrLoops = array();
	var $arrContent = array();
	// storage strings
	var $strLoops;
	var $strILoops;
#	var $arrStorA = array();
#	var $arrStorB = array();
#	var $arrStorC = array();
#	var $arrStorD = array();
	
	####################################################################
	# Constructor                                                      #
	####################################################################
	#public function __construct($boolVerbose = true, $boolDie = true)
	#{
		// this should have some type of error checking.
	#}
	function reset_variables()
	{
		$this->strFile = "";
		$this->strTemplate = "";
		$this->strFileContent = "";
		$this->boolVerbose = "";
		$this->boolDie = "";
		$this->boolFile = "";
		$this->strError = "";
		$this->arrILoops = array();
		$this->arrLoops = array();
		$this->arrContent = array();
		$this->strLoops = "";
		$this->strILoops = "";
	}
	####################################################################
	# new starter                                                      #
	####################################################################
	// this will allow us to check for errors.
	function set_file($strFile, $arrContent, $boolFile = true)
	{
		$this->boolFile = $boolFile;
		// sets $this->strFileContent
		$this->open_file($strFile);
		$this->arrContent = $arrContent;
	}
	
	####################################################################
	# error_check                                                      #
	####################################################################
	function error_check()
	#function parse_str($strData, $arrContent, $strStorage = 'strFileContent', $boolAppend = false)
	{
		foreach ($this->arrContent as $strKey => $strValue)
		{
			#echo $strKey."<br />\n";
/*

			if ($strKey == 'addtoany')
			{
				#echo $this->strTemplate."<br />\n";
				#echo 'if (!preg_match("[".'.$strKey.'."]", '.$this->strTemplate.'))';
echo "<br /><br />";
if (preg_match("[".$strKey."]", "something [".$strKey."] something"))
	echo "Match";
else
	echo "No Match";
echo "<br /><br />";

echo $this->strTemplate;
			}
*/
			#if (!preg_match("[".$strKey."]", $this->strFileContent)) //oops passed wrong string
// I think the brackets [] may be giving some type of error..
			//http://stackoverflow.com/questions/1519318/preg-match-all-200932
			$strMatch = "/\[".$strKey."\]/"; // pregmatch bug with [ brackets ]
			#$strMatch = "[".$strKey."]";
			#echo 'strmatch : '.$strMatch.'<br />';
#if ($strKey == 'news')
#{
	#echo 'key is news';
	#echo $this->strTemplate; #exit;
#}

			#if (!preg_match("[".$strKey."]", $this->strTemplate))
			if (!preg_match($strMatch, $this->strTemplate))
			{

#if ($strKey == 'news')
#{
	#echo "are were here".$strMatch;
#}
				// should not have found a match.
				if ($this->boolFile)
					$this->strError .= 'Template Warning "['.$strKey.']" does not exist in '.$this->strFile."<br />\n";
				else
					$this->strError .= 'Template Warning "['.$strKey.']" does not exist in string variable'."<br />\n";
			}
			else
			{
				// testing
				#echo 'we are here<br />';
			}
		}
		#return true;
	}
	// run these two then do parse_str
	####################################################################
	# go                                                               #
	#     This should run all "helper" functions                       #
	####################################################################
	function go($strFile, $arrContent, $boolFile = true)
	{
		$this->set_file($strFile, $arrContent, $boolFile);
		$this->error_check();
		$this->parse_str($this->strTemplate, $this->arrContent);
	}
	####################################################################
	# go_old                                                           #
	####################################################################
	function go_old($strFile, $arrContent, $boolFile = true, $arrLoopContent=array(), $arrILoopContent=array())
	#function go($strFile, $arrContent, $arrLoopContent=array(), $arrILoopContent=array())
	#function go($strFile, $arrContent, $arrLoop, $arrILoop)
	{
		// added bool file to open_file to have the ability
		// to use strFile as a content string instead of a file.
		$this->boolFile = $boolFile;
		$this->open_file($strFile);
		$this->parse_chunks('<!--[iloop]-->', 'iloop', 'arrILoops');
		$this->parse_chunks('<!--[loop]-->', 'loop', 'arrLoops');
		$this->parse_str($this->strFileContent, $arrContent);

		// put loop arrays in the proper places and fill strFileContent accordingly
		foreach ($arrLoopContent as $intKey => $arrValue)
		{
#print_r($arrValue);
			foreach($arrValue as $key => $value)
			{
#print_r($value);
				$this->parse_str($this->arrLoops[$intKey]['c'], $value, 'strLoops', true);
			}
			$arrLoopParse = array(
				'loop'.$intKey => $this->strLoops
			);
			$this->parse_str($this->strFileContent, $arrLoopParse);
			// reset strLoops for each time we go through since we just pushed the data into the main content.
			$this->strLoops = null;
		}
		#echo $this->strLoops;

		// process internal loop fill and as below.
		foreach ($arrILoopContent as $intKey => $arrValue)
		{
#print_r($arrValue);
			foreach($arrValue as $key => $value)
			{
#print_r($value);
				$this->parse_str($this->arrILoops[$intKey]['c'], $value, 'strILoops', true);
			}
			$arrILoopParse = array(
				'iloop'.$intKey => $this->strILoops
			);
			$this->parse_str($this->strFileContent, $arrILoopParse);
			// reset strLoops for each time we go through since we just pushed the data into the main content.
			$this->strILoops = null;
		}
	}
	####################################################################
	#                                                                  #
	####################################################################
	// reset function
	function set_reset()
	{
		$this->strTemplate = "";
		$this->strFileContent = "";
	}
	####################################################################
	# Gets                                                             #
	####################################################################
	function get_tpl()
	{
		return $this->strTemplate;
	}
	function get_content()
	{
		return $this->strFileContent;
	}
	function get_arrLoops()
	{
		return $this->arrLoops;
	}
	function get_arrILoops()
	{
		return $this->arrILoops;
	}
	####################################################################
	# open_file                                                        #
	#     Opens a file and stores it into fileContent                  #
	####################################################################
	function open_file($strFile)
	{
		if ($this->boolFile)
		{
			$this->strFile = $strFile;
			if (file_exists($strFile) && filesize($strFile) != 0)
			{
				if(!$fileRead = fopen($strFile, "r"))
				{
					echo 'cannot read file '.$strFile.'<br />';
					exit;
				}
				else
				{
					$this->strTemplate = fread($fileRead, filesize($strFile));
				}
			}
			else
			{
				echo 'File Does Not Exist, or File is empty : '.$strFile;
				exit;
			}
		}
		else
		{
			$this->strTemplate = $strFile;
		}
	}
	####################################################################
	# parse_chunks                                                     #
	#     Chunks are delimated by <!--[something]-->                   #
	#     replace is string to replace we will add the []'s            #
	####################################################################
	function parse_chunks($strNeedle, $strReplace, $strStorage)
	{
		// if no template has been read.
		if ($this->strTemplate == null)
		{
			$this->strError = 'Must read a "template" before processing';
			return false;
		}
		$arrReturn = array();
			//find loop 1
			$intLocate = 0;
			$intCounter = 0;
			// needle length
			$intNeedleL = strlen($strNeedle);
			// if content is null set it to template
			if ($this->strFileContent == null)
			{
				$this->strFileContent = $this->strTemplate;
			}
			// loop find needle supress error (@)
			// we replace the needle with strReplace so loop is not infinit.
# Debug
#	echo $strNeedle;
			while(@strpos($this->strFileContent, $strNeedle, $intLocate))
			{
				// add intNeedleL
				$intPosS = strpos($this->strFileContent, $strNeedle, $intLocate) + $intNeedleL;
				$intPosE = strpos($this->strFileContent, $strNeedle, $intPosS);
				$intLocate = $intPosE + $intNeedleL;
				//int L length of chunk to pull. if its negative. strpos looped.
				$intL = $intPosE - $intPosS;
				if ($intL < 0)
				{
					$this->strError = 'Uneven amount of parse chunk tags';
					return false;
					#echo 'uneven amount of parse chunk tags terminating';
					#exit;
				}
				// counter = 0 first time through loop.
				// replace chunk content with replace variable
				if ($intCounter == 0)
				{
					$strTempFile = substr($this->strFileContent,0,($intPosS - $intNeedleL)).'['.$strReplace.$intCounter.']';
				}
				else
				{
					$strTempFile .= substr($this->strFileContent,($arrReturn[$intCounter - 1]['e'] + $intNeedleL),(($intPosS - $intNeedleL) - ($arrReturn[$intCounter - 1]['e']+$intNeedleL))).'['.$strReplace.$intCounter.']';
				}
#debug
#	echo $strTempFile;
				// store the locations we ripped somewhere.
				$arrReturn[$intCounter] = array(
					's' => $intPosS,
					'e' => $intPosE,
					'c' => substr($this->strFileContent, $intPosS, $intL)
					);
				$intCounter++;
			}
# Debug
#	echo $intCounter;
			if ($intCounter != 0)
			{
				$strTempFile .= substr($this->strFileContent, ($arrReturn[$intCounter - 1]['e']+$intNeedleL));
			}
			else
			{
				$strTempFile = $this->strFileContent;
			}
			$this->strFileContent = $strTempFile;
			$this->$strStorage = $arrReturn;
		return true;
	}
	####################################################################
	# parse_str                                                        #
	####################################################################
	function parse_str($strData, $arrContent, $strStorage = 'strFileContent', $boolAppend = false)
	{
		$boolError = false;
		foreach ($arrContent as $strKey => $strValue)
		{
			// the error message needs to be processed last. 
			// so a simple if not error run as normal. Otherwise set boolean
			// to flag run later.
			if ($strKey != "error")
			{
#echo $strKey.'<br />';
#echo "\n\n\n<!---------- ".$strKey."-------->".$strData."<!---------- ".$strKey."-------->\n\n\n";
				if (preg_match("[".$strKey."]", $strData))
				{
					$strData = str_replace("[".$strKey."]", $arrContent[$strKey], $strData);
# debug
#	echo 'found match for ['.$strKey.']';
				}
			}
			else
			{
				$boolError = true;
			}
		}
		// end of for each process error
		if ($boolError)
		{
			if (preg_match("[error]", $strData))
			{
				$strData = str_replace("[error]", $arrContent['error'], $strData);
			}
		}
		//store strData in $this->strFileContent
		if ($boolAppend)
			$this->$strStorage .= $strData;
		else
			$this->$strStorage = $strData;
		return true;
	}
# END Class                                                            #
}
?>