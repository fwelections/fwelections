<?php

class wpTBLang {

	public function wpTBLang() {
		if (is_admin()) add_action('admin_menu', array($this, 'adminMenu'));
		add_filter( 'locale', array($this, 'change_locale'), 2 );
	}

	function adminMenu() {
		add_options_page(WPTBLANG_PLUGIN_NAME, WPTBLANG_PLUGIN_NAME, 'manage_options', 'wptblang', array($this,'options_page'));
	}



	function GetLangFile($lang) {
		if ($lang=='en_EN') return '';
		$dir = str_replace('\\', '/', WPTBLANG_DIR);
		$dir = str_replace('plugins/wptb-language', 'languages', $dir);
		$dir = str_replace('plugins/wptblanguage', 'languages', $dir);
		if (!is_dir($dir)) {
			mkdir($dir);
			if (!is_dir($dir)) return "Can not locate or create directory: $dir";
		}
		if (!file_exists("$dir/$lang.po") || !file_exists("$dir/$lang.mo")) {
			$vers = $this->getFileCont("http://i18n.svn.wordpress.org/$lang/tags/");
			if (!$vers) return "Can not read repository: http://i18n.svn.wordpress.org/$lang/tags/";
			$vers = explode('<a href=', $vers);
			array_shift($vers);
			array_shift($vers);
			array_pop($vers);
			$usever = 0;
			foreach ($vers as $id=>$ver) {
				$ver = $this->GetBetweenTags($ver, '"', '/"');
				if ($ver > $usever) $usever = $ver;
			}
			if (!$usever) return 'It seems there are no language files in the repository for the selected language!';
			$vers = array_reverse($vers);
			$msg = '';
			if (!file_exists("$dir/$lang.mo")) {
				$d = $this->DownloadFile("http://i18n.svn.wordpress.org/$lang/tags/$usever/messages/$lang.mo", "$dir/$lang.mo");
				if (!$d) $msg = "Repository File Dosen't exist: http://i18n.svn.wordpress.org/$lang/tags/$usever/messages/$lang.mo";
			}
			if (!file_exists("$dir/$lang.po")) {
				$d = $this->DownloadFile("http://i18n.svn.wordpress.org/$lang/tags/$usever/messages/$lang.po", "$dir/$lang.po");
				if (!$d) $msg = "Repository File Dosen't exist: http://i18n.svn.wordpress.org/$lang/tags/$usever/messages/$lang.mo";
			}
			if ($msg) { // try to find files from lower versions
				set_time_limit(600);
				foreach ($vers as $id=>$ver) {
					$ver = $this->GetBetweenTags($ver, '"', '/"');
					$d = $this->DownloadFile("http://i18n.svn.wordpress.org/$lang/tags/$ver/messages/$lang.po", "$dir/$lang.po");
					if ($d) $d2 = $this->DownloadFile("http://i18n.svn.wordpress.org/$lang/tags/$ver/messages/$lang.mo", "$dir/$lang.mo");
					if ($d && $d2) {
						$msg = '';
						break;
					}
				}
			}
		}
		return $msg;
	}


