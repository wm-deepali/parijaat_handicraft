<?php

namespace Database\Seeders;

use App\Models\SeoPage;
use Illuminate\Database\Seeder;

class SeoPageSeeder extends Seeder
{
    public function run(): void
    {
        $siteSchema = json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    'name' => '{site}',
                    'url' => '{url}',
                ],
                [
                    '@type' => 'WebSite',
                    'name' => '{site}',
                    'url' => '{url}',
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => '{url}/products?q={search_term_string}',
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES);

        $noindex = 'noindex, nofollow';

        $pages = [
            // ───────── Main ─────────
            [
                'page_key' => 'home', 'page_name' => 'Home', 'page_group' => 'Main', 'slug' => '/',
                'meta_title' => 'Handcrafted Brass & Copper Decor | {site}',
                'meta_description' => 'Shop handcrafted brass decor, pooja essentials, copper drinkware and gifts made by Indian artisans. Worldwide shipping and bulk orders available.',
                'schema_markup' => $siteSchema,
                'in_sitemap' => true, 'sitemap_priority' => 1.0, 'sitemap_changefreq' => 'daily',
            ],
            [
                'page_key' => 'about', 'page_name' => 'About Us', 'page_group' => 'Main', 'slug' => '/about',
                'meta_title' => 'About Our Story & Artisans | {site}',
                'meta_description' => 'Discover the story, artisans and traditional techniques behind our handcrafted brass and copper pieces.',
                'in_sitemap' => true, 'sitemap_priority' => 0.6, 'sitemap_changefreq' => 'monthly',
            ],
            [
                'page_key' => 'contact', 'page_name' => 'Contact Us', 'page_group' => 'Main', 'slug' => '/contact',
                'meta_title' => 'Contact Us | {site}',
                'meta_description' => 'Get in touch with our team for orders, shipping, bulk enquiries and support. We reply within 1–2 business days.',
                'in_sitemap' => true, 'sitemap_priority' => 0.6, 'sitemap_changefreq' => 'monthly',
            ],
            [
                'page_key' => 'certifications', 'page_name' => 'Certifications', 'page_group' => 'Main', 'slug' => '/certifications',
                'meta_title' => 'Certifications & Quality Standards | {site}',
                'meta_description' => 'View our certifications and quality standards that back every handcrafted product we ship.',
                'in_sitemap' => true, 'sitemap_priority' => 0.4, 'sitemap_changefreq' => 'yearly',
            ],

            // ───────── Shop ─────────
            [
                'page_key' => 'products', 'page_name' => 'All Products', 'page_group' => 'Shop', 'slug' => '/products',
                'meta_title' => 'Shop Brass & Copper Handicrafts | {site}',
                'meta_description' => 'Browse our full collection of handcrafted brass, copper and metal handicrafts. Filter by category, occasion, price and material.',
                'in_sitemap' => true, 'sitemap_priority' => 0.9, 'sitemap_changefreq' => 'daily',
            ],
            [
                'page_key' => 'category.show', 'page_name' => 'Category Page (default)', 'page_group' => 'Shop', 'slug' => '/category/{slug}',
                'meta_title' => 'Shop Handcrafted Collections | {site}',
                'meta_description' => 'Explore handcrafted pieces made by Indian artisans. Authentic craftsmanship with worldwide shipping.',
                'in_sitemap' => false, 'sitemap_priority' => 0.8, 'sitemap_changefreq' => 'weekly',
            ],
            [
                'page_key' => 'product.show', 'page_name' => 'Product Page (default)', 'page_group' => 'Shop', 'slug' => '/product/{slug}',
                'meta_title' => 'Handcrafted Product | {site}',
                'meta_description' => 'Authentic handcrafted product made by Indian artisans. Secure checkout and worldwide shipping.',
                'og_type' => 'product',
                'in_sitemap' => false, 'sitemap_priority' => 0.8, 'sitemap_changefreq' => 'weekly',
            ],
            [
                'page_key' => 'cart', 'page_name' => 'Cart', 'page_group' => 'Shop', 'slug' => '/cart',
                'meta_title' => 'Shopping Cart | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],
            [
                'page_key' => 'checkout', 'page_name' => 'Checkout', 'page_group' => 'Shop', 'slug' => '/checkout',
                'meta_title' => 'Checkout | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],
            [
                'page_key' => 'payment', 'page_name' => 'Payment', 'page_group' => 'Shop', 'slug' => '/payment',
                'meta_title' => 'Payment | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],
            [
                'page_key' => 'order.success', 'page_name' => 'Order Success', 'page_group' => 'Shop', 'slug' => '/order-success/{order}',
                'meta_title' => 'Order Confirmed | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],

            // ───────── Content ─────────
            [
                'page_key' => 'blogs', 'page_name' => 'Blog Listing', 'page_group' => 'Content', 'slug' => '/blogs',
                'meta_title' => 'Handicraft Stories & Care Tips | {site}',
                'meta_description' => 'Read stories behind our crafts, styling ideas and care tips for brass and copper pieces.',
                'in_sitemap' => true, 'sitemap_priority' => 0.7, 'sitemap_changefreq' => 'weekly',
            ],
            [
                'page_key' => 'blog.show', 'page_name' => 'Blog Post (default)', 'page_group' => 'Content', 'slug' => '/blog/{slug}',
                'meta_title' => 'Blog | {site}',
                'meta_description' => 'Stories, styling ideas and care tips from our handicraft journal.',
                'og_type' => 'article',
                'in_sitemap' => false, 'sitemap_priority' => 0.6, 'sitemap_changefreq' => 'monthly',
            ],
            [
                'page_key' => 'faqs', 'page_name' => 'FAQs', 'page_group' => 'Content', 'slug' => '/faqs',
                'meta_title' => 'Frequently Asked Questions | {site}',
                'meta_description' => 'Answers to common questions about orders, shipping, returns, payments and caring for handcrafted products.',
                'in_sitemap' => true, 'sitemap_priority' => 0.5, 'sitemap_changefreq' => 'monthly',
            ],
            [
                'page_key' => 'page.show', 'page_name' => 'Policy / Dynamic Page (default)', 'page_group' => 'Content', 'slug' => '/page/{slug}',
                'meta_title' => 'Information | {site}',
                'meta_description' => 'Policies and information about shopping with us.',
                'in_sitemap' => false, 'sitemap_priority' => 0.3, 'sitemap_changefreq' => 'yearly',
            ],

            // ───────── Account (never indexed) ─────────
            [
                'page_key' => 'dashboard', 'page_name' => 'My Account', 'page_group' => 'Account', 'slug' => '/dashboard',
                'meta_title' => 'My Account | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],
            [
                'page_key' => 'user.login', 'page_name' => 'Login', 'page_group' => 'Account', 'slug' => '/user/login',
                'meta_title' => 'Login | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],
            [
                'page_key' => 'user.register', 'page_name' => 'Create Account', 'page_group' => 'Account', 'slug' => '/user/register',
                'meta_title' => 'Create Account | {site}', 'robots' => $noindex, 'in_sitemap' => false,
            ],
        ];

        foreach ($pages as $row) {
            SeoPage::firstOrCreate(['page_key' => $row['page_key']], $row + ['is_active' => true]);
        }
    }
}