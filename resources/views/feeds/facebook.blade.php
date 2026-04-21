@php echo '<' . '?xml version="1.0" encoding="UTF-8"?' . '>'; @endphp
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
  <channel>
    <title>Catalogo Doomine</title>
    <link>https://doomine.com/</link>
    <description>Feed dinámico de productos</description>
    @foreach ($items as $item)
      <item>
        <g:id>{{ $item->id }}</g:id>
        <g:title>
          <![CDATA[{{ $item->title }}]]>
        </g:title>
        <g:description>
          <![CDATA[{{ $item->description }}]]>
        </g:description>
        <g:link>{{ $item->link }}</g:link>
        <g:image_link>{{ $item->image_link }}</g:image_link>
        <g:brand>{{ $item->brand }}</g:brand>
        <g:condition>new</g:condition>
        <g:availability>in stock</g:availability>
        <g:price>{{ $item->price }}</g:price>
      </item>
    @endforeach
  </channel>
</rss>
