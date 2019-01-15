<?php

namespace DNADesign\Elemental\Models;

use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use Silverstripe\Forms\DropdownField;
use SilverShop\HasOneField\HasOneButtonField;
use DNADesign\Images\Models\MultipleSizeImage;
use DNADesign\Elemental\Controllers\ElementHeroBannerController;
use gorriecoe\Link\Models\Link;

class ElementHeroBanner extends BaseElement
{
  private static $table_name = 'ElementHeroBanner';

  private static $singular_name = 'hero banner';

  private static $plural_name = 'hero banners';

  private static $description = 'Full width image with optional title';

  private static $controller_class = ElementHeroBannerController::class;

  private static $db = [
    'TitleLevel' => "Enum('h1, h2, h3, h4, h5, h6')",
    'Content' => 'HTMLText',
    'TextPosition' => "Enum('Left, Center, Right')",
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

    $position = $fields->dataFieldByName('TextPosition');
    $position->setDescription('Text is centred on small devices. Position affects only wide screens.');

    // Need to be able to add line break in the title
    $title = TextareaField::create('Title', 'Title');
    $fields->replaceField('Title', $title);

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

  public function getSimpleClassName()
  {
    return 'element-hero-banner';
  }
}
