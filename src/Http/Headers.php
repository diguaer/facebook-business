<?php
namespace FacebookBusiness\Http;

class Headers extends \ArrayObject {

	/**
	 * @return array
	 */
	public function export(): array
	{
		$data = array();
		foreach ($this as $key => $value) {
			$data[$key] = $value;
		}

		return $data;
	}
}
