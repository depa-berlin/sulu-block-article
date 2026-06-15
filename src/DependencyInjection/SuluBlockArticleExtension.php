<?php

declare(strict_types=1);

namespace Depa\SuluBlockArticleBundle\DependencyInjection;

use Depa\SuluBlockHelperBundle\DependencyInjection\AbstractBlockExtension;

class SuluBlockArticleExtension extends AbstractBlockExtension
{
    protected function getBundleName(): string
    {
        return 'SuluBlockArticleBundle';
    }

    protected function getPackageName(): string
    {
        return 'depa/sulu-block-article';
    }

    protected function getMetadataParameterName(): string
    {
        return 'sulu_block_article.bundle_metadata';
    }

    protected function getSuluAdminTemplateKey(): string
    {
        return 'sulu_block_article';
    }
}
