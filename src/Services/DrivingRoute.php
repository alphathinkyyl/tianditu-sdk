<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:52:28
 * @LastEditors: dingtalk_kyfese xiaoyu@zsjq9.wecom.work
 * @LastEditTime: 2025-07-14 15:40:37
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
        return $this->searchBase([
            'orig' => $start,
            'dest' => $end,
            'style' => $style
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
        return $this->searchBase([
            'orig' => $start,
            'dest' => $end,
            'mid' => implode(';', $waypoints),
            'style' => $style
        ]);
    }


    /**
     * @description: 基础搜索请求
     * @param {array} $params 请求参数
     * @return {*}
     */
    protected function searchBase(array $params)
    {
        return $this->http->get('/drive', [
            'postStr' => json_encode($params,JSON_UNESCAPED_UNICODE),
            'type' => 'search'
        ]);
    }
}
