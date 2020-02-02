<?php
/**
 * Library to send SMS to a Free Mobile number
 * Example URL: https://smsapi.free-mobile.fr/sendmsg?user=12345678&pass=QWERTYUIOP&msg=Hello
 * 
 * @author     Pierre Lebedel
 * @copyright  2018-08-05
 * @license    MIT
 */


class FreeMobileSms {
	private $apiUrl = 'https://smsapi.free-mobile.fr/sendmsg';	//Free mobile API URL
	private $userId = null;										//User ID (customer number)
	private $password = null;									//User API key
	private $curl = null;										//CURL class instance
	private $httpParams = array();								//HTTP parameters for the CURL call

	/**
	 * FreeMobileSms constructor
	 * @param string $user User identifier
	 * @param string $password API Key
	 */
	function __construct($user, $pass){
		$this->userId = $user;
		$this->password = $pass;
	}

	/**
	 * Create parameters to be embeded in the GET URL
	 * @param  string $msg Message to send via SMS
	 */
	private function constructHttpParams($msg) {
		$this->httpParams = http_build_query(array(
			'user'	=> $this->userId,
			'pass'	=> $this->password,
			'msg'	=> $msg,
		));
	}

	/**
	 * Construct the CURL object and set parameters
	 * @param  string $message Message to send via SMS
	 */
	private function constructMessageUrl($message) {
		$this->constructHttpParams($message); 
		$this->curl = curl_init();

		curl_setopt($this->curl, CURLOPT_URL, $this->apiUrl.'?'.$this->httpParams);
		curl_setopt($this->curl, CURLOPT_TIMEOUT, 10);
	}

	/**
	 * Main function to call to send a message via SMS
	 * @param  string $message Message to send via SMS
	 * @return bool curl_exec status (Returns TRUE on success or FALSE on failure but may vary. Check the doc)
	 */
	public function sendMessage($message){
		$this->constructMessageUrl($message);

		$curlReturn = curl_exec($this->curl);
		curl_close($this->curl);

		return $curlReturn;
	}
}
