<!--
 * @Author: dingtalk_kyfese xiaoyu@zsjq9.wecom.work
 * @Date: 2025-07-10 14:13:59
 * @LastEditors: dingtalk_kyfese xiaoyu@zsjq9.wecom.work
 * @LastEditTime: 2025-07-10 14:41:47
 * @FilePath: /tianditu-sdk/README.md
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
-->
# tianditu-sdk
Laravel SDK for Tianditu API


## Laravel 项目使用方式

1. 安装 SDK 包

```bash
composer require alphathinkyyl/tianditu-sdk
```

2. 发布配置文件：

```bash
php artisan vendor:publish --tag=config
```

3. 在 `.env` 中添加：

```env
TIANDITU_API_KEY=你的key
TIANDITU_BASE_URL=https://api.tianditu.gov.cn
```

4. 使用方式：

```php
use Tianditu\TiandituService;

public function search(TiandituService $sdk)
{
    $data = $sdk->place()->searchNormal('天安门');
    return response()->json($data);
}
```


