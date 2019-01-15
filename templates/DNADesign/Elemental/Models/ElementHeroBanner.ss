<div class="hero-image">
  $BannerImage
</div>

<div class="hero-content {$TextPosition.LowerCase}">
  <div class="wrapper">
    <div class="hero-content-inner">
      <% if $Title && $ShowTitle && $TitleLevel %>
        <div class="hero-title">
          <$TitleLevel class="hero-header">$Title</$TitleLevel>
        </div>
      <% end_if %>

      <% if $Content %>
        <div class="hero-text">
          $Content.RAW
        </div>
      <% end_if %>

      <% if $BannerLink %>
        <div class="hero-link">
          $BannerLink
        </div>
      <% end_if %>
    </div>
  </div>
</div>
