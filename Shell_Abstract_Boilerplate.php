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
    $this->log($this->startTime);
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
    $this->log("\n\nScript execution time: " . round($executionTime, 2) . " seconds\n\n");
  }

  /**
   * Prints colored output based on the provided color.
   *
   * @param string      $message The string to be printed.
   * @param string|null $color   The color to be applied (red, yellow, green).
   * @param string|null $level   The log level (optional).
   * @param string|null $file    The log file (optional).
   * @param bool        $force   Whether to force logging (optional, default: false).
   */
  public function log($message, $color = null, $level = null, $file = null, $force = false)
  {
    Mage::log($message, $level, $file, $force);

    $coloredMessage = $this->applyColor($message, $color);
    echo $coloredMessage;
  }

  /**
   * Applies the specified color to the message.
   *
   * @param string      $message The string to be colored.
   * @param string|null $color   The color to be applied (red, yellow, green).
   *
   * @return string The colored message.
   */
  private function applyColor($message, $color)
  {
    switch ($color) {
      case 'red':
        $coloredMessage = self::COLOR_RED . $message . self::COLOR_RESET;
        break;
      case 'yellow':
        $coloredMessage = self::COLOR_YELLOW . $message . self::COLOR_RESET;
        break;
      case 'green':
        $coloredMessage = self::COLOR_GREEN . $message . self::COLOR_RESET;
        break;
      default:
        $coloredMessage = $message;
        break;
    }

    return $coloredMessage;
  }

}

$shell = new Shell_Abstract_Boilerplate();
$shell->run();
