
<?php

include('controlSesion.php');
require('bd.php');


include('includes/parametros.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es"/>
<title>Inmuebles a la venta y arriendo en colombia, todo en finca raiz</title>
<meta property="fb:admins" content="100005082218469">
<meta property="fb:app_id" content="1435079113381937">
<meta property="og:url" content="http://www.inmueblealaventa.com/">
<meta property="og:title" content="inmuebles a la venta, apartamentos y casas en venta y arriendo y finca raiz">
<meta property="og:description" content="inmuebles a la arriendo y venta en colombia encuentre apartamentos, casas, fincas y todo tipo de inmuebles en venta y arriendo en inmueble a la venta">
<meta property="og:type" content="website">
<meta property="og:image" content="http://www.inmueblealaventa.com/imagenes/logo.png">
<meta name="description" content="inmuebles a la venta y arriendo en colombia, encuentre la mayor oferta de apartamentos, casas, oficinas y todo tipo de inmuebles en inmueble a la venta, con informacion  completa sobre cada inmueble">
<meta name="keywords" content="apartamentos en venta y arriendo en colombia, apartamentos en arriendo, venta de casas en colombia, inmuebles a la venta, arriendo de apartamentos y casas,venta y arriendo de finca raiz, apartamentos, casas, oficinas, venta de fincas en colombia, apartamentos en bogota">
<meta name="viewport" content="width=device-width, initial-scale=0.75">
<link rel="stylesheet" type="text/css" href="css/jqueryui/jquery-ui-1.8.18.custom.css"/>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/jflow.style.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="css/nuevos-estilos.css"/>
<link rel="stylesheet" type="text/css" href="funciones/style.css"/>
<link rel="stylesheet" type="text/css" href="css/gomo_style.css"/>


<meta name="google-site-verification" content="KdMlrsCQaAVTbzW95l4fnJ4sqO6F3L4elb0SPbbmzWw" />
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
  <script src="assets/js/cycle.js"></script>

<script type="text/javascript" src="TABS.js"></script>
<script type="text/javascript" src="js/pestanas/js/tabs.js"></script>




<script src="funciones/script_cajas.js" type="text/javascript"></script>
<script  type="text/javascript">

	/*function enviar()
	{
					var concatenar="";
					
					var tipoInmueble=$("#tipoInmueble").val();
					var ciudad=$("#idciudad").val();
					var precio=$("#precio").val();
					var area=$("#area").val();
					var codigo=$("#codigo").val();
					
					if (tipoinmueble=="")
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&tipoInmueble="+tipoInmueble
					}
					
					
					if (ciudad=="")
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&ciudad="+ciudad
					}
				
					
					
					
					//location.href="propiedades.php?para=1";
					location.href="propiedades.php?para=1&tipoInmueble="+tipoInmueble+"&ciudad="+ciudad+"&area="+area+"&precio="+precio+"&codigo="+codigo;

	}*/


    
    
    
    </script>



</head>

<body>
<?php include_once("analyticstracking.php"); ?>
<?php
   $ips ='<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:pingdom="http://www.pingdom.com/ns/PingdomRSSNamespace">
    <channel>
        <title>Probe servers</title>
        <link>http://www.pingdom.com</link>
        <description>These are the servers that we use to check your site. You can use the IP numbers to open up for them in your firewall.</description>
        <language>en</language>
        <lastBuildDate>Thu, 20 Mar 2014 22:19:32 +0100</lastBuildDate>
        <docs>http://cyber.law.harvard.edu/rss/rss.html</docs>
        <atom:link href="https://my.pingdom.com/probes/feed" rel="self" type="application/rss+xml" />

                            <item>
                <guid isPermaLink="false">pingdom-probe-86</guid>
                <title>Milan 2, Italy</title>
                <description>IP: 95.141.32.46; Hostname: s470.pingdom.com; State: Active; Country: Italy; City: Milan</description>
                <pingdom:ip>95.141.32.46</pingdom:ip>
                <pingdom:hostname>s470.pingdom.com</pingdom:hostname>
                <pingdom:country code="IT">Italy</pingdom:country>
                <pingdom:city>Milan</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-85</guid>
                <title>Amsterdam, Netherlands</title>
                <description>IP: 95.211.217.68; Hostname: s469.pingdom.com; State: Active; Country: Netherlands; City: Amsterdam</description>
                <pingdom:ip>95.211.217.68</pingdom:ip>
                <pingdom:hostname>s469.pingdom.com</pingdom:hostname>
                <pingdom:country code="NL">Netherlands</pingdom:country>
                <pingdom:city>Amsterdam</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-84</guid>
                <title>Leiria, Portugal</title>
                <description>IP: 91.109.115.41; Hostname: s468.pingdom.com; State: Active; Country: Portugal; City: Leiria</description>
                <pingdom:ip>91.109.115.41</pingdom:ip>
                <pingdom:hostname>s468.pingdom.com</pingdom:hostname>
                <pingdom:country code="PT">Portugal</pingdom:country>
                <pingdom:city>Leiria</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-83</guid>
                <title>London, UK</title>
                <description>IP: 83.170.113.210; Hostname: s466.pingdom.com; State: Active; Country: United Kingdom; City: London</description>
                <pingdom:ip>83.170.113.210</pingdom:ip>
                <pingdom:hostname>s466.pingdom.com</pingdom:hostname>
                <pingdom:country code="GB">United Kingdom</pingdom:country>
                <pingdom:city>London</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-82</guid>
                <title>Strasbourg 4, France</title>
                <description>IP: 188.138.118.144; Hostname: s465.pingdom.com; State: Active; Country: France; City: Strasbourg</description>
                <pingdom:ip>188.138.118.144</pingdom:ip>
                <pingdom:hostname>s465.pingdom.com</pingdom:hostname>
                <pingdom:country code="FR">France</pingdom:country>
                <pingdom:city>Strasbourg</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-81</guid>
                <title>Charlotte 2, NC</title>
                <description>IP: 174.34.224.167; Hostname: s464.pingdom.com; State: Inactive; Country: United States; City: Charlotte</description>
                <pingdom:ip>174.34.224.167</pingdom:ip>
                <pingdom:hostname>s464.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Charlotte</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-80</guid>
                <title>Las Vegas 5, NV</title>
                <description>IP: 72.46.140.106; Hostname: s462.pingdom.com; State: Active; Country: United States; City: Las Vegas</description>
                <pingdom:ip>72.46.140.106</pingdom:ip>
                <pingdom:hostname>s462.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Las Vegas</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-79</guid>
                <title>Philadelphia 2, PA</title>
                <description>IP: 76.72.172.208; Hostname: s460.pingdom.com; State: Active; Country: United States; City: Philadelphia</description>
                <pingdom:ip>76.72.172.208</pingdom:ip>
                <pingdom:hostname>s460.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Philadelphia</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-78</guid>
                <title>Toronto 5, Canada</title>
                <description>IP: 184.75.210.226; Hostname: s459.pingdom.com; State: Active; Country: Canada; City: Toronto</description>
                <pingdom:ip>184.75.210.226</pingdom:ip>
                <pingdom:hostname>s459.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Toronto</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-77</guid>
                <title>Paris, France</title>
                <description>IP: 78.40.124.16; Hostname: s458.pingdom.com; State: Active; Country: France; City: Paris</description>
                <pingdom:ip>78.40.124.16</pingdom:ip>
                <pingdom:hostname>s458.pingdom.com</pingdom:hostname>
                <pingdom:country code="FR">France</pingdom:country>
                <pingdom:city>Paris</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-76</guid>
                <title>Montreal, Canada</title>
                <description>IP: 67.205.67.76; Hostname: s457.pingdom.com; State: Active; Country: Canada; City: Montreal</description>
                <pingdom:ip>67.205.67.76</pingdom:ip>
                <pingdom:hostname>s457.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Montreal</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-75</guid>
                <title>Strasbourg 2, France</title>
                <description>IP: 188.138.118.184; Hostname: s456.pingdom.com; State: Active; Country: France; City: Strasbourg</description>
                <pingdom:ip>188.138.118.184</pingdom:ip>
                <pingdom:hostname>s456.pingdom.com</pingdom:hostname>
                <pingdom:country code="FR">France</pingdom:country>
                <pingdom:city>Strasbourg</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-74</guid>
                <title>Strasbourg 3, France</title>
                <description>IP: 188.138.124.110; Hostname: s455.pingdom.com; State: Active; Country: France; City: Strasbourg</description>
                <pingdom:ip>188.138.124.110</pingdom:ip>
                <pingdom:hostname>s455.pingdom.com</pingdom:hostname>
                <pingdom:country code="FR">France</pingdom:country>
                <pingdom:city>Strasbourg</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-73</guid>
                <title>Amsterdam 5, Netherlands</title>
                <description>IP: 85.17.156.99; Hostname: s454.pingdom.com; State: Active; Country: Netherlands; City: Amsterdam</description>
                <pingdom:ip>85.17.156.99</pingdom:ip>
                <pingdom:hostname>s454.pingdom.com</pingdom:hostname>
                <pingdom:country code="NL">Netherlands</pingdom:country>
                <pingdom:city>Amsterdam</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-72</guid>
                <title>Amsterdam 4, Netherlands</title>
                <description>IP: 85.17.156.11; Hostname: s453.pingdom.com; State: Active; Country: Netherlands; City: Amsterdam</description>
                <pingdom:ip>85.17.156.11</pingdom:ip>
                <pingdom:hostname>s453.pingdom.com</pingdom:hostname>
                <pingdom:country code="NL">Netherlands</pingdom:country>
                <pingdom:city>Amsterdam</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-71</guid>
                <title>Amsterdam 3, Netherlands</title>
                <description>IP: 85.17.156.76; Hostname: s452.pingdom.com; State: Active; Country: Netherlands; City: Amsterdam</description>
                <pingdom:ip>85.17.156.76</pingdom:ip>
                <pingdom:hostname>s452.pingdom.com</pingdom:hostname>
                <pingdom:country code="NL">Netherlands</pingdom:country>
                <pingdom:city>Amsterdam</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-70</guid>
                <title>Las Vegas 4, NV</title>
                <description>IP: 72.46.153.26; Hostname: s451.pingdom.com; State: Active; Country: United States; City: Las Vegas</description>
                <pingdom:ip>72.46.153.26</pingdom:ip>
                <pingdom:hostname>s451.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Las Vegas</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-69</guid>
                <title>Las Vegas 3, NV</title>
                <description>IP: 208.64.28.194; Hostname: s450.pingdom.com; State: Active; Country: United States; City: Las Vegas</description>
                <pingdom:ip>208.64.28.194</pingdom:ip>
                <pingdom:hostname>s450.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Las Vegas</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-68</guid>
                <title>Las Vegas 2, NV</title>
                <description>IP: 76.164.194.74; Hostname: s449.pingdom.com; State: Active; Country: United States; City: Las Vegas</description>
                <pingdom:ip>76.164.194.74</pingdom:ip>
                <pingdom:hostname>s449.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Las Vegas</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-67</guid>
                <title>Toronto 4, Canada</title>
                <description>IP: 184.75.210.90; Hostname: s448.pingdom.com; State: Active; Country: Canada; City: Toronto</description>
                <pingdom:ip>184.75.210.90</pingdom:ip>
                <pingdom:hostname>s448.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Toronto</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-66</guid>
                <title>Toronto 3, Canada</title>
                <description>IP: 184.75.208.210; Hostname: s447.pingdom.com; State: Active; Country: Canada; City: Toronto</description>
                <pingdom:ip>184.75.208.210</pingdom:ip>
                <pingdom:hostname>s447.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Toronto</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-65</guid>
                <title>Toronto 2, Canada</title>
                <description>IP: 184.75.209.18; Hostname: s446.pingdom.com; State: Active; Country: Canada; City: Toronto</description>
                <pingdom:ip>184.75.209.18</pingdom:ip>
                <pingdom:hostname>s446.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Toronto</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-64</guid>
                <title>Frankfurt 2, Germany</title>
                <description>IP: 46.165.195.139; Hostname: s445.pingdom.com; State: Active; Country: Germany; City: Frankfurt</description>
                <pingdom:ip>46.165.195.139</pingdom:ip>
                <pingdom:hostname>s445.pingdom.com</pingdom:hostname>
                <pingdom:country code="DE">Germany</pingdom:country>
                <pingdom:city>Frankfurt</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-63</guid>
                <title>Portland, OR</title>
                <description>IP: 199.87.228.66; Hostname: s444.pingdom.com; State: Active; Country: United States; City: Portland</description>
                <pingdom:ip>199.87.228.66</pingdom:ip>
                <pingdom:hostname>s444.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Portland</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-62</guid>
                <title>Philadelphia, PA</title>
                <description>IP: 76.72.167.90; Hostname: s443.pingdom.com; State: Active; Country: United States; City: Philadelphia</description>
                <pingdom:ip>76.72.167.90</pingdom:ip>
                <pingdom:hostname>s443.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Philadelphia</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-61</guid>
                <title>Falkenberg, Sweden</title>
                <description>IP: 94.247.174.83; Hostname: s442.pingdom.com; State: Active; Country: Sweden; City: Falkenberg</description>
                <pingdom:ip>94.247.174.83</pingdom:ip>
                <pingdom:hostname>s442.pingdom.com</pingdom:hostname>
                <pingdom:country code="SE">Sweden</pingdom:country>
                <pingdom:city>Falkenberg</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-60</guid>
                <title>St. Louis, MO</title>
                <description>IP: 69.64.56.47; Hostname: s441.pingdom.com; State: Inactive; Country: United States; City: St. Louis</description>
                <pingdom:ip>69.64.56.47</pingdom:ip>
                <pingdom:hostname>s441.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>St. Louis</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-59</guid>
                <title>Roubaix, France</title>
                <description>IP: 176.31.228.137; Hostname: s440.pingdom.com; State: Active; Country: France; City: Roubaix</description>
                <pingdom:ip>176.31.228.137</pingdom:ip>
                <pingdom:hostname>s440.pingdom.com</pingdom:hostname>
                <pingdom:country code="FR">France</pingdom:country>
                <pingdom:city>Roubaix</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-58</guid>
                <title>Toronto, Canada</title>
                <description>IP: 184.75.210.186; Hostname: s439.pingdom.com; State: Active; Country: Canada; City: Toronto</description>
                <pingdom:ip>184.75.210.186</pingdom:ip>
                <pingdom:hostname>s439.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Toronto</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-57</guid>
                <title>Phoenix, AZ</title>
                <description>IP: 108.62.115.226; Hostname: s435.pingdom.com; State: Active; Country: United States; City: Phoenix</description>
                <pingdom:ip>108.62.115.226</pingdom:ip>
                <pingdom:hostname>s435.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Phoenix</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-56</guid>
                <title>Lisbon, Portugal</title>
                <description>IP: 94.46.4.1; Hostname: s434.pingdom.com; State: Active; Country: Portugal; City: Lisbon</description>
                <pingdom:ip>94.46.4.1</pingdom:ip>
                <pingdom:hostname>s434.pingdom.com</pingdom:hostname>
                <pingdom:country code="PT">Portugal</pingdom:country>
                <pingdom:city>Lisbon</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-55</guid>
                <title>Dusseldorf, Germany</title>
                <description>IP: 46.20.45.18; Hostname: s433.pingdom.com; State: Active; Country: Germany; City: Dusseldorf</description>
                <pingdom:ip>46.20.45.18</pingdom:ip>
                <pingdom:hostname>s433.pingdom.com</pingdom:hostname>
                <pingdom:country code="DE">Germany</pingdom:country>
                <pingdom:city>Dusseldorf</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-54</guid>
                <title>San Jose, CA</title>
                <description>IP: 50.23.94.74; Hostname: s432.pingdom.com; State: Active; Country: United States; City: San Jose</description>
                <pingdom:ip>50.23.94.74</pingdom:ip>
                <pingdom:hostname>s432.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>San Jose</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-53</guid>
                <title>Calgary, Canada</title>
                <description>IP: 64.141.100.136; Hostname: s431.pingdom.com; State: Inactive; Country: Canada; City: Calgary</description>
                <pingdom:ip>64.141.100.136</pingdom:ip>
                <pingdom:hostname>s431.pingdom.com</pingdom:hostname>
                <pingdom:country code="CA">Canada</pingdom:country>
                <pingdom:city>Calgary</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-52</guid>
                <title>Charlotte, NC</title>
                <description>IP: 69.59.28.19; Hostname: s430.pingdom.com; State: Active; Country: United States; City: Charlotte</description>
                <pingdom:ip>69.59.28.19</pingdom:ip>
                <pingdom:hostname>s430.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Charlotte</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-51</guid>
                <title>Prague, Czech Republic</title>
                <description>IP: 178.255.154.2; Hostname: s429.pingdom.com; State: Active; Country: Czech Republic; City: Prague</description>
                <pingdom:ip>178.255.154.2</pingdom:ip>
                <pingdom:hostname>s429.pingdom.com</pingdom:hostname>
                <pingdom:country code="CZ">Czech Republic</pingdom:country>
                <pingdom:city>Prague</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-50</guid>
                <title>Zurich, Switzerland</title>
                <description>IP: 178.255.153.2; Hostname: s428.pingdom.com; State: Active; Country: Switzerland; City: Zurich</description>
                <pingdom:ip>178.255.153.2</pingdom:ip>
                <pingdom:hostname>s428.pingdom.com</pingdom:hostname>
                <pingdom:country code="CH">Switzerland</pingdom:country>
                <pingdom:city>Zurich</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-49</guid>
                <title>Milan, Italy</title>
                <description>IP: 178.255.155.2; Hostname: s427.pingdom.com; State: Active; Country: Italy; City: Milan</description>
                <pingdom:ip>178.255.155.2</pingdom:ip>
                <pingdom:hostname>s427.pingdom.com</pingdom:hostname>
                <pingdom:country code="IT">Italy</pingdom:country>
                <pingdom:city>Milan</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-48</guid>
                <title>Newark, NJ</title>
                <description>IP: 64.237.55.3; Hostname: s426.pingdom.com; State: Active; Country: United States; City: Newark</description>
                <pingdom:ip>64.237.55.3</pingdom:ip>
                <pingdom:hostname>s426.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Newark</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-47</guid>
                <title>Vienna, Austria</title>
                <description>IP: 178.255.152.2; Hostname: s425.pingdom.com; State: Active; Country: Austria; City: Vienna</description>
                <pingdom:ip>178.255.152.2</pingdom:ip>
                <pingdom:hostname>s425.pingdom.com</pingdom:hostname>
                <pingdom:country code="AT">Austria</pingdom:country>
                <pingdom:city>Vienna</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-46</guid>
                <title>Manchester, UK</title>
                <description>IP: 212.84.74.156; Hostname: s424.pingdom.com; State: Inactive; Country: United Kingdom; City: Manchester</description>
                <pingdom:ip>212.84.74.156</pingdom:ip>
                <pingdom:hostname>s424.pingdom.com</pingdom:hostname>
                <pingdom:country code="GB">United Kingdom</pingdom:country>
                <pingdom:city>Manchester</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-44</guid>
                <title>San Francisco, CA</title>
                <description>IP: 173.204.85.217; Hostname: s422.pingdom.com; State: Inactive; Country: United States; City: San Francisco</description>
                <pingdom:ip>173.204.85.217</pingdom:ip>
                <pingdom:hostname>s422.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>San Francisco</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-43</guid>
                <title>Denver, CO</title>
                <description>IP: 173.248.147.18; Hostname: s421.pingdom.com; State: Active; Country: United States; City: Denver</description>
                <pingdom:ip>173.248.147.18</pingdom:ip>
                <pingdom:hostname>s421.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Denver</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-42</guid>
                <title>Las Vegas, NV</title>
                <description>IP: 72.46.130.42; Hostname: s420.pingdom.com; State: Active; Country: United States; City: Las Vegas</description>
                <pingdom:ip>72.46.130.42</pingdom:ip>
                <pingdom:hostname>s420.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Las Vegas</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-41</guid>
                <title>Madrid, Spain</title>
                <description>IP: 94.46.240.121; Hostname: s419.pingdom.com; State: Active; Country: Spain; City: Madrid</description>
                <pingdom:ip>94.46.240.121</pingdom:ip>
                <pingdom:hostname>s419.pingdom.com</pingdom:hostname>
                <pingdom:country code="ES">Spain</pingdom:country>
                <pingdom:city>Madrid</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-40</guid>
                <title>Washington, DC</title>
                <description>IP: 208.43.68.59; Hostname: s418.pingdom.com; State: Active; Country: United States; City: Washington</description>
                <pingdom:ip>208.43.68.59</pingdom:ip>
                <pingdom:hostname>s418.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Washington</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-39</guid>
                <title>Seattle, WA</title>
                <description>IP: 67.228.213.178; Hostname: s417.pingdom.com; State: Inactive; Country: United States; City: Seattle</description>
                <pingdom:ip>67.228.213.178</pingdom:ip>
                <pingdom:hostname>s417.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Seattle</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-38</guid>
                <title>Tampa, FL</title>
                <description>IP: 96.31.66.245; Hostname: s415.pingdom.com; State: Inactive; Country: United States; City: Tampa</description>
                <pingdom:ip>96.31.66.245</pingdom:ip>
                <pingdom:hostname>s415.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Tampa</pingdom:city>
                <pingdom:state>Inactive</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-37</guid>
                <title>Copenhagen, Denmark</title>
                <description>IP: 82.103.128.63; Hostname: s416.pingdom.com; State: Active; Country: Denmark; City: Copenhagen</description>
                <pingdom:ip>82.103.128.63</pingdom:ip>
                <pingdom:hostname>s416.pingdom.com</pingdom:hostname>
                <pingdom:country code="DK">Denmark</pingdom:country>
                <pingdom:city>Copenhagen</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-36</guid>
                <title>Chicago, IL</title>
                <description>IP: 174.34.156.130; Hostname: s414.pingdom.com; State: Active; Country: United States; City: Chicago</description>
                <pingdom:ip>174.34.156.130</pingdom:ip>
                <pingdom:hostname>s414.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Chicago</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-35</guid>
                <title>New York, NY</title>
                <description>IP: 70.32.40.2; Hostname: s413.pingdom.com; State: Active; Country: United States; City: New York</description>
                <pingdom:ip>70.32.40.2</pingdom:ip>
                <pingdom:hostname>s413.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>New York</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-34</guid>
                <title>Atlanta, GA</title>
                <description>IP: 174.34.162.242; Hostname: s412.pingdom.com; State: Active; Country: United States; City: Atlanta</description>
                <pingdom:ip>174.34.162.242</pingdom:ip>
                <pingdom:hostname>s412.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Atlanta</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-33</guid>
                <title>Strasbourg, France</title>
                <description>IP: 85.25.176.167; Hostname: s411.pingdom.com; State: Active; Country: France; City: Strasbourg</description>
                <pingdom:ip>85.25.176.167</pingdom:ip>
                <pingdom:hostname>s411.pingdom.com</pingdom:hostname>
                <pingdom:country code="FR">France</pingdom:country>
                <pingdom:city>Strasbourg</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-32</guid>
                <title>Los Angeles, CA</title>
                <description>IP: 204.152.200.42; Hostname: s410.pingdom.com; State: Active; Country: United States; City: Los Angeles</description>
                <pingdom:ip>204.152.200.42</pingdom:ip>
                <pingdom:hostname>s410.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">United States</pingdom:country>
                <pingdom:city>Los Angeles</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-28</guid>
                <title>Amsterdam 2, Netherlands</title>
                <description>IP: 95.211.87.85; Hostname: s406.pingdom.com; State: Active; Country: Netherlands; City: Amsterdam</description>
                <pingdom:ip>95.211.87.85</pingdom:ip>
                <pingdom:hostname>s406.pingdom.com</pingdom:hostname>
                <pingdom:country code="NL">Netherlands</pingdom:country>
                <pingdom:city>Amsterdam</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-6</guid>
                <title>Seattle</title>
                <description>IP: 64.120.6.122; Hostname: s461.pingdom.com; State: Active; Country: USA; City: Seattle</description>
                <pingdom:ip>64.120.6.122</pingdom:ip>
                <pingdom:hostname>s461.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">USA</pingdom:country>
                <pingdom:city>Seattle</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-5</guid>
                <title>Milan</title>
                <description>IP: 158.58.173.160; Hostname: s471.pingdom.com; State: Active; Country: Italy; City: Milan</description>
                <pingdom:ip>158.58.173.160</pingdom:ip>
                <pingdom:hostname>s471.pingdom.com</pingdom:hostname>
                <pingdom:country code="IT">Italy</pingdom:country>
                <pingdom:city>Milan</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-4</guid>
                <title>Philadelphia</title>
                <description>IP: 76.72.171.180; Hostname: s477.pingdom.com; State: Active; Country: USA; City: Philadelphia</description>
                <pingdom:ip>76.72.171.180</pingdom:ip>
                <pingdom:hostname>s477.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">USA</pingdom:country>
                <pingdom:city>Philadelphia</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-3</guid>
                <title>Las Vegas</title>
                <description>IP: 72.46.140.186; Hostname: s476.pingdom.com; State: Active; Country: USA; City: Las Vegas</description>
                <pingdom:ip>72.46.140.186</pingdom:ip>
                <pingdom:hostname>s476.pingdom.com</pingdom:hostname>
                <pingdom:country code="US">USA</pingdom:country>
                <pingdom:city>Las Vegas</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-2</guid>
                <title>Düsseldorf</title>
                <description>IP: 78.31.69.179; Hostname: s475.pingdom.com; State: Active; Country: Germany; City: Düsseldorf</description>
                <pingdom:ip>78.31.69.179</pingdom:ip>
                <pingdom:hostname>s475.pingdom.com</pingdom:hostname>
                <pingdom:country code="DE">Germany</pingdom:country>
                <pingdom:city>Düsseldorf</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
                    <item>
                <guid isPermaLink="false">pingdom-probe-1</guid>
                <title>Amsterdam</title>
                <description>IP: 95.211.198.87; Hostname: s474.pingdom.com; State: Active; Country: Netherlands; City: Amsterdam</description>
                <pingdom:ip>95.211.198.87</pingdom:ip>
                <pingdom:hostname>s474.pingdom.com</pingdom:hostname>
                <pingdom:country code="NL">Netherlands</pingdom:country>
                <pingdom:city>Amsterdam</pingdom:city>
                <pingdom:state>Active</pingdom:state>
            </item>
        
    </channel>
</rss>';

    if(preg_match("/" . str_replace(".","\.",$_SERVER["REMOTE_ADDR"]) ."/", $ips))
         die;

  ?>
<section>
	<?php  include("cabezote.php");?>
    <div class="barraMenu">
    	<div class="contenedor" align="left"><?php include('menu.php');?></div>
    </div>
</section>
<div class="centrado" id="contenedor1">
    <div class="lineatiempo"><h1>Apartamentos en Colombia | Venta y Arriendo de inmuebles en Colombia</h1></div>

<div class="containerpestasupe">
        	<ul class="pestamenusupe">
            	<li id="venta" class="activesup" data-type="ventas" data-tab>Venta </li>
                <li id="arriendo" data-type="arriendos" data-tab>Arriendo </li>               
            </ul>
            <span class="clear"></span>
            <div class="contenidopestasup venta">
               <div class="buscador">
                <form name="buscarventa" id="buscarventa"  action="#">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="33%" align="center"><label for="select"></label>
              <span>
                <select name="tipoInmueble" id="tipoInmoeble"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                  <option value="">- Tipo de inmueble -</option>
                <option value="0">Cualquiera</option>
                <?php
                $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
                $resultado = mysql_query($consulta, $conexion);
                
                while ($registro= mysql_fetch_array($resultado))
                {
                ?>
                <option value="<?php echo $registro["tip_inm"]?>"> <?php echo $registro["dest_tip"]?> </option>
                <?php
                }
                ?>
              </select>
              </span></td>
              <td width="33%" align="center"><label for="select2"></label>
                    <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
    
              <script type="text/javascript" src="funciones/script.js"></script>
            <span> <input type="text"  name="ciudad" id="ciudad" placeholder="Ciudad"></span><img src="funciones/loading.gif" id="loading"  alt="" />
             <input type="hidden"  name="idciudad" id="idciudad" >
             <div id="ajax_response"></div>  
            
               
        
             </td>
              <td width="33%" align="center"><label for="precio"></label>
                         <span>
                <select name="precio" id="precio"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                  
             
             
              </select>
              </span></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><label for="select4"></label>
              <span>
                <select name="area" id="area"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
                  
                <option value="0">- Area -</option>
                <?php
                $consulta = "SELECT idarea , areaini,  areafin , areadesc  FROM area ORDER BY areaini ASC";	
                $resultado = mysql_query($consulta, $conexion);
               
                while ($registro= mysql_fetch_array($resultado))
                {
                ?>
                <option value="<?php echo $registro["idarea"]?>"> <?php echo $registro["areadesc"]?> </option>
                <?php
                }
                ?>
              </select>
              </span></td>
              <td align="center"><label for="codigo"></label>
              <span>
                <input name="codigo" type="text" id="codigo" placeholder="C&oacute;digo"   />
              </span></td>
              <td align="center"><button class="submit_searcher"></button></td>
            </tr>
          </table>
        </form>
    
                
                </div>
    		</div>
            
            <div class="contenidopestasup arriendo"  style="display:none">
            <div class="buscador">
          		 <form name="buscararriendo" id="buscararriendo"  action="#">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33%" align="center"><label for="select"></label>
          <span>
            <select name="tipoInmueble" id="tipoInmueble"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
              <option value="">- Tipo de inmueble -</option>
            <option value="0">Cualquiera</option>
            <?php
            $consulta = "SELECT * FROM tipo_in ORDER BY dest_tip ASC";	
            $resultado = mysql_query($consulta, $conexion);
            
            while ($registro= mysql_fetch_array($resultado))
            {
            ?>
            <option value="<?php echo $registro["tip_inm"]?>"> <?php echo $registro["dest_tip"]?> </option>
            <?php
            }
            ?>
          </select>
          </span></td>
          <td width="33%" align="center"><label for="select2"></label>
                <script type="text/javascript" src="js/jquery-1.7.2.js"></script>

          <script type="text/javascript" src="funciones/script.js"></script>
		<span> <input type="text"  name="ciudadarr" id="ciudadarr" placeholder="Ciudad"></span><img src="funciones/loading.gif" id="loading" alt="" />
		 <input type="hidden"  name="idciudadarr" id="idciudadarr" >
		 <div id="ajax_responsearr" ></div>  
        
           
  	
         </td>
          <td width="33%" align="center"><label for="precio"></label>
                     <span>
            <select name="precio" id="precio"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
              
            <option value="0">- Precio -</option>
            <?php
            $consulta = "SELECT idpre , preini,  preini , predesc  FROM precio ORDER BY preini ASC";	
            $resultado = mysql_query($consulta, $conexion);
           
            while ($registro= mysql_fetch_array($resultado))
            {
            ?>
            <option value="<?php echo $registro["idpre"]?>"> <?php echo $registro["predesc"]?> </option>
            <?php
            }
            ?>
          </select>
          </span></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><label for="select4"></label>
          <span>
            <select name="area" id="area"  class="validate[required]" data-errormessage-value-missing="Campo obligatorio">
              
            <option value="0">- Area -</option>
            <?php
            $consulta = "SELECT idarea , areaini,  areafin , areadesc  FROM area ORDER BY areaini ASC";	
            $resultado = mysql_query($consulta, $conexion);
         
            while ($registro= mysql_fetch_array($resultado))
            {
            ?>
            <option value="<?php echo $registro["idarea"]?>"> <?php echo $registro["areadesc"]?> </option>
            <?php
            }
            ?>
          </select>
          </span></td>
          <td align="center"><label for="codigo"></label>
          <span>
            <input name="codigo" type="text" id="codigo" placeholder="C&oacute;digo"   />
          </span></td>
          <td align="center"><img  name="button" onclick="enviar(2)" id="button" src="imagenes/btmBuscar.png" style="cursor:pointer" alt="" /></td>
        </tr>
      </table>
   	</form>

            
			</div>
    		</div>
            
            
            
            
    	</div>

<section style="overflow:hidden">
  <div style="clear:left; padding-top:0px;" class="contenedor">
    	<!-- Div 1 -->
        <div style="float:left; margin-right:27px;"><iframe width="315" height="233" src="http://www.youtube.com/embed/ikkvemPCJTk?rel=0" frameborder="0" allowfullscreen></iframe></div>
        
        <!-- Div 2 -->
        <?php //include('bannerInferior.php')?>
        <?php
		$consulta_banner="SELECT * FROM banner WHERE posicion = 1 AND estado = 1 ORDER BY fecha DESC limit 0,1"; 
		$resultado_banner=mysql_query($consulta_banner,$conexion);
		$num_banner = mysql_num_rows($resultado_banner);
		$registro_banner=mysql_fetch_array($resultado_banner);
		$archivo = $registro_banner['archivo'];
		if($registro_banner['link'] != '')
			$link = $registro_banner['link'];
			else
				$link = '#';
		
		if($num_banner != 0)
		{
		?>
   	<div style="float:left; margin-right:27px; width:315px; height:233px"><a href="<?php echo $link?>" <?php if($link != '#') { echo "target='_blank'"; }?>><img src="banner/<?php echo $archivo?>" width="315" height="233" border="0" alt="" /></a></div>
        <?php
		}
		else
		{
		?>
        	<div style="float:left; margin-right:20px; width:315px; height:233px"><a href="planes.php"><img src="imagenes/bannerCasa.jpg" width="315" height="233" alt="" /></a></div>
        <?php
		}
		?>
    <!-- Div 3 -->
        <div style="float:left; width:315px; margin:0px 0px;  background:#F1F1F1;  height:233px; position: relative;">
          
<div >

				    <ul id="slidebox" style="width: 100% !important; margin-left: -41px !important;position: relative; margin: 0;top: 0;">
    	
        				
                        <li>
							<a href="#"   onclick="parametrosgaleria(1,'524')" ><img class="portfolio_image" src="gallery/bogota.png" alt=""   /></a>
						
						<P class="flex-caption">Venta y Arriendo de inmuebles en Bogotá</p></li>
                        
                        <li>
							<a href="#"  onclick="parametrosgaleria(2,'145')"  ><img class="portfolio_image" src="gallery/barranquilla.png" alt="" /></a>
						
		                <P class="flex-caption">Venta de inmuebles en Barranquilla</p></li>
                        
                        

						<li>
							<a href="#"  onclick="parametrosgaleria(2,'1071')"><img class="portfolio_image" src="gallery/cali.png" alt="" /></a>
						
						<P class="flex-caption">Arriendo de inmuebles en Cali</p></li>

                        <li>
							<a href="#"  onclick="parametrosgaleria(1,'176')" ><img class="portfolio_image" src="gallery/cartagena.png" alt="" /></a>
						
						<P class="flex-caption">Venta y Arriendo de inmuebles en Cartagena </p></li>
                        
                         <li>
							<a href="#"   onclick="parametrosgaleria(1,'842')" ><img class="portfolio_image" src="gallery/medellin.png" alt="" /></a>
						
						<P class="flex-caption">Venta y Arriendo de inmuebles en Medellin </p></li>

											
					</li>

	</ul>
</div>
  
          
  		</div>
  </div>
</section>

<section>
  <div class="centrado">
  
  
    
   	  <ul class="cajas">
        <li>
        	<h2>Venta de inmuebles en Colombia</h2>
             <div id="lista">
                <table>                  
                    <tr><a class="grandes" href="http://www.inmueblealaventa.com/venta/apartamento/bogota/[%22tipo_inmueble%22:1,%22type%22:1,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]"> Apartamentos venta Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/casa/bogota/[%22tipo_inmueble%22:2,%22type%22:1,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]"> Casas venta en Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/apartamento/medellin/[%22tipo_inmueble%22:1,%22type%22:1,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Apartamentos venta Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/apartamento/[%22tipo_inmueble%22:1,%22type%22:1,%22area%22:0,%22ciudad%22:null,%22codigo%22:null,%22precio%22:0]"> venta apartamentos</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/apartamento/cali/[%22tipo_inmueble%22:1,%22type%22:1,%22area%22:0,%22ciudad%22:1071,%22codigo%22:null,%22precio%22:0]" class="grandes"> Apartamentos venta Cali</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/casa/cali/[%22tipo_inmueble%22:2,%22type%22:1,%22area%22:0,%22ciudad%22:1071,%22codigo%22:null,%22precio%22:0]"> casas Cali</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/oficina/bogota/[%22tipo_inmueble%22:4,%22type%22:1,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]" class="grandes"> Oficinas venta Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/bodega/bogota/[%22tipo_inmueble%22:5,%22type%22:1,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]"> bodegas venta Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/casa/medellin/[%22tipo_inmueble%22:2,%22type%22:1,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Casas venta Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/apartamento/cartagena/[%22tipo_inmueble%22:1,%22type%22:1,%22area%22:0,%22ciudad%22:176,%22codigo%22:null,%22precio%22:0]"> Apartamentos venta en Cartagena</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/medellin/[%22tipo_inmueble%22:null,%22type%22:1,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> venta en Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/apartamento/cartagena/[%22tipo_inmueble%22:1,%22type%22:1,%22area%22:0,%22ciudad%22:176,%22codigo%22:null,%22precio%22:0]"> Apartamentos venta en Cartagena</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/medellin/[%22tipo_inmueble%22:null,%22type%22:1,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> venta en Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/venta/medellin/[%22tipo_inmueble%22:null,%22type%22:1,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> venta en Medellín</a></tr>                   
                </table>
                </div>
        
</li>
        <li class="medio">
        	<h2 class="casa2">Arriendo de inmuebles en Colombia</h2>
             <div id="lista">
                <table>                  
                    <tr><a class="grandes" href="http://www.inmueblealaventa.com/arriendo/apartamento/bogota/[%22tipo_inmueble%22:1,%22type%22:2,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]"> Apartamentos arriendo Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/casa/bogota/[%22tipo_inmueble%22:2,%22type%22:2,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]"> Casas Arriendo en Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/apartamento/medellin/[%22tipo_inmueble%22:1,%22type%22:2,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Apartamentos arriendo Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/apartamento/[%22tipo_inmueble%22:1,%22type%22:2,%22area%22:0,%22ciudad%22:null,%22codigo%22:null,%22precio%22:0]?page=4"> Arriendo apartamentos</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/apartamento/cali/[%22tipo_inmueble%22:1,%22type%22:2,%22area%22:0,%22ciudad%22:1071,%22codigo%22:null,%22precio%22:0]" class="grandes"> Apartamentos arriendo Cali</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/casa/cali/[%22tipo_inmueble%22:2,%22type%22:2,%22area%22:0,%22ciudad%22:1071,%22codigo%22:null,%22precio%22:0]"> casas Cali</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/oficina/bogota/[%22tipo_inmueble%22:4,%22type%22:2,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]" class="grandes"> Oficinas arriendo Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/bodega/bogota/[%22tipo_inmueble%22:5,%22type%22:2,%22area%22:0,%22ciudad%22:524,%22codigo%22:null,%22precio%22:0]"> bodegas arriendo Bogotá</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/casa/medellin/[%22tipo_inmueble%22:2,%22type%22:2,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Casas arriendo Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/apartamento/cartagena/[%22tipo_inmueble%22:1,%22type%22:2,%22area%22:0,%22ciudad%22:176,%22codigo%22:null,%22precio%22:0]"> Apartamentos arriendo en Cartagena</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/medellin/[%22tipo_inmueble%22:null,%22type%22:2,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Arriendos en Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/apartamento/cartagena/[%22tipo_inmueble%22:1,%22type%22:2,%22area%22:0,%22ciudad%22:176,%22codigo%22:null,%22precio%22:0]"> Apartamentos arriendo en Cartagena</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/medellin/[%22tipo_inmueble%22:null,%22type%22:2,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Arriendos en Medellín</a></tr>
                    <tr><a href="http://www.inmueblealaventa.com/arriendo/medellin/[%22tipo_inmueble%22:null,%22type%22:2,%22area%22:0,%22ciudad%22:82,%22codigo%22:null,%22precio%22:0]" class="grandes"> Arriendos en Medellín</a></tr>                   
                </table>
                </div>
         
        </li>
        <div style="float:left; width:315px;height:233px; margin-top:-13px">
        <div class="containerpestainfe">
        	<ul class="menuinf">
            	<li id="bogota" class="activeinf">Bogotá </li>
                <li id="bucaramanga" >Bucaramanga </li>
                <li id="cali" >Cali</li>
                <li id="cartagena" >Cartagena </li>
            </ul>
        
            <span class="clear"></span>
            <div  class="contentinf bogota">
            <div class="pestabuscador">
            	<table width="100%" border="0">
                  <tr>
                    <td><img src="/pic.php?i=/gallery/bogota.png&make=show&w=80&h=80&c=60" alt="" /></td>
                    <td><span >
										<?php
                                   $sql="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
                        FROM inmueble, municipio, departamento, tipo_in
                        WHERE inmueble.estado =1
                        AND municipio.idmunicipio = 524 and tipo_neg=1
                        AND municipio.departamento_iddepartamento = departamento.iddepartamento
                        ORDER BY RAND( )
                        LIMIT 3 "; 
                        $ejecuta=mysql_query($sql);
                        while ($muestra=mysql_fetch_assoc($ejecuta))
                        {
                            $tipoin="";
                            if($muestra['tipo_neg']==1){	$tipoin="Venta";}
                            else if ($muestra['tipo_neg']==2){	$tipoin="Arriendo";	}
                            
                         echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra['tipo_neg'].','.$muestra['tip_inm'].','.$muestra['ciudad'].')">'.$tipoin." ".$muestra['dest_tip']." ".$muestra['nombreMunicipio'].'</a><br>';          
                        }

                        ?></span></td>
                  </tr>
                  <tr>
                    <td><img src="/pic.php?i=/gallery/bogota.png&make=show&w=80&h=80&c=60" alt="" /></td>
                    <td> <span>
                                        <?php
                                   $sql2="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
                        FROM inmueble, municipio, departamento, tipo_in
                        WHERE inmueble.estado =1
                        AND municipio.idmunicipio = 524 and tipo_neg=2
                        AND municipio.departamento_iddepartamento = departamento.iddepartamento
                        ORDER BY RAND( )
                        LIMIT 3 "; 
                        
                        $ejecuta2=mysql_query($sql2);
                        while ($muestra2=mysql_fetch_assoc($ejecuta2))
                        {
                            $tipoin2="";
                            if($muestra2['tipo_neg']==1){	$tipoin2="Venta";}
                            else if ($muestra2['tipo_neg']==2){	$tipoin2="Arriendo";	}
                         	echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra2['tipo_neg'].','.$muestra2['tip_inm'].','.$muestra2['ciudad'].')">'.$tipoin2." ".$muestra2['dest_tip']." ".$muestra2['nombreMunicipio'].'</a><br>';
                        }

                        ?></span></td>
                  </tr>
                </table>
                </div>
    		</div>
            
            <div class="contentinf bucaramanga"  style="display:none">
            <div class="pestabuscador">
            <table width="100%" border="0">
              <tr>
                <td><img src="/pic.php?i=/gallery/bmanga02.png&make=show&w=80&h=80&c=60" alt="" /></td>
                <td><span>
            	<?php
		   $sql1="SELECT tipo_in.dest_tip, municipio.idmunicipio,municipio.nombreMunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 912 and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 
$ejecuta1=mysql_query($sql1);
while ($muestra1=mysql_fetch_assoc($ejecuta1))
{
	$tipoin1="";
	if($muestra1['tipo_neg']==1){	$tipoin1="Venta";}
	else if ($muestra1['tipo_neg']==2){	$tipoin1="Arriendo";	}
	echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra1['tipo_neg'].','.$muestra1['tip_inm'].','.$muestra1['idmunicipio'].')">'.$tipoin1." ".$muestra1['dest_tip']." ".$muestra1['nombreMunicipio'].'</a><br>';
}


?></span></td>
              </tr>
              <tr>
                <td><img src="/pic.php?i=/gallery/bmanga02.png&make=show&w=80&h=80&c=60" alt="" /></td>
                <td><span>
            	<?php
		   $sql3="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 912 and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta3=mysql_query($sql3);
while ($muestra3=mysql_fetch_assoc($ejecuta3))
{
	$tipoin3="";
	if($muestra3['tipo_neg']==1){	$tipoin3="Venta";}
	else if ($muestra3['tipo_neg']==2){	$tipoin3="Arriendo";	}
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra3['tipo_neg'].','.$muestra3['tip_inm'].','.$muestra3['idmunicipio'].')">'.$tipoin3." ".$muestra3['dest_tip']." ".$muestra3['nombreMunicipio'].'</a><br>';
}

?>
</span></td>
              </tr>
            </table>

            
			</div>
    		</div>
            
            <div class="contentinf cali"  style="display:none">
            
            <div class="pestabuscador">
            
            <table width="100%" border="0">
              <tr>
                <td><img src="/pic.php?i=/gallery/cali.png&make=show&w=80&h=80&c=60" alt="" /></td>
                <td> <span>
            	<?php
		   $sql4="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 1071 and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta4=mysql_query($sql4);
while ($muestra4=mysql_fetch_assoc($ejecuta4))
{
	$tipoin4="";
	if($muestra4['tipo_neg']==1){	$tipoin4="Venta";}
	else if ($muestra4['tipo_neg']==2){	$tipoin4="Arriendo";	}
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra4['tipo_neg'].','.$muestra4['tip_inm'].','.$muestra4['idmunicipio'].')">'.$tipoin4." ".$muestra4['dest_tip']." ".$muestra4['nombreMunicipio'].'</a><br>';
}

?></span></td>
              </tr>
              <tr>
                <td><img src="/pic.php?i=/gallery/cali.png&make=show&w=80&h=80&c=60" height="80" alt="" /></td>
                <td><span>
            	<?php
		   $sql5="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio,tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 1071 and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta5=mysql_query($sql5);
while ($muestra5=mysql_fetch_assoc($ejecuta5))
{
	$tipoin5="";
	if($muestra5['tipo_neg']==1){	$tipoin5="Venta";}
	else if ($muestra5['tipo_neg']==2){	$tipoin5="Arriendo";	}
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra5['tipo_neg'].','.$muestra5['tip_inm'].','.$muestra5['idmunicipio'].')">'.$tipoin5." ".$muestra5['dest_tip']." ".$muestra5['nombreMunicipio'].'</a><br>';
}
?>
</span></td>
              </tr>
            </table>
				</div>
    		</div>
            
            <div class="contentinf cartagena"  style="display:none">
            <div class="pestabuscador">
            <table width="100%" border="0">
              <tr>
                <td><img src="/pic.php?i=/gallery/cartagena.png&make=show&w=80&h=80&c=60" alt="" /></td>
                <td> <span>
            	<?php
		   $sql6="SELECT tipo_in.dest_tip, municipio.nombreMunicipio,municipio.idmunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 176 and tipo_neg=2
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta6=mysql_query($sql6);
while ($muestra6=mysql_fetch_assoc($ejecuta6))
{
	$tipoin6="";
	if($muestra6['tipo_neg']==1){	$tipoin6="Venta";}
	else if ($muestra6['tipo_neg']==2){	$tipoin6="Arriendo";	}
	
 echo '<a href="#" style="font-size:11px" onclick="enviarpagina('.$muestra6['tipo_neg'].','.$muestra6['tip_inm'].','.$muestra6['idmunicipio'].')">'.$tipoin6." ".$muestra6['dest_tip']." ".$muestra6['nombreMunicipio'].'</a><br>';
 
  

}

?></span></td>
              </tr>
              <tr>
                <td><img src="/pic.php?i=/gallery/cartagena.png&make=show&w=80&h=80&c=60" alt="" /></td>
                <td><span>
            	<?php
		   $sql7="SELECT tipo_in.dest_tip, municipio.nombreMunicipio, municipio.idmunicipio, tipo_in.tip_inm, tipo_neg, departamento.nombre, inmueble . *
FROM inmueble, municipio, departamento, tipo_in
WHERE inmueble.estado =1
AND municipio.idmunicipio = 176 and tipo_neg=1
AND municipio.departamento_iddepartamento = departamento.iddepartamento
ORDER BY RAND( )
LIMIT 3 "; 

$ejecuta7=mysql_query($sql7);
while ($muestra7=mysql_fetch_assoc($ejecuta7))
{
	$tipoin7="";
	if($muestra7['tipo_neg']==1){	$tipoin7="Venta";}
	else if ($muestra7['tipo_neg']==2){	$tipoin7="Arriendo";	}
	
 echo '<a href="#"  style="font-size:11px" onclick="enviarpagina('.$muestra7['tipo_neg'].','.$muestra7['tip_inm'].','.$muestra7['idmunicipio'].')">'.$tipoin7." ".$muestra7['dest_tip']." ".$muestra7['nombreMunicipio'].'</a><br>';
 
  

}


?>
</span>
</td>
            </tr>
            </table>


            
			</div >
    		</div>
            </div>
         </div>

    </ul>
        
        
       	
        
    </div>
</section>
</div>


<footer>
<?php include('pie.php'); ?>
</footer>

 <!-- jQuery -->
 




  <!-- Optional FlexSlider Additions -->
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
  <script src="assets/js/cycle.js"></script>

<script type="text/javascript">

    
$(function() {

      // cargar_pestanas_sup();

    $("#slidebox").cycle('scrollLeft');

        cargar_pestanas();

        
    });

</script>

</body>
</html>
