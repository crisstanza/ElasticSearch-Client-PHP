<?php
	namespace simplerestclient;

	class SRCHeader {

		private ?string $name;
		private ?string $value;

		public static function CONTENT_TYPE_APPLICATION_JSON() { return new SRCHeader('Content-type', 'application/json'); }

		public function __construct(?string $name, ?string $value) {
			$this->name = $name;
			$this->value = $value;
		}

		public function name() : ?string { return $this->name; }
		public function value() : ?string { return $this->value; }

	}
?>