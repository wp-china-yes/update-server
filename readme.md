# WP-China-Yes更新推送服务

2020年4月14日，WordPress官方以安全为由下架了WP-China-Yes插件，这一举动令我们大家唏嘘不已。

为了保证WP-China-Yes未来的版本推送不受影响，这个项目应运而生。

其原理是在官方检查插件版本更新的API请求的返回值中插入WP-China-Yes的版本信息。

## 部署方法

创建一个站点，将这个PHP脚本扔上去，之后修改API域名的反向代理的配置文件，添加如下配置即可。

```
location ^~ /plugins/update-check/1.1/ {
    proxy_pass  http://your_domain/;
}
```

## 新版本的推送

在源码中替换`NEW_VERSION`宏的值即可。