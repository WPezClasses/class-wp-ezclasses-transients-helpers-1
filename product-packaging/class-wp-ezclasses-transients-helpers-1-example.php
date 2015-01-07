<?php
/**
 * WordPress transients done The ezWay.
 *
 * Centralize your transients and treat them more like methods / functions.
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WP ezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.0
 *
 */
/**
 * == Change Log ==
 *
 * -- 0.5.0 - Tue 6 Jan 2015
 * ---- Pop the champagne!
 */
/**
 * == TODO ==
 *
 * Use it. Test it. Beat it up.
 *
 */

if (!class_exists('Class_WP_ezClasses_Transients_Helpers_1_Example')) {
  class Class_WP_ezClasses_Transients_Helpers_1_Example extends Class_WP_ezClasses_Transients_Helpers_1{
    
	// private static $obj_static_instance = null;
    protected $_arr_init; // NEW GOOD!!
	
    protected $_version;
    protected $_url;
    protected $_path;
    protected $_path_parent;
    protected $_basename;
    protected $_file;

    /**
     *
     */
    protected function __construct(){
      parent::__construct();
    }

    /**
     *
     */
    public function ez__construct(){
	
	  add_action('save_post', array($this, 'save_post_delete_transients'));
	
	}
	
    /**
     * currently NA (but it's here just in case)
     */
    protected function setup() {
      $this->_version = '0.5.0';
      $this->_url = plugin_dir_url(__FILE__);
      $this->_path = plugin_dir_path(__FILE__);
      $this->_path_parent = dirname($this->_path);
      $this->_basename = plugin_basename(__FILE__);
      $this->_file = __FILE__;
    }
	
    /**
     * currently NA
     */
    protected function ez_defaults(){
      $arr_ez_defaults = array(
        'active'				=> true, 	// currently NA
        'active_true' 			=> false, 	// currently NA (use the active true "filtering")
        'filters'				=> false, 	// currently NA
        'arr_arg_validation'	=> false,	// currently NA
      );
      return $arr_ez_defaults;
    }
	
	/**
	 * This is where the magic happens, define your transients here. 
	 */
	protected function transients_todo(){
	
	  $arr_transients = array(
	  
	  	// the array key / index is the transient name
	    'transient_1'	=> array(
		  'active'	=> true,					// TODO note: false just turns off the transient'ing. in other words, go right to method_value and return that value
		  'expiration' => 60 * 1,				// in seconds (obviously)
		  'type'		=> 'single',			//  or 'multi' - multi will use the name concat'ed with multi_id (name.'_'.{id}) to create multiple instances per id
		  'multi_id'	=> false,				// ''post', 'user', TODO = other (?)
		  'site'		=> false,				// site_transient?
		  'arr_args'	=> array(				// args to be passed to the method specific to this transient
			'foo'	=> 'bar'					
		    ),
		  'method_value'		=> 'the_method_that_delivers_the_value_for_1',
		  'delete_events'		=> array()
		  ),
		

	    'transient_2' => array(
		  'active'		=> true,					
		  'expiration' 	=> 60 * 1,
		  'type'		=> 'multi',
		  'multi_id'	=> 'post',
		  'site'		=> false,
		  'arr_args'	=> array(
			'foo'	=> 'bar'
		    ),
		  'method_value'		=> 'the_method_that_delivers_the_value_for_2',
		  'delete_events'		=> array(
		    'save_post_personnel' 		=> true,
			'delete_method_2_swtich_2'	=> true,
			),
		  ),
		);
		
		return $arr_transients; 
	}
	
	/**
	 * TODO
	 */
	protected static function transients_defaults(){
	
	  $arr_defaults = array(
	    'active'		=> true,
		'flush'			=> false,			// flush => true will force a delete transient
		'prefix'		=> 'ez_',			// note: 'prefix' and 'suffix' can be defined at the individual transient level (above)
		'suffix'		=> '',				// in a multi this will be AFTER the (base) name but BEFORE the id. Be sure of use an underscore. For example '_suffix'
		'expiration'	=> 60*60, 			// 60 sec * 60 mins
		'type'			=> 'single',
	    'multi_id'		=> 'post',			// multi_id type: 'post', 'user'. Others are TODO.
		'arr_args'		=> array(),
		'method_value'	=> '',	
		'delete_events'	=> array(),
	  );
	  
	  return $arr_defaults;
	
	}
	
	/**
	 * add your methods for method_value to your own class.
	 */
	static public function the_method_that_delivers_the_value_for_1($arr_args){
	
	  return '1_ - ' . time();
	
	}
	
	/**
	 *
	 */
	static public function the_method_that_delivers_the_value_for_2($arr_args){
	
	  return '2_ - ' . time();
	  
	}
	
	/**
	 *
	 */
	public function save_post_delete_transients(){
	  global $post;
	  
	  $post->post_type;
	  
	  switch ($post->post_type){
	  
	    case 'page':
		  // some logic here
		  break;
		
	    case 'personnel':
		  $this->delete_transient('save_post_personnel');
		  break;
		
	    default:
	
	  }
	
	}
	
	/**
	 * We use the usual WP actions to define broadly WHEN there will be deleting. Within those methods
	 * can get more specific (e.g., which post type) about the nature of those event (i.e. in the example via 
	 * a switch case). Once we know the when and the case we can go back to our transient definitions and 
	 * decide which are to be deleted.
	 *
	 * Agreed, this feels somewhat awkward but once you get the hang of it, it makes a lot of sense. In short, 
	 * define some delete events, and then see which transients were defined to be deleted when a particular 
	 * event(s) happens. 
	 *
	 * Obviously, more than one transient can be deleted for a given event and/or more than one event can 
	 * cause a transient to be deleted. It's this two way street that make this approach powerful, if not
	 * somewhat awkard (at first).
	 */
	protected function delete_transient ($str_current_event = ''){

	  $arr_defaults = $this->transients_defaults();
	  $arr_transients_all = $this->transients_todo();
	  
	  // get all our transient definitions
	  foreach ($arr_transients_all as $str_name => $arr_transient){
	    $arr_transient = array_merge($arr_defaults, $arr_transient);
		
		// is there any delete parms for this particular transient?
		if ( isset($arr_transient['delete_events']) && is_array($arr_transient['delete_events']) ){
		  // loop over the delete event to see if one matches the current_event
		  foreach ( $arr_transient['delete_events'] as $str_key => $bool_active ){
		    if ($str_key == $str_current_event && $bool_active === true){
			  // match! get the full name
			  $str_full_name = $this->get_transient_name($str_name, $arr_transient);
			  // site or regular?
			  if ( $arr_transient['site'] === true ){
			    delete_site_transient($str_full_name);
			  } else {
			   delete_transient($str_full_name);
			  }
			  // no need to keep looping, we can move on
			  continue;
			}
		  }
		}
	  }
	}
	
	/**
	 * gets the transient
	 */
    public function get_transient($str_name = ''){

	  if ( empty($str_name) ){
	    return NULL;
	  }
	  
	  $str_name = trim($str_name);
	  $arr_transients_all = $this->transients_todo();
	  if ( ! isset($arr_transients_all[$str_name]) ){
	    return 'Transient: ' . $str_name . ' is not defined in ' . 'TODO class / method';
	  }
	  
	  // Grab only the stuff we need for the transient we're working on
	  $arr_transient = $arr_transients_all[$str_name];
	  
	  // get defaults
	  $arr_defaults = $this->transients_defaults();
	  // merge'em!
	  $arr_transient = array_merge($arr_defaults,$arr_transient);
 	  
	  // this is our name!
	  $str_full_name = $this->get_transient_name($str_name, $arr_transient);
	  
	  // forces a delete during the get (as opposed to a delete trigger by some defined event)
	  if ($arr_transient['flush'] === true ){
	    // is it a site transient
	    if ( $arr_transient['site'] === true ){
	      delete_site_transient($str_full_name);
	    } else {
	      delete_transient($str_full_name);
	    }
	  } 
	  
	  // kinda a test / fail safe mode. we can use the transient-helpers class but not do transients. who knew? :) comes in handy while testing / dev
	  if ($arr_transient['active'] === true ){
	    // is it a site transient
	    if ( $arr_transient['site'] === true ){
	      $mix_this_transient = get_site_transient($str_full_name);
	    } else {
	      $mix_this_transient = get_transient($str_full_name);
	    }
	    // did we find the droids we're looking for?
	    if ($mix_this_transient !== false){
	      return $mix_this_transient;
	    }
	  }
	  
	  // oh my. we got nuttin'. we need to reload the transient. 
	  // what's the method that calculates the value?
	  $str_method_value = $arr_transient['method_value'];
	  $arr_args = $arr_transient['arr_args'];

	  if ( method_exists($this, $str_method_value)){
	    $mix_value = $this->$str_method_value($arr_args);
	  } else {
		  // TODO - if we don't have the method, that what? 
	  }
	  
	  if ($arr_transient['active'] === true ){
	    
		$int_expire = (integer)$arr_transient['expiration'];
		
		if ( isset($arr_transient['site']) && $arr_transient['site'] == true ){
	      set_site_transient($str_full_name, $mix_value, $int_expire);
	    } else {
	      set_transient($str_full_name, $mix_value, $int_expire);
	    }
	  }
	  return $mix_value;	
	}
	
	/**
	 * Figures out what the name of the transient is based on the definition / parms in the_todo()
	 */
	protected function get_transient_name( $str_name = '', $arr_transient = array() ){
	
	  // get defaults
	  $arr_defaults = $this->transients_defaults();
	  // merge'em!
	  $arr_transient = array_merge($arr_defaults,$arr_transient);
	  
	  // we need some magic for the name if it's a 'type' => 'multi'
	  $str_prefix = $arr_transient['prefix'];
	  $str_suffix = $arr_transient['suffix'];
	  
	  $str_full_name = $str_prefix . $str_name . $str_suffix;
	  if ( $arr_transient['type'] == 'multi' ){
	    $str_full_name = $str_full_name . '_' . $this->get_multi_id($arr_transient['multi_id']);
	  }
	  
	  return $str_full_name;
	}
	
	/**
	 * When the type is multi, use the multi_id (type) to decide which id to use
	 *
	 * IMPORTANT - Please be mindful of trying to get your transient too early, else you might get unexpected results.
	 *
	 * Also note, you can continue to use regular WP transient function, if you feel you must. 
	 */
	protected function get_multi_id($str_multi_id = ''){

	  switch ($str_multi_id) {
	  
	    case 'post':
		  global $post;
          return $post->ID;
          break;
		
		case 'user':
		  return get_current_user_id();
          break;
		  
	    case 'other': // ???
          return 'TODO';
          break;
		  
		default:
		  return get_the_id();
	  }
	}
	
	// TODO - Important! If you want some static-ness, this needs to be in your class (that inherits this class)
	/**
	 * A slight bit of fakin' some static funk. 
	 */
	 
	/*
	public static function get( $str_name = ''){
	 
	   if ( ! is_string($str_name) || empty($str_name) ){
	     return $str_name;
	   }
	   
	   if ( self::$obj_static_instance === NULL ) {
	     self::$obj_static_instance = TODO_CLASS_NAME::ez_new();
       }
	   
	   return self::$obj_static_instance->get_transient($str_name);	 
	 }
	 */	 

  }
}

// TODO - Important! This needs to be in your class (that inherits this class)
/*
$obj_new_init_ez_transients = TODO_CLASS_NAME::ez_new();

// Note: If for some reason you have more than one class to define transients, you can't use the same alias. I know, #Duh (but just in case we mention it anyway)
class_alias('TODO_CLASS_NAME', 'WPezTransients');
*/