<?php
define('FPDF_FONTPATH', 'font/');
require_once ('fpdf.php');

$Big5_widths = array (
	' ' => 250,
	'!' => 250,
	'"' => 408,
	'#' => 668,
	'$' => 490,
	'%' => 875,
	'&' => 698,
	'\'' => 250,
	'(' => 240,
	')' => 240,
	'*' => 417,
	'+' => 667,
	',' => 250,
	'-' => 313,
	'.' => 250,
	'/' => 520,
	'0' => 500,
	'1' => 500,
	'2' => 500,
	'3' => 500,
	'4' => 500,
	'5' => 500,
	'6' => 500,
	'7' => 500,
	'8' => 500,
	'9' => 500,
	':' => 250,
	';' => 250,
	'<' => 667,
	'=' => 667,
	'>' => 667,
	'?' => 396,
	'@' => 921,
	'A' => 677,
	'B' => 615,
	'C' => 719,
	'D' => 760,
	'E' => 625,
	'F' => 552,
	'G' => 771,
	'H' => 802,
	'I' => 354,
	'J' => 354,
	'K' => 781,
	'L' => 604,
	'M' => 927,
	'N' => 750,
	'O' => 823,
	'P' => 563,
	'Q' => 823,
	'R' => 729,
	'S' => 542,
	'T' => 698,
	'U' => 771,
	'V' => 729,
	'W' => 948,
	'X' => 771,
	'Y' => 677,
	'Z' => 635,
	'[' => 344,
	'\\' => 520,
	']' => 344,
	'^' => 469,
	'_' => 500,
	'`' => 250,
	'a' => 469,
	'b' => 521,
	'c' => 427,
	'd' => 521,
	'e' => 438,
	'f' => 271,
	'g' => 469,
	'h' => 531,
	'i' => 250,
	'j' => 250,
	'k' => 458,
	'l' => 240,
	'm' => 802,
	'n' => 531,
	'o' => 500,
	'p' => 521,
	'q' => 521,
	'r' => 365,
	's' => 333,
	't' => 292,
	'u' => 521,
	'v' => 458,
	'w' => 677,
	'x' => 479,
	'y' => 458,
	'z' => 427,
	'{' => 480,
	'|' => 496,
	'}' => 480,
	'~' => 667
);

$GB_widths = array (
	' ' => 207,
	'!' => 270,
	'"' => 342,
	'#' => 467,
	'$' => 462,
	'%' => 797,
	'&' => 710,
	'\'' => 239,
	'(' => 374,
	')' => 374,
	'*' => 423,
	'+' => 605,
	',' => 238,
	'-' => 375,
	'.' => 238,
	'/' => 334,
	'0' => 462,
	'1' => 462,
	'2' => 462,
	'3' => 462,
	'4' => 462,
	'5' => 462,
	'6' => 462,
	'7' => 462,
	'8' => 462,
	'9' => 462,
	':' => 238,
	';' => 238,
	'<' => 605,
	'=' => 605,
	'>' => 605,
	'?' => 344,
	'@' => 748,
	'A' => 684,
	'B' => 560,
	'C' => 695,
	'D' => 739,
	'E' => 563,
	'F' => 511,
	'G' => 729,
	'H' => 793,
	'I' => 318,
	'J' => 312,
	'K' => 666,
	'L' => 526,
	'M' => 896,
	'N' => 758,
	'O' => 772,
	'P' => 544,
	'Q' => 772,
	'R' => 628,
	'S' => 465,
	'T' => 607,
	'U' => 753,
	'V' => 711,
	'W' => 972,
	'X' => 647,
	'Y' => 620,
	'Z' => 607,
	'[' => 374,
	'\\' => 333,
	']' => 374,
	'^' => 606,
	'_' => 500,
	'`' => 239,
	'a' => 417,
	'b' => 503,
	'c' => 427,
	'd' => 529,
	'e' => 415,
	'f' => 264,
	'g' => 444,
	'h' => 518,
	'i' => 241,
	'j' => 230,
	'k' => 495,
	'l' => 228,
	'm' => 793,
	'n' => 527,
	'o' => 524,
	'p' => 524,
	'q' => 504,
	'r' => 338,
	's' => 336,
	't' => 277,
	'u' => 517,
	'v' => 450,
	'w' => 652,
	'x' => 466,
	'y' => 452,
	'z' => 407,
	'{' => 370,
	'|' => 258,
	'}' => 370,
	'~' => 605
);

