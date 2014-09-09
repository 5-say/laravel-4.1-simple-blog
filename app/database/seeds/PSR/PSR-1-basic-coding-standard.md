基本代码规范
=====================

本节标准包含了成为标准代码所需要的基本元素，以确保开源出来的PHP代码之间有较高度的技术互用性。

在 [RFC 2119][]中的特性关键词"必须"(MUST)，“不可”(MUST NOT)，“必要”(REQUIRED)，“将会”(SHALL)，“不会”(SHALL NOT)，“应当”(SHOULD)，“不应”(SHOULD NOT)，“推荐”(RECOMMENDED)，“可以”(MAY)和“可选”(OPTIONAL)在这文档中将被用来描述。

[RFC 2119]: http://www.ietf.org/rfc/rfc2119.txt
[PSR-0]: https://github.com/hfcorriez/fig-standards/blob/zh_CN/接受/PSR-0.md


1. 大纲
-----------

- 源文件`必须`只使用 `<?php` 和 `<?=` 标签。

- 源文件中`必须`只使用不带BOM的UTF-8作为PHP代码。

- 源文件`应当`只声明符号（类，函数，常量等...）或者引起副作用（例如：生成输出，修改.ini配置等）,但`不应`同时做这两件事。

- 命名空间和类`必须`遵守 [PSR-0][]。

- 类名`必须`使用骆驼式`StudlyCaps`写法 (译者注：驼峰式的一种变种，后文将直接用`StudlyCaps`表示)。

- 类中的常量`必须`使用全大写和下划线分隔符。

- 方法名`必须`使用驼峰式`cameCase`写法(译者注：后文将直接用`camelCase`表示)。


2. 文件
--------

### 2.1. PHP标签

PHP代码`必须`只使用长标签`<?php ?>`或者短输出式`<?= ?>`标签；它`不可`使用其他的标签变种。

### 2.2. 字符编码

PHP代码`必须`只使用不带BOM的UTF-8。

### 2.3. 副作用

一个文件`应当`声明新符号 (类名，函数名，常量等)并且不产生副作用，或者`应当`执行有副作用的逻辑，但不能同时做这两件事。

短语"副作用"意思是不直接执行逻辑的类，函数，常量等 *仅包括文件*

“副作用”包含但不局限于：生成输出，显式地使用`require`或`include`，连接外部服务，修改ini配置，触发错误或异常，修改全局或者静态变量，读取或修改文件等等

下面是一个既包含声明又有副作用的示例文件；即应避免的例子：

```php
<?php
// side effect: change ini settings
ini_set('error_reporting', E_ALL);

// side effect: loads a file
include "file.php";

// side effect: generates output
echo "<html>\n";

// declaration
function foo()
{
    // function body
}
```

下面是一个仅包含声明的示例文件；即需要提倡的例子：

```php
<?php
// declaration
function foo()
{
    // function body
}

// conditional declaration is *not* a side effect
if (! function_exists('bar')) {
    function bar()
    {
        // function body
    }
}
```


3. 命名空间和类名
----------------------------

命名空间和类名必须遵守 [PSR-0][].

这意味着每个类必须单独一个源文件，并且至少有一级命名空间：顶级的组织名。

类名必须使用骆驼式`StudlyCaps`写法。

PHP5.3之后的代码`必须`使用正式的命名空间
例子：

```php
<?php
// PHP 5.3 and later:
namespace Vendor\Model;

class Foo
{
}
```

PHP5.2.x之前的代码应当用伪命名空间`Vendor_`作为类名的前缀

```php
<?php
// PHP 5.2.x and earlier:
class Vendor_Model_Foo
{
}
```

4. 类常量，属性和方法
-------------------------------------------

术语“类”指所有的类，接口和特性(traits)

### 4.1. 常量

类常量`必须`使用全大写，并使用分隔符作为下划线。
例子：

```php
<?php
namespace Vendor\Model;

class Foo
{
    const VERSION = '1.0';
    const DATE_APPROVED = '2012-06-01';
}
```

### 4.2. 属性

本手册有意避免推荐使用`$StulyCaps`，`$camelCase`或者`unser_score`作为属性名字

不管名称如何约定，它`应当`在一个合理范围内保持一致。这个范围可能是组织层，包层，类层，方法层。

### 4.3. 方法

方法名必须用`camelCase()`写法。
