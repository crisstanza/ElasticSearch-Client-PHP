<?php
	namespace simplerestclient;

	class SRCResponse {

		private ?array $headers;
		private ?int $status;
		private ?string $contents;

		public function __construct(?array $headers, ?int $status, ?string $contents) {
			$this->headers = $headers;
			$this->status = $status;
			$this->contents = $contents;
		}

		public function headers() : ?array { return $this->headers; }
		public function status() : ?int { return $this->status; }
		public function contents() : ?string { return $this->contents; }

	}
?>