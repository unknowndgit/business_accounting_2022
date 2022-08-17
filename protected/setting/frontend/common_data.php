<?php

 if(!$session->Check()){
    if(!isset($_COOKIE['remember_me']) || $_COOKIE['remember_me']=='')
        $session->redirect('login',user);
 else
    {
        $cookie=explode('___',$_COOKIE['remember_me']);
        $session->Open();
        if(isset($_SESSION) )
        {
            $_SESSION ['email'] = $cookie['0'];
            $_SESSION['user_id'] = $cookie['1'];
            $_SESSION['department']=$cookie['2'];
        }

    }
}
$user_details=$db->get_row('users',array('user_id'=>$_SESSION['user_id']));
jump:
$settings=$db->get_row('settings');
//datetime zone setting
date_default_timezone_set($settings['timezone']);

$months_array = array(1 => 'Jan',
                      2 => 'Feb',
                      3 => 'Mar',
                      4 => 'Apr',
                      5 => 'May',
                      6 => 'Jun',
                      7 => 'Jul',
                      8 => 'Aug',
                      9 => 'Sep',
                      10 => 'Oct',
                      11 => 'Nov',
                      12 => 'Dec');

$countryList = array(
		"AF" => "Afghanistan",
		"AL" => "Albania",
		"DZ" => "Algeria",
		"AS" => "American Samoa",
		"AD" => "Andorra",
		"AO" => "Angola",
		"AI" => "Anguilla",
		"AQ" => "Antarctica",
		"AG" => "Antigua and Barbuda",
		"AR" => "Argentina",
		"AM" => "Armenia",
		"AW" => "Aruba",
		"AU" => "Australia",
		"AT" => "Austria",
		"AZ" => "Azerbaijan",
		"BS" => "Bahamas",
		"BH" => "Bahrain",
		"BD" => "Bangladesh",
		"BB" => "Barbados",
		"BY" => "Belarus",
		"BE" => "Belgium",
		"BZ" => "Belize",
		"BJ" => "Benin",
		"BM" => "Bermuda",
		"BT" => "Bhutan",
		"BO" => "Bolivia",
		"BA" => "Bosnia and Herzegovina",
		"BW" => "Botswana",
		"BV" => "Bouvet Island",
		"BR" => "Brazil",
		"BQ" => "British Antarctic Territory",
		"IO" => "British Indian Ocean Territory",
		"VG" => "British Virgin Islands",
		"BN" => "Brunei",
		"BG" => "Bulgaria",
		"BF" => "Burkina Faso",
		"BI" => "Burundi",
		"KH" => "Cambodia",
		"CM" => "Cameroon",
		"CA" => "Canada",
		"CT" => "Canton and Enderbury Islands",
		"CV" => "Cape Verde",
		"KY" => "Cayman Islands",
		"CF" => "Central African Republic",
		"TD" => "Chad",
		"CL" => "Chile",
		"CN" => "China",
		"CX" => "Christmas Island",
		"CC" => "Cocos [Keeling] Islands",
		"CO" => "Colombia",
		"KM" => "Comoros",
		"CG" => "Congo - Brazzaville",
		"CD" => "Congo - Kinshasa",
		"CK" => "Cook Islands",
		"CR" => "Costa Rica",
		"HR" => "Croatia",
		"CU" => "Cuba",
		"CY" => "Cyprus",
		"CZ" => "Czech Republic",
		"CI" => "C�te d�Ivoire",
		"DK" => "Denmark",
		"DJ" => "Djibouti",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"NQ" => "Dronning Maud Land",
		"DD" => "East Germany",
		"EC" => "Ecuador",
		"EG" => "Egypt",
		"SV" => "El Salvador",
		"GQ" => "Equatorial Guinea",
		"ER" => "Eritrea",
		"EE" => "Estonia",
		"ET" => "Ethiopia",
		"FK" => "Falkland Islands",
		"FO" => "Faroe Islands",
		"FJ" => "Fiji",
		"FI" => "Finland",
		"FR" => "France",
		"GF" => "French Guiana",
		"PF" => "French Polynesia",
		"TF" => "French Southern Territories",
		"FQ" => "French Southern and Antarctic Territories",
		"GA" => "Gabon",
		"GM" => "Gambia",
		"GE" => "Georgia",
		"DE" => "Germany",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GR" => "Greece",
		"GL" => "Greenland",
		"GD" => "Grenada",
		"GP" => "Guadeloupe",
		"GU" => "Guam",
		"GT" => "Guatemala",
		"GG" => "Guernsey",
		"GN" => "Guinea",
		"GW" => "Guinea-Bissau",
		"GY" => "Guyana",
		"HT" => "Haiti",
		"HM" => "Heard Island and McDonald Islands",
		"HN" => "Honduras",
		"HK" => "Hong Kong SAR China",
		"HU" => "Hungary",
		"IS" => "Iceland",
		"IN" => "India",
		"ID" => "Indonesia",
		"IR" => "Iran",
		"IQ" => "Iraq",
		"IE" => "Ireland",
		"IM" => "Isle of Man",
		"IL" => "Israel",
		"IT" => "Italy",
		"JM" => "Jamaica",
		"JP" => "Japan",
		"JE" => "Jersey",
		"JT" => "Johnston Island",
		"JO" => "Jordan",
		"KZ" => "Kazakhstan",
		"KE" => "Kenya",
		"KI" => "Kiribati",
		"KW" => "Kuwait",
		"KG" => "Kyrgyzstan",
		"LA" => "Laos",
		"LV" => "Latvia",
		"LB" => "Lebanon",
		"LS" => "Lesotho",
		"LR" => "Liberia",
		"LY" => "Libya",
		"LI" => "Liechtenstein",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"MO" => "Macau SAR China",
		"MK" => "Macedonia",
		"MG" => "Madagascar",
		"MW" => "Malawi",
		"MY" => "Malaysia",
		"MV" => "Maldives",
		"ML" => "Mali",
		"MT" => "Malta",
		"MH" => "Marshall Islands",
		"MQ" => "Martinique",
		"MR" => "Mauritania",
		"MU" => "Mauritius",
		"YT" => "Mayotte",
		"FX" => "Metropolitan France",
		"MX" => "Mexico",
		"FM" => "Micronesia",
		"MI" => "Midway Islands",
		"MD" => "Moldova",
		"MC" => "Monaco",
		"MN" => "Mongolia",
		"ME" => "Montenegro",
		"MS" => "Montserrat",
		"MA" => "Morocco",
		"MZ" => "Mozambique",
		"MM" => "Myanmar [Burma]",
		"NA" => "Namibia",
		"NR" => "Nauru",
		"NP" => "Nepal",
		"NL" => "Netherlands",
		"AN" => "Netherlands Antilles",
		"NT" => "Neutral Zone",
		"NC" => "New Caledonia",
		"NZ" => "New Zealand",
		"NI" => "Nicaragua",
		"NE" => "Niger",
		"NG" => "Nigeria",
		"NU" => "Niue",
		"NF" => "Norfolk Island",
		"KP" => "North Korea",
		"VD" => "North Vietnam",
		"MP" => "Northern Mariana Islands",
		"NO" => "Norway",
		"OM" => "Oman",
		"PC" => "Pacific Islands Trust Territory",
		"PK" => "Pakistan",
		"PW" => "Palau",
		"PS" => "Palestinian Territories",
		"PA" => "Panama",
		"PZ" => "Panama Canal Zone",
		"PG" => "Papua New Guinea",
		"PY" => "Paraguay",
		"YD" => "People's Democratic Republic of Yemen",
		"PE" => "Peru",
		"PH" => "Philippines",
		"PN" => "Pitcairn Islands",
		"PL" => "Poland",
		"PT" => "Portugal",
		"PR" => "Puerto Rico",
		"QA" => "Qatar",
		"RO" => "Romania",
		"RU" => "Russia",
		"RW" => "Rwanda",
		"RE" => "R�union",
		"BL" => "Saint Barth�lemy",
		"SH" => "Saint Helena",
		"KN" => "Saint Kitts and Nevis",
		"LC" => "Saint Lucia",
		"MF" => "Saint Martin",
		"PM" => "Saint Pierre and Miquelon",
		"VC" => "Saint Vincent and the Grenadines",
		"WS" => "Samoa",
		"SM" => "San Marino",
		"SA" => "Saudi Arabia",
		"SN" => "Senegal",
		"RS" => "Serbia",
		"CS" => "Serbia and Montenegro",
		"SC" => "Seychelles",
		"SL" => "Sierra Leone",
		"SG" => "Singapore",
		"SK" => "Slovakia",
		"SI" => "Slovenia",
		"SB" => "Solomon Islands",
		"SO" => "Somalia",
		"ZA" => "South Africa",
		"GS" => "South Georgia and the South Sandwich Islands",
		"KR" => "South Korea",
		"ES" => "Spain",
		"LK" => "Sri Lanka",
		"SD" => "Sudan",
		"SR" => "Suriname",
		"SJ" => "Svalbard and Jan Mayen",
		"SZ" => "Swaziland",
		"SE" => "Sweden",
		"CH" => "Switzerland",
		"SY" => "Syria",
		"ST" => "S�o Tom� and Pr�ncipe",
		"TW" => "Taiwan",
		"TJ" => "Tajikistan",
		"TZ" => "Tanzania",
		"TH" => "Thailand",
		"TL" => "Timor-Leste",
		"TG" => "Togo",
		"TK" => "Tokelau",
		"TO" => "Tonga",
		"TT" => "Trinidad and Tobago",
		"TN" => "Tunisia",
		"TR" => "Turkey",
		"TM" => "Turkmenistan",
		"TC" => "Turks and Caicos Islands",
		"TV" => "Tuvalu",
		"UM" => "U.S. Minor Outlying Islands",
		"PU" => "U.S. Miscellaneous Pacific Islands",
		"VI" => "U.S. Virgin Islands",
		"UG" => "Uganda",
		"UA" => "Ukraine",
		"SU" => "Union of Soviet Socialist Republics",
		"AE" => "United Arab Emirates",
		"GB" => "United Kingdom",
		"US" => "United States",
		"ZZ" => "Unknown or Invalid Region",
		"UY" => "Uruguay",
		"UZ" => "Uzbekistan",
		"VU" => "Vanuatu",
		"VA" => "Vatican City",
		"VE" => "Venezuela",
		"VN" => "Vietnam",
		"WK" => "Wake Island",
		"WF" => "Wallis and Futuna",
		"EH" => "Western Sahara",
		"YE" => "Yemen",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe",
		"AX" => "�land Islands",
);