	function options_page(){
		$langnames = array(
			'af'=>'Afrikaans - Afrikaans', 'bg_BG'=>'Bulgarian - Български', 'ar'=>'Arabic - عربي', 'bn_BD'=>'Bangla - Bengali',
			'bs_BA'=>'Bosnian - Bosanski', 'ca'=>'Catalan - Català', 'cs_CZ'=>'Czech - Čeština', 'cy'=>'Welsh - Cymraeg',
			'da_DK'=>'Danish - Dansk', 'de_DE'=>'German - Deutsch', 'el'=>'Greek - Ελληνικά', 'en_CA'=>'English - Canada', 'en_GB'=>'English - UK', 'en_EN'=>'English - USA',
			'eo'=>'Esperanto - Esperanto', 'es_CL'=>'Chilean - Chile', 'es_ES'=>'Español - España', 'es_PE'=>'Español - Perú', 'et'=>'Estonian - Eesti', 'eu'=>'Basque - Euskara',
			'fa_IR'=>'Persian - پارسی', 'fi'=>'Finnish - Suomi', 'fo'=>'Faroese - Faroese', 'fr_FR'=>'French - Français', 'gl_ES'=>'Galician - Galego', 'he_IL'=>'Hebrew - עברית',
			'hr'=>'Croatian - Hrvatski', 'hu_HU'=>'Hungarian - Magyar', 'id_ID'=>'Indonesian - Bahasa Indonesia', 'is_IS'=>'Icelandic - íslenska', 'it_IT'=>'Italian - Italiano',
			'kk'=>'Kazakh - Қазақша', 'ko_KR'=>'Korean - 한국어', 'ky_KY'=>'Kyrgyz - Кыргызча', 'lv'=>'Latvian (Latviešu)', 'mg_MG'=>'Malagasy - Malagasy', 'mk_MK'=>'Macedonian - Македонски',
			'ms_MY'=>'Malay – Bahasa Melayu', 'nb_NO'=>'Bokmal - Bokmål', 'nl_NL'=>'Dutch - Nederlands', 'nn_NO'=>'Nynorsk - Nynorsk', 'pl_PL'=>'Polish - Polski', 'pt_BR'=>'Portuguese - Brazilian',
			'pt_PT'=>'Portuguese - European', 'ro_RO'=>'Romanian - Română', 'ru_RU'=>'Russian - Русский', 'sk_SK'=>'Slovak – Slovenčina', 'sl_SI'=>'Slovenian - Slovenščina', 'sq_AL'=>'Albanian - Shqiptar', 
			'sq'=>'Albanian - Shqiptar', 'sr_RS'=>'Serbian - Српски', 'su_ID'=>'Sundanese - Basa Sunda', 'sv_SE'=>'Swedish - Svenska', 'tg'=>'Tajik - Tajik', 'th'=>'Thai - ภาษาไทย', 'tr_TR'=>'Turkish - Türkçe', 
			'uk'=>'Ukrainian - Українська', 'uz_UZ'=>'Uzbek - O‘zbekcha', 'vi'=>'Vietnamse - Tiếng Việt', 'zh_CN'=>'Chinese - 中文', 'zh_HK'=>'Hong Kong - 香港', 'zh_TW'=>'Taiwan - 台灣',
			'hi_IN'=>'Hindi - हिन्दी', 'si_LK'=>'Sinhala - සිංහල ', 'ta_LK'=>'Tamil-Sri Lanka - இலங்கைத் தமிழ்'
		);
		$msg = '';
		if (isset($_POST['tblang'])) {
			$msg = $this->GetLangFile($_POST['tblang']);
			if (!$msg) {
				update_option('wptblang', $_POST['tblang']);
				die("<META HTTP-EQUIV='Refresh' Content='0; URL=$_SERVER[REQUEST_URI]' />");
			}
		}
		if ($msg) $msg = "<div style='color: red; font-weight: bold; padding: 10px 0 10px 0;'>$msg</div>";
		echo "
			<div class='wrap'>
			<div id='icon-tools' class='icon32'></div>
			<h2>WPTB Language - ".__('Settings')."</h2>
			$msg
			<div style='padding: 10px 30px 10px 10px;'>
		";
		$langs = $this->getFileCont('http://i18n.svn.wordpress.org');
		if (!$langs) {
			echo 'Can not read the repository: http://i18n.svn.wordpress.org</div></div>';
			return ;
		}
		$sellang = get_option('wptblang');
		$langs = explode('<a href=', $langs);
		array_shift($langs);
		array_shift($langs);
		array_pop($langs);
		$langslist = array();
		foreach ($langs as $id=>$lang) {
			$lang = $this->GetBetweenTags($lang, '"', '/"');
			$title = isset($langnames[$lang])?$langnames[$lang]:'';
			if ($title) $langslist[$lang] = $title;

		}
		asort($langslist);
		echo "<form method='post'>".__('Set Language').": <select name='tblang'><option value='en_EN'>Default - English</option>";
		foreach ($langslist as $lang=>$title) echo sprintf("<option value='$lang'%s>$title</option>", ($sellang==$lang)?' selected':'');
		echo "
			</select> 
			<input class='button-primary' type='submit' name='submbut' value='".__('Submit')."' />
			</form><br />
			<div style='width: 300px;'>Please wait few seconds (up to few minutes) after you click the button, because it may take some time for the needed files to be downloaded.</div>
			</div></div>
		";
	}

	function change_locale($locale) {
		$stub = get_option('wptblang');
		if ($stub) return $stub;
		return $locale;
	}


	function DownloadFile($url, $fn) {
		$file = fopen($url, "r");
		$line = '';
		if (!$file) return false;
		while (!feof ($file)) $line .= fgets ($file, 1024);
		fclose($file);
		$file = fopen($fn, "wb");
		if (!$file) return false;
		fwrite($file, $line);
		fclose($file);
		return true;
	}


	function getFileCont($command) {
		return file_get_contents($command);
	}



	function GetBetweenTags($content, $tag1, $tag2) {
		$pos1 = strpos($content, $tag1);
		if ($pos1===false) return '';
		$pos1 += strlen($tag1);
		$pos2 = strpos($content, $tag2, $pos1);
		if ($pos2===false) return '';
		$content = substr($content, $pos1, $pos2-$pos1);
		return trim($content);
	}


}

?>