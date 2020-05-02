@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ config('app.url') }}/sitemap.xml/items</loc>
    </sitemap>
    <sitemap>
        <loc>{{ config('app.url') }}/sitemap.xml/categories</loc>
    </sitemap>
    <sitemap>
        <loc>{{ config('app.url') }}/sitemap.xml/tags</loc>
    </sitemap>
    <sitemap>
        <loc>{{ config('app.url') }}/sitemap.xml/pages</loc>
    </sitemap>
</sitemapindex>