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


