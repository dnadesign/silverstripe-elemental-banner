<?php

namespace DNADesign\ElementalBanner\Controllers;

use DNADesign\Elemental\Controllers\ElementController;
use SilverStripe\View\Requirements;

class ElementBannerController extends ElementController
{
  public function init()
  {
    parent::init();

    Requirements::css('dnadesign/silverstripe-elemental-banner:client/css/elemental-banner.css');
  }
}
