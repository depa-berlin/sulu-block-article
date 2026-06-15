# sulu-block-article

Article block collection for Sulu CMS — 12 structured content blocks designed for article and long-form text layouts.

## Included Blocks

| Block | Description |
|---|---|
| `block--article-h1` | Article main heading (H1) |
| `block--article-h2` | Article section heading (H2) |
| `block--article-h3` | Article subsection heading (H3) |
| `block--article-html` | Raw HTML block for article content |
| `block--article-alert` | Alert/callout box |
| `block--article-blockquote` | Styled blockquote |
| `block--article-image-full` | Full-width article image |
| `block--article-image-half` | Half-width article image |
| `block--article-list` | Article list container |
| `block--article-list-item` | List item (child of article-list) |
| `block--article-col-6-6` | Two-column layout (50/50) |
| `block--article-toc` | Table of contents block |

## Requirements

- PHP 8.2+
- Symfony 7.0+
- Sulu CMS 3.0+
- `depa/sulu-block-helper`

## Installation

```bash
composer require depa/sulu-block-article
```

Register in `config/bundles.php`:

```php
Depa\SuluBlockHelperBundle\SuluBlockHelperBundle::class  => ['all' => true],
Depa\SuluBlockArticleBundle\SuluBlockArticleBundle::class => ['all' => true],
```

## License

Proprietary — Copyright (c) depa Berlin GmbH & Co. KG. All rights reserved.
See [LICENSE](LICENSE) for details.