$months_array = array(1 => 'Jan',
                2 => 'Feb',
                3 => 'Mar',
                4 => 'Apr',
                5 => 'May',
                6 => 'Jun',
                7 => 'Jul',
                8 => 'Aug',
                9 => 'Sep',
                10 => 'Oct',
                11 => 'Nov',
                12 => 'Dec');

$currency=$settings['currency_symbol'];
$site_name=$settings['name'];
$site_address=$settings['address'];
$site_email=$settings['email'];
$site_telephone1=$settings['telephone1'];
$is_gst_registered=$settings['is_gst_registered'];
define(CURRENCY, $currency);
define(SITE_NAME,$site_name);
define(SITE_EMAIL,$site_email);
define(SITE_ADDRESS,$site_address);
define(SITE_PHONE1,$site_telephone1);
$date_format=$settings['date_format'];
define(DATE_FORMAT,$date_format);
define(IS_GST_REGISTERED,$is_gst_registered);
//main permissions or site settings

//echo IS_GST_REGISTERED;

/************##day to day setting;##*******************/
$dr_settings=$db->get_row('daytoday_report_settings',array('id'=>'1'));

$selling_approval=$dr_settings['selling_approval'];
$estimate_prefix=$dr_settings['estimate_prefix'];
$estimate_default_template=$dr_settings['estimate_default_template'];
$estimate_expiry=$dr_settings['estimate_expiry'];
$estimate_term_condition=$dr_settings['estimate_term_condition'];
$estimate_payment_notes=$dr_settings['estimate_payment_notes'];
$invoice_prefix=$dr_settings['invoice_prefix'];
$invoice_default_template=$dr_settings['invoice_default_template'];
$invoice_payment_details=$dr_settings['invoice_payment_details'];
$can_prefix=$dr_settings['can_prefix'];
$buying_approval=$dr_settings['buying_approval'];
$bill_prefix=$dr_settings['bill_prefix'];
$san_prefix=$dr_settings['san_prefix'];
$report_basis=$dr_settings['report_basis'];
$ageing_report=$dr_settings['ageing_report'];

