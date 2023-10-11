<?php

declare(strict_types=1);

namespace App\Exchange;

enum Currency: string
{
    //United Arab Emirates Dirham
    case AED = 'AED';
    //Afghan Afghani
    case AFN = 'AFN';
    //Albanian Lek
    case ALL = 'ALL';
    //Armenian Dram
    case AMD = 'AMD';
    //Netherlands Antillean Guilder
    case ANG = 'ANG';
    //Angolan Kwanza
    case AOA = 'AOA';
    //Argentine Peso
    case ARS = 'ARS';
    //Australian Dollar
    case AUD = 'AUD';
    //Aruban Florin
    case AWG = 'AWG';
    //Azerbaijani Manat
    case AZN = 'AZN';
    //Bosnia-Herzegovina Convertible Mark
    case BAM = 'BAM';
    //Barbadian Dollar
    case BBD = 'BBD';
    //Bangladeshi Taka
    case BDT = 'BDT';
    //Bulgarian Lev
    case BGN = 'BGN';
    //Bahraini Dinar
    case BHD = 'BHD';
    //Burundian Franc
    case BIF = 'BIF';
    //Bermudan Dollar
    case BMD = 'BMD';
    //Brunei Dollar
    case BND = 'BND';
    //Bolivian Boliviano
    case BOB = 'BOB';
    //Brazilian Real
    case BRL = 'BRL';
    //Bahamian Dollar
    case BSD = 'BSD';
    //Bitcoin
    case BTC = 'BTC';
    //Bhutanese Ngultrum
    case BTN = 'BTN';
    //Botswanan Pula
    case BWP = 'BWP';
    //New Belarusian Ruble
    case BYN = 'BYN';
    //Belarusian Ruble
    case BYR = 'BYR';
    //Belize Dollar
    case BZD = 'BZD';
    //Canadian Dollar
    case CAD = 'CAD';
    //Congolese Franc
    case CDF = 'CDF';
    //Swiss Franc
    case CHF = 'CHF';
    //Chilean Unit of Account (UF)
    case CLF = 'CLF';
    //Chilean Peso
    case CLP = 'CLP';
    //Chinese Yuan
    case CNY = 'CNY';
    //Colombian Peso
    case COP = 'COP';
    //Costa Rican Colón
    case CRC = 'CRC';
    //Cuban Convertible Peso
    case CUC = 'CUC';
    //Cuban Peso
    case CUP = 'CUP';
    //Cape Verdean Escudo
    case CVE = 'CVE';
    //Czech Republic Koruna
    case CZK = 'CZK';
    //Djiboutian Franc
    case DJF = 'DJF';
    //Danish Krone
    case DKK = 'DKK';
    //Dominican Peso
    case DOP = 'DOP';
    //Algerian Dinar
    case DZD = 'DZD';
    //Egyptian Pound
    case EGP = 'EGP';
    //Eritrean Nakfa
    case ERN = 'ERN';
    //Ethiopian Birr
    case ETB = 'ETB';
    //Euro
    case EUR = 'EUR';
    //Fijian Dollar
    case FJD = 'FJD';
    //Falkland Islands Pound
    case FKP = 'FKP';
    //British Pound Sterling
    case GBP = 'GBP';
    //Georgian Lari
    case GEL = 'GEL';
    //Guernsey Pound
    case GGP = 'GGP';
    //Ghanaian Cedi
    case GHS = 'GHS';
    //Gibraltar Pound
    case GIP = 'GIP';
    //Gambian Dalasi
    case GMD = 'GMD';
    //Guinean Franc
    case GNF = 'GNF';
    //Guatemalan Quetzal
    case GTQ = 'GTQ';
    //Guyanaese Dollar
    case GYD = 'GYD';
    //Hong Kong Dollar
    case HKD = 'HKD';
    //Honduran Lempira
    case HNL = 'HNL';
    //Croatian Kuna
    case HRK = 'HRK';
    //Haitian Gourde
    case HTG = 'HTG';
    //Hungarian Forint
    case HUF = 'HUF';
    //Indonesian Rupiah
    case IDR = 'IDR';
    //Israeli New Sheqel
    case ILS = 'ILS';
    //Manx pound
    case IMP = 'IMP';
    //Indian Rupee
    case INR = 'INR';
    //Iraqi Dinar
    case IQD = 'IQD';
    //Iranian Rial
    case IRR = 'IRR';
    //Icelandic Króna
    case ISK = 'ISK';
    //Jersey Pound
    case JEP = 'JEP';
    //Jamaican Dollar
    case JMD = 'JMD';
    //Jordanian Dinar
    case JOD = 'JOD';
    //Japanese Yen
    case JPY = 'JPY';
    //Kenyan Shilling
    case KES = 'KES';
    //Kyrgystani Som
    case KGS = 'KGS';
    //Cambodian Riel
    case KHR = 'KHR';
    //Comorian Franc
    case KMF = 'KMF';
    //North Korean Won
    case KPW = 'KPW';
    //South Korean Won
    case KRW = 'KRW';
    //Kuwaiti Dinar
    case KWD = 'KWD';
    //Cayman Islands Dollar
    case KYD = 'KYD';
    //Kazakhstani Tenge
    case KZT = 'KZT';
    //Laotian Kip
    case LAK = 'LAK';
    //Lebanese Pound
    case LBP = 'LBP';
    //Sri Lankan Rupee
    case LKR = 'LKR';
    //Liberian Dollar
    case LRD = 'LRD';
    //Lesotho Loti
    case LSL = 'LSL';
    //Lithuanian Litas
    case LTL = 'LTL';
    //Latvian Lats
    case LVL = 'LVL';
    //Libyan Dinar
    case LYD = 'LYD';
    //Moroccan Dirham
    case MAD = 'MAD';
    //Moldovan Leu
    case MDL = 'MDL';
    //Malagasy Ariary
    case MGA = 'MGA';
    //Macedonian Denar
    case MKD = 'MKD';
    //Myanma Kyat
    case MMK = 'MMK';
    //Mongolian Tugrik
    case MNT = 'MNT';
    //Macanese Pataca
    case MOP = 'MOP';
    //Mauritanian Ouguiya
    case MRO = 'MRO';
    //Mauritian Rupee
    case MUR = 'MUR';
    //Maldivian Rufiyaa
    case MVR = 'MVR';
    //Malawian Kwacha
    case MWK = 'MWK';
    //Mexican Peso
    case MXN = 'MXN';
    //Malaysian Ringgit
    case MYR = 'MYR';
    //Mozambican Metical
    case MZN = 'MZN';
    //Namibian Dollar
    case NAD = 'NAD';
    //Nigerian Naira
    case NGN = 'NGN';
    //Nicaraguan Córdoba
    case NIO = 'NIO';
    //Norwegian Krone
    case NOK = 'NOK';
    //Nepalese Rupee
    case NPR = 'NPR';
    //New Zealand Dollar
    case NZD = 'NZD';
    //Omani Rial
    case OMR = 'OMR';
    //Panamanian Balboa
    case PAB = 'PAB';
    //Peruvian Nuevo Sol
    case PEN = 'PEN';
    //Papua New Guinean Kina
    case PGK = 'PGK';
    //Philippine Peso
    case PHP = 'PHP';
    //Pakistani Rupee
    case PKR = 'PKR';
    //Polish Zloty
    case PLN = 'PLN';
    //Paraguayan Guarani
    case PYG = 'PYG';
    //Qatari Rial
    case QAR = 'QAR';
    //Romanian Leu
    case RON = 'RON';
    //Serbian Dinar
    case RSD = 'RSD';
    //Russian Ruble
    case RUB = 'RUB';
    //Rwandan Franc
    case RWF = 'RWF';
    //Saudi Riyal
    case SAR = 'SAR';
    //Solomon Islands Dollar
    case SBD = 'SBD';
    //Seychellois Rupee
    case SCR = 'SCR';
    //Sudanese Pound
    case SDG = 'SDG';
    //Swedish Krona
    case SEK = 'SEK';
    //Singapore Dollar
    case SGD = 'SGD';
    //Saint Helena Pound
    case SHP = 'SHP';
    //Sierra Leonean Leone
    case SLE = 'SLE';
    //Sierra Leonean Leone
    case SLL = 'SLL';
    //Somali Shilling
    case SOS = 'SOS';
    //Surinamese Dollar
    case SRD = 'SRD';
    //South Sudanese Pound
    case SSP = 'SSP';
    //São Tomé and Príncipe Dobra
    case STD = 'STD';
    //Salvadoran Colón
    case SVC = 'SVC';
    //Syrian Pound
    case SYP = 'SYP';
    //Swazi Lilangeni
    case SZL = 'SZL';
    //Thai Baht
    case THB = 'THB';
    //Tajikistani Somoni
    case TJS = 'TJS';
    //Turkmenistani Manat
    case TMT = 'TMT';
    //Tunisian Dinar
    case TND = 'TND';
    //Tongan Paʻanga
    case TOP = 'TOP';
    //Turkish Lira
    case TRY = 'TRY';
    //Trinidad and Tobago Dollar
    case TTD = 'TTD';
    //New Taiwan Dollar
    case TWD = 'TWD';
    //Tanzanian Shilling
    case TZS = 'TZS';
    //Ukrainian Hryvnia
    case UAH = 'UAH';
    //Ugandan Shilling
    case UGX = 'UGX';
    //United States Dollar
    case USD = 'USD';
    //Uruguayan Peso
    case UYU = 'UYU';
    //Uzbekistan Som
    case UZS = 'UZS';
    //Venezuelan Bolívar Fuerte
    case VEF = 'VEF';
    //Sovereign Bolivar
    case VES = 'VES';
    //Vietnamese Dong
    case VND = 'VND';
    //Vanuatu Vatu
    case VUV = 'VUV';
    //Samoan Tala
    case WST = 'WST';
    //CFA Franc BEAC
    case XAF = 'XAF';
    //Silver (troy ounce)
    case XAG = 'XAG';
    //Gold (troy ounce)
    case XAU = 'XAU';
    //East Caribbean Dollar
    case XCD = 'XCD';
    //Special Drawing Rights
    case XDR = 'XDR';
    //CFA Franc BCEAO
    case XOF = 'XOF';
    //CFP Franc
    case XPF = 'XPF';
    //Yemeni Rial
    case YER = 'YER';
    //South African Rand
    case ZAR = 'ZAR';
    //Zambian Kwacha (pre-2013)
    case ZMK = 'ZMK';
    //Zambian Kwacha
    case ZMW = 'ZMW';
    //Zimbabwean Dollar
    case ZWL = 'ZWL';
}
