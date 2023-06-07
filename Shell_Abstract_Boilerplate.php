<?php

/*
 * Magento 1.9 Shell Abstract Boilerplate
 * Author: Matteo Barbero
 */

//Change your path
require_once __DIR__ . '/../abstract.php';

class Shell_Abstract_Boilerplate extends Mage_Shell_Abstract
{
  const COLOR_RED = "\033[31m";
  const COLOR_GREEN = "\033[32m";
  const COLOR_YELLOW = "\033[33m";
  const COLOR_RESET = "\033[0m";

  private $startTime;

  /**
   * Constructor. Initializes the start time.
   */
  public function __construct()
  {
    parent::__construct();
    $this->startTime = microtime(true);
  }

  /**
   * Entry point of the shell script.
   */
  public function run()
  {
    // Run your methods here

    $this->endTimer();
  }

  /**
   * Displays the usage help text.
   *
   * @return string
   */
  public function usageHelp()
  {
    return <<<USAGE
\n
Write here your help text...
\n
USAGE;
  }

  /**
   * Retrieve the current store ID.
   *
   * @return int
   */
  protected function getCurrentStoreId()
  {
    return Mage::app()->getStore()->getStoreId();
  }

  /**
   * Retrieve the current store code.
   *
   * @return string
   */
  protected function getCurrentStoreCode()
  {
    return Mage::app()->getStore()->getCode();
  }

  /**
   * Retrieve the current store name.
   *
   * @return string
   */
  protected function getCurrentStoreName()
  {
    return Mage::app()->getStore()->getName();
  }

  /**
   * Retrieve the base URL for the current store.
   *
   * @return string
   */
  protected function getBaseUrl()
  {
    return Mage::getBaseUrl();
  }

  /**
   * Retrieve the base URL for the current store with a specified path.
   *
   * @param string $path
   * @return string
   */
  protected function getUrl($path = '')
  {
    return Mage::getUrl($path);
  }

  /**
   * Retrieve the value of a configuration setting.
   *
   * @param string $path
   * @param int $storeId
   * @return mixed
   */
  protected function getConfigValue($path, $storeId = null)
  {
    return Mage::getStoreConfig($path, $storeId);
  }
  /**
   * Ends the timer and displays the script execution time.
   */
  public function endTimer()
  {
    $endTime = microtime(true);
    $executionTime = $endTime - $this->startTime;
    echo "\n\nScript execution time: " . round($executionTime, 2) . " seconds\n\n";
  }

  /**
   * Prints colored output based on the provided color.
   *
   * @param string $string The string to be printed
   * @param string $color The color to be applied (red, yellow, green)
   */
  public function log($message, $level = null, $file = null, $force = false , $color = '')
  {
    Mage::log($message, $level, $file, $force);

    switch ($color) {
      case 'red':
        echo self::COLOR_RED . $message . self::COLOR_RESET;
        break;
      case 'yellow':
        echo self::COLOR_YELLOW . $message . self::COLOR_RESET;
        break;
      case 'green':
        echo self::COLOR_GREEN . $message . self::COLOR_RESET;
        break;
      default:
        echo $message;
        break;
    }
  }
}

$shell = new Shell_Abstract_Boilerplate();
$shell->run();
