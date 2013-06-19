<?php
namespace GeolocationTest;//Change this namespace for your test


use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use RuntimeException;

//Additional functions to PHP5
include './../../../vendor/Ipascual/PhpFunctions.php';

//Error reporting
error_reporting( E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1); 

chdir(__DIR__);

class Bootstrap
{
    protected static $serviceManager;
    protected static $config;
    protected static $bootstrap;

    public static function init()
    {
		//Environment
		putenv('APPLICATION_ENV=test');
    	
        // Load the user-defined test configuration file, if it exists; otherwise, load
        if (is_readable(__DIR__ . '/TestConfig.php')) {
            $testConfig = include __DIR__ . '/TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/TestConfig.php.dist';
        }

        $zf2ModulePaths = array();

        if (isset($testConfig['module_listener_options']['module_paths'])) {
            $modulePaths = $testConfig['module_listener_options']['module_paths'];
            foreach ($modulePaths as $modulePath) {
                if (($path = static::findParentPath($modulePath)) ) {
                    $zf2ModulePaths[] = $path;
                }
            }
        }

        $zf2ModulePaths  = implode(PATH_SEPARATOR, $zf2ModulePaths) . PATH_SEPARATOR;
        $zf2ModulePaths .= getenv('ZF2_MODULES_TEST_PATHS') ?: (defined('ZF2_MODULES_TEST_PATHS') ? ZF2_MODULES_TEST_PATHS : '');

        static::initAutoloader();

        // use ModuleManager to load this module and it's dependencies
        $baseConfig = array(
            'module_listener_options' => array(
                'module_paths' => explode(PATH_SEPARATOR, $zf2ModulePaths),
            ),
        );

        $config = ArrayUtils::merge($baseConfig, $testConfig);

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
        static::$config = $config;
		
		self::destroyDatabase(true);
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    public static function getConfig()
    {
        return static::$config;
    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {
            $loader = include $vendorPath . '/autoload.php';
        } else {
            $zf2Path = getenv('ZF2_PATH') ?: (defined('ZF2_PATH') ? ZF2_PATH : (is_dir($vendorPath . '/ZF2/library') ? $vendorPath . '/ZF2/library' : false));

            if (!$zf2Path) {
                throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
            }

            include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';

        }

        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
                ),
            ),
        ));
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) return false;
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }
	
	/**
	 * Common test functions
	 */
	public static function setUp() {
		self::createDatabase();
	}
	
	public static function tearDown() {
		self::destroyDatabase();
	}
	
	protected static function createDatabase(){
		//Global fixtures
		$fixturesFolder = __DIR__.'/../../Application/tests/fixtures';
		
		if ($dir = opendir($fixturesFolder)) {
			while (false !== ($file = readdir($dir))) {
				if ($file != "." && $file != "..") {
					$data = null;
					$databaseName = self::getDatabaseName();
					require $fixturesFolder."/".$file;
					$collection = str_replace(".php", "", $file);
					$dm = self::getServiceManager()->get('doctrine.documentmanager.odm_default');
					$collection = $dm->getConnection()->selectCollection($databaseName, $collection);
					$collection->batchInsert($data);
				}
			}
			closedir($dir);
		}
	}
	
	protected static function destroyDatabase($force = false) {
    	global $argv, $argc;

		$keep = false;		
		foreach($argv as $arg) {
			if($arg == "--debug") {
				$keep = true;		
			}
		}
		
		if(! $keep || $force) {
			$databaseName = self::getDatabaseName();
			$dm = self::getServiceManager()->get('doctrine.documentmanager.odm_default');
	        $collections = $dm->getConnection()->selectDatabase($databaseName)->listCollections();
	        foreach ($collections as $collection) {
	            $collection->remove(array(), array('safe' => true));
	        }
			//Clear cache
			$dm->clear();
		}
	}
	
	protected static function getDatabaseName() {
		$config = self::$serviceManager->get('Config');
		return $config['doctrine']['configuration']['odm_default']['default_db'];
		
	}

}

Bootstrap::init();
