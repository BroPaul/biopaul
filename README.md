#BioPaul

A WordPress theme adapted from Biopic

Feel free to download, use, test, or modify it. But DO NOT use it for commercial purposes.

----------

本主题修改自WordPress收费主题 `Biopic`，**请勿用于商业用途**！

主题安装说明请参考 http://bropaul.com/biopaul ，演示站点 http://bropaul.tk/

###**V2.0** 修改的内容如下：

 1. 尽量减少HTTP请求（图片用base64编码）
 2. 响应式布局优化（不再需要 `WPtouch` 插件了）
 3. 原生Ajax评论（不再需要 `多说` 等评论插件了）
 4. 整合多说“最近访问”（不安装`多说`也能用了，后台可关闭）
 5. 整合OptionTree（不再需要安装 `OptionTree` 插件和导入数据了）
 6. 优化Ajax加载，只返回变化的内容；移动设备也启用Ajax
 7. 404页面强制使用公益404，优化显示
 8. （基本上）完全汉化了（毕竟只给中国人用）
 9. 其他样式微调
 10. 美化后台登录界面
 11. 支持邮箱登录后台 

###**V2.0** 仍没解决的问题如下：

1. 后台编辑器的短代码：由于WordPress升级 `TinyMCE` 到 4.x，所以之前的API失效，致使无法**方便地**插入短代码，但还是可以手动插入的
2. 主题安装说明网页也在制（fan）作（yi）中... 
<del>不过估计一时半会儿是弄不完的，因为我太懒了哈哈哈</del>
既然整合了`OptionTree`也不用导入数据了，主题的安装也没原来那么复杂了... 是不是没必要搞安装说明了 =.=