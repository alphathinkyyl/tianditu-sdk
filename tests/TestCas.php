<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 17:13:56
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 13:53:25
 * @FilePath: \tianditu-sdk\tests\TestCas.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Alphathinkyyl\Tianditu\Tests;
use Alphathinkyyl\Tianditu\TiandituService;
use PHPUnit\Framework\TestCase as BaseTestCase;
use PSpell\Config;

class TestCase extends BaseTestCase
{
    protected $sdk;

    protected function setUp(): void
    {
        $config = config('tianditu');
        $this->sdk = new TiandituService($config);
    }
}
