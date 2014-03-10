# laravel-4.1-simple-blog

- 这是一个 laravel-4.1 的 Demo，一个简单的博客实例。
  - 涵盖知识点：
    - 路由、过滤器。
    - Eloquent 基础、模型对象关系、分页、搜索、排序。
    - 控制器、blade 模板。
    - Mail 操作。
    - Auth 类的使用。
    - Validator 类的使用。
- 为求开发尽可能的简单高效，做出以下调整。
  - 所有控制器均置于顶层命名空间，遵循 PSR-0 规范，使用 PEAR 命名风格进行前后台控制器分离。
  - 开发阶段引入了 laravel-debugbar。
  - 开发阶段使用了自定义的辅助工具包 Assists，部署后可以完全移除。
- 此项目仅用于学习交流，有任何问题请发 [issues](https://github.com/5-say/laravel-4.1-simple-blog/issues)。
- 2014-02-19 初始版本编写结束。

---

- [项目进度](#project)
- [安装方法](#install)
- [项目截图](#screenshot)
- [项目依赖](#require)
- [开发者私人信息保密方法](#assume-unchanged)

---

<a name="project"></a>
### 项目进度

- 已经完成
  - 权限
    - 注册、登录、邮箱激活、忘记密码
    - 最简陋的权限：仅区分管理员、注册用户、游客
  - 博客
    - 文章列表页
    - 分类文章列表页
    - 文章展示页
      - 评论
  - 管理员后台
    - 用户管理
    - 分类管理
    - 文章管理
      - Markdown 编辑器（编辑和发布文章）
    - 资源列表搜索功能
    - 资源列表排序功能
  - 用户中心
    - 修改密码
    - 更改头像
    - 我的评论
- 预计加入的功能
  - 初始版本编写结束

<a name="install"></a>
### 安装方法

[下载项目文件](https://github.com/5-say/laravel-4.1-simple-blog/archive/master.zip)

使用 composer 进行安装

    composer install

> **注意：** 项目默认采用 Sqlite 数据库，数据库文件已包含于项目中。composer 安装结束后即可直接使用。  
> Assist 包中存放着迁移文件，可配合开发辅助工具无缝切换至 MySql 等 laravel 支持的数据库。（工具 URI `/5-say` ）

默认管理员账号密码：

    admin@demo.com
    111111

> 账号激活等功能需要进行邮件发送，请在 `/app/config/mail.php` 文件中做好邮件服务器的相关配置。

<a name="screenshot"></a>
### 项目截图

![Alt text](/public/readmeAssets/mx3540D.png "Optional title")
![Alt text](/public/readmeAssets/mx3826D.png "Optional title")
![Alt text](/public/readmeAssets/mx3D2BE.png "Optional title")

<a name="require"></a>
### 项目依赖

- 主要依赖
  - laravel/framework
    - 主框架
  - intervention/image
    - 图片处理
  - yzalis/identicon
    - 头像生成
  - michelf/php-markdown
    - markdown 文档解析
  - nickcernis/html-to-markdown
    - “html 文档”转“markdown 文档”
- 开发辅助
  - barryvdh/laravel-debugbar
    - 调试工具栏
  - five-say/vendor-cleaner
    - vendor 目录清理

<a name="assume-unchanged"></a>
### 开发者私人信息保密方法

实际开发中（类似邮件功能）需要开发者私人密码的文件，可以采用以下方法进行隐私保护。**请在命令行中使用**。

    // 假设文件无改动，作用于版本库中已存在的文件。
    // 此方法将确保本地文件不提交，并且版本库中此文件的变更无法影响本地文件。
    git update-index --assume-unchanged app/config/mail.php
    // 取消并恢复为普通文件
    git update-index --no-assume-unchanged app/config/mail.php