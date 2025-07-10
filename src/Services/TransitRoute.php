<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:52:07
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:42:59
 * @FilePath: \tianditu-sdk\src\Services\TransitRoute.php
 * @Description: 公交规划服务   
 */
namespace Alphathinkyyl\Tianditu\Services;

use Alphathinkyyl\Tianditu\Support\HttpClient;

class TransitRoute
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @description: 公交规划 http://lbs.tianditu.gov.cn/server/bus.html
     * @param {string} $start 出发点坐标 “经度，纬度”
     * @param {string} $end 目的地坐标 “经度，纬度”
     * @param {string} $lineType  获取线路规划类型(按位判断规划类型，以支持同时获取多种规划结果)第0位为1，较快捷；第1位为1，少换乘；第2位为1，少步行；第3位为1，不坐地铁。
     * @return {*}
     */    
    public function route(string $start, string $end, string $lineType = '1110')
    {
        return $this->http->get('/transit', [
            'startposition' => $start,
            'endposition' => $end,
            'linetype' => $lineType
        ]);
    }
}