$estimate_start_from=$dr_settings['estimate_start_from'];
$invoice_start_from=$dr_settings['invoice_start_from'];
$can_start_from=$dr_settings['can_start_from'];
$bill_start_from=$dr_settings['bill_start_from'];
$san_start_from=$dr_settings['san_start_from'];
$journal_start_from=$dr_settings['journal_start_from'];

define(ESTIMATE_START_FROM, $estimate_start_from);
define(INVOICE_START_FROM, $invoice_start_from);
define(CAN_START_FROM, $can_start_from);
define(BILL_START_FROM, $bill_start_from);
define(SAN_START_FROM, $san_start_from);
define(JOURNAL_START_FROM, $journal_start_from);



define(SELLING_APPROVAL,$selling_approval);
define(ESTIMATE_PREFIX,$estimate_prefix);
define(ESTIMATE_DEFAULT_TEMPLATE,$estimate_default_template);
define(ESTIMATE_EXPIRY,$estimate_expiry);
define(ESTIMATE_TERM_CONDITION,$estimate_term_condition);
define(ESTIMATE_PAYMENT_NOTES,$estimate_payment_notes);
define(INVOICE_PREFIX,$invoice_prefix);
define(INVOICE_DEFAULT_TEMPLATE,$invoice_default_template);
define(INVOICE_PAYMENT_DETAILS,$invoice_payment_details);
define(CAN_PREFIX,$can_prefix);
define(BUYING_APPROVAL,$buying_approval);
define(BILL_PREFIX,$bill_prefix);
define(SAN_PREFIX,$san_prefix);
define(REPORT_BASIS,$report_basis);
define(AGEING_REPORT,$ageing_report);

