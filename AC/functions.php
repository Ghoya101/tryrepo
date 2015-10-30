<?php
function convert_number_to_words($number) 
{

    $hyphen      = '-';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' AND ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

	$string = strtoupper($string);
    return $string;
}?>


<script>
function additem()
{
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;
var desc = document.getElementById("desc").value;
var qty  = document.getElementById("qty").value;
var unit = document.getElementById("unit").value ;
var up	 = document.getElementById("unitprice").value ;
var total= qty * up;
var empid	 = document.getElementById("empid").value ;
var payee	 = document.getElementById("payee").value ;
var paccount	 = document.getElementById("paccount").value ;
	var pbank	 = document.getElementById("pbank").value ;
var contact	 = document.getElementById("contact").value ;
var contactno	 = document.getElementById("contactno").value ;
var terms	 = document.getElementById("terms").value ;
var ddate	 = document.getElementById("ddate").value ;
var dplace	 = document.getElementById("dplace").value ;
var receiver	 = document.getElementById("receiver").value ;
var now = date_time('date_time');


var a = "po-final.php?additem=Yes&&projid="+proj+"&&po="+po+"&&desc="+desc+"&&qty="+qty+"&&unit="+unit+"&&up="+up+"&&empid="+empid+"&&payee="+payee+"&&paccount="+paccount+"&&pbank="+pbank+"&&contact="+contact+"&&contactno="+contactno+"&&ddate="+ddate+"&&dplace="+dplace+"&&receiver="+receiver+"&&terms="+terms+"&&now="+now;
//var a = "po-final.php?additem=Yes&&projid="+proj+"&&po="+po+"&&desc="+desc+"&&qty="+qty+"&&unit="+unit+"&&up="+up+"&&empid="+empid+"&&payee="+payee;
//	document.getElementById('showme').innerHTML = a;
	if(payee != '' && desc !='' && qty !='' && up!='')
	{
	window.location.href=a;
	//document.getElementById('showme').innerHTML = a;
	}else
	{
	alert("PLEASE FILL IN THE REQUIRED FIELDS!!!!");
	}

}



//FUNCTION SAVING
function savepo()
{
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;
var payee	 = document.getElementById("payee").value ;
var paccount	 = document.getElementById("paccount").value ;
var pbank	 = document.getElementById("pbank").value ;
var contact	 = document.getElementById("contact").value ;
var contactno	 = document.getElementById("contactno").value ;
var terms	 = document.getElementById("terms").value ;
var ddate	 = document.getElementById("ddate").value ;
var dplace	 = document.getElementById("dplace").value ;
var receiver	 = document.getElementById("receiver").value ;
var a = "po-final.php?cmdsavepo=Yes&&projid="+proj+"&&po="+po+"&&payee="+payee+"&&paccount="+paccount+"&&pbank="+pbank+"&&contact="+contact+"&&contactno="+contactno+"&&ddate="+ddate+"&&dplace="+dplace+"&&receiver="+receiver+"&&terms="+terms;

	if(payee != '')
	{
	window.location.href=a;
	//document.getElementById('showme').innerHTML = a;
	}else
	{
	alert("PLEASE FILL IN THE REQUIRED FIELDS!!!!");
	}

}


//FUNCTION SENDING/ SUBMITTING PO
function sendpo()
{
var project = document.getElementById("project").value;
var po	 = document.getElementById("po").value;
var a = "po-final.php?send=Yes&&projid="+project+"&&po="+po;
//var r = confirm("Are you sure you want to send POID: "+po+" ?");
	//if (r == true) 
	//{   	
	window.location.href=a;
	//alert(a);
	//} 
	//else
	//{	
	//}

}


//FUNCTION DELETING ITEM
function delitem(id,cd)
{
var coid = id;
var codesc = cd;
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;
var a = "po-final.php?delitem=Yes&&coid="+coid+"&&cd="+codesc+"&&projid="+proj+"&&po="+po;

	var r = confirm("Are you sure you want to delete "+codesc);
	if (r == true) 
	{    window.location.href=a;
	} 
	else
	{	
	}

//window.location.href=a;
}



//FUNCTION DELETING ITEM
function edititem(id,cd)
{
var coid = id;
var codesc = cd;
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;
var a = "newpo.php?proj="+proj+"&&poid="+po+"&&edititem=Yes&&coid="+coid+"&&cd="+codesc;

	    window.location.href=a;
}


//FUNCTION DELETING ITEM
function saveitem()
{
var coid = document.getElementById("edtcoid").value;
var newcd = document.getElementById("edtcd").value;
var newqty = document.getElementById("edtqty").value;
var newunit = document.getElementById("edtunit").value;
var newprice = document.getElementById("edtprice").value;
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;

var a = "po-final.php?saveitem=Yes&&projid="+proj+"&&po="+po+"&&coid="+coid+"&&newcd="+newcd+"&&newqty="+newqty+"&&newunit="+newunit+"&&newprice="+newprice;
 window.location.href=a;
//alert('Changes in the item has been saved.');
}




//FUNCTION SIDE projects.php
function getproj(cid)
{
var proj = cid;
var a = "projects.php?proj="+proj;
 window.location.href=a;

}

//FUNCTION back
function goBack() {
    window.history.back();
}


function genpo(){
var po	 = document.getElementById("po").value;
var a = "../reports/report-po.php?poid="+po;
 window.location.href=a;
}



//FUNCTION DELETING ITEM
function editnote(id,nd)
{
var noteid = id;
var notedesc = nd;
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;
var a = "newpo.php?editnote=Yes&&proj="+proj+"&&poid="+po+"&&nid="+noteid;

	    window.location.href=a;
}
</script>
