<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Paypal {
 
    var $CI;
    var $fields;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->fields  = array();
        $this->CI->load->helper('url');
        $this->CI->load->helper('form');
        $this->CI->load->config('paypal_config');
    }
 
    function add_field($field, $value) {
        $this->fields[$field] = $value;
    }
 
    public function clear() {
        $this->fields = array();
    }
 
    function paypal_auto_form() {
        $output = '';
        $output .= '<html>' . "\n";
        $output .= '<head><title>Processing Payment...</title></head>' . "\n";
        $output .= '<body onLoad="document.forms[\'paypal_auto_form\'].submit();">' . "\n";
        $output .= '<p>Please wait, your order is being processed and you will be redirected to the paypal website.</p>' . "\n";
        $output .= '<form method="post" action="'.$this->paypal_url.'" name="paypal_auto_form"/>' . "\n";
        foreach ($this->fields as $name => $value)
            $output .= form_hidden($name, $value) . "\n";
        $output .= '<p>'. form_submit('pp_submit', 'Click here if you\'re not automatically redirected...') . '</p>';
        $output .= form_close() . "\n";
        $output .= '</body></html>';
        return $output;
    }
 
    function validate_ipn() {
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
 
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }
 
        $ch = curl_init($this->paypal_url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
 
        if( !($res = curl_exec($ch)) ) {
            curl_close($ch);
            exit;
        }
        curl_close($ch);
 
        $this->ipn_data = $_POST;
 
        if (strcmp ($res, "VERIFIED") == 0) {
            return $this->log_ipn_results(true);
        } else if (strcmp ($res, "INVALID") == 0) {
            $this->last_error = 'IPN Validation Failed.';
            $this->log_ipn_results(false);
            return false;
        }
    }
 
    function log_ipn_results($success){
        if (!$this->ipn_log) return;  // is logging turned off?
 
        $text = '['.date('m/d/Y g:i A').'] - ';
 
        if ($success) $text .= "SUCCESS!\n";
        else $text .= 'FAIL: '.$this->last_error."\n";
 
        $text .= "IPN POST Vars from Paypal:\n";
        foreach ($this->ipn_data as $key=>$value)
            $text .= "$key=$value\n ";
 
        $data['text']         = $text;
 
        $log_data = array(
                'paypal_log_data'           => serialize($data),
                'paypal_log_created'        => date('Y-m-d H:i:s')
        );
 
        $this->CI->db->insert('paypal_log', $log_data);
        return $this->CI->db->insert_id();
    }
}