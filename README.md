# Pipeline

[![Check & fix styling](https://github.com/curder/laravel-pipeline-demo/actions/workflows/pint.yml/badge.svg?branch=master)](https://github.com/curder/laravel-pipeline-demo/actions/workflows/pint.yml)
[![Test Laravel Github action](https://github.com/curder/laravel-pipeline-demo/actions/workflows/run-test.yml/badge.svg?branch=master)](https://github.com/curder/laravel-pipeline-demo/actions/workflows/run-test.yml)

[Laravel Pipeline](https://laravel.com/docs/master/helpers#pipeline) 的简单示例。

```php
public function __invoke(Request $request)
{
    $pipelines = [
        new ByName($request->get('name')),
        new ByRole($request->get('role')),
        new ByCountry($request->get('country')),
    ];

    $users = Pipeline::send(User::query())
        ->through($pipelines)
        ->thenReturn()
        ->orderByDesc('id')
        ->paginate();

    return UsersResource::collection($users);
}
```

## 项目初始化

```bash
# 下载项目源代码
git clone https://github.com/curder/laravel-pipeline-demo.git

# 进入到项目源代码目录
cd laravel-pipeline-demo

# 拷贝项目本地化配置文件 
cp .env.example .env

# 生成应用密钥
php artisan key:generate

# 创建数据库存储文件
touch database/database.sqlite

# 执行数据库迁移
php artisan migrate

# 安装PHP依赖
composer install

# 运行单元测试 
php artisan test -p
```

## 相关视频

- [Laravel Pipelines: Build an Api](https://www.youtube.com/watch?v=1RzqbiGVH24)

- [Laravel Pipeline Pattern - when to use it and how to use it](https://www.youtube.com/watch?v=FByQN_d876c)