/************##Tax General setting;##*******************/
$tax_gen_setting=$db->get_row('tax_setting',array('id'=>'1'));

//$register_for_tax=$tax_gen_setting['register_for_tax'];
//$reporting_basis=$tax_gen_setting['reporting_basis'];
//$default_sale_figure=$tax_gen_setting['default_sale_figure'];

//$allow_user_edit_tax=$tax_gen_setting['allow_user_edit_tax'];
//$allow_user_include_tax=$tax_gen_setting['allow_user_include_tax'];

//define(REGISTEER_FOR_TAX,$register_for_tax);
//define(REPORTING_BASIS,$reporting_basis);
//define(DEFAULT_SALE_FIGURE,$default_sale_figure);

//define(ALLOW_USER_EDIT_TAX,$allow_user_edit_tax);
//define(ALLOW_USER_INCLUDE_TAX,$allow_user_include_tax);

$default_tax_for_sale=$tax_gen_setting['default_tax_for_sale'];
$default_tax_for_purchase=$tax_gen_setting['default_tax_for_purchase'];
define(DEFAULT_TAX_FOR_SALE,$default_tax_for_sale);
define(DEFAULT_TAX_FOR_PURCHASE,$default_tax_for_purchase);

/************##Default linked Account setting;##*******************/
$linked_accounts=$db->get_row('linked_accounts',array('id'=>'1'));

//$sale_iaff=$linked_accounts['sale_iaff'];
//$sale_lafcd=$linked_accounts['sale_lafcd'];
//$sale_ecosafd=$linked_accounts['sale_ecosafd'];

$sale_aaftr=$linked_accounts['sale_aaftr'];
$sale_bafcr=$linked_accounts['sale_bafcr'];
define(Asset_Account_for_Tracking_Receivables,$sale_aaftr);
define(Bank_Account_for_Customer_Receipts,$sale_bafcr);

$purchase_bafpb=$linked_accounts['purchase_bafpb'];
$purchase_lafir=$linked_accounts['purchase_lafir'];
define(Bank_Account_for_Paying_Bills,$purchase_bafpb);
define(Liability_Account_for_Item_Receipts,$purchase_lafir);

$account_tax_collect=$linked_accounts['account_tax_collect'];
$account_tax_paid=$linked_accounts['account_tax_paid'];
define(ACCOUNT_FOR_TAX_COLLECTED,$account_tax_collect);
define(ACCOUNT_FOR_TAX_PAID,$account_tax_paid);


  $entity_array = [
      "sole_proprietorship" => 'Sole Proprietorship',
      "partnership" =>'Partnership',
      "limited_liability_company" => 'Limited Liability Company',
      "limited_liability_partnership" => 'Limited Liability Partnership',
      "c_corporation" => 'C Corporation',
      "s_corporation" => 'S Corporation' 
  ];




?>