class PDF_Chinese extends FPDF
{
	var $angle = 0;
	var $outlines = array ();
	var $OutlineRoot;
	var $widths;
	var $tablewidths;
	var $headerset;
	var $footerset;

function _beginpage($orientation) {
	$this->page++;
	if(!$this->pages[$this->page]) // solved the problem of overwriting a page, if it already exists
		$this->pages[$this->page]='';
	$this->state=2;
	$this->x=$this->lMargin;
	$this->y=$this->tMargin;
	$this->lasth=0;
	$this->FontFamily='';
	//Page orientation
	if(!$orientation)
		$orientation=$this->DefOrientation;
	else
	{
		$orientation=strtoupper($orientation{0});
		if($orientation!=$this->DefOrientation)
			$this->OrientationChanges[$this->page]=true;
	}
	if($orientation!=$this->CurOrientation)
	{
		//Change orientation
		if($orientation=='P')
		{
			$this->wPt=$this->fwPt;
			$this->hPt=$this->fhPt;
			$this->w=$this->fw;
			$this->h=$this->fh;
		}
		else
		{
			$this->wPt=$this->fhPt;
			$this->hPt=$this->fwPt;
			$this->w=$this->fh;
			$this->h=$this->fw;
		}
		$this->PageBreakTrigger=$this->h-$this->bMargin;
		$this->CurOrientation=$orientation;
	}
}

	function AddCIDFont($family, $style, $name, $cw, $CMap, $registry)
	{
		$i = count($this->fonts) + 1;
		$fontkey = strtolower($family) . strtoupper($style);
		$this->fonts[$fontkey] = array (
			'i' => $i,
			'type' => 'Type0',
			'name' => $name,
			'up' => -120,
			'ut' => 40,
			'cw' => $cw,
			'CMap' => $CMap,
			'registry' => $registry
		);
	}

	function AddBig5Font($family = 'Big5')
	{
		$cw = $GLOBALS['Big5_widths'];
		$name = 'MSungStd-Light-Acro';
		$CMap = 'ETenms-B5-H';
		$registry = array (
			'ordering' => 'CNS1',
			'supplement' => 0
		);
		$this->AddCIDFont($family, '', $name, $cw, $CMap, $registry);
		$this->AddCIDFont($family, 'B', $name . ',Bold', $cw, $CMap, $registry);
		$this->AddCIDFont($family, 'I', $name . ',Italic', $cw, $CMap, $registry);
		$this->AddCIDFont($family, 'BI', $name . ',BoldItalic', $cw, $CMap, $registry);
	}

	function AddGBFont($family = 'GB', $name = 'STSongStd-Light-Acro')
	{
		$cw = $GLOBALS['GB_widths'];
		//$name='STSongStd-Light-Acro';
		$CMap = 'GBKp-EUC-H';
		$registry = array (
			'ordering' => 'GB1',
			'supplement' => 2
		);
		$this->AddCIDFont($family, '', $name, $cw, $CMap, $registry);
		$this->AddCIDFont($family, 'B', $name . ',Bold', $cw, $CMap, $registry);
		$this->AddCIDFont($family, 'I', $name . ',Italic', $cw, $CMap, $registry);
		$this->AddCIDFont($family, 'BI', $name . ',BoldItalic', $cw, $CMap, $registry);
	}

	function GetStringWidth($s)
	{
		if ($this->CurrentFont['type'] == 'Type0')
			return $this->GetMBStringWidth($s);
		else
			return parent :: GetStringWidth($s);
	}

	function GetMBStringWidth($s)
	{
		//Multi-byte version of GetStringWidth()
		$l = 0;
		$cw = & $this->CurrentFont['cw'];
		$nb = strlen($s);
		$i = 0;
		while ($i < $nb)
		{
			$c = $s[$i];
			if (ord($c) < 128)
			{
				$l += $cw[$c];
				$i++;
			}
			else
			{
				$l += 1000;
				$i += 2;
			}
		}
		return $l * $this->FontSize / 1000;
	}

	function MultiCell($w, $h, $txt, $border = 0, $align = 'L', $fill = 0)
	{
		if ($this->CurrentFont['type'] == 'Type0')
			$this->MBMultiCell($w, $h, $txt, $border, $align, $fill);
		else
			parent :: MultiCell($w, $h, $txt, $border, $align, $fill);
	}

