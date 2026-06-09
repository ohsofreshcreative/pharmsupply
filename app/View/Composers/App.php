<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'*', // działa globalnie
	];

	/**
	 * Dane dostępne we wszystkich widokach Blade.
	 */
	public function with(): array
	{
		return [
			'siteName' => $this->siteName(),
			'logo' => \get_field('logo', 'option'),
			'logo_footer' => \get_field('logo_footer', 'option'),
			'breadcrumbs' => $this->breadcrumbs(),
		];
	}

	/**
	 * Zwraca nazwę strony.
	 */
	public function siteName(): string
	{
		return \get_bloginfo('name', 'display');
	}

	public function breadcrumbs(): string
	{
		if (\is_front_page() || \is_home()) {
			return '';
		}

		if (\function_exists('yoast_breadcrumb')) {
			return \yoast_breadcrumb('<nav id="breadcrumbs" aria-label="Breadcrumbs">', '</nav>', false) ?: '';
		}

		if (\function_exists('woocommerce_breadcrumb') && (\is_woocommerce() || \is_product() || \is_product_taxonomy() || \is_cart() || \is_checkout())) {
			return \woocommerce_breadcrumb([
				'wrap_before' => '<nav class="woocommerce-breadcrumb" aria-label="Breadcrumbs">',
				'wrap_after' => '</nav>',
				'echo' => false,
			]) ?: '';
		}

		$items = [
			[
				'label' => \__('Home', 'sage'),
				'url' => \home_url('/'),
			],
		];

		if (\is_page()) {
			$pageId = \get_queried_object_id();
			$ancestors = \array_reverse(\get_post_ancestors($pageId));

			foreach ($ancestors as $ancestorId) {
				$items[] = [
					'label' => \get_the_title($ancestorId),
					'url' => \get_permalink($ancestorId),
				];
			}

			$items[] = [
				'label' => \get_the_title($pageId),
				'url' => null,
			];
		} elseif (\is_singular()) {
			$postId = \get_queried_object_id();
			$postType = \get_post_type($postId);

			if ($postType === 'post') {
				$pageForPosts = (int) \get_option('page_for_posts');

				if ($pageForPosts) {
					$items[] = [
						'label' => \get_the_title($pageForPosts),
						'url' => \get_permalink($pageForPosts),
					];
				}
			}

			if ($postType && $postType !== 'post') {
				$postTypeObject = \get_post_type_object($postType);

				if ($postTypeObject?->has_archive) {
					$items[] = [
						'label' => $postTypeObject->labels->name,
						'url' => \get_post_type_archive_link($postType),
					];
				}
			}

			$termContext = $postType ? $this->resolveBreadcrumbTerm($postId, $postType) : null;

			if (!empty($termContext)) {
				$this->appendTermItems($items, $termContext['term'], $termContext['taxonomy']);
			}

			$items[] = [
				'label' => \get_the_title($postId),
				'url' => null,
			];
		} elseif (\is_category() || \is_tag() || \is_tax()) {
			$term = \get_queried_object();
			$taxonomy = $term->taxonomy ?? null;

			if ($term && $taxonomy) {
				$this->appendTaxonomyArchiveItem($items, $taxonomy);
				$this->appendTermItems($items, $term, $taxonomy, true);
			}
		} elseif (\is_post_type_archive()) {
			$items[] = [
				'label' => \post_type_archive_title('', false),
				'url' => null,
			];
		} elseif (\is_search()) {
			$items[] = [
				'label' => \sprintf(\__('Search results for: %s', 'sage'), \get_search_query()),
				'url' => null,
			];
		} elseif (\is_404()) {
			$items[] = [
				'label' => \__('404', 'sage'),
				'url' => null,
			];
		} elseif (\is_archive()) {
			$items[] = [
				'label' => \get_the_archive_title(),
				'url' => null,
			];
		}

		return count($items) > 1 ? $this->renderBreadcrumbs($items) : '';
	}

	protected function renderBreadcrumbs(array $items): string
	{
		$breadcrumbs = '<nav id="breadcrumbs" aria-label="Breadcrumbs">';

		foreach ($items as $index => $item) {
			$isLast = $index === \array_key_last($items);
			$label = \esc_html($item['label']);

			if (!$isLast && !empty($item['url'])) {
				$breadcrumbs .= '<a href="' . \esc_url($item['url']) . '">' . $label . '</a>';
			} else {
				$breadcrumbs .= '<span>' . $label . '</span>';
			}

			if (!$isLast) {
				$breadcrumbs .= '<span class="__separator">&bull;</span>';
			}
		}

		$breadcrumbs .= '</nav>';

		return $breadcrumbs;
	}

	protected function appendTermItems(array &$items, $term, string $taxonomy, bool $isCurrent = false): void
	{
		if (!$term || \is_wp_error($term)) {
			return;
		}

		$ancestorIds = \array_reverse(\get_ancestors($term->term_id, $taxonomy, 'taxonomy'));

		foreach ($ancestorIds as $ancestorId) {
			$ancestor = \get_term($ancestorId, $taxonomy);

			if ($ancestor && !\is_wp_error($ancestor)) {
				$items[] = [
					'label' => $ancestor->name,
					'url' => \get_term_link($ancestor),
				];
			}
		}

		$items[] = [
			'label' => $term->name,
			'url' => $isCurrent ? null : \get_term_link($term),
		];
	}

	protected function resolveBreadcrumbTerm(int $postId, string $postType): ?array
	{
		$taxonomyCandidates = [];

		if ($postType === 'post') {
			$taxonomyCandidates[] = 'category';
		}

		$preferredTaxonomies = [
			$postType . '_category',
			$postType . '_cat',
			'category',
			'product_category',
			'product_cat',
		];

		foreach ($preferredTaxonomies as $taxonomy) {
			if (\taxonomy_exists($taxonomy) && \is_object_in_taxonomy($postType, $taxonomy)) {
				$taxonomyCandidates[] = $taxonomy;
			}
		}

		foreach (\get_object_taxonomies($postType, 'objects') as $taxonomy => $taxonomyObject) {
			if (!$taxonomyObject->public || !$taxonomyObject->hierarchical) {
				continue;
			}

			if (\in_array($taxonomy, ['post_format', 'product_visibility'], true)) {
				continue;
			}

			$taxonomyCandidates[] = $taxonomy;
		}

		$taxonomyCandidates = \array_values(\array_unique($taxonomyCandidates));

		foreach ($taxonomyCandidates as $taxonomy) {
			$terms = \get_the_terms($postId, $taxonomy);

			if (empty($terms) || \is_wp_error($terms)) {
				continue;
			}

			\usort($terms, function ($left, $right) use ($taxonomy) {
				return \count(\get_ancestors($right->term_id, $taxonomy, 'taxonomy')) <=> \count(\get_ancestors($left->term_id, $taxonomy, 'taxonomy'));
			});

			$term = $terms[0];

			if ($postType !== 'post') {
				$ancestorIds = \get_ancestors($term->term_id, $taxonomy, 'taxonomy');
				$topLevelTermId = !empty($ancestorIds) ? \end($ancestorIds) : $term->term_id;
				$topLevelTerm = \get_term($topLevelTermId, $taxonomy);

				if ($topLevelTerm && !\is_wp_error($topLevelTerm)) {
					$term = $topLevelTerm;
				}
			}

			return [
				'taxonomy' => $taxonomy,
				'term' => $term,
			];
		}

		return null;
	}

	protected function appendTaxonomyArchiveItem(array &$items, string $taxonomy): void
	{
		$taxonomyObject = \get_taxonomy($taxonomy);

		if (!$taxonomyObject || empty($taxonomyObject->object_type)) {
			return;
		}

		foreach ($taxonomyObject->object_type as $objectType) {
			$postTypeObject = \get_post_type_object($objectType);

			if ($postTypeObject?->has_archive) {
				$items[] = [
					'label' => $postTypeObject->labels->name,
					'url' => \get_post_type_archive_link($objectType),
				];
				return;
			}
		}

		if ($taxonomy === 'category') {
			$pageForPosts = (int) \get_option('page_for_posts');

			if ($pageForPosts) {
				$items[] = [
					'label' => \get_the_title($pageForPosts),
					'url' => \get_permalink($pageForPosts),
				];
			}
		}
	}
}
