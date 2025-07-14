<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:49:22
 * @LastEditors: dingtalk_kyfese xiaoyu@zsjq9.wecom.work
 * @LastEditTime: 2025-07-14 13:07:48
 * @FilePath: \tianditu-sdk\src\Services\Geocoder.php
 * @Description: 地理编码服务
 */

namespace Alphathinkyyl\Tianditu\Services;

use Alphathinkyyl\Tianditu\Support\HttpClient;

class Geocoder
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @description: 地理编码接口 http://lbs.tianditu.gov.cn/server/geocodinginterface.html
     * @param {string} $address 请求关键字
     * @return {*}
     */
    public function geocode(string $address)
    {
        return $this->http->get('/geocoder', ['ds' => json_encode(['keyWord' => $address], JSON_UNESCAPED_UNICODE)]);
    }

    /**
     * @description:  逆地理编码查询 http://lbs.tianditu.gov.cn/server/geocoding.html
     * @param {string} $lon 坐标的x值
     * @param {string} $lat 坐标的y值
     * @return {*}
     */
    public function reverse(string $lon, string $lat)
    {
        return $this->http->get('/geocoder', [
            'postStr' => json_encode([
                'lon' => $lon,
                'lat' => $lat,
                'ver' => 1
            ], JSON_UNESCAPED_UNICODE),
            'type' => 'geocode'
        ]);
    }
}
