<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:43:15
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:47:28
 * @FilePath: \tianditu-sdk\tests\TransitRouteTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Alphathinkyyl\Tianditu\Tests;
use Alphathinkyyl\Tianditu\Exceptions\TiandituException;

class TransitRouteTest extends TestCase
{
    public function testGetTransitRoute()
    {
        $data = $this->sdk->transitRoute()->route('116.403874,39.914888', '116.407526,39.915085');
        $this->assertIsArray($data);   
    }

    public function testGetTransitRouteWithInvalidCoords()
    {
        $this->expectException(TiandituException::class);
        $this->sdk->transitRoute()->getTransitRoute('999,999', '999,999');
    }   
}