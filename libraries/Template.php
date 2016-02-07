<?php
class Template {
	protected $template_dir = 'templates/';
	protected $vars = array();

	///Patikrina, ar buvo nurodyta templeito direktorija
	public function __construct($template_dir = null) {
		if ($template_dir !== null)
			$this->template_dir = $template_dir;
	}

	///Surenderina nurodytą templeitą (patikrina, ar egzistuoja templeitas, ir jei taip, tai jį includina)
	public function render($template_file) {
		if(file_exists($this->template_dir.$template_file)) {
			include $this->template_dir.$template_file;
		} else {
			throw new Exception('No template file ' . $template_file . ' present in directory ' . $this->template_dir);
		}
	}

	///Magiškas metodas __set - įrašo duomenis į viešai neprieinamą kintamąjį $vars
	public function __set($name, $value) {
		$this->vars[$name] = $value;
	}

	///Magiškas metodas __get - grąžina viešai neprieinamą kintamąjį $vars
	public function __get($name) {
		return $this->vars[$name];
	}

	///Magiškas metodas __isset - iškviečia isset() funkcija su kintamuoju, kuris yra viešai neprieinamas, ir grąžina rezultatą
	public function __isset($name) {
		return isset($this->vars[$name]);
	}
}