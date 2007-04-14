<?php
/**
 * package.xml generation script
 *
 * @package Quickpay
 * @author  Lars Olesen <lars@legestue.net>
 * @since   1.18.1
 * @version @package-version@
 */

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);
$pfm = new PEAR_PackageFileManager2();
$pfm->setOptions(
    array(
        'baseinstalldir'    => 'Quickpay',
        'filelistgenerator' => 'file',
        'packagedirectory'  => dirname(__FILE__),
        'packagefile'       => 'package.xml',
        'ignore'            => array(
			'generate_package_xml.php',
			'package.xml',
			'*.tgz'
			),
		'exceptions'        => array(),
        'simpleoutput'      => true,
	)
);

$pfm->setPackage('Quickpay');
$pfm->setSummary('Communicates with Quickpay');
$pfm->setDescription('Needs to be filled in');
$pfm->setUri('http://localhost/');
$pfm->setLicense('BSD license', 'http://www.opensource.org/licenses/bsd-license.php');
$pfm->addMaintainer('lead', 'lars', 'Lars Olesen', 'lars@legestue.net');

$pfm->setPackageType('php');

$pfm->setAPIVersion('1.18.1');
$pfm->setReleaseVersion('1.18.1');
$pfm->setAPIStability('beta');
$pfm->setReleaseStability('stable');
$pfm->setNotes('Needs to be filled in');
$pfm->addRelease();

$pfm->addGlobalReplacement('package-info', '@package-version@', 'version');

$pfm->clearDeps();
$pfm->setPhpDep('4.3.0');
$pfm->setPearinstallerDep('1.5.0');
$pfm->addExtensionDep('required', 'curl');
$pfm->addExtensionDep('required', 'xml');

$pfm->generateContents();

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
	echo 'write package file';
    $pfm->writePackageFile();
} else {
	echo 'debug package file';
    $pfm->debugPackageFile();
}
?>