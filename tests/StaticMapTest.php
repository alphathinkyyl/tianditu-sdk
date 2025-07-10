<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:41:24
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:57:07
 * @FilePath: \tianditu-sdk\tests\StaticMapTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

 namespace Alphathinkyyl\Tianditu\Tests;
 use Alphathinkyyl\Tianditu\Exceptions\TiandituException;
 
class StaticMapTest extends TestCase
{   
    public function testGetStaticMap()
    {
        $data = $this->sdk->staticMap()->getStaticMap('116.403874,39.914888', 500, 500, 10);
        $this->assertIsString($data);
        $this->assertStringContainsString('http', $data); // 确保返回的是一个有效的URL
    }

    public function testGetStaticMapWithInvalidCoords()
    {
        $this->expectException(TiandituException::class);
        $this->sdk->staticMap()->getStaticMap('999,999', 500, 500, 10);
    }
}