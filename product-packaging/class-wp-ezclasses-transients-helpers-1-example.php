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
 * Add / expose a delete_transient method().
 *
 * Use it. Test it. Beat it up.
 *
 */

if (!class_exists('Class_WP_ezClasses_Transients_Helpers_1_Example')) {
  class Class_WP_ezClasses_Transients_Helpers_1_Example extends Class_WP_ezClasses_Transients_Helpers_1{
    
	private static $obj_static_instance = null;
    //protected $_arr_init; // NEW GOOD!!
	
    protected $_version;
    protected $_url;
    protected $_path;
    protected $_path_parent;
    protected $_basename;
    protected $_file;

    /**
     *
     */
    public function ez__construct(){
	
	  // queue up our actions
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
		  'arr_args'	=> array(				// args to be passed to the method_velue() specific to this transient
			'foo'	=> 'bar'					
		    ),
		  'method_value'		=> 'transient_1_value',   // the name of the method that will do the value for this transients
		  'delete_events'		=> array(
		    'save_post_post' 	=> true,)   	// the event name for triggering a delete. see the delete_transient() method for more details.
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
		  'method_value'		=> 'transient_2_value',
		  'delete_events'		=> array(
		    'save_post_page' 			=> true,
			'some_other_event'			=> true,
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
	 * TODO add your methods for method_value to your own class.
	 */
	static public function transient_1_value($arr_args){
	
	  return 'value_transient_1 - ' . time();
	
	}
	
	/**
	 * TODO
	 */
	static public function transient_2_value($arr_args){
	
	  return 'value_transient_2 - ' . time();
	}
	
	/**
	 * TODO - once you get an action, what do you want to do with it?
	 */
	public function save_post_delete_transients(){
	  global $post;
	  
	  // New post trigger the save_post but there is not really a post yet so we're outta here
	  if ( empty($post) ){
	    return;
	  }
	  
	  $post->post_type;
	  
	  switch ($post->post_type){
	  
	    case 'page':
		  $this->delete_transient('save_post_page');  // the delete_transient() will match the event name to transients and then delete
		  break;
		
	    case 'post':
		  $this->delete_transient('save_post_post');
		  break;
		
	    default:
	
	  }
	}

// ---------------------------------------------------------------------------------------------------------------	
	/**
	 * A slight bit of fakin' some static funk. 
	 */
	public static function get( $str_name = ''){
	 
	   if ( ! is_string($str_name) || empty($str_name) ){
	     return $str_name;
	   }
	   
	   if ( self::$obj_static_instance === NULL ) {
	     self::$obj_static_instance = Class_WP_ezClasses_Transients_Helpers_1_Example::ez_new();
       }
	   
	   return self::$obj_static_instance->get_transient($str_name);	 
	 }
	 */	 

  }
}

// TODO - Important! This needs to be in your class (that inherits this class)
$obj_new_init_ez_transients = Class_WP_ezClasses_Transients_Helpers_1_Example::ez_new();

/**
 * Note: If for some reason you have more than one class to define transients, 
 * you can't use the same alias. I know, #Duh (but just in case we mention it anyway)
 */
class_alias('Class_WP_ezClasses_Transients_Helpers_1_Example', 'WPezTransients');
