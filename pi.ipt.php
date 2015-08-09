<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 In-place translation for multi-lingual EE sites

 @package       ipt
 @subpackage    Plugins
 @category      Plugins
 @author        Andy Hebrank
 */

$plugin_info = array(
  'pi_name'     => 'ipt',
  'pi_version'    => '0.1',
  'pi_author'     => 'Andy Hebrank',
  'pi_author_url'   => 'https://github.com/ahebrank',
  'pi_description'  => 'In-place translation',
  'pi_usage'      => ipt::usage(),
);

// define the old-style EE object
if (!function_exists('ee')) {
    function ee() {
        static $EE;
        if (! $EE) {
          $EE = get_instance();
        }
        return $EE;
    }
}

class ipt {

  public function __construct() {

    $default = ee()->TMPL->fetch_param('default', '');

    $lang = ee()->TMPL->fetch_param('lang', null);
    if (empty($lang)) {
      $this->return_data = $default;
      return;
    }

    $translation = ee()->TMPL->fetch_param($lang, null);
    if (empty($translation)) {
      $this->return_data = $default;
    }
    else {
      $this->return_data = $translation;
    }
  }

    
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.

  public function usage() {
    ob_start(); ?>
In-place translations based on a global language variable.
  {exp:ipt lang="{lang}" default="hello" en="hello" fr="bonjour" es="hola"}
<?php 
    return ob_get_clean();
  } // usage()

}?>