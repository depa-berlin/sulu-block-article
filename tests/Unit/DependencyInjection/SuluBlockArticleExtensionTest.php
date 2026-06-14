<?php

declare(strict_types=1);

namespace Depa\SuluBlockArticleBundle\Tests\Unit\DependencyInjection;

use Depa\SuluBlockArticleBundle\DependencyInjection\SuluBlockArticleExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SuluBlockArticleExtensionTest extends TestCase
{
    private ContainerBuilder $container;
    private SuluBlockArticleExtension $extension;

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->extension = new SuluBlockArticleExtension();
    }

    public function testLoadSetsBundleMetadataParameter(): void
    {
        $this->extension->load([], $this->container);
        self::assertTrue($this->container->hasParameter('sulu_block_article.bundle_metadata'));
    }

    public function testBundleMetadataHasRequiredKeys(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);
        self::assertArrayHasKey('bundle', $meta);
        self::assertArrayHasKey('package', $meta);
        self::assertArrayHasKey('blocks', $meta);
        self::assertArrayHasKey('children', $meta);
    }

    public function testBundleMetadataContainsCorrectBundleName(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);
        self::assertSame('SuluBlockArticleBundle', $meta['bundle']);
    }

    public function testBundleMetadataContainsCorrectPackageName(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);
        self::assertSame('depa-berlin/sulu-block-article', $meta['package']);
    }

    public function testBundleMetadataContainsAtLeastOneBlock(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);
        self::assertNotEmpty($meta['blocks']);
    }

    public function testBlocksAreSortedAndUnique(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);
        $blocks = $meta['blocks'];
        $sorted = $blocks;
        sort($sorted);
        self::assertSame($sorted, $blocks, 'blocks must be sorted');
        self::assertSame(array_unique($blocks), $blocks, 'blocks must be unique');
    }

    public function testKnownArticleBlocksArePresent(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);

        foreach ([
            'block--article-alert',
            'block--article-blockquote',
            'block--article-h1',
            'block--article-h2',
            'block--article-h3',
            'block--article-html',
            'block--article-image-full',
            'block--article-image-half',
            'block--article-list',
            'block--article-list-item',
            'block--article-toc',
        ] as $expected) {
            self::assertContains($expected, $meta['blocks']);
        }
    }

    public function testChildrenValuesAreArraysOfStrings(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);

        foreach ($meta['children'] as $parent => $kids) {
            self::assertIsArray($kids, "Children of '{$parent}' must be an array");
            foreach ($kids as $child) {
                self::assertIsString($child);
            }
        }
    }

    public function testArticleListHasListItemAsChild(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_article.bundle_metadata');
        self::assertIsArray($meta);

        self::assertArrayHasKey('block--article-list', $meta['children']);
        self::assertContains('block--article-list-item', $meta['children']['block--article-list']);
    }
}
