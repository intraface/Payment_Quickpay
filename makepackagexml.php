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

$version = '1.18.2';
$notes = 'Initial release as a public PEAR package.';
$stability = 'alpha';

PEAR::setErrorHandling(PEAR_ERROR_DIE);
$pfm = new PEAR_PackageFileManager2();
$pfm->setOptions(
    array(
        'baseinstalldir'    => '/',
        'filelistgenerator' => 'file',
        'packagedirectory'  => dirname(__FILE__) . '/src/',
        'packagefile'       => 'package.xml',
        'ignore'            => array(
            'generate_package_xml.php',
            '*.tgz'
            ),
        'exceptions'        => array(),
        'simpleoutput'      => true,
    )
);

$pfm->setPackage('Payment_Quickpay');
$pfm->setSummary('Communicates with Quickpay');
$pfm->setDescription('API for communicating with the QuickPay api');
$pfm->setChannel('public.intraface.dk');
$pfm->setLicense('BSD license', 'http://www.opensource.org/licenses/bsd-license.php');
$pfm->addMaintainer('lead', 'lsolesen', 'Lars Olesen', 'lars@legestue.net');

$pfm->setPackageType('php');

$pfm->setAPIVersion($version);
$pfm->setReleaseVersion($version);
$pfm->setAPIStability($stability);
$pfm->setReleaseStability($stability);
$pfm->setNotes($notes);
$pfm->addRelease();

$pfm->addGlobalReplacement('package-info', '@package-version@', 'version');

$pfm->clearDeps();
$pfm->setPhpDep('4.3.0');
$pfm->setPearinstallerDep('1.5.0');
$pfm->addExtensionDep('required', 'curl');
$pfm->addExtensionDep('required', 'xml');

$pfm->generateContents();

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    if ($pfm->writePackageFile()) {
        exit('file written');
    }
} else {
    $pfm->debugPackageFile();
}
?>