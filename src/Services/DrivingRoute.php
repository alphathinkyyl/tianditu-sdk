<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:52:28
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-09 16:57:44
 * @FilePath: \tianditu-sdk\src\Services\DrivingRoute.php
 * @Description: 驾车规划服务
 */

namespace Alphathinkyyl\Tianditu\Services;

use Alphathinkyyl\Tianditu\Support\HttpClient;

class DrivingRoute
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @description: 驾车规划 http://lbs.tianditu.gov.cn/server/drive.html
     * @param {string} $start 出发点坐标 “经度，纬度”
     * @param {string} $end 目的地坐标 “经度，纬度”
     * @return {*}
     */
    public function route(string $start, string $end, $style = '0')
    {
        return $this->http->get('/driving', [
            'postStr' => [
                'orig' => $start,
                'dest' => $end,
                'style' => $style
            ],
            'type' => 'search'
        ]);
    }


    /**
     * @description: 驾车规划（带途经点） http://lbs.tianditu.gov.cn/server/drive.html
     * @param {string} $start 出发点坐标 “经度，纬度”
     * @param {string} $end 目的地坐标 “经度，纬度”
     * @param {array} $waypoints 途经点坐标数组
     * @return {*}
     */
    public function routeWithWaypoints(string $start, string $end, array $waypoints, $style = '0')
    {
        return $this->http->get('/driving', [
            'postStr' => [
                'orig' => $start,
                'dest' => $end,
                'mid' => implode(';', $waypoints),
                'style' => $style
            ],
            'type' => 'search'
        ]);
    }
}