	function MBMultiCell($w, $h, $txt, $border = 0, $align = 'L', $fill = 0)
	{
		//Multi-byte version of MultiCell()
		$cw = & $this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w -2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb -1] == "\n")
			$nb--;
		$b = 0;
		if ($border)
		{
			if ($border == 1)
			{
				$border = 'LTRB';
				$b = 'LRT';
				$b2 = 'LR';
			}
			else
			{
				$b2 = '';
				if (is_int(strpos($border, 'L')))
					$b2 .= 'L';
				if (is_int(strpos($border, 'R')))
					$b2 .= 'R';
				$b = is_int(strpos($border, 'T')) ? $b2 . 'T' : $b2;
			}
		}
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$nl = 1;
		while ($i < $nb)
		{
			//Get next character
			$c = $s[$i];
			//Check if ASCII or MB
			$ascii = (ord($c) < 128);
			if ($c == "\n")
			{
				//Explicit line break
				if ($this->ws > 0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				$this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				$nl++;
				if ($border and $nl == 2)
					$b = $b2;
				continue;
			}
			if (!$ascii)
			{
				$sep = $i;
				$ls = $l;
			}
			elseif ($c == ' ')
			{
				$sep = $i;
				$ls = $l;
				$ns++;
			}
			$l += $ascii ? $cw[$c] : 1000;
			if ($l > $wmax)
			{
				//Automatic line break
				if ($sep == -1 or $i == $j)
				{
					if ($i == $j)
						$i += $ascii ? 1 : 2;
					if ($this->ws > 0)
					{
						$this->ws = 0;
						$this->_out('0 Tw');
					}
					$this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
				}
				else
				{
					if ($align == 'J')
					{
						if ($s[$sep] == ' ')
							$ns--;
						if ($s[$i -1] == ' ')
						{
							$ns--;
							$ls -= $cw[' '];
						}
						$this->ws = ($ns > 0) ? ($wmax - $ls) / 1000 * $this->FontSize / $ns : 0;
						$this->_out(sprintf('%.3f Tw', $this->ws * $this->k));
					}
					$this->Cell($w, $h, substr($s, $j, $sep - $j), $b, 2, $align, $fill);
					$i = ($s[$sep] == ' ') ? $sep +1 : $sep;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				$nl++;
				if ($border and $nl == 2)
					$b = $b2;
			}
			else
				$i += $ascii ? 1 : 2;
		}
		//Last chunk
		if ($this->ws > 0)
		{
			$this->ws = 0;
			$this->_out('0 Tw');
		}
		if ($border and is_int(strpos($border, 'B')))
			$b .= 'B';
		$this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
		$this->x = $this->lMargin;
	}

	function Write($h, $txt, $link = '')
	{
		if ($this->CurrentFont['type'] == 'Type0')
			$this->MBWrite($h, $txt, $link);
		else
			parent :: Write($h, $txt, $link);
	}

	function MBWrite($h, $txt, $link)
	{
		//Multi-byte version of Write()
		$cw = & $this->CurrentFont['cw'];
		$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w -2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb)
		{
			//Get next character
			$c = $s[$i];
			//Check if ASCII or MB
			$ascii = (ord($c) < 128);
			if ($c == "\n")
			{
				//Explicit line break
				$this->Cell($w, $h, substr($s, $j, $i - $j), 0, 2, '', 0, $link);
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				if ($nl == 1)
				{
					$this->x = $this->lMargin;
					$w = $this->w - $this->rMargin - $this->x;
					$wmax = ($w -2 * $this->cMargin) * 1000 / $this->FontSize;
				}
				$nl++;
				continue;
			}
			if (!$ascii or $c == ' ')
				$sep = $i;
			$l += $ascii ? $cw[$c] : 1000;
			if ($l > $wmax)
			{
				//Automatic line break
				if ($sep == -1 or $i == $j)
				{
					if ($this->x > $this->lMargin)
					{
						//Move to next line
						$this->x = $this->lMargin;
						$this->y += $h;
						$w = $this->w - $this->rMargin - $this->x;
						$wmax = ($w -2 * $this->cMargin) * 1000 / $this->FontSize;
						$i++;
						$nl++;
						continue;
					}
					if ($i == $j)
						$i += $ascii ? 1 : 2;
					$this->Cell($w, $h, substr($s, $j, $i - $j), 0, 2, '', 0, $link);
				}
				else
				{
					$this->Cell($w, $h, substr($s, $j, $sep - $j), 0, 2, '', 0, $link);
					$i = ($s[$sep] == ' ') ? $sep +1 : $sep;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				if ($nl == 1)
				{
					$this->x = $this->lMargin;
					$w = $this->w - $this->rMargin - $this->x;
					$wmax = ($w -2 * $this->cMargin) * 1000 / $this->FontSize;
				}
				$nl++;
			}
			else
				$i += $ascii ? 1 : 2;
		}
		//Last chunk
		if ($i != $j)
			$this->Cell($l / 1000 * $this->FontSize, $h, substr($s, $j, $i - $j), 0, 0, '', 0, $link);
	}

	function _putfonts()
	{
		$nf = $this->n;
		foreach ($this->diffs as $diff)
		{
			//Encodings
			$this->_newobj();
			$this->_out('<</Type /Encoding /BaseEncoding /WinAnsiEncoding /Differences [' . $diff . ']>>');
			$this->_out('endobj');
		}
		$mqr = get_magic_quotes_runtime();
		set_magic_quotes_runtime(0);
		foreach ($this->FontFiles as $file => $info)
		{
			//Font file embedding
			$this->_newobj();
			$this->FontFiles[$file]['n'] = $this->n;
			if (defined('FPDF_FONTPATH'))
				$file = FPDF_FONTPATH .
				$file;
			$size = filesize($file);
			if (!$size)
				$this->Error('Font file not found');
			$this->_out('<</Length ' . $size);
			if (substr($file, -2) == '.z')
				$this->_out('/Filter /FlateDecode');
			$this->_out('/Length1 ' . $info['length1']);
			if (isset ($info['length2']))
				$this->_out('/Length2 ' .
				$info['length2'] . ' /Length3 0');
			$this->_out('>>');
			$f = fopen($file, 'rb');
			$this->_putstream(fread($f, $size));
			fclose($f);
			$this->_out('endobj');
		}
		set_magic_quotes_runtime($mqr);
		foreach ($this->fonts as $k => $font)
		{
			//Font objects
			$this->_newobj();
			$this->fonts[$k]['n'] = $this->n;
			$this->_out('<</Type /Font');
			if ($font['type'] == 'Type0')
				$this->_putType0($font);
			else
			{
				$name = $font['name'];
				$this->_out('/BaseFont /' . $name);
				if ($font['type'] == 'core')
				{
					//Standard font
					$this->_out('/Subtype /Type1');
					if ($name != 'Symbol' and $name != 'ZapfDingbats')
						$this->_out('/Encoding /WinAnsiEncoding');
				}
				else
				{
					//Additional font
					$this->_out('/Subtype /' . $font['type']);
					$this->_out('/FirstChar 32');
					$this->_out('/LastChar 255');
					$this->_out('/Widths ' . ($this->n + 1) . ' 0 R');
					$this->_out('/FontDescriptor ' . ($this->n + 2) . ' 0 R');
					if ($font['enc'])
					{
						if (isset ($font['diff']))
							$this->_out('/Encoding ' .
							 ($nf + $font['diff']) . ' 0 R');
						else
							$this->_out('/Encoding /WinAnsiEncoding');
					}
				}
				$this->_out('>>');
				$this->_out('endobj');
				if ($font['type'] != 'core')
				{
					//Widths
					$this->_newobj();
					$cw = & $font['cw'];
					$s = '[';
					for ($i = 32; $i <= 255; $i++)
						$s .= $cw[chr($i)] .
						' ';
					$this->_out($s . ']');
					$this->_out('endobj');
					//Descriptor
					$this->_newobj();
					$s = '<</Type /FontDescriptor /FontName /' . $name;
					foreach ($font['desc'] as $k => $v)
						$s .= ' /' .
						$k . ' ' . $v;
					$file = $font['file'];
					if ($file)
						$s .= ' /FontFile' .
						 ($font['type'] == 'Type1' ? '' : '2') . ' ' . $this->FontFiles[$file]['n'] . ' 0 R';
					$this->_out($s . '>>');
					$this->_out('endobj');
				}
			}
		}
	}

	function _putType0($font)
	{
		//Type0
		$this->_out('/Subtype /Type0');
		$this->_out('/BaseFont /' . $font['name'] . '-' . $font['CMap']);
		$this->_out('/Encoding /' . $font['CMap']);
		$this->_out('/DescendantFonts [' . ($this->n + 1) . ' 0 R]');
		$this->_out('>>');
		$this->_out('endobj');
		//CIDFont
		$this->_newobj();
		$this->_out('<</Type /Font');
		$this->_out('/Subtype /CIDFontType0');
		$this->_out('/BaseFont /' . $font['name']);
		$this->_out('/CIDSystemInfo <</Registry (Adobe) /Ordering (' . $font['registry']['ordering'] . ') /Supplement ' . $font['registry']['supplement'] . '>>');
		$this->_out('/FontDescriptor ' . ($this->n + 1) . ' 0 R');
		$W = '/W [1 [';
		if (is_array($font['cw']))
		{
			foreach ($font['cw'] as $w)
				$W .= $w .
				' ';
		}
		$this->_out($W . ']]');
		$this->_out('>>');
		$this->_out('endobj');
		//Font descriptor
		$this->_newobj();
		$this->_out('<</Type /FontDescriptor');
		$this->_out('/FontName /' . $font['name']);
		$this->_out('/Flags 6');
		$this->_out('/FontBBox [0 0 1000 1000]');
		$this->_out('/ItalicAngle 0');
		$this->_out('/Ascent 1000');
		$this->_out('/Descent 0');
		$this->_out('/CapHeight 1000');
		$this->_out('/StemV 10');
		$this->_out('>>');
		$this->_out('endobj');
	}

	function EAN13($x, $y, $barcode, $h = 16, $w = .35)
	{
		$this->Barcode($x, $y, $barcode, $h, $w, 13);
	}

	function UPC_A($x, $y, $barcode, $h = 16, $w = .35)
	{
		$this->Barcode($x, $y, $barcode, $h, $w, 12);
	}

	function GetCheckDigit($barcode)
	{
		//Compute the check digit
		$sum = 0;
		for ($i = 1; $i <= 11; $i += 2)
			$sum += 3 * $barcode {
			$i };
		for ($i = 0; $i <= 10; $i += 2)
			$sum += $barcode {
			$i };
		$r = $sum % 10;
		if ($r > 0)
			$r = 10 - $r;
		return $r;
	}

	function TestCheckDigit($barcode)
	{
		//Test validity of check digit
		$sum = 0;
		for ($i = 1; $i <= 11; $i += 2)
			$sum += 3 * $barcode {
			$i };
		for ($i = 0; $i <= 10; $i += 2)
			$sum += $barcode {
			$i };
		return ($sum + $barcode {
			12 }) % 10 == 0;
	}

	function Barcode($x, $y, $barcode, $h, $w, $len)
	{
		//Padding
		$barcode = str_pad($barcode, $len -1, '0', STR_PAD_LEFT);
		if ($len == 12)
			$barcode = '0' .
			$barcode;
		//Add or control the check digit
		if (strlen($barcode) == 12)
			$barcode .= $this->GetCheckDigit($barcode);
		elseif (!$this->TestCheckDigit($barcode)) $this->Error('Incorrect check digit');
		//Convert digits to bars
		$codes = array (
			'A' => array (
				'0' => '0001101',
				'1' => '0011001',
				'2' => '0010011',
				'3' => '0111101',
				'4' => '0100011',
				'5' => '0110001',
				'6' => '0101111',
				'7' => '0111011',
				'8' => '0110111',
				'9' => '0001011'
			),
			'B' => array (
				'0' => '0100111',
				'1' => '0110011',
				'2' => '0011011',
				'3' => '0100001',
				'4' => '0011101',
				'5' => '0111001',
				'6' => '0000101',
				'7' => '0010001',
				'8' => '0001001',
				'9' => '0010111'
			),
			'C' => array (
				'0' => '1110010',
				'1' => '1100110',
				'2' => '1101100',
				'3' => '1000010',
				'4' => '1011100',
				'5' => '1001110',
				'6' => '1010000',
				'7' => '1000100',
				'8' => '1001000',
				'9' => '1110100'
			)
		);
		$parities = array (
			'0' => array (
				'A',
				'A',
				'A',
				'A',
				'A',
				'A'
			),
			'1' => array (
				'A',
				'A',
				'B',
				'A',
				'B',
				'B'
			),
			'2' => array (
				'A',
				'A',
				'B',
				'B',
				'A',
				'B'
			),
			'3' => array (
				'A',
				'A',
				'B',
				'B',
				'B',
				'A'
			),
			'4' => array (
				'A',
				'B',
				'A',
				'A',
				'B',
				'B'
			),
			'5' => array (
				'A',
				'B',
				'B',
				'A',
				'A',
				'B'
			),
			'6' => array (
				'A',
				'B',
				'B',
				'B',
				'A',
				'A'
			),
			'7' => array (
				'A',
				'B',
				'A',
				'B',
				'A',
				'B'
			),
			'8' => array (
				'A',
				'B',
				'A',
				'B',
				'B',
				'A'
			),
			'9' => array (
				'A',
				'B',
				'B',
				'A',
				'B',
				'A'
			)
		);
		$code = '101';
		$p = $parities[$barcode {
			0 }
		];
		for ($i = 1; $i <= 6; $i++)
			$code .= $codes[$p[$i -1]][$barcode {
			$i }
		];
		$code .= '01010';
		for ($i = 7; $i <= 12; $i++)
			$code .= $codes['C'][$barcode {
			$i }
		];
		$code .= '101';
		//Draw bars
		for ($i = 0; $i < strlen($code); $i++)
		{
			if ($code {
				$i }
			== '1')
			$this->Rect($x + $i * $w, $y, $w, $h, 'F');
		}
		//Print text uder barcode
		$this->SetFont('Arial', '', 12);
		$this->Text($x, $y + $h +11 / $this->k, substr($barcode, - $len));
	}

	function Header()
	{
		global $maxY;
	
		// Check if header for this page already exists
		if(!$this->headerset[$this->page]) {
	
			if (is_array($this->tablewidths)) 
			{
				foreach($this->tablewidths as $width) {
					$fullwidth += $width;
				}
			}
			$this->SetY(($this->tMargin) - ($this->FontSizePt/$this->k)*2);
			$this->cellFontSize = $this->FontSizePt ;
			$this->SetFont('Arial','',( ( $this->titleFontSize) ? $this->titleFontSize : $this->FontSizePt ));
			$this->Cell(0,$this->FontSizePt,$this->titleText,0,1,'C');
			$l = ($this->lMargin);
			$this->SetFont('Arial','',$this->cellFontSize);
			if (is_array($this->colTitles)) 
			{
				foreach($this->colTitles as $col => $txt) {
					$this->SetXY($l,($this->tMargin));
					$this->MultiCell($this->tablewidths[$col], $this->FontSizePt,$txt);
					$l += $this->tablewidths[$col] ;
					$maxY = ($maxY < $this->getY()) ? $this->getY() : $maxY ;
				}
			}
			$this->SetXY($this->lMargin,$this->tMargin);
			$this->setFillColor(200,200,200);
			$l = ($this->lMargin);
			if (is_array($this->colTitles)) 
			{
				foreach($this->colTitles as $col => $txt) {
					$this->SetXY($l,$this->tMargin);
					$this->cell($this->tablewidths[$col],$maxY-($this->tMargin),'',1,0,'L',1);
					$this->SetXY($l,$this->tMargin);
					$this->MultiCell($this->tablewidths[$col],$this->FontSizePt,$txt,0,'C');
					$l += $this->tablewidths[$col];
				}
			}
			$this->setFillColor(255,255,255);
			// set headerset
			$this->headerset[$this->page] = 1;
		}
	
		$this->SetY($maxY);
		$this->SetFont('Arial', '', 8);
		$this->Write(10,"Date:".date("Y/m/d"));
		$this->SetTopMargin(80);
		//Put watermark
		$this->SetFont('Arial', 'B', 50);
		$this->SetTextColor(255, 192, 203);
		$this->RotatedText(30, 190, 'Auto PHP Framework', 45);

	}

function Footer() {
	// Check if footer for this page already exists
	if(!$this->footerset[$this->page]) {
		$this->SetY(-15);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		// set footerset
		$this->footerset[$this->page] = 1;
	}
}

	function RotatedText($x, $y, $txt, $angle)
	{
		//Text rotated around its origin
		$this->Rotate($angle, $x, $y);
		$this->Text($x, $y, $txt);
		$this->Rotate(0);
	}

	function Rotate($angle, $x = -1, $y = -1)
	{
		if ($x == -1)
			$x = $this->x;
		if ($y == -1)
			$y = $this->y;
		if ($this->angle != 0)
			$this->_out('Q');
		$this->angle = $angle;
		if ($angle != 0)
		{
			$angle *= M_PI / 180;
			$c = cos($angle);
			$s = sin($angle);
			$cx = $x * $this->k;
			$cy = ($this->h - $y) * $this->k;
			$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm', $c, $s, - $s, $c, $cx, $cy, - $cx, - $cy));
		}
	}

	function _endpage()
	{
		if ($this->angle != 0)
		{
			$this->angle = 0;
			$this->_out('Q');
		}
		parent :: _endpage();
	}

	function Bookmark($txt, $level = 0, $y = 0)
	{
		if ($y == -1)
			$y = $this->GetY();
		$this->outlines[] = array (
			't' => $txt,
			'l' => $level,
			'y' => $y,
		'p' => $this->PageNo());
	}

	function _putbookmarks()
	{
		$nb = count($this->outlines);
		if ($nb == 0)
			return;
		$lru = array ();
		$level = 0;
		foreach ($this->outlines as $i => $o)
		{
			if ($o['l'] > 0)
			{
				$parent = $lru[$o['l'] - 1];
				//Set parent and last pointers
				$this->outlines[$i]['parent'] = $parent;
				$this->outlines[$parent]['last'] = $i;
				if ($o['l'] > $level)
				{
					//Level increasing: set first pointer
					$this->outlines[$parent]['first'] = $i;
				}
			}
			else
				$this->outlines[$i]['parent'] = $nb;
			if ($o['l'] <= $level and $i > 0)
			{
				//Set prev and next pointers
				$prev = $lru[$o['l']];
				$this->outlines[$prev]['next'] = $i;
				$this->outlines[$i]['prev'] = $prev;
			}
			$lru[$o['l']] = $i;
			$level = $o['l'];
		}
		//Outline items
		$n = $this->n + 1;
		foreach ($this->outlines as $i => $o)
		{
			$this->_newobj();
			$this->_out('<</Title ' . $this->_textstring($o['t']));
			$this->_out('/Parent ' . ($n + $o['parent']) . ' 0 R');
			if (isset ($o['prev']))
				$this->_out('/Prev ' .
				 ($n + $o['prev']) . ' 0 R');
			if (isset ($o['next']))
				$this->_out('/Next ' .
				 ($n + $o['next']) . ' 0 R');
			if (isset ($o['first']))
				$this->_out('/First ' .
				 ($n + $o['first']) . ' 0 R');
			if (isset ($o['last']))
				$this->_out('/Last ' .
				 ($n + $o['last']) . ' 0 R');
			$this->_out(sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]', 1 + 2 * $o['p'], ($this->h - $o['y']) * $this->k));
			$this->_out('/Count 0>>');
			$this->_out('endobj');
		}
		//Outline root
		$this->_newobj();
		$this->OutlineRoot = $this->n;
		$this->_out('<</Type /Outlines /First ' . $n . ' 0 R');
		$this->_out('/Last ' . ($n + $lru[0]) . ' 0 R>>');
		$this->_out('endobj');
	}

	function _putresources()
	{
		parent :: _putresources();
		$this->_putbookmarks();
	}

	function _putcatalog()
	{
		parent :: _putcatalog();
		if (count($this->outlines) > 0)
		{
			$this->_out('/Outlines ' . $this->OutlineRoot . ' 0 R');
			$this->_out('/PageMode /UseOutlines');
		}
	}

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths = $w;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++)
		{
			$w = $this->widths[$i];
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h);
			//Print the text
			$this->MultiCell($w, 5, $data[$i], 0, 'L');
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw = & $this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w -2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb -1] == "\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb)
		{
			$c = $s[$i];
			if ($c == "\n")
			{
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ')
				$sep = $i;
			$l += $cw[$c];
			if ($l > $wmax)
			{
				if ($sep == -1)
				{
					if ($i == $j)
						$i++;
				}
				else
					$i = $sep +1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}

}
?>
