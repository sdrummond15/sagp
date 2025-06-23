<?php

defined('_JEXEC') or die('Restricted access');
/*
	preflight which is executed before install and update
	install
	update
	uninstall
	postflight which is executed after install and update
	*/

class com_carouselckInstallerScript {

	function install($parent) {
		
	}
	
	function update($parent) {
		
	}

	function uninstall($parent) {
		// disable all plugins and modules
		$db = JFactory::getDbo();
		$db->setQuery("UPDATE `#__modules` SET `published` = 0 WHERE `module` LIKE '%carouselck%'");
		$db->execute();

		// $db->setQuery("UPDATE `#__extensions` SET `enabled` = 0 WHERE `type` = 'plugin' AND `element` LIKE '%carouselck%' AND `folder` NOT LIKE '%carouselck%'");
		// $db->execute();
		return true;
	}

	function preflight($type, $parent) {
		// check if a pro version already installed
		$xmlPath = JPATH_ROOT . '/administrator/components/com_carouselck/carouselck.xml';

		// if no file already exists
		if (! file_exists($xmlPath)) return true;

		$xmlData = $this->getXmlData($xmlPath);
		$isProInstalled = ((int)$xmlData->ckpro);

		if ($isProInstalled) {
			throw new RuntimeException('Carousel CK Light cannot be installed over Carousel CK Pro. Please install Carousel CK Pro. To downgrade, please first uninstall Carousel CK Pro. <a href="https://www.joomlack.fr/en/documentation/45-carousel-ck/246-migration-from-slideshow-ck-version-1-to-version-2" target="_blank">Read more</a>');
			// return false;
		}

		// check if a V1 version is installed with the params (needs the pro)
		$xmlPath = JPATH_ROOT . '/modules/mod_carouselck/mod_carouselck.xml';

		// if no file already exists
		if (! file_exists($xmlPath)) return true;

		$xmlData = $this->getXmlData($xmlPath);
		$installedVersion = ((int)$xmlData->version );
		// if the installed version is the V1
		if(version_compare($installedVersion, '2.0.0', '<')) {
			// if the params is also installed
			if (file_exists(JPATH_ROOT . '/plugins/system/carouselckparams/carouselckparams.xml')) {
				throw new RuntimeException('Carousel CK Light cannot be installed over Carousel CK V1 + Params. Please install Carousel CK Pro to get the same features as previously, else you may loose your existing settings. To downgrade, please first uninstall Carousel CK Params. <a href="https://www.joomlack.fr/en/documentation/45-carousel-ck/246-migration-from-slideshow-ck-version-1-to-version-2" target="_blank">Read more</a>');
				// return false;
			}

			
		}

		return true;
	}

	public function getXmlData($file) {
		if ( ! is_file($file))
		{
			return '';
		}

		$xml = simplexml_load_file($file);

		if ( ! $xml || ! isset($xml['version']))
		{
			return '';
		}

		return $xml;
	}

	// run on install and update
	function postflight($type, $parent) {
		// install modules and plugins
		jimport('joomla.installer.installer');
		$db = JFactory::getDbo();
		$status = array();
		$src_ext = dirname(__FILE__).'/administrator/extensions';
		$installer = new JInstaller;

		// module
		$result = $installer->install($src_ext.'/mod_carouselck');
		$status[] = array('name'=>'Carousel CK - Module','type'=>'module', 'result'=>$result);

		// system plugin
		/*$result = $installer->install($src_ext.'/carouselck');
		$status[] = array('name'=>'System - Carousel CK','type'=>'plugin', 'result'=>$result);
		// system plugin must be enabled for user group limits and private areas
		$db->setQuery("UPDATE #__extensions SET enabled = '1' WHERE `element` = 'carouselck' AND `type` = 'plugin'");
		$db->execute();*/

		foreach ($status as $statu) {
			if ($statu['result'] == true) {
				$alert = 'success';
				$icon = 'icon-ok';
				$text = 'Successful';
			} else {
				$alert = 'warning';
				$icon = 'icon-cancel';
				$text = 'Failed';
			}
			echo '<div class="alert alert-' . $alert . '"><i class="icon ' . $icon . '"></i>Installation and activation of the <b>' . $statu['type'] . ' ' . $statu['name'] . '</b> : ' . $text . '</div>';
		}

		// disable the old update site
		$db->setQuery("UPDATE #__update_sites SET enabled = '0' WHERE `location` = 'http://update.joomlack.fr/mod_carouselck_update.xml'");
		$result5 = $db->execute();

		return true;
	}
}
