<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:52:39
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-09 16:56:24
 * @FilePath: \tianditu-sdk\src\Services\StaticMap.php
 * @Description: 静态地图服务
 */

namespace Alphathinkyyl\Tianditu\Services;  
use Alphathinkyyl\Tianditu\Support\HttpClient;
class StaticMap
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @description: 获取静态地图
     * @param {string} $center 中心点坐标 “经度，纬度”
     * @param {int} $width 地图宽度
     * @param {int} $height 地图高度
     * @param {int} $zoom 缩放级别
     * @return {*}
     */
    public function getStaticMap(string $center, int $width = 600, int $height = 400, int $zoom = 10,$layers = 'vec_c,eva_c')
    {
        return $this->http->get('/staticmap', [
            'center' => $center,
            'width' => $width,
            'height' => $height,
            'zoom' => $zoom,
            'layers' => $layers
        ]);
    }
}   