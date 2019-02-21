<div class="element-banner__image">
  $BannerImage
</div>

<div class="element-banner__content {$TextAlignment.LowerCase}">
  <div class="element-banner__container">
    <% if $Title && $ShowTitle %>
      <h1 class="element-banner__title">{$Title}</h1>
    <% end_if %>

    <% if $Content %>
      <div class="element-banner__text">
        {$Content.RAW}
      </div>
    <% end_if %>

    <% if $BannerLink %>
      <% with $BannerLink %>
        {$renderWith('DNADesign\ElementalBanner\Models\BannerLink')}
      <% end_with %>
    <% end_if %>
  </div>
</div>
