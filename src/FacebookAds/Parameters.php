<?php

namespace FacebookBusiness\FacebookAds;

class Parameters extends \ArrayObject
{

	/**
	 * @param array $data
	 */
	public function enhance(array $data): void
	{
		foreach ($data as $key => $value) {
			$this[$key] = $value;
		}
	}

	/**
	 * @param mixed $value
	 * @return string
	 */
	protected function exportNonScalar($value): string
	{
		return json_encode($value);
	}

	/**
	 * @return array
	 */
	public function export(): array
	{
		$data = array();
		foreach ($this as $key => $value) {
			$data[$key] = is_null($value) || is_scalar($value)
				? $value
				: $this->exportNonScalar($value);
		}

		return $data;
	}
}
