<?php 
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:49:22
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-09 16:57:29
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
        return $this->http->get('/geocoder', ['ds' => ['keyWord' => $address]]);
    }

    /**
     * @description:  逆地理编码查询 http://lbs.tianditu.gov.cn/server/geocoding.html
     * @param {string} $lon 坐标的x值
     * @param {string} $lat 坐标的y值
     * @return {*}
     */    
    public function reverse(string $lon, string $lat)
    {
        return $this->http->get('/geocoder', ['location' => ['lon' => $lon, 'lat' => $lat,'ver'=> '1']]);
    }
}
