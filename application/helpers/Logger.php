<?

class Logger
{
	public $fileName;
	public $console = false;	//wyswietlanie bledow w konsoli

	public static $DEBUG = 1;
	public static $INFO = 2;
	public static $ERROR = 4;

	public $flag = 7;

	public function __construct($fileName, $flag=7) {
		$this->fileName = $fileName;
		$this->flag = $flag;
	}
	
	public function info($text) {
		if(($this->flag & Logger::$INFO) == Logger::$INFO ) {
			$this->write($text, "INFO");
		}
	}
		
	public function error($text) {
		if(($this->flag & Logger::$ERROR) == Logger::$ERROR ) {
			$this->write($text, "ERROR");
		}
	}

	public function debug($text) {
		if(($this->flag & Logger::$DEBUG) == Logger::$DEBUG ) {
			$this->write($text, "DEBUG");
		}
	}
	

	private function write($text, $prefix="", $dateTime=true) {
		
		$text = ($dateTime ? "[".date("Y-m-d H:i:s")."] " : "").($prefix != "" ? $prefix." >> " : "").$text.PHP_EOL;
		if($this->fileName !== null) {
			$fp = fopen($this->fileName, "a+");
			fwrite($fp, $text);
			fclose($fp);
		}

		if($this->console) {
			echo $text;
		}
	}


	public function __destruct() {
		;
	}

}


?>