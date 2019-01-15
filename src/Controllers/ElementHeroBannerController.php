<?php

namespace DNADesign\Elemental\Controllers;

use SilverStripe\View\Requirements;

class ElementHeroBannerController extends ElementController
{
  public function init()
  {
    parent::init();

    Requirements::css('dnadesign/silverstripe-elemental-carbon-hero-banner:client/css/elemental-carbon-hero-banner.css');
  }
}
