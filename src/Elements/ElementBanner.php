<?php

namespace DNADesign\ElementalBanner\Models;

use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use Silverstripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use SilverShop\HasOneField\HasOneButtonField;
use DNADesign\Images\Models\MultipleSizeImage;
use DNADesign\ElementalBanner\Controllers\ElementBannerController;
use gorriecoe\Link\Models\Link;

class ElementBanner extends BaseElement
{
  private static $table_name = 'DNADesign_ElementBanner';

  private static $singular_name = 'banner';

  private static $plural_name = 'banners';

  private static $description = 'Full width image with optional title';

  private static $icon = 'font-icon-block-banner';

  private static $controller_class = ElementBannerController::class;

  private static $db = [
    'Content' => 'Text',
    'TextAlignment' => "Enum('Left, Center, Right')",
  ];

  private static $has_one = [
    'BannerImage' => MultipleSizeImage::class,
    'BannerLink' => Link::class
  ];

  private static $defaults = [
    'ShowTitle' => true
  ];

  public function getCMsFields()
  {
    $fields = parent::getCMSFields();

    // Need to be able to add line break in the title
    $fields->replaceField('Title', TextareaField::create('Title', 'Title')->setRows(2));

    // Content
    $content = $fields->dataFieldByname('Content');
    $content->setRows(3);

    // Link
    $fields->removeByName('BannerLinkID');
    $link = HasOneButtonField::create($this, 'BannerLink');
    $fields->addFieldToTab('Root.Main', $link);

    // Use the has_one field instead of a dropdown
    $fields->removeByName('BannerImageID');
    $bannerImage = HasOneButtonField::create($this, 'BannerImage');
    $fields->addFieldToTab('Root.Main', $bannerImage);

    return $fields;
  }

  public function onBeforeWrite()
  {
    parent::onBeforeWrite();

    if (!$this->BannerImage()->exists()) {
      $image = new MultipleSizeImage();
      $image->Name = "Image for banner " . $this->Title;
      $image->write();

      $this->BannerImageID = $image->ID;
    }
  }

  public function getType() {
    return "Banner";
  }

  public function getSimpleClassName()
  {
    return 'element-banner';
  }
}
