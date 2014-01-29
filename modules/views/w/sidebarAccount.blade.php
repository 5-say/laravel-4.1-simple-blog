<?php
$is_active = function($name='') use($active)
{
    if ($active===$name)
        return ' active';
    else
        return '';
}
?>

<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <div class="list-group">
        <span class="list-group-item">
            <a href="" class="thumbnail" style="width:128px;margin:0 auto;">
                <img width="128" height="128" src="..." alt="...">
            </a>
        </span>
        <a href="" class="list-group-item{{ $is_active('info') }}">账号信息</a>
        <a href="{{ route('changePassword') }}" class="list-group-item{{ $is_active('changePassword') }}">修改密码</a>
        <a href="" class="list-group-item{{ $is_active('comments') }}">我的评论</a>
        <a href="" class="list-group-item{{ $is_active('favorite') }}">我的收藏</a>
    </div>
</div>