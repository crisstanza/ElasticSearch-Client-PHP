<?php
	namespace simplerestclient;

	include_once('./php/lib/simplerestclient/SRCHeader.php');
	include_once('./php/lib/simplerestclient/SRCResponse.php');

	class SimpleRestClient {

		private ?string $baseUrl;
		private ?array $defaultHeaders;

		public function __construct(?string $baseUrl = '', ?array $defaultHeaders = NULL) {
			$this->baseUrl = $baseUrl;
			$this->defaultHeaders = $defaultHeaders;
		}

		public function delete(?string $path = '') : SRCResponse {
			return $this->send('DELETE', $this->defaultHeaders, $path, NULL);
		}

		public function get(?string $path = '') : SRCResponse {
			return $this->send('GET', $this->defaultHeaders, $path, NULL);
		}

		public function post(?string $path = '', ?\stdClass $data = NULL) : SRCResponse {
			return $this->send('POST', $this->defaultHeaders, $path, $data);
		}

		private function send(string $method, ?array $headers, ?string $path = '', ?\stdClass $data = NULL) : SRCResponse {
			$options = array(
				'http' => array(
					'ignore_errors' => true,
					'method' => $method
				)
			);
			$requestHeaders = $this->formatRequestHeaders($headers);
			if ($requestHeaders) {
				$options['http']['header'] = $requestHeaders;
			}
			if ($data) {
				$options['http']['content'] = json_encode($data);
			}
			$context = stream_context_create($options);
			$result = @file_get_contents($this->baseUrl . $path, false, $context);
			return new SRCResponse($this->parseResponseHeaders(isset($http_response_header) ? $http_response_header : NULL), http_response_code(), $result);
		}

		private function formatRequestHeaders(?array $headers) : ?array {
			if ($headers) {
				$httpRequestHeaders = array();
				foreach ($headers as $header) {
					$httpRequestHeaders[] = $header->name() . ': ' . $header->value();
				}
				return $httpRequestHeaders;
			} else {
				return NULL;
			}
		}

		private function parseResponseHeaders(?array $httpResponseHeaders) : ?array {
			if ($httpResponseHeaders) {
				$headers = array();
				foreach ($httpResponseHeaders as $httpResponseHeader) {
					$header = explode(':', $httpResponseHeader, 2);
					if (isset($header[1])) {
						$headers[] = new SRCHeader(trim($header[0]), trim($header[1]));
					} else {
						$status = explode(' ', $httpResponseHeader, 3)[1];
						http_response_code($status);
					}
				}
				return $headers;
			} else {
				http_response_code(-1);
				return NULL;
			}
		}

	}
?>