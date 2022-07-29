<?php

function toTimeZone($src, $from_tz = 'America/Denver', $to_tz = 'Asia/Shanghai', $fm = 'Y-m-d H:i:s')
{
	$datetime = new DateTime($src, new DateTimeZone($from_tz));
	$datetime->setTimezone(new DateTimeZone($to_tz));
	return $datetime->format($fm);
}

/**
 * 图片链接转换为 base64 文件流
 * @param $imgUrl
 * @return string
 */
function imgUrlToBase64($imgUrl): string
{
	return chunk_split(base64_encode(file_get_contents($imgUrl)));
}


/**
 * 数组组合成字符串
 * @param $data
 * @return string
 */
function arr_to_string($data)
{
	$buff = '';
	foreach ($data as $k => $v) {
		if ($k != "sign" && $v != "" && !is_array($v)) {
			$buff .= $k . "=" . $v . "&";
		}
	}
	return trim($buff, '&');
}

/**
 * 时区转换
 * @param $dateTime
 * @param $fromZone
 * @param $toZone
 * @param string $format
 * @return string
 */
function dateTimeChangeByZone($dateTime, $fromZone, $toZone = 'Asia/Shanghai', $format = 'Y-m-d H:i:s'): string
{
	try {
		$dateTimeZoneFrom = new \DateTimeZone($fromZone);
		$dateTimeZoneTo = new \DateTimeZone($toZone);
		$dateTimeObj = \DateTime::createFromFormat($format, $dateTime, $dateTimeZoneFrom);
		$dateTimeObj->setTimezone($dateTimeZoneTo);

		return $dateTimeObj->format($format);
	} catch (\Exception $e) {
		return "";
	}
}

/**
 * 获取之前N个月对应的当前时间点
 * @param int $mouthNum
 * @return string
 */
function beforeMouthTime(int $mouthNum): string
{

	$hour = date("d");
	$time = date("H:i:s");
	$yMouth = date('Y-m', strtotime(date('Y-m-01') . " - $mouthNum month"));
	return $yMouth . "-" . $hour . " " . $time;
}

/**
 * 去除在使用like时，%和_的影响
 * @param string $str
 * @return string
 */
function escape_like_string(string $str): string
{
	return str_replace(["\\", '%', '_'], ["\\\\", '\%', '\_'], $str);
}

/**
 * 数组分组求和
 * @param array $array
 * @param string $key
 * @param array $sumKeys
 * @return array
 */
function array_group_sum(array $array, string $key, $sumKeys = []): array
{
	$result = [];
	foreach ($array as $item) {
		if (array_key_exists($item[$key], $result)) {
			$result[$item[$key]] = calculate($result[$item[$key]], $item, $sumKeys);
			continue;
		}
		$result[$item[$key]] = $item;
	}
	return array_values($result);
}

function calculate($sumData, $newData, $sumKeys)
{
	foreach ($sumData as $key => $value) {
		if (!empty($sumKeys) && !in_array($key, $sumKeys)) {
			continue;
		}
		$newValue = !empty($newData[$key]) ? $newData[$key] : 0;
		$sumData[$key] = $value + $newValue;
	}
	return $sumData;
}


/**
 * 获取顶级域名
 * @param string|null $url
 * @return string
 */
function getHostTopDomain(string $url = null): string
{
	// 判断网址是否带http://或https://
	if (preg_match('/^http(s)?:\\/\\/.+/', $url)) {
		$hosts = parse_url(strtolower($url));
		$host = $hosts['host'];
	} else {
		$host = strtolower($url);
	}

	// 查看是几级域名
	$data = explode('.', $host);

	$n = count($data);

	if (!in_array($data[$n - 1], ['com', 'cn', 'net', 'org', 'gov', 'edu'])) {

		return '';
	}

	// 判断是否是双后缀
	$preg = '/[\w].+\.(com|net|org|gov|edu)\.cn$/';

	// 双后缀取后3位
	if (($n > 2) && preg_match($preg, $host)) {

		return $data[$n - 3] . '.' . $data[$n - 2] . '.' . $data[$n - 1];
	} // 非双后缀取后两位

	if (!isset($data[$n - 2], $data[$n - 1])) {

		return '';
	}

	return $data[$n - 2] . '.' . $data[$n - 1];
}

if (! function_exists('env')) {
	/**
	 * Gets the value of an environment variable.
	 *
	 * @param string $key
	 * @return mixed
	 */
	function env($key)
	{
		require_once dirname(__DIR__) . '/src/_env.php';

		return $_ENV[$key];
	}
}