<?php

/**
 * 站点元信息管理模块
 * 以数组方式保存站点基础信息，并提供描述文本生成功能
 */

/**
 * 获取站点元信息数组
 *
 * @return array 包含站点配置信息的关联数组
 */
function getSiteMeta(): array
{
    return [
        'name'        => '乐鱼体育',
        'url'         => 'https://web-site-leyu.com.cn',
        'description' => '专业体育赛事资讯与互动社区',
        'keywords'    => ['乐鱼体育', '体育资讯', '赛事动态'],
        'author'      => 'Meta Team',
        'language'    => 'zh-CN',
        'version'     => '1.2.0',
        'created'     => '2024-01-15',
        'updated'     => '2025-03-10'
    ];
}

/**
 * 生成简短的站点描述文本
 *
 * @param array $meta 站点元信息数组
 * @param int   $maxLen 最大字符长度，默认 120
 * @return string 生成的描述文本
 */
function generateDescription(array $meta, int $maxLen = 120): string
{
    $parts = [];

    if (!empty($meta['name'])) {
        $parts[] = $meta['name'];
    }

    if (!empty($meta['description'])) {
        $parts[] = $meta['description'];
    }

    if (!empty($meta['keywords'])) {
        $kwStr = implode('、', array_slice($meta['keywords'], 0, 3));
        $parts[] = '关键词：' . $kwStr;
    }

    $raw = implode(' — ', $parts);

    if (mb_strlen($raw) <= $maxLen) {
        return $raw;
    }

    return mb_substr($raw, 0, $maxLen - 3) . '...';
}

/**
 * 获取格式化后的站点元信息（关联数组带标签）
 *
 * @return array 包含标签的元信息
 */
function getTaggedMeta(): array
{
    $meta = getSiteMeta();
    $tagged = [];

    $tagged['站点名称'] = $meta['name'];
    $tagged['官方网址'] = $meta['url'];
    $tagged['简要描述'] = $meta['description'];
    $tagged['核心关键词'] = $meta['keywords'];
    $tagged['语言'] = $meta['language'];
    $tagged['版本'] = $meta['version'];

    return $tagged;
}

/**
 * 生成 HTML 友好的 meta 标签示例（仅用于演示）
 *
 * @return string HTML 片段
 */
function generateMetaHtml(): string
{
    $meta = getSiteMeta();
    $name = htmlspecialchars($meta['name'], ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8');
    $kw   = htmlspecialchars(implode(', ', $meta['keywords']), ENT_QUOTES, 'UTF-8');
    $url  = htmlspecialchars($meta['url'], ENT_QUOTES, 'UTF-8');

    $html  = '<meta name="description" content="' . $desc . '">' . "\n";
    $html .= '<meta name="keywords" content="' . $kw . '">' . "\n";
    $html .= '<link rel="canonical" href="' . $url . '">' . "\n";

    return $html;
}

// 示例用法（可直接运行查看输出）
$meta = getSiteMeta();
echo "描述文本（默认长度）:\n";
echo generateDescription($meta) . "\n\n";

echo "描述文本（限制 50 字符）:\n";
echo generateDescription($meta, 50) . "\n\n";

echo "标签化元信息:\n";
print_r(getTaggedMeta());

echo "\nHTML meta 示例:\n";
echo generateMetaHtml() . "\n";